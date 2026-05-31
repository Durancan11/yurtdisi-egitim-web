<x-app-layout>
    <div class="py-12 bg-[#F1F5F9] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-10 border-b border-slate-200 pb-6">
                <div>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tighter italic uppercase">Sistem <span class="text-indigo-600">Duyuruları</span></h2>
                    <p class="text-slate-500 text-xs font-black uppercase tracking-[0.3em] mt-2">Önemli Güncellemeler ve Fırsatlar</p>
                </div>
                <div class="h-16 w-16 bg-white border border-slate-100 text-indigo-500 rounded-[2rem] flex items-center justify-center shadow-xl animate-bounce">
                    <i class="fa-solid fa-bell text-2xl"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($announcements as $announcement)
                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group relative overflow-hidden">
                        
                        <div class="absolute -right-4 -top-4 opacity-[0.03] group-hover:opacity-[0.08] transition-opacity duration-500">
                            <i class="fa-solid fa-bullhorn text-[150px] text-{{ $announcement->type }}-500"></i>
                        </div>

                        <div class="flex items-center gap-3 mb-6 relative z-10">
                            <span class="flex h-4 w-4 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-{{ $announcement->type }}-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-{{ $announcement->type }}-500 shadow-lg shadow-{{ $announcement->type }}-500/50"></span>
                            </span>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-full border border-slate-100">
                                {{ $announcement->created_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-black text-slate-800 uppercase italic mb-4 relative z-10 leading-tight">
                            {{ $announcement->title }}
                        </h3>
                        
                        <p class="text-sm font-bold text-slate-500 leading-relaxed relative z-10">
                            {{ $announcement->content }}
                        </p>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-[3rem] p-20 text-center border-2 border-dashed border-slate-200 shadow-sm">
                        <i class="fa-regular fa-bell-slash text-6xl text-slate-300 mb-6 block"></i>
                        <h4 class="text-2xl font-black text-slate-800 uppercase italic mb-2">Sessizlik Hakim!</h4>
                        <p class="text-slate-400 font-bold text-sm">Şu an için yayınlanmış yeni bir sistem duyurusu bulunmuyor.</p>
                    </div>
                @endforelse
            </div>
            
        </div>
    </div>
</x-app-layout>