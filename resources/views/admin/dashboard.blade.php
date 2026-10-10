@extends('layouts.admin')
@section('pageTitle', 'Dashboard')
@section('content')

<div class="space-y-6">

    <!-- ROW 1: TOP 4 STAT CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        
        <!-- CARD 1: Spent this month -->
        <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex items-center justify-between">
            <div>
                <p class="text-[12px] font-semibold text-[#838e88]">Spent this month</p>
                <h3 class="text-2xl font-extrabold text-[#191e1b] tracking-tight mt-1">$682.5</h3>
            </div>
            <!-- Mini Sage Bar Chart -->
            <div class="flex items-end gap-1.5 h-10 px-2">
                <span class="w-1.5 h-4 bg-[#97ada1] rounded-full"></span>
                <span class="w-1.5 h-7 bg-[#3d5c4e] rounded-full"></span>
                <span class="w-1.5 h-3 bg-[#97ada1] rounded-full"></span>
                <span class="w-1.5 h-9 bg-[#3d5c4e] rounded-full"></span>
                <span class="w-1.5 h-5 bg-[#3d5c4e] rounded-full"></span>
            </div>
        </div>

        <!-- CARD 2: New clients -->
        <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex items-center justify-between">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-full bg-[#f0ece5] text-[#3d5c4e] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[12px] font-semibold text-[#838e88]">New clients</p>
                    <h3 class="text-2xl font-extrabold text-[#191e1b] tracking-tight mt-0.5">321</h3>
                </div>
            </div>
            <!-- Mini Trend Curve -->
            <div class="w-14 h-8 shrink-0">
                <svg class="w-full h-full" viewBox="0 0 60 30" fill="none">
                    <path d="M2 24 C 18 22, 28 28, 40 12 C 48 2, 54 8, 58 4" stroke="#3d5c4e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </div>

        <!-- CARD 3: Earnings -->
        <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex items-center justify-between">
            <div class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-full bg-[#f6efe7] text-[#9a8462] flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v10M15 9.5a2.5 2.5 0 00-5 0c0 2.5 5 1.5 5 4a2.5 2.5 0 01-5 0" />
                    </svg>
                </div>
                <div>
                    <p class="text-[12px] font-semibold text-[#838e88]">Earnings</p>
                    <h3 class="text-2xl font-extrabold text-[#191e1b] tracking-tight mt-0.5">$350.40</h3>
                </div>
            </div>
        </div>

        <!-- CARD 4: Activity (SOLID SAGE GREEN CARD) -->
        <div class="bg-[#456353] rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(69,99,83,0.35)] flex items-center justify-between text-white">
            <div>
                <p class="text-[12px] font-semibold text-white/80">Activity</p>
                <h3 class="text-2xl font-extrabold text-white tracking-tight mt-1">$540.50</h3>
            </div>
            <!-- Glowing Wave Line -->
            <div class="w-20 h-10 shrink-0">
                <svg class="w-full h-full" viewBox="0 0 80 40" fill="none">
                    <path d="M2 28 C 15 28, 22 10, 35 15 C 45 20, 52 5, 62 12 C 70 18, 74 10, 78 8" 
                          stroke="#ffffff" 
                          stroke-width="2.5" 
                          stroke-linecap="round" 
                          stroke-linejoin="round" 
                          opacity="0.9" />
                </svg>
            </div>
        </div>

    </div>

    <!-- ROW 2: MIDDLE 3 CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
        
        <!-- CARD A: Balance (Left Wide, 5 cols) -->
        <div class="md:col-span-12 xl:col-span-5 bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-col justify-between">
            <div>
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-extrabold text-[#191e1b]">Balance</h2>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-[#eaf5ee] text-[#286843] text-[11px] font-bold">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#286843]"></span>
                            On track
                        </span>
                    </div>
                    <div class="flex items-center gap-1 text-xs font-semibold text-[#828e87] cursor-pointer hover:text-[#191e1b]">
                        <span>Monthly</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Two Stats Row -->
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <!-- Saves -->
                    <div class="bg-[#faf8f5] rounded-2xl p-4 border border-[#eeebe3]">
                        <p class="text-[11px] font-semibold text-[#838e88]">Saves</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xl font-extrabold text-[#191e1b]">43.50%</span>
                            <span class="px-1.5 py-0.5 rounded-full bg-[#eaf5ee] text-[#286843] text-[10px] font-bold">+2.45%</span>
                        </div>
                    </div>
                    <!-- Balance -->
                    <div class="bg-[#faf8f5] rounded-2xl p-4 border border-[#eeebe3]">
                        <p class="text-[11px] font-semibold text-[#838e88]">Balance</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xl font-extrabold text-[#191e1b]">$52,422</span>
                            <span class="px-1.5 py-0.5 rounded-full bg-[#fdf0ed] text-[#b94838] text-[10px] font-bold">-4.75%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Smooth Fluid Wave Chart (Continuous Organic Flow) -->
            <div class="w-full mt-6 pt-4">
                <svg class="w-full h-24" viewBox="0 0 450 100" fill="none" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="waveGradient" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#456353" stop-opacity="0.12" />
                            <stop offset="100%" stop-color="#456353" stop-opacity="0.0" />
                        </linearGradient>
                    </defs>
                    <!-- Filled Gradient area -->
                    <path d="M 0 65 
                             C 40 65, 55 35, 75 35 
                             C 95 35, 110 75, 130 75 
                             C 150 75, 160 20, 185 20 
                             C 210 20, 225 55, 245 55 
                             C 265 55, 275 15, 295 15 
                             C 315 15, 330 45, 350 45 
                             C 370 45, 390 60, 415 60 
                             C 435 60, 445 65, 450 65 
                             L 450 100 L 0 100 Z" fill="url(#waveGradient)" />
                    <!-- Curve stroke -->
                    <path d="M 0 65 
                             C 40 65, 55 35, 75 35 
                             C 95 35, 110 75, 130 75 
                             C 150 75, 160 20, 185 20 
                             C 210 20, 225 55, 245 55 
                             C 265 55, 275 15, 295 15 
                             C 315 15, 330 45, 350 45 
                             C 370 45, 390 60, 415 60 
                             C 435 60, 445 65, 450 65" 
                          stroke="#7b998a" 
                          stroke-width="2.5" 
                          stroke-linecap="round" 
                          stroke-linejoin="round" />
                </svg>
            </div>
        </div>

        <!-- CARD B: Earnings (Middle, 4 cols) -->
        <div class="md:col-span-6 xl:col-span-4 bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-extrabold text-[#191e1b]">Earnings</h2>
                <p class="text-[12px] font-semibold text-[#838e88] mt-1">Total Expense</p>
                <h3 class="text-3xl font-extrabold text-[#191e1b] tracking-tight mt-1">$6078.76</h3>
                <p class="text-xs font-semibold text-[#6f7c75] mt-1.5">Profit is 34% More than last Month</p>
            </div>

            <!-- Semi-Circular Radial Gauge (80%) -->
            <div class="flex flex-col items-center justify-center mt-6">
                <div class="relative w-48 h-28 flex items-end justify-center">
                    <svg class="w-48 h-28" viewBox="0 0 160 90">
                        <!-- Background arc -->
                        <path d="M 15 80 A 65 65 0 0 1 145 80" 
                              fill="none" 
                              stroke="#e6ebe8" 
                              stroke-width="16" 
                              stroke-linecap="round" />
                        <!-- Progress arc (80%) -->
                        <path d="M 15 80 A 65 65 0 0 1 125 35" 
                              fill="none" 
                              stroke="#456353" 
                              stroke-width="16" 
                              stroke-linecap="round" />
                    </svg>
                    <!-- Percentage in center -->
                    <div class="absolute bottom-1 font-extrabold text-2xl text-[#191e1b]">
                        80%
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD C: Profile Card (Right, 3 cols) -->
        <div class="md:col-span-6 xl:col-span-3 bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-col items-center text-center justify-between">
            <div class="flex flex-col items-center w-full">
                <!-- Avatar with warm circular badge -->
                <div class="w-20 h-20 rounded-full bg-[#f7ebe0] ring-4 ring-white shadow-sm flex items-center justify-center text-4xl overflow-hidden mt-1">
                    <!-- Memoji Illustration -->
                    <span role="img" aria-label="avatar">😎</span>
                </div>
                <h3 class="text-lg font-extrabold text-[#191e1b] mt-3">Carlic Bolomboy</h3>
                <p class="text-xs font-semibold text-[#838e88] mt-0.5">carlic@gmail.com</p>
            </div>

            <!-- 3 Column Stats -->
            <div class="grid grid-cols-3 gap-2 w-full pt-5 mt-4 border-t border-[#f0ece5]">
                <div>
                    <p class="text-[11px] font-semibold text-[#838e88]">Projects</p>
                    <p class="text-lg font-black text-[#191e1b] mt-0.5">{{ $productCount ?? 26 }}</p>
                </div>
                <div>
                    <p class="text-[11px] font-semibold text-[#838e88]">Followers</p>
                    <p class="text-lg font-black text-[#191e1b] mt-0.5">{{ $orderCount ?? 356 }}</p>
                </div>
                <div>
                    <p class="text-[11px] font-semibold text-[#838e88]">Following</p>
                    <p class="text-lg font-black text-[#191e1b] mt-0.5">{{ $materialCount ?? 68 }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- ROW 3: BOTTOM 3 CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-5">
        
        <!-- CARD D: Available Credit Card in Wallet (Left, 5 cols) -->
        <div class="md:col-span-12 xl:col-span-5 bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-col sm:flex-row items-center justify-between gap-6 overflow-hidden">
            <!-- Text & CTA -->
            <div class="flex-1 space-y-3">
                <h3 class="text-base font-extrabold text-[#191e1b] leading-tight">
                    Available Credit<br>Card in Wallet
                </h3>
                <p class="text-[11px] font-medium text-[#7d8882] leading-relaxed line-clamp-3">
                    Kelola saldo operasional, aset material jok motor, kulit sintetis, dan komponen produksi Stalltech secara aman.
                </p>
                <div class="pt-2">
                    <a href="{{ route('admin.materials') }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-[#456353] hover:bg-[#344f41] text-white text-xs font-bold transition-all shadow-sm">
                        <span>Add New Card</span>
                        <span>+</span>
                    </a>
                </div>
            </div>

            <!-- 3D Isometric Stacked Cards Illustration -->
            <div class="w-52 h-44 shrink-0 relative flex items-center justify-center">
                <svg class="w-full h-full" viewBox="0 0 240 200" fill="none">
                    <!-- Card 3 (Bottom - Charcoal Midnight) -->
                    <g transform="translate(15, 60) skewX(-25) rotate(15)">
                        <rect width="130" height="78" rx="10" fill="#202924" shadow="0 10px 20px rgba(0,0,0,0.2)"/>
                        <circle cx="20" cy="20" r="5" fill="#e85d43" />
                        <circle cx="26" cy="20" r="5" fill="#f7ab3b" fill-opacity="0.8" />
                        <rect x="15" y="46" width="70" height="3" rx="1.5" fill="#ffffff" fill-opacity="0.3" />
                        <rect x="15" y="54" width="40" height="3" rx="1.5" fill="#ffffff" fill-opacity="0.2" />
                    </g>
                    <!-- Card 2 (Middle - Deep Sage Forest) -->
                    <g transform="translate(25, 38) skewX(-25) rotate(15)">
                        <rect width="130" height="78" rx="10" fill="#3d5c4e" />
                        <circle cx="20" cy="20" r="5" fill="#e85d43" />
                        <circle cx="26" cy="20" r="5" fill="#f7ab3b" fill-opacity="0.8" />
                        <rect x="15" y="46" width="70" height="3" rx="1.5" fill="#ffffff" fill-opacity="0.4" />
                        <rect x="15" y="54" width="40" height="3" rx="1.5" fill="#ffffff" fill-opacity="0.3" />
                    </g>
                    <!-- Card 1 (Top - Translucent Frosted Sage Card) -->
                    <g transform="translate(35, 14) skewX(-25) rotate(15)">
                        <rect width="130" height="78" rx="10" fill="#a4bdad" fill-opacity="0.75" stroke="#ffffff" stroke-width="1" />
                        <text x="15" y="18" fill="#1e3328" font-size="7" font-weight="bold">Master Card</text>
                        <!-- Chip -->
                        <rect x="15" y="24" width="16" height="12" rx="2" fill="#d9e6de" />
                        <!-- Wireless Signal -->
                        <path d="M 36 28 A 4 4 0 0 1 36 34" stroke="#ffffff" stroke-width="1" stroke-linecap="round" fill="none" />
                        <path d="M 39 26 A 7 7 0 0 1 39 36" stroke="#ffffff" stroke-width="1" stroke-linecap="round" fill="none" />
                        <!-- Numbers -->
                        <text x="15" y="52" fill="#ffffff" font-size="8" font-weight="bold" letter-spacing="1">1234 1234 1234</text>
                        <text x="15" y="65" fill="#1e3328" font-size="6">LEON STEINER</text>
                        <!-- Circles logo -->
                        <circle cx="108" cy="62" r="6" fill="#e85d43" />
                        <circle cx="116" cy="62" r="6" fill="#f7ab3b" fill-opacity="0.8" />
                    </g>
                </svg>
            </div>
        </div>

        <!-- CARD E: Your Transfers (Middle, 4 cols) -->
        <div class="md:col-span-6 xl:col-span-4 bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-col justify-between">
            <h3 class="text-base font-extrabold text-[#191e1b]">Your Transfers</h3>

            <div class="divide-y divide-[#f2ede6] mt-3">
                <!-- Transfer 1 -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-[#191e1b]">From Anna Jones</p>
                        <p class="text-[10px] font-semibold text-[#838e88] mt-0.5">Today, 14:34</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-[#eaf5ee] text-[#286843] text-[10px] font-bold">+2.45%</span>
                </div>

                <!-- Transfer 2 -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-[#191e1b]">To Carlos Brown III</p>
                        <p class="text-[10px] font-semibold text-[#838e88] mt-0.5">Today, 15:23</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-[#fdf0ed] text-[#b94838] text-[10px] font-bold">-4.75%</span>
                </div>

                <!-- Transfer 3 -->
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-extrabold text-[#191e1b]">From Joel Cannan</p>
                        <p class="text-[10px] font-semibold text-[#838e88] mt-0.5">Today, 17:54</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-[#eaf5ee] text-[#286843] text-[10px] font-bold">+2.45%</span>
                </div>
            </div>
        </div>

        <!-- CARD F: Keep you safe! (Right, 3 cols) -->
        <div class="md:col-span-6 xl:col-span-3 bg-white rounded-[24px] p-6 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60 flex flex-col items-center text-center justify-between">
            <div class="flex flex-col items-center">
                <!-- Sage Biometric Fingerprint Icon -->
                <div class="w-16 h-16 text-[#456353] flex items-center justify-center mb-1">
                    <svg class="w-14 h-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 10a2 2 0 0 0-2 2c0 1.02-.1 2.51-.26 4"/>
                        <path d="M14 13.12c0 2.38 0 6.38-1 8.88"/>
                        <path d="M2 16h.01"/>
                        <path d="M21.8 16c.2-2 .131-5.354 0-6"/>
                        <path d="M9 6.8a6 6 0 0 1 9 5.2c0 .47 0 1.17-.02 2"/>
                        <path d="M5.83 8.5a9.01 9.01 0 0 1 12.34-1.5"/>
                        <path d="M3.5 12a12.01 12.01 0 0 1 16.9-1"/>
                        <path d="M7 14c0 3.5 1.5 6 3 8"/>
                        <path d="M4.5 17.5a15.8 15.8 0 0 0 1 3.5"/>
                    </svg>
                </div>
                <h3 class="text-base font-extrabold text-[#191e1b] mt-1">Keep you safe!</h3>
                <p class="text-[11px] font-medium text-[#838e88] mt-1">Update your security password</p>
            </div>

            <div class="w-full pt-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="w-full inline-flex items-center justify-center py-2.5 px-4 rounded-full bg-[#456353] hover:bg-[#344f41] text-white text-xs font-bold transition-all shadow-sm">
                    Update Your Security
                </a>
            </div>
        </div>

    </div>

    <!-- EXTRA SECTION: STALLTECH LIVE OPERATIONAL PULSE -->
    <div class="mt-10 pt-6 border-t border-[#ded8ce]">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-[#456353]">Live System Overview</p>
                <h2 class="text-xl font-black text-[#191e1b] mt-0.5">Operasional Stalltech</h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.products') }}" class="px-3 py-1.5 rounded-full bg-white border border-[#ded8ce] text-xs font-bold text-[#191e1b] hover:bg-[#f6f3ee]">Produk ({{ $productCount }})</a>
                <a href="{{ route('admin.materials') }}" class="px-3 py-1.5 rounded-full bg-white border border-[#ded8ce] text-xs font-bold text-[#191e1b] hover:bg-[#f6f3ee]">Material ({{ $materialCount }})</a>
                <a href="{{ route('admin.orders') }}" class="px-3 py-1.5 rounded-full bg-[#456353] text-white text-xs font-bold hover:bg-[#344f41]">Order Masuk ({{ $orderCount }})</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
            <!-- Order Terbaru Stalltech -->
            <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                <div class="flex items-center justify-between pb-3 border-b border-[#f2ede6]">
                    <span class="text-xs font-bold text-[#191e1b]">Order Terbaru Masuk</span>
                    <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-[#456353] hover:underline">Semua order &rarr;</a>
                </div>
                <div class="divide-y divide-[#f2ede6]">
                    @forelse($recentOrders as $order)
                        <div class="py-3 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-[#191e1b]">{{ $order->order_number }}</span>
                                <span class="text-[11px] text-[#838e88] block">{{ $order->user->name }} &middot; {{ $order->created_at->format('d M H:i') }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-black text-[#191e1b] block">{{ rupiah($order->total) }}</span>
                                <span class="status status-{{ $order->status }} mt-0.5">{{ $order->statusLabel() }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="py-6 text-center text-xs text-[#838e88]">Belum ada pesanan terbaru.</p>
                    @endforelse
                </div>
            </div>

            <!-- Monitoring Stok & Material -->
            <div class="bg-white rounded-[24px] p-5 shadow-[0_4px_20px_-2px_rgba(60,75,65,0.05)] border border-[#e2ddd5]/60">
                <div class="flex items-center justify-between pb-3 border-b border-[#f2ede6]">
                    <span class="text-xs font-bold text-[#191e1b]">Kondisi Stok & Material</span>
                    <a href="{{ route('admin.materials') }}" class="text-xs font-bold text-[#456353] hover:underline">Kelola &rarr;</a>
                </div>
                <div class="space-y-3 mt-3">
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-[#faf8f5]">
                        <span class="text-xs font-semibold text-[#191e1b]">Stok Jok Jadi Siap Jual</span>
                        <strong class="text-sm font-black text-[#456353]">{{ number_format($finishedStock, 0, ',', '.') }} unit</strong>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-[#faf8f5]">
                        <span class="text-xs font-semibold text-[#191e1b]">Total Pendapatan Tervalidasi</span>
                        <strong class="text-sm font-black text-[#191e1b]">{{ rupiah($revenue) }}</strong>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-[#faf8f5]">
                        <span class="text-xs font-semibold text-[#191e1b]">Material Stok Minimum</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $lowMaterials->count() ? 'bg-[#fdf0ed] text-[#b94838]' : 'bg-[#eaf5ee] text-[#286843]' }}">
                            {{ $lowMaterials->count() }} item
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
