<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Stalltech - Dashboard' }}</title>
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
<body class="min-h-screen bg-[#ece9e2] text-[#191e1b] antialiased p-3 sm:p-6 lg:p-8">

    <div class="mx-auto max-w-[1600px] flex flex-col lg:flex-row gap-6 items-start relative">

        <!-- FLOATING VERTICAL DOCK SIDEBAR -->
        <aside class="w-full lg:w-[76px] lg:sticky lg:top-8 shrink-0 bg-white rounded-3xl lg:rounded-[40px] p-3 lg:py-6 shadow-[0_8px_30px_rgb(0,0,0,0.03)] border border-[#e2ddd5]/60 flex lg:flex-col items-center justify-between gap-4 z-40">
            
            <!-- Top / Primary Nav Icons -->
            <div class="flex lg:flex-col items-center gap-3 w-full justify-around lg:justify-start">
                
                <!-- Dashboard / Home (Active Button) -->
                <a href="{{ route('admin.dashboard') }}" 
                   title="Dashboard" 
                   class="w-12 h-12 rounded-full flex items-center justify-center transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#191e1b] text-white shadow-md' : 'text-[#828e87] hover:text-[#191e1b] hover:bg-[#f4efe8]' }}">
                    <!-- 4-Grid Icon -->
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <rect x="3" y="3" width="7" height="7" rx="2"/>
                        <rect x="14" y="3" width="7" height="7" rx="2"/>
                        <rect x="14" y="14" width="7" height="7" rx="2"/>
                        <rect x="3" y="14" width="7" height="7" rx="2"/>
                    </svg>
                </a>

                <!-- Products & Variasi -->
                <a href="{{ route('admin.products') }}" 
                   title="Produk & Variasi Jok" 
                   class="w-12 h-12 rounded-full flex items-center justify-center transition-all {{ request()->routeIs('admin.products*', 'admin.bom*') ? 'bg-[#191e1b] text-white shadow-md' : 'text-[#828e87] hover:text-[#191e1b] hover:bg-[#f4efe8]' }}">
                    <!-- Card / ID Card Icon -->
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="5" width="18" height="14" rx="3" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                        <circle cx="7" cy="15" r="1" fill="currentColor" />
                    </svg>
                </a>

                <!-- Reports / Analytics -->
                <a href="{{ route('admin.reports') }}" 
                   title="Laporan & Keuntungan" 
                   class="w-12 h-12 rounded-full flex items-center justify-center transition-all {{ request()->routeIs('admin.reports*') ? 'bg-[#191e1b] text-white shadow-md' : 'text-[#828e87] hover:text-[#191e1b] hover:bg-[#f4efe8]' }}">
                    <!-- Bar Chart Icon -->
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 20V10M12 20V4M6 20v-6" />
                    </svg>
                </a>

                <!-- Materials & Inventory -->
                <a href="{{ route('admin.materials') }}" 
                   title="Material & Stok" 
                   class="w-12 h-12 rounded-full flex items-center justify-center transition-all {{ request()->routeIs('admin.materials*') ? 'bg-[#191e1b] text-white shadow-md' : 'text-[#828e87] hover:text-[#191e1b] hover:bg-[#f4efe8]' }}">
                    <!-- Building / Warehouse Icon -->
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </a>

                <!-- Orders -->
                <a href="{{ route('admin.orders') }}" 
                   title="Order Masuk" 
                   class="w-12 h-12 rounded-full flex items-center justify-center transition-all {{ request()->routeIs('admin.orders*') ? 'bg-[#191e1b] text-white shadow-md' : 'text-[#828e87] hover:text-[#191e1b] hover:bg-[#f4efe8]' }}">
                    <!-- Users Icon -->
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </a>

                <!-- Storefront Link -->
                <a href="{{ route('home') }}" 
                   title="Kunjungi Storefront" 
                   class="w-12 h-12 rounded-full flex items-center justify-center text-[#828e87] hover:text-[#191e1b] hover:bg-[#f4efe8] transition-all">
                    <!-- External / Store icon -->
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </a>
            </div>

            <!-- Bottom Icons -->
            <div class="flex lg:flex-col items-center gap-3 w-full justify-around lg:justify-end mt-0 lg:mt-12">
                <!-- Settings -->
                <a href="{{ route('admin.dashboard') }}" 
                   title="Pengaturan Workspace" 
                   class="w-12 h-12 rounded-full flex items-center justify-center text-[#828e87] hover:text-[#191e1b] hover:bg-[#f4efe8] transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" 
                            title="Keluar dari Workspace" 
                            class="w-12 h-12 rounded-full flex items-center justify-center text-[#828e87] hover:text-red-600 hover:bg-[#fdf0ed] transition-all cursor-pointer">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>

                <!-- Avatar Circle -->
                <div class="w-10 h-10 rounded-full bg-[#191e1b] text-white flex items-center justify-center text-xs font-bold ring-2 ring-white shadow-sm overflow-hidden" title="{{ auth()->user()->name }}">
                    <span class="text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                </div>
            </div>
        </aside>

        <!-- MAIN VIEW AREA -->
        <main class="flex-1 w-full min-w-0">
            
            <!-- TOPBAR MATCHING REFERENCE -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                
                <!-- Left: Greeting with Starburst Sun Icon -->
                <div class="flex items-center gap-4">
                    <!-- Sage Starburst Icon -->
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center text-[#3d5c4e]">
                        <svg class="w-10 h-10 animate-spin-slow" viewBox="0 0 40 40" fill="currentColor">
                            <!-- 12-petaled sunburst star shape -->
                            <rect x="18" y="1" width="4" height="11" rx="2" />
                            <rect x="18" y="28" width="4" height="11" rx="2" />
                            <rect x="1" y="18" width="11" height="4" rx="2" />
                            <rect x="28" y="18" width="11" height="4" rx="2" />
                            <rect x="6.5" y="6.5" width="4" height="11" rx="2" transform="rotate(-45 8.5 12)" />
                            <rect x="25.5" y="25.5" width="4" height="11" rx="2" transform="rotate(-45 27.5 31)" />
                            <rect x="25.5" y="6.5" width="4" height="11" rx="2" transform="rotate(45 27.5 12)" />
                            <rect x="6.5" y="25.5" width="4" height="11" rx="2" transform="rotate(45 8.5 31)" />
                            <circle cx="20" cy="20" r="4.5" fill="#3d5c4e" />
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#191e1b]">
                            Hello, {{ auth()->user()->name ?? 'Carlic' }}!
                        </h1>
                        <p class="text-xs sm:text-sm font-medium text-[#7d8882] mt-0.5">
                            Explore information and activity about your Stalltech workshop
                        </p>
                    </div>
                </div>

                <!-- Right: Search Pill & Action Buttons -->
                <div class="flex items-center gap-3">
                    
                    <!-- Search Pill Input -->
                    <div class="relative flex items-center bg-white rounded-full pl-5 pr-2 py-1.5 shadow-[0_4px_18px_rgba(60,75,65,0.04)] border border-[#e2ddd5]/60 w-56 sm:w-72">
                        <input type="text" 
                               placeholder="Search..." 
                               class="w-full bg-transparent border-none text-xs text-[#191e1b] placeholder-[#9ca5a0] focus:outline-none p-0">
                        <button class="w-8 h-8 rounded-full bg-[#191e1b] text-white flex items-center justify-center shrink-0 hover:bg-[#343e38] transition-all cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <circle cx="11" cy="11" r="7" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </button>
                    </div>

                    <!-- Chat Circle Button with Red Badge -->
                    <div class="relative">
                        <a href="{{ route('admin.orders') }}" 
                           class="w-11 h-11 rounded-full bg-white flex items-center justify-center shadow-[0_4px_18px_rgba(60,75,65,0.04)] border border-[#e2ddd5]/60 text-[#191e1b] hover:bg-[#f6f3ee] transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <!-- Red indicator dot -->
                            <span class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-[#e05244] ring-2 ring-white"></span>
                        </a>
                    </div>

                    <!-- Bell Circle Button -->
                    <div class="relative">
                        <a href="{{ route('admin.orders') }}" 
                           class="w-11 h-11 rounded-full bg-white flex items-center justify-center shadow-[0_4px_18px_rgba(60,75,65,0.04)] border border-[#e2ddd5]/60 text-[#191e1b] hover:bg-[#f6f3ee] transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-[#eaf5ee] border border-[#b7dfc6] px-5 py-3 text-sm text-[#236540] flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="mb-6 rounded-2xl bg-[#fdf0ed] border border-[#f5c4bb] px-5 py-3 text-sm text-[#b94838] flex items-center justify-between">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- PAGE CONTENT -->
            @yield('content')

        </main>
    </div>

</body>
</html>
