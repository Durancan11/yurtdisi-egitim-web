<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">Bakiye <span class="text-indigo-600">Onay Merkezi</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Finansal Talepleri Denetleyin ve Onaylayın</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
                <div class="p-6 bg-slate-900 flex justify-between items-center">
                    <span class="text-white text-[10px] font-black uppercase tracking-widest">Bekleyen Talepler</span>
                    <span class="bg-indigo-600 text-white px-3 py-1 rounded-lg text-[10px] font-black">{{ count($requests) }} AKTİF</span>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Öğrenci Bilgisi</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Talep Edilen Tutar</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Talep Tarihi</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold text-slate-400 uppercase tracking-widest">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($requests as $req)
                        <tr class="hover:bg-indigo-50/40 transition group">
                            <td class="px-8 py-6">
                                <div class="text-sm font-black text-slate-900">{{ $req->user->name }}</div>
                                <div class="text-xs text-slate-400 font-medium">{{ $req->user->email }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xl font-black text-indigo-700 bg-indigo-50 px-4 py-2 rounded-2xl">
                                    {{ number_format($req->amount, 2) }} TL
                                </span>
                            </td>
                            <td class="px-8 py-6 text-sm text-slate-500 font-bold">
                                {{ $req->created_at->diffForHumans() }}
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.balance.approve', $req->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 hover:bg-slate-900 text-white px-8 py-3 rounded-2xl font-black text-xs shadow-lg shadow-green-100 transition-all active:scale-95 uppercase tracking-tighter">
                                        Ödemeyi Onayla
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-24 text-center">
                                <div class="flex flex-col items-center opacity-40">
                                    <span class="text-6xl mb-6">💎</span>
                                    <p class="text-slate-900 font-black uppercase text-sm tracking-[0.2em]">Şu an bekleyen herhangi bir bakiye talebi bulunmuyor.</p>
                                    <p class="text-slate-400 text-xs mt-2 italic">Her şey kontrol altında!</p>
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