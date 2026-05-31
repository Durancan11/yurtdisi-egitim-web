<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-slate-900 uppercase italic tracking-tighter border-l-4 border-rose-500 pl-4">
            Hesabı Kalıcı Olarak Sil
        </h2>
        <p class="mt-2 text-sm font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
            Hesabınız silindiğinde tüm verileriniz kalıcı olarak yok edilecektir.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-rose-50 text-rose-600 px-8 py-3 rounded-2xl font-black uppercase text-[10px] hover:bg-rose-600 hover:text-white transition-all shadow-sm"
    >Hesabımı Sil</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-12">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-slate-900 uppercase italic tracking-tighter text-center">
                Emin misiniz?
            </h2>

            <p class="mt-4 text-sm font-bold text-slate-400 uppercase tracking-widest text-center leading-relaxed">
                Bu işlem geri alınamaz. Devam etmek için lütfen şifrenizi girin.
            </p>

            <div class="mt-8">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-8 py-5 rounded-[2rem] border-none bg-slate-50 focus:ring-4 focus:ring-rose-500/10 font-bold"
                    placeholder="Onaylamak için şifrenizi girin"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-center gap-4">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest">
                    Vazgeç
                </x-secondary-button>

                <x-danger-button class="px-8 py-4 rounded-2xl bg-rose-600 font-black text-[10px] uppercase tracking-widest shadow-xl shadow-rose-200">
                    Hesabı Tamamen Sil
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>