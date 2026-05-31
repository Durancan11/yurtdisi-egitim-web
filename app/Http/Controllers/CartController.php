<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Sepet Sayfası
     */
    public function index()
{
    // Sepet verisini session'dan veya veritabanından alıyorsan şu şekilde gönder:
    $cart = session()->get('cart', []); 
    
    // Toplam tutarı hesapla
    $total = 0;
    foreach($cart as $item) {
        $total += $item['price'];
    }

    // view'e bu değişkenleri gönderiyoruz
    return view('shop.cart', compact('cart', 'total'));
}

    /**
     * Sepete Ürün Ekle
     */
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            return back()->with('info', 'Bu eğitim paketi zaten sepetinizde bulunuyor.');
        }

        $cart[$id] = [
            "title" => $product->title,
            "price" => $product->price,
            "image" => $product->image
        ];

        session()->put('cart', $cart);
        return back()->with('success', 'Paket sepete eklendi! 🛒');
    }

    /**
     * Sepetten Ürün Çıkar
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('error', 'Ürün sepetten kaldırıldı.');
    }

    /**
     * Ödeme ve Sipariş Oluşturma
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $user = auth()->user();
        $total = array_sum(array_column($cart, 'price'));

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Sepetiniz boş olduğu için işlem yapılamadı.');
        }

        if ($user->balance < $total) {
            return back()->with('error', 'Yetersiz bakiye! İşlemi tamamlamak için ' . number_format($total - $user->balance, 2) . ' TL daha yüklemelisiniz.');
        }

        // Database Transaction (Mühendislik Garantisi: Ya hepsi kaydedilir ya hiçbiri)
        DB::transaction(function () use ($user, $total, $cart) {
            // 1. Bakiyeyi Düş
            $user->decrement('balance', $total);

            // 2. Siparişleri Oluştur
            foreach ($cart as $id => $details) {
                Order::create([
                    'user_id' => $user->id,
                    'product_id' => $id,
                    'price' => $details['price'],
                    'status' => 'approved', 
                    'status_level' => 1, 
                    'approved_at' => now(),
                    'shipping_stage' => 'basvuru alindi'
                ]);
            }

            // 3. Sepeti Temizle
            session()->forget('cart');
        });

        return view('shop.success', compact('total'));
    }
}