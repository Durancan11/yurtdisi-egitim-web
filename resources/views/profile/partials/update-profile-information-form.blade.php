<section>
    <header>
        <h2 class="text-xl font-black text-slate-900 uppercase italic tracking-tighter">
            {{ __('Profil Bilgileri') }}
        </h2>

        <p class="mt-1 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            {{ __("Hesap bilgilerinizi, iletişim adresinizi ve e-posta adresinizi güncelleyin.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Ad Soyad')" class="font-black text-[10px] uppercase text-slate-400" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-2xl border-slate-200 focus:ring-indigo-600 font-bold" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-posta Adresi')" class="font-black text-[10px] uppercase text-slate-400" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-2xl border-slate-200 focus:ring-indigo-600 font-bold" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-slate-800 font-bold">
                        {{ __('E-posta adresiniz doğrulanmadı.') }}
                        <button form="send-verification" class="underline text-xs text-slate-600 hover:text-indigo-600">
                            {{ __('Yeniden gönder.') }}
                        </button>
                    </p>
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="address" :value="__('İletişim ve Tebligat Adresi')" class="font-black text-[10px] uppercase text-slate-400" />
            <textarea id="address" name="address" 
                class="mt-1 block w-full border-slate-200 focus:border-indigo-600 focus:ring-indigo-600 rounded-2xl shadow-sm font-bold text-sm min-h-[100px] transition-all"
                placeholder="Eğitim Mah. Üniversite Cad. No:41 Kocaeli">{{ old('address', $user->address) }}</textarea>
            <p class="mt-1 text-[9px] text-slate-400 font-bold italic uppercase tracking-tighter">Sertifika ve evrak gönderimleri bu adrese yapılacaktır.</p>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-indigo-600 hover:bg-slate-900 rounded-xl px-8 py-3 font-black text-[10px] uppercase transition-all shadow-lg shadow-indigo-100">
                {{ __('Bilgileri Güncelle') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-black text-emerald-600 uppercase italic">
                    {{ __('Başarıyla kaydedildi.') }}
                </p>
            @endif
        </div>
    </form>

    <hr class="my-10 border-slate-100">

    <div class="bg-rose-50 p-8 rounded-[2rem] border border-rose-100">
        <header>
            <h2 class="text-sm font-black text-rose-600 uppercase italic tracking-tighter">
                {{ __('Hesabı Pasif Hale Getir') }}
            </h2>
            <p class="mt-1 text-[10px] font-bold text-rose-400 uppercase tracking-widest leading-relaxed">
                {{ __('Üyeliğinizi pasif ederek sisteme erişiminizi geçici olarak sonlandırabilirsiniz. Devam etmek için şifrenizi girin.') }}
            </p>
        </header>

        <form method="post" action="{{ route('profile.deactivate') }}" class="mt-6 space-y-4">
            @csrf
            <div class="max-w-xs">
                <x-input-label for="deactivate_password" :value="__('Onay İçin Şifreniz')" class="font-black text-[9px] uppercase text-rose-400" />
                <x-text-input id="deactivate_password" name="password" type="password" class="mt-1 block w-full rounded-xl border-rose-100 focus:ring-rose-500 font-bold text-sm" placeholder="••••••••" required />
                <x-input-error :messages="$errors->userDeactivation->get('password')" class="mt-2" />
            </div>

            <button type="submit" 
                onclick="return confirm('Emin misiniz? Hesabınız dondurulacak ve sistemden çıkış yapacaksınız.')"
                class="inline-flex items-center px-6 py-3 bg-rose-600 border border-transparent rounded-xl font-black text-[10px] text-white uppercase tracking-widest hover:bg-black transition ease-in-out duration-150 shadow-lg shadow-rose-100">
                {{ __('Üyeliğimi Pasif Et') }}
            </button>
        </form>
    </div>
</section>