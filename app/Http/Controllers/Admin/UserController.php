<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BalanceRequest; // Yeni mühimmat eklendi!
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Kayıtlı tüm personeli listeler
    public function index()
    {
        $users = User::where('role', 'user')->get(); // Sadece öğrencileri listele
        return view('admin.users.index', compact('users'));
    }

    // Personel hesabını dondur/aktif et (Status kontrolü)
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = ($user->status === 'active') ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', 'Personel statüsü güncellendi!');
    }

    // Personeli sistemden ihraç et (Silme)
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Personel sistemden tamamen temizlendi!');
    }

    // --- YENİ EKLENEN BAKİYE SİSTEMİ FONKSİYONLARI ---

    /**
     * Bekleyen bakiye taleplerini listeler.
     */
    public function balanceRequests()
    {
        // 'pending' durumundaki talepleri kullanıcı verisiyle beraber çekiyoruz
        $requests = BalanceRequest::with('user')->where('status', 'pending')->get();
        
        return view('admin.users.balance_requests', compact('requests'));
    }

    /**
     * Talebi onaylar, parayı yükler ve talebi mühürler.
     */
    public function approveBalance($id)
    {
        $req = BalanceRequest::findOrFail($id);
        $user = $req->user;

        // 1. Finansal İşlem: Bakiyeyi arttır
        $user->increment('balance', $req->amount);
        
        // 2. Statü Güncelleme: Talebi 'approved' olarak işaretle
        $req->update(['status' => 'approved']);

        return back()->with('success', $user->name . ' isimli öğrenciye ' . number_format($req->amount, 2) . ' TL bakiye başarıyla tanımlandı!');
    }
}