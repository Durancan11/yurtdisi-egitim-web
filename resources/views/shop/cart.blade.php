<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic mb-10 border-l-8 border-indigo-600 pl-6">
                EĞİTİM <span class="text-slate-400">SEPETİM</span>
            </h2>

            @if(count($cart) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($cart as $id => $details)
                            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-md transition-all">
                                <div class="flex items-center gap-6">
                                    <div class="h-20 w-20 bg-slate-100 rounded-2xl overflow-hidden shadow-inner">
                                        <img src="{{ asset('storage/' . $details['image']) }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-black text-slate-900 uppercase tracking-tight">{{ $details['title'] }}</h4>
                                        <p class="text-indigo-600 font-black italic">{{ number_format($details['price'], 2) }} TL</p>
                                    </div>
                                </div>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button class="h-12 w-12 flex items-center justify-center rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all">✕</button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-slate-900 p-10 rounded-[3rem] text-white shadow-2xl h-fit sticky top-24">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-500 mb-6">Sipariş Özeti</p>
                        <div class="flex justify-between items-end mb-8">
                            <span class="text-slate-400 font-bold uppercase text-xs">Toplam Tutar</span>
                            <span class="text-3xl font-black italic tracking-tighter">{{ number_format($total, 2) }} TL</span>
                        </div>
                        
                        <div class="border-t border-white/10 pt-8 space-y-4">
                            <a href="{{ route('shop.checkout') }}" class="w-full bg-indigo-500 hover:bg-indigo-400 text-white py-5 rounded-2xl font-black uppercase tracking-widest transition-all shadow-xl shadow-indigo-500/20 flex items-center justify-center gap-3 group">
    <span>ÖDEME ADIMINA GEÇ</span>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
    </svg>
</a>
                            <p class="text-[9px] text-center text-slate-500 font-bold uppercase tracking-widest leading-relaxed italic">
                                * Ödeme onayından sonra bakiyeniz otomatik olarak güncellenecektir.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white p-20 rounded-[3rem] text-center border-2 border-dashed border-slate-200">
                    <span class="text-6xl mb-6 block">🛒</span>
                    <h3 class="text-xl font-black text-slate-900 uppercase italic">Sepetiniz şu an boş</h3>
                    <a href="{{ route('shop.index') }}" class="mt-8 inline-block bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest">Mağazaya Git</a>
                </div>
            @endif
        </div>
    </div>

    <script>
        function initiateEliteCheckout() {
            Swal.fire({
                title: 'ÖDEME ONAYI',
                text: "{{ number_format($total, 2) }} TL tutarındaki işlem bakiyenizden düşülecektir. Onaylıyor musunuz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6366f1',
                cancelButtonColor: '#f43f5e',
                confirmButtonText: 'EVET, SATIN AL',
                cancelButtonText: 'VAZGEÇ',
                background: '#ffffff',
                borderRadius: '2rem',
                customClass: {
                    title: 'font-sans font-black text-slate-900',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold uppercase text-xs tracking-widest',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold uppercase text-xs tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'İŞLEM YAPILIYOR',
                        html: 'Güvenli ödeme protokolü doğrulanıyor...',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            document.getElementById('checkout-form').submit();
                        }
                    });
                }
            })
        }
    </script>
</x-app-layout>