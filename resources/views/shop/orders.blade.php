<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    @php
        $stages = [
            0 => ['label' => 'Onay Bekliyor', 'color' => 'text-slate-400', 'progress' => 10],
            1 => ['label' => 'Belgeler Toplanıyor', 'color' => 'text-blue-500', 'progress' => 30],
            2 => ['label' => 'Dosya Hazırlanıyor', 'color' => 'text-indigo-500', 'progress' => 50],
            3 => ['label' => 'Okula Gönderildi', 'color' => 'text-purple-500', 'progress' => 70],
            4 => ['label' => 'Onay Sürecinde', 'color' => 'text-orange-500', 'progress' => 85],
            5 => ['label' => 'İşlem Tamamlandı', 'color' => 'text-green-500', 'progress' => 100],
            6 => ['label' => 'Arşivlendi', 'color' => 'text-slate-900', 'progress' => 100],
        ];
    @endphp

    <div class="min-h-screen bg-[#F8FAFC] pt-24 pb-20">
        
        <div class="bg-slate-900 py-16 mb-12 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center md:text-left">
                    <div class="inline-block px-4 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full mb-4">
                        <span class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em]">Operasyon Takip Paneli</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-white italic tracking-tighter uppercase leading-none">
                        SİPARİŞ <span class="text-blue-500">TAKİP MERKEZİ</span>
                    </h1>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-4 italic">Süreçlerinizi anlık ve şeffaf olarak izleyin</p>
                </div>
            </div>
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                @forelse($orders as $order)
                <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-50 overflow-hidden group hover:shadow-indigo-500/5 transition-all duration-500 animate__animated animate__fadeInUp">
                    <div class="grid grid-cols-1 lg:grid-cols-12 items-center">
                        
                        <div class="lg:col-span-4 p-10 lg:p-12 bg-slate-50/50 border-r border-slate-50">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">#GV-ORDER-{{ $order->id }}</span>
                            <h3 class="text-2xl font-black text-slate-900 uppercase italic leading-tight tracking-tighter group-hover:text-blue-600 transition-colors">
                                {{ $order->product->title }}
                            </h3>
                            <div class="flex items-center gap-3 mt-4">
                                <span class="text-[10px] font-black text-green-600 bg-green-50 px-3 py-1 rounded-lg uppercase">✓ Ödeme Alındı</span>
                                <span class="text-[10px] font-bold text-slate-400 italic">{{ $order->created_at->format('d.m.Y') }}</span>
                            </div>
                        </div>

                        <div class="lg:col-span-5 p-10 lg:p-12">
                            <div class="flex justify-between items-end mb-4">
                                <span class="text-[11px] font-black {{ $stages[$order->status_level]['color'] }} uppercase italic tracking-widest">
                                    ● {{ $stages[$order->status_level]['label'] }}
                                </span>
                                <span class="text-[10px] font-black text-slate-400 uppercase italic">%{{ $stages[$order->status_level]['progress'] }}</span>
                            </div>
                            
                            <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden border border-slate-50 p-[2px]">
                                <div class="bg-blue-600 h-full rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(37,99,235,0.4)]" 
                                     style="width: {{ $stages[$order->status_level]['progress'] }}%"></div>
                            </div>

                            @if($order->status_level == 5)
                            <form action="{{ route('shop.orders.complete', $order->id) }}" method="POST" class="mt-6">
                                @csrf
                                <button type="submit" class="w-full bg-green-600 hover:bg-slate-900 text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest transition-all shadow-lg animate-pulse">
                                    ✅ Belgeleri Teslim Aldım
                                </button>
                            </form>
                            @endif
                        </div>

                        <div class="lg:col-span-3 p-10 lg:p-12 bg-slate-50/30 text-right flex flex-col justify-center gap-4">
                            <p class="text-3xl font-black text-slate-900 italic tracking-tighter">
                                {{ number_format($order->price, 2) }} <span class="text-xs text-blue-600">TL</span>
                            </p>
                            
                            <a href="{{ route('shop.order.download', $order->id) }}" 
                               class="flex items-center justify-center gap-2 bg-white hover:bg-slate-900 border border-slate-200 text-slate-600 hover:text-white font-black py-4 rounded-2xl text-[10px] uppercase tracking-widest transition-all shadow-sm">
                                📄 Faturayı İndir
                            </a>

                            @if($order->status_level == 0)
                            <form action="{{ route('shop.orders.cancel', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('İptal etmek istediğinize emin misiniz?')" class="text-[9px] font-black text-rose-500 uppercase tracking-widest hover:underline transition-all">
                                    ✕ Siparişi İptal Et
                                </button>
                            </form>
                            @endif
                        </div>

                    </div>
                </div>
                @empty
                <div class="py-32 text-center bg-white rounded-[3rem] shadow-sm border border-slate-100">
                    <span class="text-7xl block mb-6">🎓</span>
                    <h3 class="text-xl font-black text-slate-900 uppercase italic tracking-tighter">Henüz Bir Eğitiminiz Yok</h3>
                    <p class="text-slate-400 text-xs font-bold mt-2 mb-8">Mağazaya giderek kariyerine hemen yön verebilirsin.</p>
                    <a href="{{ route('shop.index') }}" class="inline-block bg-blue-600 text-white font-black px-10 py-4 rounded-2xl uppercase text-[10px] tracking-widest shadow-xl shadow-blue-200">Mağazayı Keşfet</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>