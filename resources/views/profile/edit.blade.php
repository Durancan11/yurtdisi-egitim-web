<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <div class="mb-10 px-4 sm:px-0 text-center sm:text-left">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">Hesap <span class="text-blue-600">Ayarları</span></h2>
                <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Kişisel Bilgilerinizi ve Güvenlik Tercihlerinizi Yönetin</p>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-2xl border border-slate-100 rounded-[2.5rem] overflow-hidden">
                <div class="max-w-2xl">
                    <div class="mb-8 border-l-4 border-blue-600 pl-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase italic">Kimlik & İletişim</h3>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-2xl border border-slate-100 rounded-[2.5rem] overflow-hidden">
                <div class="max-w-2xl">
                    <div class="mb-8 border-l-4 border-slate-900 pl-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase italic">Güvenlik Kontrolü</h3>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 sm:p-12 bg-white shadow-2xl border border-red-100 rounded-[2.5rem] overflow-hidden">
                <div class="max-w-2xl">
                    <div class="mb-8 border-l-4 border-red-600 pl-4">
                        <h3 class="text-sm font-black text-red-600 uppercase italic">Hesabı Kapat</h3>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>