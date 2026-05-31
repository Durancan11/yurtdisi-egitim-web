<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Ekip kaydırma çubuğunu gizlemek için modern CSS hack */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="w-[100vw] relative left-1/2 right-1/2 -mx-[50vw] h-[650px] overflow-hidden bg-slate-900 shadow-2xl z-0"
         x-data="{
            activeSlide: 0,
            slides: [
                'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1525921429624-479b6a26d84d?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=2070&auto=format&fit=crop'
            ],
            init() { setInterval(() => { this.activeSlide = this.activeSlide === this.slides.length - 1 ? 0 : this.activeSlide + 1; }, 3000); }
         }">
        
        <template x-for="(slide, index) in slides" :key="index">
            <img :src="slide" x-show="activeSlide === index"
                 x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 class="absolute inset-0 w-full h-full object-cover opacity-50">
        </template>

        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/95 via-blue-900/70 to-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col md:flex-row items-center justify-between">
                <div class="w-full md:w-3/5 text-white pt-10 md:pt-0 animate__animated animate__fadeInLeft flex flex-col items-start">
                    <h1 class="text-5xl md:text-[5rem] font-black italic uppercase tracking-tighter leading-none mb-6 drop-shadow-2xl">
                        BAŞVURU YAP <br>
                        <span class="text-yellow-400">SINIRLARI AŞ</span>
                    </h1>
                    <p class="text-lg font-bold mb-8 text-blue-100 drop-shadow-md leading-relaxed pr-10">
                        Yurtdışında Burslu Lisans, Yüksek Lisans, Yaz Okulu, Work & Study ve Work & Travel Başvuruları Devam Ediyor!
                    </p>
                    <a href="{{ route('shop.index') }}" class="inline-block bg-blue-600 hover:bg-blue-500 text-white font-black text-xl px-10 py-5 rounded-full shadow-[0_10px_30px_rgba(37,99,235,0.5)] transition-transform hover:scale-105 uppercase tracking-widest border-4 border-blue-400/30 animate-pulse mb-6">
                        HEMEN BAŞVUR <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                    <div class="inline-flex items-center gap-4 bg-orange-500/90 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-orange-400 shadow-xl">
                        <span class="text-4xl font-black text-white">%50</span>
                        <div class="leading-tight">
                            <p class="text-white font-bold text-xs">Dünyanın En İyi Okullarında</p>
                            <p class="text-yellow-200 font-black text-[10px] uppercase tracking-widest">Kısmi Burs Fırsatı</p>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-[320px] lg:w-[350px] mt-8 md:mt-0 animate__animated animate__fadeInRight z-10">
                    <div class="bg-slate-900/80 backdrop-blur-xl p-6 rounded-[2rem] border border-slate-700 shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-indigo-500"></div>
                        <h3 class="text-xl font-black text-white text-center mb-5 leading-tight">
                            Uzmanlarımızla <br><span class="text-blue-400">İletişime Geç</span>
                        </h3>
                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-3">
                            @csrf
                            <input type="text" name="name" required placeholder="Adınız Soyadınız" class="w-full px-4 py-3 rounded-xl bg-slate-800 border-none text-white focus:ring-2 focus:ring-blue-500 transition-all font-bold text-sm">
                            <input type="email" name="email" required placeholder="E-Posta Adresiniz" class="w-full px-4 py-3 rounded-xl bg-slate-800 border-none text-white focus:ring-2 focus:ring-blue-500 transition-all font-bold text-sm">
                            <input type="tel" name="phone" required placeholder="Telefon Numaranız" class="w-full px-4 py-3 rounded-xl bg-slate-800 border-none text-white focus:ring-2 focus:ring-blue-500 transition-all font-bold text-sm">
                            <textarea name="message" required placeholder="Size nasıl yardımcı olabiliriz?" class="w-full px-4 py-3 rounded-xl bg-slate-800 border-none text-white focus:ring-2 focus:ring-blue-500 transition-all font-bold text-sm"></textarea>
                            <button type="submit" class="w-full bg-[#10b981] hover:bg-[#059669] text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest transition-all active:scale-95 shadow-lg mt-2">
                                Sizi Arayalım
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 border-b border-slate-100">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">Öğrenci <span class="text-indigo-600">Panelİ</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-1">Hesap Özeti ve Hızlı İşlemler</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-indigo-600 rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 opacity-10 group-hover:scale-110 transition-transform duration-700"><span class="text-[150px] font-black italic">₺</span></div>
                <p class="text-[10px] font-black uppercase tracking-widest text-indigo-200 mb-2">Mevcut Bakiyen</p>
                <p class="text-5xl font-black tracking-tighter italic">{{ number_format(auth()->user()->balance, 2) }} TL</p>
                <a href="{{ route('shop.deposit') }}" class="inline-block mt-8 bg-white/20 hover:bg-white/30 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">+ Bakiye Yükle</a>
            </div>
            <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl relative overflow-hidden group">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Toplam Eğitim Paketi</p>
                <p class="text-5xl font-black tracking-tighter italic">{{ auth()->user()->orders()->count() }} Adet</p>
                <a href="{{ route('shop.orders') }}" class="inline-block mt-8 bg-white/10 hover:bg-white/20 px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all">Siparişleri Yönet →</a>
            </div>
            <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 shadow-lg flex flex-col justify-center items-center text-center group hover:border-indigo-200 transition-all cursor-pointer" onclick="window.location.href='{{ route('shop.index') }}'">
                <div class="h-16 w-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all"><i class="fa-solid fa-graduation-cap text-2xl"></i></div>
                <h3 class="text-lg font-black text-slate-900 uppercase italic">Eğitim Mağazası</h3>
                <p class="text-xs text-slate-400 font-bold mt-2">Yeni paketleri keşfet ve kariyerini yönet.</p>
            </div>
        </div>
    </div>
    @endauth

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid grid-cols-1 lg:grid-cols-2 gap-16 border-b border-slate-100">
        <div>
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 bg-indigo-50 px-4 py-2 rounded-full">Biz Kimiz?</span>
            <h2 class="text-4xl font-black text-slate-900 tracking-tighter italic uppercase mt-6 mb-6 leading-tight">Geleceğinizi <br>Şansa Bırakmayın.</h2>
            <p class="text-slate-500 font-medium leading-relaxed mb-6">Global Vizyon, 20 yılı aşkın tecrübesiyle on binlerce öğrencinin yurtdışı eğitim hayallerini gerçeğe dönüştürmüştür. Amacımız sadece sizi bir okula yerleştirmek değil, kariyer yolculuğunuzda size rehberlik etmektir.</p>
            <ul class="space-y-4">
                <li class="flex items-center gap-4 text-sm font-bold text-slate-700"><i class="fa-solid fa-check text-green-500"></i> %100 Vize Başarı Oranı Hedefi</li>
                <li class="flex items-center gap-4 text-sm font-bold text-slate-700"><i class="fa-solid fa-check text-green-500"></i> Resmi Üniversite Temsilcilikleri</li>
                <li class="flex items-center gap-4 text-sm font-bold text-slate-700"><i class="fa-solid fa-check text-green-500"></i> 7/24 Öğrenci Danışmanlık Desteği</li>
            </ul>
        </div>
        <div class="grid grid-cols-2 gap-6 h-full">
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-50 text-center hover:-translate-y-2 transition-transform flex flex-col items-center justify-center h-full">
                <i class="fa-solid fa-earth-americas text-4xl text-blue-500 mb-4"></i>
                <h4 class="font-black text-slate-900 uppercase italic">15+ Ülke</h4>
                <p class="text-[10px] text-slate-400 uppercase font-bold mt-2">Global Ağ</p>
            </div>
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-50 text-center hover:-translate-y-2 transition-transform flex flex-col items-center justify-center h-full">
                <i class="fa-solid fa-university text-4xl text-indigo-500 mb-4"></i>
                <h4 class="font-black text-slate-900 uppercase italic">300+ Okul</h4>
                <p class="text-[10px] text-slate-400 uppercase font-bold mt-2">Resmi Partner</p>
            </div>
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-50 text-center hover:-translate-y-2 transition-transform flex flex-col items-center justify-center h-full">
                <i class="fa-solid fa-users text-4xl text-orange-500 mb-4"></i>
                <h4 class="font-black text-slate-900 uppercase italic">25.000+</h4>
                <p class="text-[10px] text-slate-400 uppercase font-bold mt-2">Mutlu Öğrenci</p>
            </div>
            <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-50 text-center hover:-translate-y-2 transition-transform flex flex-col items-center justify-center h-full">
                <i class="fa-solid fa-medal text-4xl text-yellow-500 mb-4"></i>
                <h4 class="font-black text-slate-900 uppercase italic">20 Yıl</h4>
                <p class="text-[10px] text-slate-400 uppercase font-bold mt-2">Sektör Tecrübesi</p>
            </div>
        </div>
    </div>

    <div class="py-20 border-b border-slate-100 relative overflow-hidden" 
         x-data="{
            cities: [
                { name: 'Varşova', lat: 52.2297, lon: 21.0122, temp: '...', wind: '-', currency: 'PLN', rate: '...', tz: 'Europe/Warsaw', time: '' },
                { name: 'Londra', lat: 51.5085, lon: -0.1257, temp: '...', wind: '-', currency: 'GBP', rate: '...', tz: 'Europe/London', time: '' },
                { name: 'Berlin', lat: 52.5200, lon: 13.4050, temp: '...', wind: '-', currency: 'EUR', rate: '...', tz: 'Europe/Berlin', time: '' }
            ],
            updateTime() {
                this.cities.forEach(city => {
                    city.time = new Date().toLocaleTimeString('tr-TR', { timeZone: city.tz, hour: '2-digit', minute:'2-digit', second:'2-digit' });
                });
            },
            init() {
                this.updateTime();
                setInterval(() => this.updateTime(), 1000);

                this.cities.forEach(city => {
                    fetch(`https://api.open-meteo.com/v1/forecast?latitude=${city.lat}&longitude=${city.lon}&current_weather=true`)
                        .then(res => res.json())
                        .then(data => {
                            city.temp = data.current_weather.temperature + '°C';
                            city.wind = data.current_weather.windspeed + ' km/h';
                        });
                });
                
                fetch('https://open.er-api.com/v6/latest/TRY')
                    .then(res => res.json())
                    .then(data => {
                        let rates = data.rates;
                        this.cities.forEach(city => {
                            let valInTry = (1 / rates[city.currency]).toFixed(2);
                            city.rate = `1 ${city.currency} = ${valInTry} TL`;
                        });
                    });
            }
         }">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 relative z-10">
                <span class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.3em] text-blue-600 bg-blue-50 px-5 py-2.5 rounded-full border border-blue-100 shadow-sm">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-600"></span>
                    </span>
                    CANLI API BAĞLANTISI AKTİF
                </span>
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase mt-5">Destinasyonlarda <span class="text-blue-600">Canlı Durum</span></h2>
                <p class="text-slate-400 font-bold text-xs mt-2">Hava durumu, yerel saatler ve para birimleri anlık olarak senkronize edilmektedir.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <template x-for="city in cities">
                    <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden group hover:-translate-y-2 hover:shadow-[0_20px_40px_-15px_rgba(37,99,235,0.5)] transition-all duration-500 border border-slate-700">
                        <i class="fa-solid fa-satellite-dish text-8xl text-white/5 absolute -left-8 -bottom-8 group-hover:rotate-12 transition-transform duration-700"></i>
                        <div class="relative z-10 flex justify-between items-start mb-6">
                            <h3 class="text-3xl font-black italic uppercase tracking-widest text-blue-400 drop-shadow-md" x-text="city.name"></h3>
                            <div class="flex items-center gap-2 bg-slate-950/60 backdrop-blur-md px-4 py-2 rounded-xl border border-slate-700 shadow-inner">
                                <i class="fa-regular fa-clock text-blue-400 animate-pulse text-xs"></i>
                                <span class="text-sm font-black tracking-widest text-slate-100 font-mono" x-text="city.time"></span>
                            </div>
                        </div>
                        <div class="mt-4 relative z-10">
                            <span class="text-6xl font-black tracking-tighter drop-shadow-lg" x-text="city.temp"></span>
                        </div>
                        <div class="mt-8 space-y-3 text-xs font-bold text-slate-400 uppercase tracking-widest border-t border-slate-700/80 pt-5 relative z-10 bg-slate-900/20 p-4 rounded-2xl">
                            <p class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><i class="fa-solid fa-wind text-slate-300"></i> Rüzgar</span>
                                <span class="text-white font-black" x-text="city.wind"></span>
                            </p>
                            <p class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><i class="fa-solid fa-coins text-yellow-500"></i> Canlı Kur</span>
                                <span class="text-green-400 font-black bg-green-500/10 px-2 py-1 rounded-md" x-text="city.rate"></span>
                            </p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid grid-cols-1 lg:grid-cols-2 gap-16 border-b border-slate-100">
        <div class="w-full" x-data="{
            activeMember: 0,
            members: [
                { name: 'Ahmet Yılmaz', role: 'Polonya Danışmanı', img: 'https://i.pravatar.cc/300?img=11' },
                { name: 'Ayşe Demir', role: 'İngiltere Vize Uzmanı', img: 'https://i.pravatar.cc/300?img=47' },
                { name: 'Caner Kaya', role: 'Almanya Koordinatörü', img: 'https://i.pravatar.cc/300?img=33' },
                { name: 'Selin Çelik', role: 'Kariyer Planlama', img: 'https://i.pravatar.cc/300?img=41' }
            ],
            init() {
                setInterval(() => {
                    this.activeMember = this.activeMember === this.members.length - 1 ? 0 : this.activeMember + 1;
                }, 4000);
            }
        }">
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase mb-8">Uzman <span class="text-indigo-600">Kadromuz</span></h2>
            <div class="relative bg-white rounded-[2.5rem] shadow-xl border border-slate-50 h-[380px] overflow-hidden group">
                <template x-for="(member, index) in members" :key="index">
                    <div x-show="activeMember === index"
                         x-transition:enter="transition ease-out duration-700"
                         x-transition:enter-start="opacity-0 transform translate-x-12"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-500 absolute inset-0"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-12"
                         class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center">
                         <div class="relative mb-6">
                             <div class="absolute inset-0 bg-indigo-500 rounded-full blur-md opacity-20 group-hover:opacity-40 transition-opacity animate-pulse"></div>
                             <img :src="member.img" class="relative w-36 h-36 rounded-full object-cover shadow-2xl border-4 border-white">
                         </div>
                         <h4 class="text-3xl font-black text-slate-900 italic uppercase" x-text="member.name"></h4>
                         <p class="text-xs text-indigo-600 font-bold uppercase tracking-widest mt-3 bg-indigo-50 px-4 py-2 rounded-full" x-text="member.role"></p>
                    </div>
                </template>
                <div class="absolute bottom-6 left-0 right-0 flex justify-center gap-3 z-10">
                    <template x-for="(member, index) in members" :key="'dot-'+index">
                        <button @click="activeMember = index"
                                class="h-2 rounded-full transition-all duration-500 shadow-sm"
                                :class="activeMember === index ? 'w-10 bg-indigo-600' : 'w-2 bg-slate-200 hover:bg-indigo-400'"></button>
                    </template>
                </div>
            </div>
        </div>

        <div x-data="{ active: 1 }">
            <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase mb-8">Sıkça Sorulan <span class="text-orange-500">Sorular</span></h2>
            <div class="space-y-4">
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm">
                    <button @click="active = active === 1 ? null : 1" class="w-full text-left p-6 font-black text-slate-800 uppercase flex justify-between items-center text-sm">
                        Öğrenci Vizesi almak zor mu?
                        <i class="fa-solid fa-chevron-down transition-transform" :class="active === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 1" x-collapse class="p-6 pt-0 text-slate-500 text-sm font-medium">
                        Uzman ekibimiz sayesinde vize ret oranımız %2'nin altındadır. Belgelerinizi eksiksiz hazırlayarak konsolosluk mülakatlarına sizi birebir hazırlıyoruz.
                    </div>
                </div>
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm">
                    <button @click="active = active === 2 ? null : 2" class="w-full text-left p-6 font-black text-slate-800 uppercase flex justify-between items-center text-sm">
                        Eğitim alırken çalışma iznim olacak mı?
                        <i class="fa-solid fa-chevron-down transition-transform" :class="active === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 2" x-collapse class="p-6 pt-0 text-slate-500 text-sm font-medium">
                        Evet. Polonya, İngiltere, Almanya gibi birçok popüler destinasyonda lisans ve yüksek lisans öğrencilerinin yasal olarak haftada 20 saate kadar (tatillerde tam zamanlı) çalışma izni bulunmaktadır.
                    </div>
                </div>
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm">
                    <button @click="active = active === 3 ? null : 3" class="w-full text-left p-6 font-black text-slate-800 uppercase flex justify-between items-center text-sm">
                        Dil yeterlilik belgesi (IELTS/TOEFL) şart mı?
                        <i class="fa-solid fa-chevron-down transition-transform" :class="active === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 3" x-collapse class="p-6 pt-0 text-slate-500 text-sm font-medium">
                        Her okul için zorunlu değildir. Birçok üniversite, kendi içlerinde online seviye tespit sınavı yapmakta veya 1 yıllık hazırlık eğitimi opsiyonu sunmaktadır. Detaylar için uzmanlarımıza danışabilirsiniz.
                    </div>
                </div>
                <div class="bg-white border border-slate-100 rounded-3xl overflow-hidden shadow-sm">
                    <button @click="active = active === 4 ? null : 4" class="w-full text-left p-6 font-black text-slate-800 uppercase flex justify-between items-center text-sm">
                        Konaklama süreçlerinde destek oluyor musunuz?
                        <i class="fa-solid fa-chevron-down transition-transform" :class="active === 4 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 4" x-collapse class="p-6 pt-0 text-slate-500 text-sm font-medium">
                        Kesinlikle. Gideceğiniz ülkede üniversite yurtları, özel öğrenci rezidansları veya paylaşımlı ev seçeneklerini size sunuyor ve tüm kiralama süreçlerini Türkiye'den yönetmenizi sağlıyoruz.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-16 bg-slate-900 text-white w-[100vw] relative left-1/2 right-1/2 -mx-[50vw] mt-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <h2 class="text-3xl font-black italic uppercase tracking-tighter mb-4">GLOBAL <span class="text-indigo-500">VIZYON</span></h2>
                <p class="text-slate-400 text-sm w-3/4">Geleceğinize yön veren eğitim danışmanlığı. Polonya'dan İngiltere'ye tüm süreçlerde yanınızdayız.</p>
                <div class="flex gap-4 mt-6">
                    <a href="#" class="h-10 w-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="h-10 w-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="h-10 w-10 bg-slate-800 rounded-full flex items-center justify-center hover:bg-indigo-600 transition"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h4 class="font-black text-slate-100 uppercase tracking-widest mb-6">Şubelerimiz</h4>
                <ul class="space-y-4 text-slate-400 text-sm">
                    <li><i class="fa-solid fa-location-dot mr-2 text-indigo-500"></i> İstanbul / Beşiktaş</li>
                    <li><i class="fa-solid fa-location-dot mr-2 text-indigo-500"></i> Ankara / Çankaya</li>
                    <li><i class="fa-solid fa-location-dot mr-2 text-indigo-500"></i> İzmir / Alsancak</li>
                </ul>
            </div>
            <div>
                <h4 class="font-black text-slate-100 uppercase tracking-widest mb-6">İletişim</h4>
                <ul class="space-y-4 text-slate-400 text-sm font-bold">
                    <li><i class="fa-solid fa-phone mr-2 text-green-500"></i> 0850 123 45 67</li>
                    <li><i class="fa-solid fa-envelope mr-2 text-blue-500"></i> info@globalvizyon.com</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>