<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <div class="min-h-screen bg-gray-50 pt-20 pb-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            
            <div class="text-center mb-10 animate__animated animate__fadeInDown">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-600 rounded-[2rem] shadow-2xl shadow-blue-500/20 mb-6 transform hover:rotate-12 transition-transform">
                    <span class="text-3xl text-white font-black">₺</span>
                </div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter italic uppercase">Bakiye <span class="text-blue-600">Yükle</span></h2>
                <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Global Vizyon Finans Merkezi</p>
            </div>

            <div class="bg-white rounded-[3rem] shadow-2xl border border-gray-100 p-10 animate__animated animate__fadeInUp">
                <form action="{{ route('shop.deposit.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div class="space-y-4">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Miktar Belirleyin</label>
                        
                        <div class="relative group">
                            <span class="absolute left-8 top-1/2 -translate-y-1/2 text-2xl text-blue-600 font-black transition-transform group-focus-within:scale-110">₺</span>
                            
                            <input type="number" name="amount" min="10" required 
                                   placeholder="0.00" 
                                   class="w-full pl-20 pr-8 py-6 bg-gray-50 border-none rounded-[2rem] text-3xl font-black text-gray-900 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all placeholder-gray-200">
                        </div>
                        
                        <p class="text-[9px] text-center text-gray-400 font-bold uppercase tracking-tighter">Minimum yükleme tutarı: 10.00 TL</p>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-gray-900 text-white font-black py-6 rounded-[2rem] transition-all shadow-xl active:scale-95 uppercase tracking-widest italic text-sm">
                        Talebi Gönder 🚀
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                    <p class="text-[10px] text-gray-400 font-medium leading-relaxed italic">
                        Talebiniz iletildikten sonra admin onayının ardından bakiyeniz hesabınıza yansıtılacaktır.
                    </p>
                </div>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('shop.index') }}" class="text-[10px] font-black text-gray-300 hover:text-blue-600 uppercase tracking-widest transition-colors">
                    ← Mağazaya Geri Dön
                </a>
            </div>
        </div>
    </div>
</x-app-layout>