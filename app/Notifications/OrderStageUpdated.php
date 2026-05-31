<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStageUpdated extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    // Hangi kanallardan gitsin? (Mail ve Database/Veritabanı)
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    // 📧 MAİL İÇERİĞİ
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Global Vizyon | Süreç Güncellemesi 📈')
                    ->greeting('Merhaba ' . $notifiable->name . '!')
                    ->line('"' . $this->order->product->title . '" paketiniz için yeni bir gelişme var.')
                    ->line('Siparişinizin yeni aşaması: **' . strtoupper($this->order->shipping_stage) . '**')
                    ->action('Süreci Takip Et', url('/orders'))
                    ->line('Global Vizyon ile hayallerine bir adım daha yaklaştın!');
    }

    // 🔔 VERİTABANI BİLDİRİMİ (UI'da göstermek için)
    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'title' => $this->order->product->title,
            'stage' => $this->order->shipping_stage,
            'message' => 'Siparişiniz "' . $this->order->shipping_stage . '" aşamasına geçti.'
        ];
    }
}