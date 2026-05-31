<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-4" x-data="checkoutData()">
        <h2 class="text-3xl font-black text-slate-900 italic uppercase mb-8 border-l-8 border-indigo-600 pl-6">Siparişi <span class="text-indigo-600">Tamamla</span></h2>

        <form action="{{ route('shop.processOrder') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8" id="payment-form">
            @csrf
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100">
                    <h3 class="text-xl font-black uppercase italic mb-6 text-slate-800">Teslimat Bilgileri</h3>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <input type="text" name="name" placeholder="Adınız" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/20 font-bold text-sm transition-all" required>
                        <input type="text" name="surname" placeholder="Soyadınız" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/20 font-bold text-sm transition-all" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="relative">
                            <select name="city" x-model="selectedCity" @change="updateDistricts()" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/20 font-bold text-sm text-slate-600 appearance-none bg-slate-50 cursor-pointer" required>
                                <option value="" disabled selected>İl Seçiniz...</option>
                                <template x-for="city in cities" :key="city.name">
                                    <option :value="city.name" x-text="city.name"></option>
                                </template>
                            </select>
                        </div>

                        <div class="relative">
                            <select name="district" x-model="selectedDistrict" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/20 font-bold text-sm text-slate-600 appearance-none bg-slate-50 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" :disabled="districts.length === 0" required>
                                <option value="" disabled selected>İlçe Seçiniz...</option>
                                <template x-for="district in districts" :key="district.name">
                                    <option :value="district.name" x-text="district.name"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    
                    <textarea name="address" rows="3" placeholder="Mahalle, Sokak, Bina ve Daire No (Açık Adresiniz)" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/20 font-bold text-sm transition-all" required></textarea>
                    
                    <div class="mt-4 relative">
                        <input type="tel" name="phone" x-model="phone" @input="phone = formatPhone($event.target.value)" placeholder="0 5XX XXX XX XX" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/20 font-black text-slate-700 tracking-widest transition-all" required maxlength="15">
                        <i class="fa-solid fa-phone absolute right-5 top-5 text-slate-300"></i>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gradient-to-b from-slate-900 to-slate-800 p-8 rounded-[2.5rem] text-white shadow-2xl sticky top-24 border border-slate-700">
                    <h3 class="text-xl font-black uppercase italic mb-6 text-indigo-400">Ödeme Bilgileri</h3>
                    
                    <div class="space-y-4">
                        <input type="text" placeholder="Kart Üzerindeki İsim" x-model="cardName" @input="cardName = formatName($event.target.value)" class="w-full px-5 py-4 rounded-2xl bg-slate-950/50 border border-slate-700 text-white focus:ring-2 focus:ring-indigo-500 font-bold uppercase text-sm tracking-widest" required>
                        
                        <div class="relative">
                            <input type="text" placeholder="XXXX XXXX XXXX XXXX" x-model="cardNumber" @input="cardNumber = formatCard($event.target.value)" class="w-full px-5 py-4 rounded-2xl bg-slate-950/50 border border-slate-700 text-white focus:ring-2 focus:ring-indigo-500 font-black tracking-widest text-sm" required>
                            <i class="fa-brands fa-cc-visa absolute right-4 top-4 text-2xl text-slate-500"></i>
                        </div>

                        <div class="flex gap-4">
                            <input type="text" placeholder="AA/YY" x-model="expiry" @input="expiry = formatExpiry($event.target.value)" class="w-1/2 px-5 py-4 rounded-2xl bg-slate-950/50 border border-slate-700 text-white focus:ring-2 focus:ring-indigo-500 font-black tracking-widest text-center" required>
                            
                            <div class="w-1/2 relative">
                                <input type="password" placeholder="CVV" x-model="cvv" @input="cvv = formatCvv($event.target.value)" class="w-full px-5 py-4 rounded-2xl bg-slate-950/50 border border-slate-700 text-white focus:ring-2 focus:ring-indigo-500 font-black tracking-widest text-center" required>
                                <i class="fa-solid fa-circle-question absolute right-3 top-5 text-slate-500 cursor-help" title="Kartınızın arkasındaki 3 haneli güvenlik kodu"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 border-t border-slate-700 pt-6">
                        <div class="flex justify-between text-lg font-black uppercase italic mb-6">
                            <span>Toplam</span>
                            <span class="text-indigo-400 text-2xl">₺ {{ number_format($total ?? 0, 2) }}</span>
                        </div>
                        <button type="submit" class="w-full bg-[#10b981] hover:bg-[#059669] py-5 rounded-2xl font-black uppercase tracking-widest transition-all shadow-[0_10px_20px_rgba(16,185,129,0.3)] active:scale-95 flex items-center justify-center gap-3">
                            <i class="fa-solid fa-lock"></i> Güvenli Ödeme
                        </button>
                    </div>
                    
                    <div class="mt-6 flex items-center justify-center gap-4 opacity-50">
                        <i class="fa-brands fa-cc-visa text-3xl"></i>
                        <i class="fa-brands fa-cc-mastercard text-3xl"></i>
                        <i class="fa-brands fa-cc-amex text-3xl"></i>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkoutData', () => ({
                cities: [],
                districts: [],
                selectedCity: '',
                selectedDistrict: '',
                
                phone: '',
                cardName: '',
                cardNumber: '',
                expiry: '',
                cvv: '',

                init() {
                    // Türkiye İl/İlçe API'sini Çekiyoruz
                    fetch('https://turkiyeapi.dev/api/v1/provinces')
                        .then(res => res.json())
                        .then(data => {
                            // İlleri alfabetik sırala
                            this.cities = data.data.sort((a, b) => a.name.localeCompare(b.name));
                        })
                        .catch(err => console.error('Lokasyon API Hatası:', err));
                },

                updateDistricts() {
                    let city = this.cities.find(c => c.name === this.selectedCity);
                    if (city) {
                        this.districts = city.districts.sort((a, b) => a.name.localeCompare(b.name));
                    } else {
                        this.districts = [];
                    }
                    this.selectedDistrict = ''; // İl değişince ilçeyi sıfırla
                },

                // TELEFON MASKELEME (0 5XX XXX XX XX)
                formatPhone(val) {
                    let num = val.replace(/\D/g, ''); // Sadece rakamları al
                    if (num.length > 0 && num[0] !== '0') num = '0' + num; // Her zaman 0 ile başla
                    
                    let formatted = '';
                    for (let i = 0; i < num.length; i++) {
                        if (i === 1 || i === 4 || i === 7 || i === 9) formatted += ' ';
                        formatted += num[i];
                    }
                    return formatted.substring(0, 15); // Max uzunluk kısıtlaması
                },

                // KART İSMİ MASKELEME (Sadece Harf)
                formatName(val) {
                    return val.toUpperCase().replace(/[^A-ZÇĞİÖŞÜ\s]/g, '');
                },

                // KART NUMARASI MASKELEME (XXXX XXXX XXXX XXXX)
                formatCard(val) {
                    let num = val.replace(/\D/g, '');
                    return num.replace(/(\d{4})(?=\d)/g, '$1 ').substring(0, 19);
                },

                // SON KULLANMA MASKELEME (AA/YY)
                formatExpiry(val) {
                    let num = val.replace(/\D/g, '');
                    if (num.length >= 3) {
                        let month = num.substring(0, 2);
                        // Ay 12'den büyük girilemez
                        if(parseInt(month) > 12) month = '12';
                        if(parseInt(month) === 0) month = '01';
                        return month + '/' + num.substring(2, 4);
                    }
                    return num.substring(0, 4);
                },

                // CVV MASKELEME (Sadece 3 Rakam)
                formatCvv(val) {
                    return val.replace(/\D/g, '').substring(0, 3);
                }
            }));
        });
    </script>
</x-app-layout>