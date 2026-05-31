<x-admin-layout>
    <div class="flex justify-between items-end mb-12">
        <div class="animate__animated animate__fadeInLeft">
            <span class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-2 block italic">Sistem Genel Bakış</span>
            <h2 class="text-4xl font-black text-slate-900 tracking-tighter uppercase italic leading-none">
                HOŞ GELDİN, <span class="text-slate-400">ADMIN DURAN CAN</span>
            </h2>
        </div>
        
        <div class="bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3 animate__animated animate__fadeInRight">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </span>
            <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Sistem Aktif</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8 mb-12 animate__animated animate__fadeInUp">
        
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Aktif Eğitim Paketi</p>
                <h3 class="text-4xl font-black text-slate-900 italic">
                    {{ $productCount }} <span class="text-xs text-indigo-600 uppercase">Adet</span>
                </h3>
            </div>
            <span class="absolute -right-4 -bottom-4 text-8xl text-slate-50 font-black italic group-hover:text-indigo-50 transition-colors">📦</span>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-xl transition-all">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kayıtlı Öğrenci</p>
                <h3 class="text-4xl font-black text-slate-900 italic">
                    {{ $userCount }} <span class="text-xs text-emerald-600 uppercase">Kişi</span>
                </h3>
            </div>
            <span class="absolute -right-4 -bottom-4 text-8xl text-slate-50 font-black italic group-hover:text-emerald-50 transition-colors">👥</span>
        </div>

        <div class="bg-slate-900 p-8 rounded-[2rem] shadow-2xl shadow-slate-200 relative overflow-hidden group hover:scale-[1.02] transition-all">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Bekleyen Bakiye Onayı</p>
                <h3 class="text-4xl font-black text-white italic">
                    {{ $pendingBalanceRequests }} <span class="text-xs text-rose-500 uppercase">Talep</span>
                </h3>
            </div>
            <span class="absolute -right-4 -bottom-4 text-8xl text-white/5 font-black italic">💰</span>
        </div>

        <div class="bg-blue-600 p-8 rounded-[2rem] shadow-2xl shadow-blue-200 relative overflow-hidden group hover:scale-[1.02] transition-all">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-blue-200 uppercase tracking-widest mb-1">Yeni İletişim Talebi</p>
                <h3 class="text-4xl font-black text-white italic">
                    {{ \App\Models\ContactMessage::where('status', 'bekliyor')->count() }} <span class="text-xs text-blue-200 uppercase">Mesaj</span>
                </h3>
            </div>
            <span class="absolute -right-4 -bottom-4 text-8xl text-white/10 font-black italic">✉️</span>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm xl:col-span-2">
            <h4 class="text-sm font-black text-slate-900 uppercase italic mb-8 border-b pb-4">Hızlı Erişim Menüsü</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.products.create') }}" class="p-6 bg-slate-50 rounded-2xl hover:bg-indigo-600 hover:text-white transition-all group">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-1 opacity-60">Üretim</p>
                    <p class="text-sm font-black uppercase italic">Yeni Paket Ekle</p>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="p-6 bg-slate-50 rounded-2xl hover:bg-emerald-600 hover:text-white transition-all group">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-1 opacity-60">Kontrol</p>
                    <p class="text-sm font-black uppercase italic">Kullanıcı Listesi</p>
                </a>

                <a href="{{ route('admin.contacts.index') }}" class="p-6 bg-slate-50 rounded-2xl hover:bg-blue-600 hover:text-white transition-all group relative">
                    @if(\App\Models\ContactMessage::where('status', 'bekliyor')->count() > 0)
                        <span class="absolute top-4 right-4 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-rose-500"></span>
                        </span>
                    @endif
                    <p class="text-[10px] font-black uppercase tracking-widest mb-1 opacity-60">Müşteri İlişkileri</p>
                    <p class="text-sm font-black uppercase italic">Gelen Kutusu</p>
                </a>
            </div>
        </div>

        <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <h4 class="text-sm font-black text-slate-900 uppercase italic mb-8 border-b pb-4">Sistem Durumu</h4>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 bg-slate-50 rounded-xl">
                    <span class="text-xs font-black text-slate-500 uppercase">Veritabanı</span>
                    <span class="text-[10px] font-black text-emerald-600 uppercase">Stabil</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-slate-50 rounded-xl">
                    <span class="text-xs font-black text-slate-500 uppercase">PDF Motoru</span>
                    <span class="text-[10px] font-black text-emerald-600 uppercase">Hazır</span>
                </div>
                <div class="flex justify-between items-center p-4 bg-slate-50 rounded-xl">
                    <span class="text-xs font-black text-slate-500 uppercase">İletişim Formu</span>
                    <span class="text-[10px] font-black text-blue-600 uppercase">Aktif</span>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>