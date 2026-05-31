<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-12">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">
                    Finansal <span class="text-blue-600">Onay Merkezi</span>
                </h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Bekleyen Bakiye Yükleme Talepleri</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-slate-100 animate__animated animate__fadeInUp">
                <div class="p-8 border-b border-slate-50 bg-slate-900 flex justify-between items-center">
                    <h3 class="text-white font-black uppercase italic tracking-widest text-xs">Onay Bekleyen İşlemler</h3>
                    <span class="bg-blue-600 text-white text-[10px] font-black px-3 py-1 rounded-lg uppercase">Toplam: {{ count($requests) }} Talep</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase italic">Kullanıcı Bilgisi</th>
                                <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase italic">Talep Edilen Tutar</th>
                                <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase italic">Tarih</th>
                                <th class="px-8 py-5 text-right text-[10px] font-black text-slate-400 uppercase italic">İşlem</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($requests as $request)
                            <tr class="hover:bg-blue-50/50 transition-all duration-200">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 font-black">
                                            {{ substr($request->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-slate-900 uppercase tracking-tighter">{{ $request->user->name }}</p>
                                            <p class="text-[10px] text-slate-400 font-bold tracking-tight">{{ $request->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-xl font-black text-slate-900 tracking-tighter italic">
                                        {{ number_format($request->amount, 2) }} <span class="text-xs text-blue-600">TL</span>
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-xs text-slate-400 font-bold uppercase tracking-widest">
                                    {{ $request->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <form action="{{ route('admin.balance.approve', $request->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="button" onclick="confirmApproval(this)" class="bg-green-600 hover:bg-slate-900 text-white font-black py-3 px-6 rounded-xl transition-all shadow-lg active:scale-95 uppercase text-[10px] tracking-widest">
                                            Ödemeyi Onayla
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center gap-3 opacity-20">
                                        <span class="text-6xl">📥</span>
                                        <p class="font-black text-slate-900 uppercase italic tracking-[0.3em]">Şu an bekleyen talep bulunmuyor</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmApproval(button) {
            Swal.fire({
                title: 'Ödeme Onayı',
                text: "Bu tutarı kullanıcının bakiyesine eklemek istediğinize emin misiniz?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#059669',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Evet, Onayla',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            })
        }
    </script>
</x-admin-layout>