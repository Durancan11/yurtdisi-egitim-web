<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\BalanceRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Mağaza Ana Sayfası ve Canlı Döviz API Entegrasyonu
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('type');     // Menüdeki ?type=dil-okulu için
        $country = $request->input('country');   // Menüdeki ?country=polonya için

        $products = Product::where('is_active', true)
            ->when($search, function($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            })
            ->when($category, function($query, $category) {
                return $query->where('category', $category);
            })
            ->when($country, function($query, $country) {
                return $query->where('country', $country);
            })
            ->latest()
            ->get();

        try {
            $response = Http::get('https://open.er-api.com/v6/latest/TRY');
            $rates = $response->json()['rates'];
            $usd = round(1 / $rates['USD'], 2);
            $eur = round(1 / $rates['EUR'], 2);
        } catch (\Exception $e) {
            $usd = 32.85; 
            $eur = 35.60;
        }

        return view('shop.index', compact('products', 'usd', 'eur'));
    }

    public function show($id)
    {
        // Aktif olan ürünleri getirir, eğer ürün yoksa 404 hatası verir
        $product = Product::where('is_active', true)->findOrFail($id);
        
        // Bu ürünün detay sayfasını yükler
        return view('shop.show', compact('product'));
    }

    public function processOrder(Request $request)
    {
        // 1. Formdan gelen adres ve iletişim bilgilerini doğrulayalım
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $user = auth()->user();
        $cart = session()->get('cart', []);

        // Eğer sepet boşsa veya hata olduysa geri gönder
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Sepetiniz boş, ödeme yapılamaz.');
        }

        // 2. Toplam tutarı hesaplayalım
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'];
        }

        // 3. Kullanıcının bakiyesi yeterli mi kontrol edelim
        if ($user->balance < $total) {
            return back()->with('error', 'Bakiyeniz yetersiz! Lütfen önce bakiye yükleyiniz.');
        }

        // 4. VERİTABANI İŞLEMİ (Transaction) - Ya hepsi başarılı olur ya da hiçbiri!
        DB::transaction(function () use ($user, $cart, $total) {
            
            // A. Kullanıcının bakiyesinden parayı düş
            $user->decrement('balance', $total);

            // B. Sepetteki her ürün için sipariş oluştur ve stok düş
            foreach($cart as $id => $details) {
                
                // Stok düşme işlemi
                $product = \App\Models\Product::find($id);
                if($product) {
                    $product->decrement('stock', 1);
                }

                // Sipariş tablosuna yazma
                \App\Models\Order::create([
                    'user_id' => $user->id,
                    'product_id' => $id,
                    'price' => $details['price'],
                    'status' => 'pending',
                    'status_level' => 0,
                    'shipping_stage' => 'Sipariş Alındı, Hazırlanıyor'
                ]);
            }
        });

        // 5. İşlem bitti, sepeti boşalt!
        session()->forget('cart');

        // 6. Başarı mesajıyla birlikte siparişlerim sayfasına yönlendir
        return redirect()->route('shop.orders')->with('success', 'Ödemeniz başarıyla alındı ve siparişleriniz oluşturuldu! 🎉');
    }

    public function announcements()
    {
        // Aktif olan tüm duyuruları en yeniden eskiye doğru çeker
        $announcements = \App\Models\Announcement::where('is_active', true)->latest()->get();
        
        return view('announcements', compact('announcements'));
    }
public function checkout()
{
    // Kullanıcının sepetindeki toplam tutarı hesaplayalım
    $total = auth()->user()->orders()->where('status', 'pending')->sum('price');
    return view('shop.checkout', compact('total'));
}

    /**
     * İletişim Formu Taleplerini Kaydetme (YENİ EKLENDİ)
     */
    public function storeContact(Request $request)
    {
        // 1. Validasyon: message alanını zorunlu kıldık ve ekledik
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:50',
            'message' => 'required|string|max:1000', // Mesaj alanı burada!
        ]);

        // 2. Kayıt işlemi: message alanını diziye ekledik
        ContactMessage::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'message' => $validated['message'], // Veritabanına bu şekilde gidecek
            'status'  => 'bekliyor'
        ]);

        return back()->with('success', 'Mesajınız başarıyla iletildi, teşekkürler! 🚀');
    }

    /**
     * Direkt Satın Alma (Hızlı İşlem)
     */
    public function buy($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();

        if (!$product->is_active || $product->stock <= 0) {
            return back()->with('error', 'Bu paket şu anda kontenjan dışıdır.');
        }

        if ($user->balance < $product->price) {
            return back()->with('error', 'Yetersiz bakiye! Lütfen önce bakiye yükleyiniz.');
        }

        DB::transaction(function () use ($user, $product) {
            $user->decrement('balance', $product->price);
            $product->decrement('stock', 1);

            Order::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'price' => $product->price,
                'status' => 'pending',
                'status_level' => 0,
                'shipping_stage' => 'siparis alindi'
            ]);
        });

        return redirect()->route('shop.orders')->with('success', 'Siparişiniz başarıyla oluşturuldu! 🚀');
    }

    /**
     * Kullanıcının Siparişlerini Listeleme
     */
    public function orders()
    {
        $orders = auth()->user()->orders()->with('product')->latest()->get();
        return view('shop.orders', compact('orders'));
    }

    /**
     * Sipariş İptal ve Bakiyeye İade
     */
    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', auth()->id())
                      ->firstOrFail();
        
        if ($order->status_level == 0) {
            DB::transaction(function () use ($order) {
                auth()->user()->increment('balance', $order->price);
                $order->delete(); 
            });
            
            return back()->with('success', 'Sipariş iptal edildi ve ücret bakiyenize tanımlandı. 💰');
        }
        
        return back()->with('error', 'İşleme alınmış siparişler iptal edilemez.');
    }

    /**
     * "Ürünleri Teslim Aldım" Onayı
     */
    public function completeOrder($id)
    {
        $order = Order::where('id', $id)
                      ->where('user_id', auth()->id())
                      ->firstOrFail();

        if ($order->status_level == 5) {
            $order->status_level = 6; 
            $order->status = 'completed';
            $order->save();
            return back()->with('success', 'Süreci başarıyla sonlandırdınız. Hayırlı olsun! 🎓');
        }

        return back()->with('error', 'Sipariş henüz teslimat aşamasına gelmedi.');
    }

    public function depositForm()
    {
        return view('shop.deposit');
    }

    /**
     * Bakiye Yükleme Talebi
     */
    public function depositStore(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:10']);

        BalanceRequest::create([
            'user_id' => auth()->id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return redirect()->route('shop.index')->with('success', 'Bakiye yükleme talebiniz yöneticiye iletildi. ✨');
    }

    /**
     * PDF Fatura İndirme
     */
    public function downloadInvoice($id)
    {
        $order = Order::with(['user', 'product'])
                      ->where('user_id', auth()->id())
                      ->findOrFail($id);
                      
        $pdf = Pdf::loadView('shop.invoice', compact('order'));
        return $pdf->download('global_vizyon_fatura_' . $order->id . '.pdf');
    }
}