@if ($errors->any())
    <div class="max-w-4xl mx-auto mt-4">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-2xl shadow-sm animate__animated animate__shakeX">
            <strong class="font-black uppercase text-xs tracking-widest">Hay aksi! Bir şeyler eksik:</strong>
            <ul class="mt-2 text-xs font-bold">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<x-admin-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic uppercase">
                        YENİ <span class="text-blue-600">ÜRÜN EKLE</span>
                    </h2>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mt-1">Kataloğa Yeni Eğitim Paketi Tanımla</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100 text-[10px] font-black text-gray-400 hover:text-blue-600 transition-all uppercase tracking-widest">
                    ← Listeye Dön
                </a>
            </div>

            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100 animate__animated animate__fadeIn">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-10 lg:p-16 space-y-10">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Eğitim Başlığı</label>
                            <input type="text" name="title" required placeholder="Örn: Polonya Yazılım Mühendisliği" 
                                   class="w-full px-8 py-5 rounded-[2rem] border-none bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-gray-900 text-lg shadow-inner">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Paket Fiyatı (TL)</label>
                            <input type="number" step="0.01" name="price" required placeholder="0.00" 
                                   class="w-full px-8 py-5 rounded-[2rem] border-none bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-gray-900 text-lg shadow-inner">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Eğitim Türü</label>
                            <select name="category" required class="w-full px-8 py-5 rounded-[2rem] border-none bg-gray-50 focus:ring-4 focus:ring-blue-500/10 transition-all font-black text-gray-900 appearance-none cursor-pointer shadow-inner uppercase text-xs italic tracking-widest">
                                <option value="">TÜR SEÇİNİZ</option>
                                <option value="dil-okulu">📚 Dil Okulu</option>
                                <option value="lisans">🎓 Üniversite / Master</option>
                                <option value="sertifika">🏅 Sertifika Programı</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Lokasyon / Ülke</label>
                            <select name="country" required class="w-full px-8 py-5 rounded-[2rem] border-none bg-gray-50 focus:ring-4 focus:ring-blue-500/10 transition-all font-black text-gray-900 appearance-none cursor-pointer shadow-inner uppercase text-xs italic tracking-widest">
                                <option value="">ÜLKE SEÇİNİZ</option>
                                <option value="polonya">🇵🇱 Polonya</option>
                                <option value="ingiltere">🇬🇧 İngiltere</option>
                                <option value="almanya">🇩🇪 Almanya</option>
                                <option value="abd">🇺🇸 ABD</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Ürün Görseli</label>
                        <div class="relative group">
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="w-full px-8 py-10 rounded-[2.5rem] border-2 border-dashed border-gray-100 bg-gray-50 group-hover:bg-blue-50 group-hover:border-blue-200 transition-all text-center">
                                <span class="text-3xl mb-2 block animate-bounce">📸</span>
                                <p class="text-sm font-bold text-gray-500 uppercase italic tracking-tight">Görseli Buraya Sürükleyin veya Seçin</p>
                                <p class="text-[10px] text-gray-300 uppercase font-black mt-2 tracking-widest">PNG, JPG (MAX: 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Paket İçerik Bilgisi</label>
                        <textarea name="description" rows="4" required placeholder="Eğitim kapsamını, süresini ve avantajlarını detaylandırın..." 
                                  class="w-full px-8 py-6 rounded-[2.5rem] border-none bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-gray-900 shadow-inner"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Öğrenci Kontenjanı</label>
                            <input type="number" name="stock" required placeholder="Örn: 50" 
                                   class="w-full px-8 py-5 rounded-[2rem] border-none bg-gray-50 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all font-bold text-gray-900 shadow-inner">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 italic">Yayın Durumu</label>
                            <select name="is_active" class="w-full px-8 py-5 rounded-[2rem] border-none bg-gray-50 focus:ring-4 focus:ring-blue-500/10 transition-all font-black text-gray-900 appearance-none cursor-pointer shadow-inner uppercase text-xs italic tracking-widest">
                                <option value="1">✅ SATIŞA AÇIK</option>
                                <option value="0">📂 TASLAK / KAPALI</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-gray-900 text-white font-black py-7 rounded-[2.5rem] transition-all shadow-2xl active:scale-95 uppercase tracking-widest italic text-sm">
                            Paketi Envantere Kaydet 🚀
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>