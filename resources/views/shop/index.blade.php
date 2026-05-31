<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <div class="min-h-screen bg-slate-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col lg:flex-row justify-between items-center mb-16 gap-10 mt-6 animate__animated animate__fadeInDown">
                <div class="text-center lg:text-left">
                    <div class="inline-block px-4 py-1 bg-blue-500/10 border border-blue-500/20 rounded-full mb-4">
                        <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em]">Global Vizyon Eğitim Store</span>
                    </div>
                    <h2 class="text-5xl font-black text-slate-900 tracking-tighter italic uppercase leading-none">
                        GELECEĞİNİ <span class="text-blue-600">TASARLA</span>
                    </h2>
                    <p class="text-slate-400 text-[11px] font-black uppercase tracking-[0.3em] mt-4">Uluslararası Eğitim Paketleri ve Canlı Döviz Kurları</p>
                </div>
                
                <div class="flex flex-wrap justify-center lg:justify-end gap-6 items-center">
                    
                    <div class="bg-white px-6 py-4 rounded-[1.5rem] shadow-xl border border-slate-100 flex items-center gap-4 min-w-[160px] group hover:border-blue-200 transition-all">
                        <span class="text-2xl">🇺🇸</span>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">USD/TRY</p>
                            </div>
                            <p class="text-xl font-black text-slate-900 leading-none tracking-tighter">{{ $usd }}</p>
                        </div>
                    </div>

                    <div class="bg-white px-6 py-4 rounded-[1.5rem] shadow-xl border border-slate-100 flex items-center gap-4 min-w-[160px] group hover:border-blue-200 transition-all">
                        <span class="text-2xl">🇪🇺</span>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">EUR/TRY</p>
                            </div>
                            <p class="text-xl font-black text-slate-900 leading-none tracking-tighter">{{ $eur }}</p>
                        </div>
                    </div>
                    
                    @auth
                        <div class="bg-slate-900 px-8 py-5 rounded-[1.5rem] shadow-2xl border border-slate-800 flex flex-col justify-center min-w-[200px]">
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Cüzdan Bakiyesi</span>
                            <span class="text-2xl font-black text-white leading-none tracking-tighter italic">
                                {{ number_format(auth()->user()->balance, 2) }} <span class="text-blue-500 text-xs">TL</span>
                            </span>
                        </div>
                    @else
                        <div class="flex items-center h-full">
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-5 bg-indigo-600 text-white hover:bg-indigo-700 rounded-[1.5rem] text-[11px] font-black uppercase tracking-widest transition-all shadow-xl hover:-translate-y-1">
                                <i class="fa-solid fa-lock"></i> Giriş Yap & Satın Al
                            </a>
                        </div>
                    @endauth

                </div>
            </div>

            <div class="flex justify-center mb-12 animate__animated animate__fadeIn">
                <div class="bg-white p-2 rounded-[2rem] shadow-lg border border-slate-100 flex items-center gap-2">
                    <span class="px-5 text-[10px] font-black text-slate-400 uppercase tracking-widest hidden sm:block italic">Para Birimi:</span>
                    <button onclick="convertCurrency('TL', 1, this)" class="currency-btn active bg-blue-600 text-white px-8 py-3 rounded-[1.5rem] text-[10px] font-black uppercase transition-all shadow-md">TRY</button>
                    <button onclick="convertCurrency('USD', {{ $usd }}, this)" class="currency-btn text-slate-500 hover:bg-slate-50 px-8 py-3 rounded-[1.5rem] text-[10px] font-black uppercase transition-all">USD</button>
                    <button onclick="convertCurrency('EUR', {{ $eur }}, this)" class="currency-btn text-slate-500 hover:bg-slate-50 px-8 py-3 rounded-[1.5rem] text-[10px] font-black uppercase transition-all">EUR</button>
                </div>
            </div>

            <div class="mb-20 animate__animated animate__fadeIn">
                <div class="relative max-w-3xl mx-auto group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative bg-white shadow-2xl rounded-[2.2rem] overflow-hidden flex items-center">
                        <input type="text" id="shop-search" name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Polonya, Londra, Mühendislik..." 
                               class="w-full pl-10 pr-40 py-7 border-none text-xl font-bold text-slate-800 focus:ring-0 placeholder-slate-300">
                        <div class="absolute right-6 bg-blue-50 text-blue-600 px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] italic">
                            Anlık Filtreleme
                        </div>
                    </div>
                </div>
                <p id="no-results" class="text-center mt-12 font-black text-slate-300 uppercase italic hidden">Eşleşen bir eğitim paketi bulunamadı...</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12" id="product-grid">
                @foreach($products as $product)
                
                <a href="{{ route('shop.show', $product->id) }}" class="product-card block bg-white rounded-[3.5rem] shadow-2xl overflow-hidden border border-slate-50 group hover:shadow-indigo-600/20 transition-all duration-500 flex flex-col animate__animated animate__fadeInUp hover:-translate-y-2" 
                    data-title="{{ strtolower($product->title) }}">
                    
                    <div class="h-80 bg-slate-100 relative overflow-hidden">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://loremflickr.com/800/600/'.($product->country ?? 'education').',university?lock='.$product->id }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                             alt="{{ $product->title }}">
                        
                        <div class="absolute top-8 left-8 bg-white/95 backdrop-blur-md px-5 py-2.5 rounded-2xl text-[10px] font-black {{ $product->stock < 5 ? 'text-rose-600' : 'text-blue-600' }} uppercase shadow-xl tracking-widest italic flex items-center gap-2">
                             <span class="animate-pulse">●</span> {{ $product->stock }} Kontenjan
                        </div>
                    </div>

                    <div class="p-12 flex flex-col flex-grow">
                        <h3 class="text-2xl font-black text-slate-900 mb-4 h-16 overflow-hidden leading-tight italic uppercase tracking-tighter group-hover:text-indigo-600 transition-colors">
                            {{ $product->title }}
                        </h3>
                        <p class="text-slate-400 text-xs mb-10 h-12 overflow-hidden italic leading-relaxed font-bold uppercase tracking-tight">
                            "{{ Str::limit($product->description, 85) }}"
                        </p>
                        
                        <div class="mt-auto pt-10 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 italic">Paket Ücreti</span>
                                <span class="product-price text-3xl font-black text-slate-900 tracking-tighter italic" 
                                      data-base-price="{{ $product->price }}">
                                    {{ number_format($product->price, 2) }} TL
                                </span>
                            </div>

                            <div class="bg-slate-100 text-slate-500 px-6 py-4 rounded-[1.5rem] font-black text-[10px] uppercase tracking-widest group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                                İncele <i class="fa-solid fa-arrow-right ml-1"></i>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        // 1. AKILLI ARAMA FİLTRESİ
        document.getElementById('shop-search').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.product-card');
            let hasResults = false;

            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                if (title.includes(searchTerm)) {
                    card.style.display = 'flex';
                    hasResults = true;
                } else {
                    card.style.display = 'none';
                }
            });

            const noResultsMsg = document.getElementById('no-results');
            if (hasResults || searchTerm === "") {
                noResultsMsg.classList.add('hidden');
            } else {
                noResultsMsg.classList.remove('hidden');
            }
        });

        // 2. CANLI KUR ÇEVİRİCİ MANTIĞI
        function convertCurrency(currency, rate, btn) {
            document.querySelectorAll('.currency-btn').forEach(b => {
                b.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
                b.classList.add('text-slate-500', 'hover:bg-slate-50');
            });
            btn.classList.add('bg-blue-600', 'text-white', 'shadow-md');
            btn.classList.remove('text-slate-500', 'hover:bg-slate-50');

            document.querySelectorAll('.product-price').forEach(el => {
                const basePrice = parseFloat(el.getAttribute('data-base-price'));
                const convertedPrice = basePrice / rate;
                
                let symbol = 'TL';
                if(currency === 'USD') symbol = '$';
                if(currency === 'EUR') symbol = '€';

                el.style.opacity = 0;
                setTimeout(() => {
                    el.innerText = convertedPrice.toLocaleString('tr-TR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + ' ' + symbol;
                    el.style.opacity = 1;
                }, 150);
            });
        }
    </script>

    <style>
        .product-price { transition: opacity 0.2s ease-in-out; }
        .product-card { backface-visibility: hidden; }
        input:focus { box-shadow: none !important; }
    </style>
</x-app-layout>