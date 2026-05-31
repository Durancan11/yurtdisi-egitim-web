<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Global Vizyon') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-slate-900 bg-[#F8FAFC] overflow-x-hidden">
    
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white/50 border-b border-slate-100">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="animate__animated animate__fadeInLeft">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endisset

        <main class="pt-12 pb-20 animate__animated animate__fadeIn">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Sihirli Dokunuş Burası: Hem eski hem yeni sayfaları destekleyecek hibrit yapı --}}
                @if (isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </div>
        </main>
    </div>

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