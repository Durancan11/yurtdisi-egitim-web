<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\BalanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    /**
     * Yönetim Paneli Özet Sayfası (Grafik ve İstatistikler)
     */
    public function index()
    {
        $userCount = User::where('role', 'user')->count();
        $productCount = Product::count();
        $pendingBalanceRequests = BalanceRequest::where('status', 'pending')->count();
        
        $totalEarnings = Order::where('status_level', '>', 0)->sum('price');
        $recentOrders = Order::with(['user', 'product'])->latest()->take(5)->get();

        $salesData = Order::selectRaw('DATE(created_at) as date, SUM(price) as total')
            ->where('status_level', '>', 0)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->take(7)
            ->get();

        $labels = $salesData->pluck('date');
        $data = $salesData->pluck('total');

        return view('admin.dashboard', compact(
            'userCount', 'productCount', 'pendingBalanceRequests',
            'totalEarnings', 'recentOrders', 'labels', 'data'
        ));
    }

    /**
     * KULLANICI YÖNETİMİ
     */
    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'balance' => 'required|numeric|min:0',
        ]);

        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı bilgileri güncellendi.');
    }

    /**
     * SİPARİŞ YÖNETİMİ
     */
    public function orders()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function nextStep($id)
    {
        $order = Order::findOrFail($id);
        if ($order->status_level < 5) {
            $order->increment('status_level');
            if ($order->status_level == 1) { 
                $order->update(['status' => 'approved']); 
            }
        }
        return back()->with('success', 'Sipariş süreci bir adım ilerletildi.');
    }

    /**
     * BAKİYE TALEPLERİ
     */
    public function balanceRequests()
    {
        $requests = BalanceRequest::with('user')->where('status', 'pending')->latest()->get();
        return view('admin.users.balance_requests', compact('requests'));
    }

    public function approveBalance($id)
    {
        $request = BalanceRequest::findOrFail($id);
        $user = $request->user;
        
        DB::transaction(function () use ($user, $request) {
            $user->increment('balance', $request->amount);
            $request->update(['status' => 'approved']);
        });

        return back()->with('success', 'Bakiye onaylandı ve kullanıcıya tanımlandı.');
    }

    /**
     * ÜRÜN YÖNETİMİ (CRUD)
     */
    public function products()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->merge(['is_active' => $request->has('is_active') ? 1 : 0]);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'stock' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'category' => 'required|string',
            'country' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Harika! Yeni paket sisteme eklendi. 🚀');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->merge(['is_active' => $request->has('is_active') ? 1 : 0]);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'is_active' => 'required|boolean',
            'category' => 'required|string',
            'country' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Paket başarıyla güncellendi! ✨');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Paket sistemden kaldırıldı.');
    }

    /**
     * GÜVENLİK VE DURUM
     */
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = ($user->status == 'active') ? 'passive' : 'active';
        $user->save();
        return back()->with('success', 'Kullanıcı durumu güncellendi.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) { 
            return back()->with('error', 'Kendi hesabınızı silemezsiniz!'); 
        }
        $user->delete();
        return back()->with('success', 'Kullanıcı sistemden kaldırıldı.');
    }

    public function contacts()
    {
        $messages = ContactMessage::latest()->get();
        return view('admin.contacts.index', compact('messages'));
    }

    public function markContactRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'okundu']);
        return back()->with('success', 'Mesaj okundu olarak işaretlendi.');
    }

public function replyContact(Request $request, $id)
    {
        try {
            $message = ContactMessage::findOrFail($id); 
            
            $cevap = $request->admin_reply ?? $request->message ?? $request->reply ?? 'Bir yanıt gönderildi.';

            $message->admin_reply = $cevap;
            
            $message->status = 'okundu'; 
            $message->save();

            return back()->with('success', 'Yanıtınız başarıyla kaydedildi! 🚀');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Hata: ' . $e->getMessage());
        }
    }
    /**
     * Duyuruları Listeleme
     */
    public function announcements()
    {
        $announcements = \App\Models\Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Yeni Duyuru Kaydetme
     */
    public function storeAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string|in:indigo,rose,emerald,amber',
        ]);

        \App\Models\Announcement::create($validated);

        return back()->with('success', 'Duyuru başarıyla yayına alındı! 📢');
    }

    /**
     * Duyuru Güncelleme
     */
    public function updateAnnouncement(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|string',
        ]);

        $announcement = \App\Models\Announcement::findOrFail($id);
        
        $announcement->update([
            'title' => $request->title,
            'content' => $request->input('content'),
            'type' => $request->type,
        ]);
        return redirect()->back()->with('success', 'Duyuru başarıyla güncellendi!');
    }

    /**
     * Duyuru Silme
     */
    public function destroyAnnouncement($id)
    {
        \App\Models\Announcement::findOrFail($id)->delete();
        return back()->with('success', 'Duyuru sistemden kaldırıldı.');
    }
}