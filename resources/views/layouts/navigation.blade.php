<nav x-data="{ open: false }" class="sticky top-0 z-[110] w-full bg-white/95 backdrop-blur-xl border-b border-slate-200 shadow-md transition-all duration-300">
     
    <div class="bg-slate-900 text-slate-300 py-2 px-4 md:px-8 xl:px-16 flex justify-between items-center text-[9px] font-black uppercase tracking-widest border-b border-slate-800 hidden sm:flex">
        <div class="flex items-center gap-6">
            <span class="flex items-center gap-2"><i class="fa-solid fa-shield-halved text-emerald-400"></i> %100 Vize Başarı Hedefi</span>
            <span class="flex items-center gap-2 hidden md:flex"><i class="fa-solid fa-earth-americas text-blue-400"></i> 15+ Ülke, 300+ Resmi Üniversite Partneri</span>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-slate-500">Bizi Takip Edin:</span>
            <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-instagram text-[11px]"></i></a>
            <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-linkedin-in text-[11px]"></i></a>
            <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-youtube text-[11px]"></i></a>
        </div>
    </div>

    <div class="w-full px-4 lg:px-6 xl:px-10"> {{-- Kenar boşluklarını daralttık --}}
        <div class="flex h-24 items-center justify-between gap-4 xl:gap-8"> {{-- Aralarındaki boşluğu daralttık --}}
            
            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 shadow-lg shadow-indigo-200 group-hover:rotate-6 transition-transform">
                    <span class="text-white font-black text-2xl italic leading-none">G</span>
                </div>
                <div class="hidden xl:block leading-tight"> {{-- Logo yazısını sadece çok geniş ekranda göster --}}
                    <p class="text-[16px] font-black tracking-tighter text-slate-900 uppercase italic whitespace-nowrap">GLOBAL <span class="text-indigo-600">VIZYON</span></p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">Eğitim Danışmanlığı</p>
                </div>
            </a>

            {{-- ORTA KISIM: Arama Çubuğu ve Menüler --}}
            <div class="hidden lg:flex flex-1 items-center justify-between gap-4"> {{-- Burayı esnek yaptık --}}
                
                {{-- ARAMA ÇUBUĞU --}}
                <form action="{{ route('shop.index') }}" method="GET" class="relative w-full max-w-sm xl:max-w-md group"> {{-- Genişliğini biraz sınırladık --}}
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 group-focus-within:text-indigo-600 transition-colors"></i>
                    </div>
                    <input type="text" name="search" placeholder="Eğitim Ara..." 
                           class="w-full bg-slate-50/80 border border-slate-200 py-3 pl-10 pr-6 rounded-full text-xs font-bold text-slate-700 focus:bg-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-400 transition-all shadow-inner placeholder-slate-400">
                    <button type="submit" class="absolute inset-y-1 right-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 rounded-full text-[10px] font-black uppercase tracking-widest transition-colors shadow-md h-8">
                        Ara
                    </button>
                </form>

                {{-- MENÜ LİNKLERİ --}}
                <div class="flex items-center gap-1 xl:gap-2"> {{-- Linkler arası boşluğu daralttık --}}
                    @php
                        if(auth()->check()) {
                            $links = auth()->user()->role === 'admin' ? [
                                ['route' => 'admin.dashboard', 'label' => 'Panelim'],
                                ['route' => 'admin.announcements.index', 'label' => 'Duyuru Yönetimi'],
                                ['route' => 'admin.products.index', 'label' => 'Paket Yönetimi'],
                                ['route' => 'admin.users.index', 'label' => 'Kullanıcılar'],
                                ['route' => 'admin.balance.requests', 'label' => 'Talepler'],
                            ] : [
                                ['route' => 'shop.index', 'label' => 'Eğitim Mağazası'],
                                ['route' => 'shop.orders', 'label' => 'Siparişlerim'],
                                ['route' => 'shop.deposit', 'label' => 'Bakiye Yükle'],
                                ['route' => 'announcements.index', 'label' => 'Duyurular'],
                            ];
                        } else {
                            $links = [
                                ['route' => 'shop.index', 'label' => 'Eğitim Mağazası'],
                                ['route' => 'announcements.index', 'label' => 'Duyurular'],
                            ];
                        }
                    @endphp

                    @foreach($links as $link)
                        <a href="{{ route($link['route']) }}" 
                           class="px-3 py-2 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all whitespace-nowrap {{ request()->routeIs($link['route']) ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-slate-500 hover:text-indigo-600 hover:bg-slate-50' }}">
                            {{ __($link['label']) }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- SAĞ KISIM: Profil ve Bakiye --}}
            <div class="flex items-center gap-3 shrink-0">
                
                @guest
                    <div class="hidden lg:flex items-center gap-4">
                        <a href="#" class="flex items-center gap-2 group border-r border-slate-200 pr-4">
                            <div class="h-10 w-10 rounded-full bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-500 transition-colors">
                                <i class="fa-brands fa-whatsapp text-emerald-500 text-lg group-hover:text-white transition-colors"></i>
                            </div>
                            <div class="hidden xl:block">
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest leading-none">Hızlı Destek</p>
                                <p class="text-[12px] font-black text-slate-700 tracking-widest group-hover:text-emerald-600 transition-colors">0850 123 45 67</p>
                            </div>
                        </a>
                        
                        <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-indigo-600 transition-colors">
                            Giriş Yap
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-3 bg-indigo-600 text-white rounded-[1rem] text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                            Kayıt Ol <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                @endguest

                @auth
                    @if(auth()->user()->role === 'user')
                        <div class="hidden lg:flex items-center gap-2 px-4 py-2 bg-slate-50 border border-slate-100 rounded-2xl">
                            <div class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-r border-slate-200 pr-2">Bakiye</span>
                            <span class="text-[13px] font-black text-indigo-600 italic whitespace-nowrap tracking-tighter">
                                {{ number_format(auth()->user()->balance, 2) }} <span class="text-[9px] opacity-70">TL</span>
                            </span>
                        </div>

                        <a href="{{ route('cart.index') }}" class="relative group p-2.5 bg-indigo-50 rounded-2xl hover:bg-indigo-600 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[9px] font-black text-white shadow-lg border-2 border-white">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                    @endif

                    <x-dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 bg-white border border-slate-200 p-1.5 pr-4 rounded-2xl hover:shadow-md transition-all">
                                <div class="h-9 w-9 bg-slate-900 rounded-xl flex items-center justify-center text-white font-black italic shadow-inner">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="text-left hidden xl:block"> {{-- Yazıyı sadece geniş ekranda göster --}}
                                    <p class="text-[11px] font-black text-slate-900 uppercase italic leading-none">{{ auth()->user()->name }}</p>
                                    <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ auth()->user()->role === 'admin' ? 'Yönetici' : 'Öğrenci Hesabı' }}</p>
                                </div>
                                <i class="fa-solid fa-chevron-down text-slate-400 text-xs ml-1 xl:ml-2"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 border-b border-slate-50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] italic">Erişim Merkezi</div>
                            <x-dropdown-link :href="route('profile.edit')" class="font-bold text-[11px] uppercase py-3 italic tracking-widest">⚙️ Profil Ayarları</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-rose-600 font-black text-[11px] uppercase py-3 hover:bg-rose-50 italic tracking-widest">✕ Güvenli Çıkış</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

            </div>
        </div>
    </div>
</nav>