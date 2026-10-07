<?php
/**
 * Hero Component - D'BRIGHT COFFEE
 * Banner promosi utama dengan tampilan modern, estetik, dan rapi
 */
?>
<!-- HERO SECTION -->
<section id="beranda" class="pt-10 pb-16 lg:py-18 bg-gradient-to-b from-cream-50 via-cream-100/70 to-cream-50 border-b border-cream-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            
            <!-- Left Column: Copywriting & CTA -->
            <div class="lg:col-span-7 text-center lg:text-left">
                <div class="inline-flex items-center gap-2.5 border border-cream-300 bg-white/90 backdrop-blur-xs px-4 py-1.5 rounded-full shadow-xs mb-6">
                    <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo" class="w-5 h-5 rounded-full object-cover">
                    <span class="text-coffee-dark text-xs font-bold uppercase tracking-wider">Official Coffee & Snack Samata</span>
                </div>

                <h1 class="font-heading font-extrabold text-3xl sm:text-5xl lg:text-5xl text-stone-900 tracking-tight leading-tight mb-5">
                    Nikmati Setiap Tegukan Bersama <br class="hidden sm:inline">
                    <span class="text-coffee">D'BRIGHT COFFEE</span>
                </h1>

                <p class="text-stone-600 text-sm sm:text-base leading-relaxed mb-7 max-w-2xl mx-auto lg:mx-0">
                    Menyajikan racikan kopi autentik berkualitas mulai dari <?= formatRupiah(10000) ?>, pilihan Non-Coffee creamy yang segar, serta camilan hangat khas kafe dengan cita rasa istimewa dan harga bersahabat bagi mahasiswa.
                </p>

                <!-- Benefit Pills -->
                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-2.5 mb-7 text-xs sm:text-sm text-stone-700 font-semibold">
                    <div class="bg-white px-3.5 py-1.5 rounded-full border border-cream-300 shadow-xs flex items-center gap-1.5">
                        <span class="text-coffee">☕</span>
                        <span><?= $totalMenu ?> Menu Lengkap</span>
                    </div>
                    <div class="bg-white px-3.5 py-1.5 rounded-full border border-cream-300 shadow-xs flex items-center gap-1.5">
                        <span class="text-emerald-600">🏷️</span>
                        <span>Mulai <?= formatRupiah(8000) ?>,-</span>
                    </div>
                    <div class="bg-white px-3.5 py-1.5 rounded-full border border-cream-300 shadow-xs flex items-center gap-1.5">
                        <span class="text-amber-600">📍</span>
                        <span>Romang Polong, Samata</span>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5">
                    <button class="btn-order-item w-full sm:w-auto bg-coffee hover:bg-coffee-dark text-white font-bold px-7 py-3.5 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all cursor-pointer flex items-center justify-center gap-2 text-sm" data-name="Signature D'Bright" data-price="15000" data-category="coffee">
                        <span>Pesan via WhatsApp &rarr;</span>
                    </button>
                    <a href="#menu" class="w-full sm:w-auto bg-white hover:bg-cream-100 text-stone-800 font-bold px-6 py-3.5 rounded-xl border border-cream-300 shadow-xs hover:shadow-md hover:-translate-y-0.5 text-center transition-all text-sm">
                        Lihat Katalog Menu
                    </a>
                </div>

                <!-- Akses Cepat Terpadu Admin & Pesanan di Halaman Utama -->
                <div class="mt-4 flex items-center justify-center lg:justify-start gap-3 text-xs font-semibold text-stone-600">
                    <button type="button" class="btn-buka-pesanan hover:text-coffee transition inline-flex items-center gap-1 cursor-pointer">
                        <span>📋</span>
                        <span class="underline">Riwayat Pesanan (<?= $countPesanan ?>)</span>
                    </button>
                    <span class="text-stone-300">&bull;</span>
                    <a href="admin.php" class="hover:text-coffee transition inline-flex items-center gap-1">
                        <span>⚙️</span>
                        <span class="underline font-bold text-coffee">Panel Admin CRUD Menu</span>
                    </a>
                </div>

                <!-- Statistik Menu Ringkas -->
                <div class="grid grid-cols-3 gap-3 pt-6 mt-8 border-t border-cream-200 max-w-lg mx-auto lg:mx-0">
                    <div class="bg-white/80 p-3.5 rounded-xl border border-cream-200/80 shadow-xs text-center sm:text-left">
                        <p class="font-heading font-black text-xl sm:text-2xl text-stone-900"><?= $countCoffee ?></p>
                        <p class="text-[11px] text-stone-500 font-medium">Coffee Series</p>
                    </div>
                    <div class="bg-white/80 p-3.5 rounded-xl border border-cream-200/80 shadow-xs text-center sm:text-left">
                        <p class="font-heading font-black text-xl sm:text-2xl text-coffee"><?= $countNonCoffee ?></p>
                        <p class="text-[11px] text-stone-500 font-medium">Non Coffee</p>
                    </div>
                    <div class="bg-white/80 p-3.5 rounded-xl border border-cream-200/80 shadow-xs text-center sm:text-left">
                        <p class="font-heading font-black text-xl sm:text-2xl text-stone-900"><?= $countSnack ?></p>
                        <p class="text-[11px] text-stone-500 font-medium">Snack & Makanan</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Showcase Banner -->
            <div class="lg:col-span-5">
                <div class="bg-white p-3 rounded-3xl border border-cream-300 shadow-xl relative animate-float-wave hover:shadow-2xl transition-all duration-300 group">
                    <div class="absolute -top-3 -right-3 bg-stone-900 text-cream-100 border border-cream-300 px-3.5 py-1 text-xs font-bold rounded-full shadow-md z-20 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-amber-400 inline-block animate-pulse"></span>
                        <span>Menu Favorit</span>
                    </div>

                    <!-- Image Container -->
                    <div class="overflow-hidden aspect-[4/5] bg-cream-200 relative rounded-2xl border border-cream-200">
                        <div class="w-full h-full relative overflow-hidden">
                            <img src="<?= htmlspecialchars($outlet['banner']) ?>" alt="<?= htmlspecialchars($outlet['nama']) ?> Aneka Minuman dan Kopi" class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-700">
                            
                            <!-- Shimmer Light Overlay on Hover -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 pointer-events-none"></div>
                        </div>
                        
                        <!-- Banner Bottom Info Card -->
                        <div class="absolute bottom-0 left-0 right-0 bg-stone-950/90 backdrop-blur-md p-4 text-white border-t border-stone-800 z-10">
                            <div class="flex items-center justify-between mb-1">
                                <span class="bg-coffee text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider inline-block"><?= htmlspecialchars($outlet['nama']) ?></span>
                                <span class="text-xs text-amber-400 font-bold">★ 5.0 (Samata, Gowa)</span>
                            </div>
                            <h2 class="font-heading font-bold text-base leading-snug">Jl. Mustafa Dg. Bunga No.33</h2>
                            <p class="text-xs text-stone-300">Romang Polong, Gowa - Samata (Area Kampus)</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-3 text-center text-xs">
                        <div class="bg-cream-50 p-2.5 rounded-xl border border-cream-200">
                            <span class="text-stone-500 text-[11px] block font-medium">Katalog Menu</span>
                            <span class="font-bold text-stone-900"><?= $totalMenu ?> Pilihan Lengkap</span>
                        </div>
                        <div class="bg-cream-50 p-2.5 rounded-xl border border-cream-200">
                            <span class="text-stone-500 text-[11px] block font-medium">Harga Bersahabat</span>
                            <span class="font-bold text-coffee">Mulai <?= formatRupiah(8000) ?>,-</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- WAVE SECTION DIVIDER HALUS -->
<div class="relative w-full overflow-hidden leading-none bg-cream-50 -mt-1 pointer-events-none select-none">
    <svg class="relative block w-full h-6 sm:h-10 text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 C150,70 350,-20 500,45 C650,110 900,15 1200,35 L1200,120 L0,120 Z"></path>
    </svg>
</div>
