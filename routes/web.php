<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Herkesin Erişebildiği Alanlar)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('dashboard');
})->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/paket/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/duyurular', [ShopController::class, 'announcements'])->name('announcements.index');

/*
|--------------------------------------------------------------------------
| User Routes (Sadece Giriş Yapmış ve Aktif Kullanıcılar)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'checkStatus'])->group(function () {

    // --- DASHBOARD ---
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // --- PROFİL YÖNETİMİ ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');

    // --- SEPET SİSTEMİ ---
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // --- ÖDEME EKRANI (CHECKOUT) ---
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('shop.checkout');
    Route::post('/checkout/process', [ShopController::class, 'processOrder'])->name('shop.processOrder');
    
    // --- SİPARİŞLER ---
    Route::get('/orders', [ShopController::class, 'orders'])->name('shop.orders');
    Route::post('/orders/{id}/cancel', [ShopController::class, 'cancelOrder'])->name('shop.orders.cancel');
    Route::post('/orders/{id}/complete', [ShopController::class, 'completeOrder'])->name('shop.orders.complete');
    Route::get('/orders/{id}/download', [ShopController::class, 'downloadInvoice'])->name('shop.order.download');

    // --- BAKİYE SİSTEMİ ---
    Route::get('/deposit', [ShopController::class, 'depositForm'])->name('shop.deposit');
    Route::post('/deposit', [ShopController::class, 'depositStore'])->name('shop.deposit.store');

    // --- İLETİŞİM FORMU (Kullanıcı Gönderimi) ---
    Route::post('/contact/store', [ShopController::class, 'storeContact'])->name('contact.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Prefix: admin - Sadece Admin Erişebilir)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Duyuru Yönetimi
    Route::get('/announcements', [AdminController::class, 'announcements'])->name('announcements.index');
    Route::post('/announcements', [AdminController::class, 'storeAnnouncement'])->name('announcements.store');
    Route::delete('/announcements/{id}', [AdminController::class, 'destroyAnnouncement'])->name('announcements.destroy');
    Route::put('/announcements/{id}', [AdminController::class, 'updateAnnouncement'])->name('announcements.update');
    
    // Özet Paneli
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Ürün (Eğitim Paketi) Yönetimi - Tam CRUD
    Route::get('/products', [AdminController::class, 'products'])->name('products.index');
    Route::get('/products/create', function() { return view('admin.products.create'); })->name('products.create');
    Route::post('/products', [AdminController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    // Kullanıcı Yönetimi
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');

    // İletişim Mesajları Yönetimi
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts.index');
    Route::post('/contacts/{id}/read', [AdminController::class, 'markContactRead'])->name('contacts.read');
    Route::post('/contacts/{id}/reply', [AdminController::class, 'replyContact'])->name('contacts.reply');
    
    // Bakiye & Sipariş Süreç Yönetimi
    Route::get('/balance-requests', [AdminController::class, 'balanceRequests'])->name('balance.requests');
    Route::post('/balance-requests/{id}/approve', [AdminController::class, 'approveBalance'])->name('balance.approve');
    
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::post('/orders/{id}/next-step', [AdminController::class, 'nextStep'])->name('orders.next-step');
});

require __DIR__.'/auth.php';

Route::get('/make-me-admin', function () {
    $user = \App\Models\User::first();
    if ($user) {
        $user->role = 'admin';
        $user->save();
        return 'Tebrikler! Admin yetkisi başarıyla tanımlandı. Artık /admin paneline gidebilirsiniz.';
    }
    return 'Önce siteye normal bir kayıt olmalısın!';
});

Route::get('/verileri-esitle', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    return 'Harika! Eski kullanicilar, duyurular ve magaza urunleri basariyla buluta aktarildi!';
});