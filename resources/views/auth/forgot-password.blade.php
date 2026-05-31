<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Şifremi Unuttum | Global Vizyon</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>

<body class="font-sans antialiased text-slate-900 bg-[#F8FAFC] min-h-screen flex flex-col justify-center items-center p-4">

    <div class="mb-10 text-center animate__animated animate__fadeInDown">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-4 group">
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 shadow-xl shadow-indigo-200 group-hover:rotate-6 transition-transform duration-300">
                <span class="text-white font-black text-4xl italic leading-none">G</span>
            </div>
            <div class="text-left leading-tight">
                <p class="text-2xl font-black tracking-tighter text-slate-900 uppercase italic">GLOBAL <span class="text-indigo-600">VIZYON</span></p>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">Eğitim Danışmanlığı</p>
            </div>
        </a>
    </div>

    <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl rounded-[2.5rem] border border-slate-100 animate__animated animate__fadeInUp">
        
        <h3 class="text-xl font-black text-slate-800 uppercase tracking-widest text-center mb-4">
            Şifrenizi mi <span class="text-indigo-600 italic">Unuttunuz?</span>
        </h3>

        <p class="text-xs font-bold text-slate-500 text-center mb-8 leading-relaxed">
            Sorun değil. E-posta adresinizi girin, size yeni bir şifre belirleyebileceğiniz sıfırlama bağlantısını hemen gönderelim.
        </p>

        @if (session('status'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-center">
                <p class="text-xs font-black text-emerald-600 uppercase tracking-widest">{{ session('status') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl">
                <ul class="text-xs font-bold text-rose-500 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2 mb-2">E-Posta Adresiniz</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-envelope text-slate-400"></i>
                    </div>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ornek@globalvizyon.com"
                           class="w-full pl-11 pr-5 py-4 rounded-2xl border-slate-200 focus:ring-4 focus:ring-indigo-500/20 text-sm font-bold text-slate-700 bg-slate-50 focus:bg-white transition-all shadow-inner" />
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest hover:bg-indigo-600 transition-all duration-300 shadow-xl hover:shadow-indigo-200 active:scale-95 flex items-center justify-center gap-3 group">
                    SIFIRLAMA LİNKİ GÖNDER 
                    <i class="fa-solid fa-paper-plane opacity-70 group-hover:-translate-y-1 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
            
            <div class="text-center mt-6 pt-6 border-t border-slate-100">
                <a href="{{ route('login') }}" class="text-[11px] font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                    <i class="fa-solid fa-arrow-left"></i> Giriş Ekranına Dön
                </a>
            </div>
        </form>
    </div>

</body>
</html>