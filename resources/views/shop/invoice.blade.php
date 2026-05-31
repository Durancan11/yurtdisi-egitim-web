<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sipariş Faturası - #{{ $order->id }}</title>
    <style>
        /* PDF için en uyumlu font */
        body { 
            font-family: 'DejaVu Sans', sans-serif; 
            color: #1e293b; 
            margin: 0;
        }
        
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #f1f5f9; }
        .header { border-bottom: 4px solid #2563eb; padding-bottom: 20px; margin-bottom: 20px; }
        
        /* DÜZELTME: font-weight değerini 900'den bold'a (700) çektik. 
           Çünkü 900 ağırlığında Türkçe karakter desteği kütüphanede olmayabiliyor.
        */
        .logo { 
            font-size: 24px; 
            font-weight: bold; 
            color: #0f172a; 
            text-transform: none; /* Otomatik büyütmeyi kapattık */
        }
        .logo span { 
            color: #2563eb; 
            font-weight: bold;
        }
        
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        .info-table td { width: 50%; vertical-align: top; font-size: 12px; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        .items-table th { background: #f8fafc; padding: 15px; text-align: left; font-size: 10px; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; }
        .items-table td { padding: 15px; border-bottom: 1px solid #f1f5f9; font-size: 13px; }
        .total-section { text-align: right; margin-top: 30px; }
        .total-amount { font-size: 24px; font-weight: bold; color: #2563eb; }
        .footer { text-align: center; margin-top: 50px; font-size: 10px; color: #94a3b8; border-top: 1px solid #f1f5f9; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <table style="width:100%">
                <tr>
                    <td class="logo">GLOBAL <span>V&#304;ZYON</span></td>
                    <td style="text-align:right; font-size: 14px; font-weight: bold;">SİPARİŞ FATURASI</td>
                </tr>
            </table>
        </div>

        <table class="info-table">
            <tr>
                <td>
                    <strong>ALICI BİLGİLERİ:</strong><br>
                    {{ $order->user->name }}<br>
                    {{ $order->user->email }}<br>
                    Kocaeli, Türkiye
                </td>
                <td style="text-align:right">
                    <strong>SİPARİŞ DETAYI:</strong><br>
                    Fatura No: #GV-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}<br>
                    Tarih: {{ $order->created_at->format('d.m.Y') }}<br>
                    Ödeme: Bakiye (Cüzdan)
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Eğitim Paketi / Hizmet</th>
                    <th style="text-align:right">Tutar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $order->product->title }}</strong><br>
                        <small style="color:#64748b">{{ $order->product->description }}</small>
                    </td>
                    <td style="text-align:right; font-weight: bold;">
                        {{ number_format($order->price, 2) }} TL
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            <p style="font-size: 12px; font-weight: bold; color: #64748b; margin-bottom: 5px;">GENEL TOPLAM</p>
            <div class="total-amount">{{ number_format($order->price, 2) }} TL</div>
        </div>

        <div class="footer">
            <p>Bu fatura elektronik ortamda oluşturulmuştur. Global Vizyon Eğitim Danışmanlığı.</p>
            <p>www.globalvizyon.com | info@globalvizyon.com</p>
        </div>
    </div>
</body>
</html>