<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-8 animate__animated animate__shakeX">
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-sm">
                        <div class="flex items-center mb-2">
                            <span class="text-red-500 mr-2 text-lg">⚠️</span>
                            <strong class="text-red-800 font-black uppercase text-xs tracking-widest">Doğrulama Hatası:</strong>
                        </div>
                        <ul class="text-red-700 text-xs font-bold space-y-1 ml-6 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="mb-10 flex items-center justify-between animate__animated animate__fadeIn">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase leading-none">
                        PAKET <span class="text-indigo-600">GÜNCELLEME</span>
                    </h2>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-3">Envanter Kaydı Düzenleme Paneli</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="group text-slate-400 hover:text-indigo-600 font-black text-[10px] transition-all flex items-center gap-2 uppercase tracking-widest">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Listeye Dön
                </a>
            </div>

            <div class="bg-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] rounded-[2.5rem] overflow-hidden border border-slate-100 animate__animated animate__fadeInUp">
                <div class="p-10 lg:p-14">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <div class="md:col-span-2">
                                <label class="text-[11px] font-black text-slate-500 uppercase ml-2 mb-3 block italic tracking-widest">Paket Başlığı / Adı</label>
                                <input type="text" name="title" value="{{ old('title', $product->title) }}" required
                                       class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 focus:border-indigo-600 focus:ring-0 text-lg font-black text-slate-900 transition shadow-sm outline-none bg-slate-50/50">
                            </div>

                            <div>
                                <label class="text-[11px] font-black text-slate-500 uppercase ml-2 mb-3 block italic tracking-widest">Eğitim Türü</label>
                                <select name="category" required class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 focus:border-indigo-600 focus:ring-0 text-sm font-black text-slate-900 transition shadow-sm outline-none bg-white cursor-pointer appearance-none">
                                    <option value="dil-okulu" {{ (old('category', $product->category) == 'dil-okulu') ? 'selected' : '' }}>📚 Dil Okulu</option>
                                    <option value="lisans" {{ (old('category', $product->category) == 'lisans') ? 'selected' : '' }}>🎓 Üniversite / Master</option>
                                    <option value="sertifika" {{ (old('category', $product->category) == 'sertifika') ? 'selected' : '' }}>🏅 Sertifika Programı</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-[11px] font-black text-slate-500 uppercase ml-2 mb-3 block italic tracking-widest">Lokasyon / Ülke</label>
                                <select name="country" required class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 focus:border-indigo-600 focus:ring-0 text-sm font-black text-slate-900 transition shadow-sm outline-none bg-white cursor-pointer appearance-none">
                                    <option value="polonya" {{ (old('country', $product->country) == 'polonya') ? 'selected' : '' }}>🇵🇱 Polonya</option>
                                    <option value="ingiltere" {{ (old('country', $product->country) == 'ingiltere') ? 'selected' : '' }}>🇬🇧 İngiltere</option>
                                    <option value="almanya" {{ (old('country', $product->country) == 'almanya') ? 'selected' : '' }}>🇩🇪 Almanya</option>
                                    <option value="abd" {{ (old('country', $product->country) == 'abd') ? 'selected' : '' }}>🇺🇸 ABD</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="text-[11px] font-black text-slate-500 uppercase ml-2 mb-3 block italic tracking-widest">Paket Detay Açıklaması</label>
                                <textarea name="description" rows="4" required
                                          class="w-full px-6 py-4 rounded-2xl border-2 border-slate-50 focus:border-indigo-600 focus:ring-0 text-sm font-medium text-slate-700 transition shadow-sm outline-none leading-relaxed bg-slate-50/50">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div>
                                <label class="text-[11px] font-black text-slate-500 uppercase ml-2 mb-3 block italic tracking-widest">Paket Fiyatı (TL)</label>
                                <div class="relative group">
                                    <span class="absolute left-5 top-4 text-xl font-black text-indigo-600 transition">₺</span>
                                    <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" required
                                           class="w-full pl-12 pr-6 py-4 rounded-2xl border-2 border-slate-50 focus:border-indigo-600 focus:ring-0 text-xl font-black text-slate-900 transition shadow-sm outline-none bg-slate-50/50">
                                </div>
                            </div>

                            <div>
                                <label class="text-[11px] font-black text-slate-500 uppercase ml-2 mb-3 block italic tracking-widest">Kontenjan / Stok</label>
                                <div class="relative group">
                                    <span class="absolute left-5 top-4 text-xl font-black text-indigo-300 transition">#</span>
                                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                                           class="w-full pl-12 pr-6 py-4 rounded-2xl border-2 border-slate-50 focus:border-indigo-600 focus:ring-0 text-xl font-black text-slate-900 transition shadow-sm outline-none bg-slate-50/50">
                                </div>
                            </div>

                            <div class="md:col-span-2 bg-slate-50 p-8 rounded-[2rem] border border-slate-100 flex flex-col md:flex-row items-center gap-8 mt-4">
                                <div class="relative group/img">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://picsum.photos/seed/'.$product->id.'/400/400' }}" 
                                         class="w-32 h-32 rounded-3xl object-cover shadow-2xl border-4 border-white rotate-2 group-hover/img:rotate-0 transition-all duration-500"
                                         alt="Mevcut Görsel">
                                    <span class="absolute -top-3 -right-3 bg-indigo-600 text-white text-[9px] font-black px-3 py-1.5 rounded-full shadow-lg tracking-widest uppercase italic">Mevcut</span>
                                </div>
                                <div class="flex-1">
                                    <label class="text-[11px] font-black text-slate-500 uppercase mb-3 block italic tracking-widest">Görseli Değiştir</label>
                                    <input type="file" name="image" 
                                           class="text-xs text-slate-400 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-indigo-600 file:text-white hover:file:bg-slate-900 transition-all cursor-pointer">
                                    <p class="mt-3 text-[10px] text-slate-400 italic font-bold">Mevcut görseli korumak için boş bırakın. (Max: 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex items-center gap-3 px-2">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}
                                   class="h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="is_active" class="text-[11px] font-black text-slate-600 uppercase tracking-widest italic cursor-pointer">Bu paket mağazada yayında olsun</label>
                        </div>

                        <div class="mt-12">
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-slate-900 text-white py-6 rounded-2xl font-black text-lg shadow-[0_20px_50px_rgba(79,70,229,0.3)] transition-all active:scale-95 uppercase tracking-[0.2em] italic">
                                Güncellemeleri Kaydet 🚀
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>