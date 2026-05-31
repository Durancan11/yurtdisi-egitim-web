<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <div class="min-h-screen bg-slate-50 py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            
            <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-indigo-600 font-black text-xs uppercase tracking-widest transition-all mb-10 group">
                <div class="bg-white p-2 rounded-full shadow-sm group-hover:shadow-md transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                Mağazaya Geri Dön
            </a>

            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-slate-100 flex flex-col lg:flex-row">
                
                <div class="lg:w-1/2 relative bg-slate-100 min-h-[400px]">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://loremflickr.com/800/800/'.($product->country ?? 'education').',university?lock='.$product->id }}" 
                         class="absolute inset-0 w-full h-full object-cover"
                         alt="{{ $product->title }}">
                    
                    <div class="absolute top-8 left-8 bg-white/90 backdrop-blur-md px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
                        <span class="text-2xl">
                            @if($product->country == 'polonya') 🇵🇱
                            @elseif($product->country == 'ingiltere') 🇬🇧
                            @elseif($product->country == 'almanya') 🇩🇪
                            @elseif($product->country == 'abd') 🇺🇸
                            @else 🌍 @endif
                        </span>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">{{ $product->country ?? 'Global' }}</p>
                            <p class="text-xs font-black text-indigo-600 uppercase tracking-widest mt-1">{{ str_replace('-', ' ', $product->category) ?? 'Eğitim Paketi' }}</p>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 p-12 lg:p-16 flex flex-col justify-center">
                    
                    <div class="inline-block px-4 py-1.5 bg-indigo-50 border border-indigo-100 rounded-full mb-6 w-max">
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.2em]"><i class="fa-solid fa-hashtag mr-1"></i> Paket ID: {{ $product->id }}</span>
                    </div>

                    <h1 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter italic uppercase leading-none mb-6">
                        {{ $product->title }}
                    </h1>
                    
                    <p class="text-slate-500 font-medium leading-relaxed mb-10 text-sm lg:text-base">
                        {{ $product->description }}
                    </p>

                    <div class="grid grid-cols-2 gap-6 mb-10 pb-10 border-b border-slate-100">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Paket Ücreti</p>
                            <p class="text-4xl font-black text-slate-900 tracking-tighter italic">{{ number_format($product->price, 2) }} <span class="text-lg text-slate-400">TL</span></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Mevcut Durum</p>
                            <p class="text-2xl font-black {{ $product->stock < 5 ? 'text-red-500' : 'text-green-500' }} tracking-tighter italic mt-2">
                                {{ $product->stock }} Kontenjan
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white py-5 rounded-2xl font-black text-sm uppercase tracking-widest transition-all shadow-xl active:scale-95 flex items-center justify-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                Sepete Ekle
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>