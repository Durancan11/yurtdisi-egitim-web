<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Global Vizyon | Admin Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />
</head>
<body class="bg-[#F1F5F9] font-sans antialiased text-slate-900 overflow-hidden">
    
    <div class="flex h-screen">
        <aside class="w-72 bg-slate-900 h-full flex flex-col shadow-2xl z-50">
            <div class="p-8 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <span class="text-white font-black italic text-xl">G</span>
                    </div>
                    <div>
                        <p class="text-white font-black text-xs uppercase tracking-tighter italic">ADMIN <span class="text-indigo-400">CENTER</span></p>
                        <p class="text-[9px] font-bold text-slate-500 uppercase tracking-widest">Global Vizyon v3.0</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 p-6 space-y-2 overflow-y-auto">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-4 ml-2">Ana Menü</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-lg">📊</span>
                    <span class="text-xs font-black uppercase tracking-widest">Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.products.*') ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-lg">📦</span>
                    <span class="text-xs font-black uppercase tracking-widest">Ürün Yönetimi</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-lg">👥</span>
                    <span class="text-xs font-black uppercase tracking-widest">Kullanıcılar</span>
                </a>

                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-lg">📋</span>
                    <span class="text-xs font-black uppercase tracking-widest">Siparişler</span>
                </a>

                <a href="{{ route('admin.balance.requests') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.balance.requests') ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-4">
                        <span class="text-lg">💰</span>
                        <span class="text-xs font-black uppercase tracking-widest">Bakiye Onayları</span>
                    </div>
                </a>

                <a href="{{ route('admin.contacts.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.contacts.*') ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <div class="flex items-center gap-4">
                        <span class="text-lg">✉️</span>
                        <span class="text-xs font-black uppercase tracking-widest">Gelen Kutusu</span>
                    </div>
                    @php $unreadCount = \App\Models\ContactMessage::where('status', 'bekliyor')->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="bg-rose-500 text-white text-[9px] font-black px-2 py-1 rounded-full animate-pulse shadow-md">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.announcements.index') }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.announcements.*') ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="text-lg">📢</span>
                    <span class="text-xs font-black uppercase tracking-widest">Duyurular</span>
                </a>

            </nav>

            <div class="p-6 border-t border-slate-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-4 px-4 py-3 rounded-xl text-rose-500 hover:bg-rose-500/10 transition-all font-black text-xs uppercase tracking-widest">
                        <span>🚪</span> Çıkış Yap
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 h-screen overflow-y-auto bg-[#F1F5F9] relative">
            <div class="sticky top-0 bg-white/80 backdrop-blur-md border-b border-slate-200 px-10 py-5 flex justify-between items-center z-40">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Yönetim Paneli > <span class="text-slate-900">Genel Bakış</span></h3>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-xs font-black text-slate-900 uppercase italic">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] font-bold text-emerald-500 uppercase">Sistem Yöneticisi</p>
                    </div>
                    <div class="h-10 w-10 bg-slate-900 rounded-xl flex items-center justify-center text-white font-black italic">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <div class="p-10">
                {{ $slot }}
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        @if(session('error'))
            Toast.fire({ icon: 'error', title: "{{ session('error') }}" });
        @endif

        @if(session('info'))
            Toast.fire({ icon: 'info', title: "{{ session('info') }}" });
        @endif
    });
</script>
</body>
</html>