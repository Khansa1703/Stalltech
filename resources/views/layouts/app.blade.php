<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Stalltech - Jok Motor Siap Jalan' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @if(!app()->environment('testing')) @vite(['resources/css/app.css', 'resources/js/app.js']) @endif
    <style>
        body {
            background-color: #ece9e2;
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            color: #191e1b;
        }
    </style>
</head>
<body class="min-h-screen bg-[#ece9e2] text-[#191e1b] antialiased">
    
    <!-- FLOATING TOP NAVBAR -->
    <header class="sticky top-4 z-50 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl bg-white/95 backdrop-blur-md rounded-full shadow-[0_4px_25px_rgba(60,75,65,0.06)] border border-[#e2ddd5]/70 px-6 py-3.5 flex items-center justify-between">
            
            <!-- Brand -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 font-black text-xl tracking-tight text-[#191e1b]">
                <div class="w-8 h-8 rounded-full bg-[#456353] text-white flex items-center justify-center text-xs font-bold shadow-sm">
                    S
                </div>
                <span>STALL<span class="text-[#456353]">TECH</span></span>
            </a>

            <!-- Nav Links -->
            <nav class="hidden md:flex items-center gap-6 text-xs font-bold text-[#55635c]">
                <a href="{{ route('catalog') }}" class="hover:text-[#191e1b] transition-colors">Katalog Produk</a>
                @auth
                    <a href="{{ route('orders.index') }}" class="hover:text-[#191e1b] transition-colors">Pesanan Saya</a>
                    @if(auth()->user()->isOwner())
                        <a href="{{ route('admin.dashboard') }}" class="text-[#456353] font-extrabold hover:underline">Workspace Owner</a>
                    @endif
                @endauth
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('cart') }}" class="inline-flex items-center gap-2 rounded-full bg-[#f4efe8] hover:bg-[#eae4da] px-4 py-2 text-xs font-bold text-[#191e1b] transition-colors">
                    <svg class="w-4 h-4 text-[#456353]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Keranjang</span>
                    <span class="w-5 h-5 rounded-full bg-[#456353] text-white flex items-center justify-center text-[10px] font-extrabold">
                        {{ array_sum(session('cart', [])) }}
                    </span>
                </a>

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="m-0 hidden sm:block">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-[#828e87] hover:text-red-600 transition-colors cursor-pointer">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-block text-xs font-bold text-[#55635c] hover:text-[#191e1b] transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="button small">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="mx-auto mt-6 max-w-7xl px-5">
            <div class="rounded-2xl border border-[#b7dfc6] bg-[#eaf5ee] px-5 py-3 text-sm text-[#236540] flex items-center justify-between">
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="mx-auto mt-6 max-w-7xl px-5">
            <div class="rounded-2xl border border-[#f5c4bb] bg-[#fdf0ed] px-5 py-3 text-sm text-[#b94838] flex items-center justify-between">
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
    @endif

    <main class="py-6">
        @yield('content')
    </main>

    <footer class="mt-20 border-t border-[#ded8ce] py-8 text-center text-xs font-medium text-[#828e87]">
        <div class="mx-auto max-w-7xl px-5">
            Stalltech Management System &mdash; Jok motor siap jalan dengan kenyamanan presisi.
        </div>
    </footer>

</body>
</html>
