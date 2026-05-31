<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStageUpdated; // 🔥 Bildirimi import ettik

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function approve($id)
    {
        $order = Order::findOrFail($id);

        $order->status = 'approved';
        $order->approved_at = now();
        $order->shipping_stage = 'basvuru alindi';
        $order->save();

        // 🔥 İlk onay bildirimini gönderiyoruz
        $order->user->notify(new OrderStageUpdated($order));

        return back()->with('success', 'Sipariş onaylandı! Öğrenciye süreç başlangıç bildirimi gönderildi. 🎓');
    }

    public function advance($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'approved') {
            return back()->with('error', 'Onaylanmamış bir siparişin süreci ilerletilemez! ✕');
        }

        $stages = [
            'basvuru alindi',
            'danisman atandi',
            'evrak hazirlaniyor',
            'basvuru yapildi',
            'kabul bekleniyor',
            'tamamlandi'
        ];

        if (!$order->shipping_stage || !in_array($order->shipping_stage, $stages)) {
            $order->shipping_stage = 'basvuru alindi';
            $order->save();
            
            // Bildirimi tetikle
            $order->user->notify(new OrderStageUpdated($order));
            
            return back()->with('success', 'Süreç ilk aşamaya getirildi ve bildirildi. 📈');
        }

        $currentIndex = array_search($order->shipping_stage, $stages);

        if ($currentIndex < count($stages) - 1) {
            $newStage = $stages[$currentIndex + 1];
            $order->shipping_stage = $newStage;
            $order->save();

            // 🔥 AŞAMA GÜNCELLENDİ: Öğrenciye anlık haber veriyoruz
            $order->user->notify(new OrderStageUpdated($order));

            return back()->with('success', "Aşama başarıyla güncellendi: '" . strtoupper($newStage) . "'. Öğrenciye mail ve bildirim iletildi! 🚀");
        }

        return back()->with('info', 'Bu sipariş zaten en son aşamada. ✅');
    }
}