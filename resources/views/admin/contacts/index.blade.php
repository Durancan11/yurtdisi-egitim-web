<x-admin-layout>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic uppercase">Müşteri <span class="text-indigo-600">İlişkileri</span></h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Gelen Kutusu ve Yanıt Sistemi</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100">
                <table class="w-full border-collapse">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="px-8 py-5 text-left text-[10px] font-bold uppercase tracking-widest">Kişi Bilgisi</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold uppercase tracking-widest">İletişim</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold uppercase tracking-widest">Tarih</th>
                            <th class="px-8 py-5 text-left text-[10px] font-bold uppercase tracking-widest">Durum</th>
                            <th class="px-8 py-5 text-right text-[10px] font-bold uppercase tracking-widest">Aksiyon</th>
                        </tr>
                    </thead>
                    
                    @foreach($messages as $message)
                    <tbody x-data="{ openForm: false }" class="divide-y divide-gray-100 border-b border-gray-100">
                        
                        <tr class="hover:bg-slate-50 transition-all group {{ $message->status == 'bekliyor' ? 'bg-indigo-50/30' : 'bg-white' }}">
                            <td class="px-8 py-6">
                                <div class="text-sm font-black text-slate-900 uppercase italic">{{ $message->name }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="text-xs font-bold text-slate-600">{{ $message->email }}</div>
                                <div class="text-[10px] text-slate-400 font-bold mt-1">{{ $message->phone }}</div>
                            </td>
                            <td class="px-8 py-6 text-xs font-bold text-slate-500">
                                {{ $message->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-8 py-6">
                                @if($message->status == 'bekliyor')
                                    <span class="px-4 py-1 bg-rose-100 text-rose-600 rounded-xl text-[9px] font-black uppercase tracking-widest animate-pulse shadow-sm">Bekliyor</span>
                                @else
                                    <span class="px-4 py-1 bg-emerald-100 text-emerald-600 rounded-xl text-[9px] font-black uppercase tracking-widest shadow-sm">Cevaplandı</span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($message->status == 'bekliyor')
                                    <button @click="openForm = !openForm" class="bg-indigo-600 hover:bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all shadow-md active:scale-95">
                                        <span x-text="openForm ? 'İptal Et' : 'Cevap Yaz'"></span>
                                    </button>
                                @else
                                    <button @click="openForm = !openForm" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">
                                        <span x-text="openForm ? 'Gizle' : 'Yanıtı Gör'"></span>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <tr x-show="openForm" style="display: none;" class="bg-slate-50">
                            <td colspan="5" class="p-0 border-0">
                                <div class="px-8 py-6 border-b-4 border-indigo-500 bg-indigo-50/30">
                                    
                                    @if($message->status == 'bekliyor')
                                        <form action="{{ route('admin.contacts.reply', $message->id) }}" method="POST">
                                            @csrf
                                            <p class="text-[10px] font-black text-indigo-600 uppercase tracking-widest mb-3">Öğrenciye E-Posta Yanıtı Gönder</p>
                                            <textarea name="admin_reply" rows="3" required placeholder="Sayın {{ $message->name }}, mesajınız alınmıştır..." 
                                                      class="w-full px-5 py-4 rounded-2xl border-none focus:ring-4 focus:ring-indigo-500/20 text-sm font-medium text-slate-700 shadow-inner mb-4"></textarea>
                                            <div class="flex justify-end">
                                                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg active:scale-95 flex items-center gap-2">
                                                    <i class="fa-solid fa-paper-plane"></i> Gönder
                                                </button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="flex items-start gap-4">
                                            <div class="h-10 w-10 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg shrink-0">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest mb-1">Gönderilen Yanıt</p>
                                                <p class="text-sm font-bold text-slate-700 italic border-l-2 border-emerald-300 pl-4 py-1">
                                                    "{{ $message->admin_reply }}"
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>