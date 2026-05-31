<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BalanceRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BalanceRequestController extends Controller
{
    // Onay bekleyen tüm talepleri listeleme
    public function index()
    {
        $requests = BalanceRequest::with('user')->latest()->get();
        return view('admin.balance.requests', compact('requests'));
    }

    // Bakiye Talebini Onaylama
    public function approve($id)
    {
        $balanceRequest = BalanceRequest::findOrFail($id);
        
        if ($balanceRequest->status !== 'pending') {
            return back()->with('info', 'Bu talep daha önce işleme alınmış.');
        }

        // Kullanıcıyı bul ve bakiyesini güncelle
        $user = User::findOrFail($balanceRequest->user_id);
        $user->balance += $balanceRequest->amount;
        $user->save();

        // Talebi onaylandı olarak işaretle
        $balanceRequest->update(['status' => 'approved']);

        return back()->with('success', 'Ödeme onaylandı! ' . number_format($balanceRequest->amount, 2) . ' TL kullanıcının hesabına aktarıldı. 💰');
    }

    // Bakiye Talebini Reddetme
    public function reject($id)
    {
        $balanceRequest = BalanceRequest::findOrFail($id);
        
        $balanceRequest->update(['status' => 'rejected']);

        return back()->with('error', 'Bakiye yükleme talebi reddedildi. Kullanıcıya bildirim iletilecek. ✕');
    }
}