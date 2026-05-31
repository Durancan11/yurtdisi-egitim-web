<x-app-layout>
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full text-center animate__animated animate__zoomIn">
            <div class="mb-8 flex justify-center">
                <div class="h-24 w-24 bg-emerald-100 rounded-[2.5rem] flex items-center justify-center shadow-lg shadow-emerald-100/50 border-4 border-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            
            <h2 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic mb-4">ÖDEME BAŞARILI!</h2>
            <p class="text-slate-400 font-bold uppercase text-[10px] tracking-[0.25em] mb-10 leading-relaxed px-10">
                Eğitim paketlerin tanımlandı. Operasyonel süreçler başlatıldı, detayları siparişlerimden takip edebilirsin.
            </p>

            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('shop.orders') }}" class="bg-slate-900 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl transition-all hover:scale-105 active:scale-95">
                    SİPARİŞLERİM
                </a>
                <a href="{{ route('shop.index') }}" class="bg-white border border-slate-200 text-slate-900 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-sm transition-all hover:bg-slate-50 hover:scale-105 active:scale-95">
                    MAĞAZAYA DÖN
                </a>
            </div>
        </div>
    </div>
</x-app-layout>