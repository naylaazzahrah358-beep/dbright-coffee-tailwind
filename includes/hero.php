<?php
/**
 * Hero Component - D'BRIGHT COFFEE
 * Banner promosi utama dengan data dinamis
 */
?>
<!-- HERO SECTION -->
<section id="beranda" class="pt-12 pb-16 lg:py-20 bg-cream-100 border-b border-cream-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column: Copywriting & CTA -->
            <div class="lg:col-span-7 text-center lg:text-left">
                <div class="inline-flex items-center gap-2.5 border border-cream-300 bg-white px-3 py-1.5 mb-6">
                    <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo" class="w-6 h-6 object-cover border border-cream-200">
                    <span class="text-coffee-dark text-xs font-bold uppercase tracking-wider">Menu <?= htmlspecialchars($outlet['nama']) ?></span>
                </div>

                <h1 class="font-heading font-extrabold text-3xl sm:text-5xl lg:text-5xl text-stone-900 tracking-tight leading-tight mb-6">
                    Segarkan Harimu Bersama <br class="hidden sm:inline">
                    <span class="text-coffee">D'BRIGHT COFFEE</span>
                </h1>

                <p class="text-stone-600 text-base sm:text-lg font-normal leading-relaxed mb-8 max-w-2xl mx-auto lg:mx-0">
                    Nikmati racikan kopi autentik mulai <?= formatRupiah(10000) ?>, aneka varian Non-Coffee favorit seperti Matcha, Chocolate, Red Velvet, hingga menu snack hangat seperti Roti Bakar, Dimsum Mentai, dan Platter komplit.
                </p>

                <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 mb-8 text-xs sm:text-sm text-stone-800 font-medium">
                    <div class="bg-white px-3.5 py-2 border border-cream-300">
                        <?= $totalMenu ?> Pilihan Menu Lengkap
                    </div>
                    <div class="bg-white px-3.5 py-2 border border-cream-300">
                        Harga Mulai <?= formatRupiah(8000) ?>,-
                    </div>
                    <div class="bg-white px-3.5 py-2 border border-cream-300">
                        Romang Polong, Gowa - Samata
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <button class="btn-order-item w-full sm:w-auto bg-coffee hover:bg-coffee-dark text-white font-bold px-8 py-3.5 border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all cursor-pointer" data-name="Signature D'Bright" data-price="15000" data-category="coffee">
                        Pesan via WhatsApp &rarr;
                    </button>
                    <a href="#menu" class="w-full sm:w-auto bg-white hover:bg-cream-100 text-stone-900 font-bold px-7 py-3.5 border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 text-center transition-all">
                        Lihat Katalog Menu
                    </a>
                </div>

                <!-- Akses Cepat Terpadu Admin & Pesanan di Halaman Utama -->
                <div class="mt-3.5 flex items-center justify-center lg:justify-start gap-3 text-xs font-bold">
                    <button type="button" class="btn-buka-pesanan text-stone-700 hover:text-coffee underline inline-flex items-center gap-1 cursor-pointer">
                        📋 Riwayat Pesanan (<?= $countPesanan ?>)
                    </button>
                    <span class="text-stone-400">&bull;</span>
                    <a href="admin.php" class="text-stone-700 hover:text-coffee underline inline-flex items-center gap-1">
                        ⚙️ Panel Admin (CRUD Menu & Pesanan)
                    </a>
                </div>

                <!-- Statistik Menu Dihitung Otomatis PHP -->
                <div class="grid grid-cols-3 gap-4 pt-8 mt-10 border-t-2 border-cream-300 max-w-lg mx-auto lg:mx-0">
                    <div class="bg-white p-3 border border-cream-300">
                        <p class="font-heading font-black text-2xl text-stone-900"><?= $countCoffee ?> Kopi</p>
                        <p class="text-xs text-stone-500 font-medium">Coffee Series</p>
                    </div>
                    <div class="bg-white p-3 border border-cream-300">
                        <p class="font-heading font-black text-2xl text-coffee"><?= $countNonCoffee ?> Varian</p>
                        <p class="text-xs text-stone-500 font-medium">Non Coffee</p>
                    </div>
                    <div class="bg-white p-3 border border-cream-300">
                        <p class="font-heading font-black text-2xl text-stone-900"><?= $countSnack ?> Snack</p>
                        <p class="text-xs text-stone-500 font-medium">Menu Camilan</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Showcase Banner -->
            <div class="lg:col-span-5">
                <div class="bg-white p-3.5 border-2 border-stone-900 shadow-[10px_10px_0px_0px_#7F5539] relative animate-float-wave hover:shadow-[14px_14px_0px_0px_#7F5539] transition-all group">
                    <div class="absolute -top-3.5 -right-3.5 bg-stone-900 text-cream-100 border-2 border-cream-300 px-3.5 py-1 text-xs font-bold uppercase tracking-wider shadow-md z-20 flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-amber-400 inline-block animate-pulse"></span>
                        <span>Menu Terpopuler</span>
                    </div>

                    <!-- Image Container with Subtle Wave Shape & Fluid Transitions -->
                    <div class="overflow-hidden aspect-[4/5] bg-cream-200 relative border-2 border-stone-900">
                        <div class="w-full h-full relative overflow-hidden">
                            <!-- Gambarnya berbentuk gelombang sedikit via SVG clip-path & class wavy-image-shape -->
                            <img src="<?= htmlspecialchars($outlet['banner']) ?>" alt="<?= htmlspecialchars($outlet['nama']) ?> Aneka Minuman dan Kopi" class="w-full h-full object-cover object-center transform group-hover:scale-105 transition-transform duration-700 wavy-image-shape">
                            
                            <!-- Animasi Sapuan Gelombang Cahaya (Wave Shimmer) Saat Hover -->
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 pointer-events-none"></div>

                            <!-- Aksen Gelombang Sedikit Bagian Atas Gambar (Wave Overlay Top) -->
                            <div class="absolute top-0 left-0 right-0 w-full overflow-hidden leading-none z-10 pointer-events-none">
                                <svg class="relative block w-full h-4 sm:h-5 text-white fill-current" viewBox="0 0 1200 60" preserveAspectRatio="none">
                                    <path d="M0,0 L1200,0 L1200,16 C1050,38 850,5 600,22 C350,38 150,6 0,26 Z"></path>
                                </svg>
                            </div>

                            <!-- Aksen Gelombang Sedikit Bagian Bawah Gambar di Atas Info Card -->
                            <div class="absolute bottom-[84px] left-0 right-0 w-full overflow-hidden leading-none z-10 pointer-events-none">
                                <svg class="relative block w-full h-5 sm:h-6 text-stone-950/95 fill-current" viewBox="0 0 1200 60" preserveAspectRatio="none">
                                    <path d="M0,34 C200,8 440,48 700,20 C920,-6 1080,30 1200,12 L1200,60 L0,60 Z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Banner Bottom Info Card -->
                        <div class="absolute bottom-0 left-0 right-0 bg-stone-950/95 p-4 text-white border-t border-stone-800 z-10">
                            <div class="flex items-center justify-between mb-1">
                                <span class="bg-coffee text-white text-[10px] font-bold px-2 py-0.5 uppercase tracking-wider inline-block"><?= htmlspecialchars($outlet['nama']) ?></span>
                                <span class="text-xs text-amber-400 font-bold">★ 5.0 (Samata, Gowa)</span>
                            </div>
                            <h2 class="font-heading font-bold text-lg leading-snug">Jl. Mustafa Dg. Bunga No.33</h2>
                            <p class="text-xs text-stone-300">Romang Polong, Gowa - Samata (Area Kampus)</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 mt-3 pt-3 border-t-2 border-cream-200 text-center text-xs">
                        <div class="bg-cream-50 p-2.5 border border-cream-300">
                            <span class="text-stone-500 text-[11px] block font-medium">Katalog Menu</span>
                            <span class="font-bold text-stone-900"><?= $totalMenu ?> Pilihan</span>
                        </div>
                        <div class="bg-cream-50 p-2.5 border border-cream-300">
                            <span class="text-stone-500 text-[11px] block font-medium">Harga Bersahabat</span>
                            <span class="font-bold text-coffee">Mulai <?= formatRupiah(8000) ?>,-</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- PEMISAH GELOMBANG HALUS (WAVE SECTION DIVIDER) -->
<div class="relative w-full overflow-hidden leading-none bg-cream-100 -mt-1 pointer-events-none select-none">
    <svg class="relative block w-full h-8 sm:h-12 md:h-14 text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 C150,70 350,-20 500,45 C650,110 900,15 1200,35 L1200,120 L0,120 Z"></path>
    </svg>
</div>
