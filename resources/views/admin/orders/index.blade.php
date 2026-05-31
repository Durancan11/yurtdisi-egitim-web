<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    @php
        $stages = [
    0 => ['label' => 'Onay Bekliyor', 'color' => 'bg-gray-100 text-gray-600'],
    1 => ['label' => 'Tedarik (Belgeler Toplanıyor)', 'color' => 'bg-blue-100 text-blue-700'],
    2 => ['label' => 'Kutulanıyor (Dosya Hazırlanıyor)', 'color' => 'bg-indigo-100 text-indigo-700'],
    3 => ['label' => 'Kargoya Verildi (Okula Gönderildi)', 'color' => 'bg-purple-100 text-purple-700'],
    4 => ['label' => 'Yolda (Onay Sürecinde)', 'color' => 'bg-orange-100 text-orange-700'],
    5 => ['label' => 'Teslim Edildi (İşlem Tamamlandı)', 'color' => 'bg-green-100 text-green-700'],
    6 => ['label' => 'Müşteri Tarafından Onaylandı', 'color' => 'bg-green-200 text-green-800'],
];
    @endphp

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">Sipariş <span class="text-indigo-600 font-black">Yönetim Merkezi</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Lojistik Süreç Takip ve Onay Sistemi</p>
            </div>

            <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-slate-100">
                <table class="w-full">
                    <thead class="bg-slate-900">
                        <tr>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sipariş Bilgisi</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Öğrenci</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tutar</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Süreç Durumu</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold text-slate-400 uppercase tracking-widest">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($orders ?? [] as $order)
                        <tr class="hover:bg-indigo-50/30 transition duration-150 group">
                            <td class="px-8 py-6">
                                <div class="text-[10px] font-black text-indigo-600 mb-1 tracking-widest">#{{ $order->id }}</div>
                                <div class="text-sm font-black text-slate-900 group-hover:text-indigo-700 transition">{{ $order->product->title }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase mt-1">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-sm font-bold text-slate-800">{{ $order->user->name }}</div>
                                <div class="text-xs text-slate-400">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-lg font-black text-slate-900 italic">{{ number_format($order->price, 2) }} TL</span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 rounded-xl text-[10px] font-black uppercase {{ $stages[$order->status_level]['color'] ?? 'bg-gray-100' }}">
                                    {{ $stages[$order->status_level]['label'] ?? 'Belirsiz' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($order->status_level < 5)
                                    <form action="{{ route('admin.orders.next-step', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-indigo-600 hover:bg-slate-900 text-white px-6 py-3 rounded-2xl font-black text-[10px] shadow-xl shadow-indigo-100 transition-all active:scale-95 uppercase tracking-tighter">
                                            Süreci İlerlet →
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[10px] font-black text-green-600 uppercase tracking-widest italic">Süreç Tamamlandı</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center opacity-40">
                                    <span class="text-6xl mb-6">📦</span>
                                    <p class="text-slate-900 font-black uppercase text-sm tracking-[0.2em]">Henüz bir sipariş kaydı bulunmuyor.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>