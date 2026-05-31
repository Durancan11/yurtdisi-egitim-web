<x-admin-layout>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Sayfa Başlığı --}}
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic uppercase">Duyuru <span class="text-indigo-600">Yönetimi</span></h2>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sistem Duyurularını Yönetin</p>
            </div>

            {{-- Form ve Tablo Alanı --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                {{-- SOL TARAF: FORM --}}
                <div class="md:col-span-1">
                    <div class="bg-white p-6 sm:p-8 rounded-[2.5rem] shadow-2xl border border-gray-100 sticky top-10">
                        <h3 class="text-lg font-black uppercase italic mb-6 text-slate-800">Yeni <span class="text-indigo-600">Duyuru</span></h3>
                        
                        <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Başlık</label>
                                <input type="text" name="title" placeholder="Duyuru başlığı..." required class="w-full mt-1 px-5 py-3 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/20 text-sm font-bold">
                            </div>
                            
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">İçerik</label>
                                <textarea name="content" rows="4" placeholder="Duyuru detayları..." required class="w-full mt-1 px-5 py-3 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/20 text-sm font-bold"></textarea>
                            </div>
                            
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Renk Modeli</label>
                                <select name="type" class="w-full mt-1 px-5 py-3 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/20 text-sm font-bold">
                                    <option value="indigo">Mavi (Bilgi)</option>
                                    <option value="emerald">Yeşil (Fırsat)</option>
                                    <option value="rose">Kırmızı (Kritik)</option>
                                    <option value="amber">Turuncu (Uyarı)</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg active:scale-95 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane text-xs opacity-70"></i> YAYINLA
                            </button>
                        </form>
                    </div>
                </div>

                {{-- SAĞ TARAF: TABLO --}}
                <div class="md:col-span-2">
                    <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100">
                        <table class="w-full border-collapse">
                            <thead class="bg-slate-900 text-white">
                                <tr>
                                    <th class="px-8 py-5 text-left text-[10px] font-bold uppercase tracking-widest">Duyuru Detayı</th>
                                    <th class="px-8 py-5 text-right text-[10px] font-bold uppercase tracking-widest">İşlem</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 border-b border-gray-100">
                                @foreach($announcements as $announcement)
                                <tr x-data="{ editModal: false }" class="hover:bg-slate-50 transition-all group bg-white">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="h-2 w-2 rounded-full bg-{{ $announcement->type }}-500 shadow-[0_0_8px_rgba(var(--tw-color-{{ $announcement->type }}-500),0.5)]"></span>
                                            <div class="text-sm font-black text-slate-900 uppercase italic">{{ $announcement->title }}</div>
                                        </div>
                                        <div class="text-xs font-bold text-slate-600 pl-5">{{ $announcement->content }}</div>
                                    </td>
                                    
                                    {{-- BUTONLAR --}}
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button @click="editModal = true" type="button" class="bg-indigo-50 hover:bg-indigo-600 text-indigo-600 hover:text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all shadow-sm active:scale-95">
                                                DÜZENLE
                                            </button>

                                            <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Silmek istediğine emin misin?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all shadow-sm active:scale-95">
                                                    SİL
                                                </button>
                                            </form>
                                        </div>

                                        <template x-teleport="body">
                                            <div x-show="editModal" style="display: none;" class="fixed inset-0 z-[200] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                    <div x-show="editModal" x-transition.opacity @click="editModal = false" class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" aria-hidden="true"></div>

                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                                    <div x-show="editModal" 
                                                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                                         class="inline-block w-full max-w-md p-8 my-8 text-left align-middle transition-all transform bg-white shadow-2xl rounded-[2.5rem] border border-slate-100">
                                                        
                                                        <div class="flex justify-between items-center mb-6">
                                                            <h3 class="text-xl font-black uppercase italic text-slate-800">Duyuruyu <span class="text-indigo-600">Düzenle</span></h3>
                                                            <button @click="editModal = false" type="button" class="text-slate-400 hover:text-rose-500 transition-colors bg-slate-100 hover:bg-rose-100 h-8 w-8 rounded-full flex items-center justify-center">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>

                                                        <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" class="space-y-5">
                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <div>
                                                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Başlık</label>
                                                                <input type="text" name="title" value="{{ $announcement->title }}" required class="w-full mt-1 px-5 py-3 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/20 text-sm font-bold text-slate-800">
                                                            </div>
                                                            
                                                            <div>
                                                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">İçerik</label>
                                                                <textarea name="content" rows="4" required class="w-full mt-1 px-5 py-3 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/20 text-sm font-bold text-slate-800">{{ $announcement->content }}</textarea>
                                                            </div>
                                                            
                                                            <div>
                                                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Renk Modeli</label>
                                                                <select name="type" class="w-full mt-1 px-5 py-3 rounded-xl border-slate-200 focus:ring-4 focus:ring-indigo-500/20 text-sm font-bold text-slate-800">
                                                                    <option value="indigo" {{ $announcement->type == 'indigo' ? 'selected' : '' }}>Mavi (Bilgi)</option>
                                                                    <option value="emerald" {{ $announcement->type == 'emerald' ? 'selected' : '' }}>Yeşil (Fırsat)</option>
                                                                    <option value="rose" {{ $announcement->type == 'rose' ? 'selected' : '' }}>Kırmızı (Kritik)</option>
                                                                    <option value="amber" {{ $announcement->type == 'amber' ? 'selected' : '' }}>Turuncu (Uyarı)</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="pt-2 flex gap-3">
                                                                <button @click="editModal = false" type="button" class="w-1/3 bg-slate-100 text-slate-500 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-slate-200 transition-all active:scale-95 text-[10px]">
                                                                    İPTAL
                                                                </button>
                                                                <button type="submit" class="w-2/3 bg-indigo-600 text-white py-4 rounded-xl font-black uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 active:scale-95 text-[10px]">
                                                                    GÜNCELLE
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-admin-layout>