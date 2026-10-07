<?php
/**
 * Navbar Component - D'BRIGHT COFFEE
 * Berisi Top Promo Bar dan Navigasi Header
 */
$statusAwal = getStatusOperasional();
?>
<!-- TOP PROMO BAR -->
<aside class="bg-cream-200 text-stone-800 text-xs md:text-sm py-2 px-4 font-medium border-b border-cream-300">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-3 flex-wrap">
        <div class="flex items-center gap-2 flex-wrap">
            <span class="px-2 py-0.5 text-xs font-bold bg-white text-coffee-dark border border-cream-300 uppercase tracking-wider">Promo</span>
            <span>Menu <?= htmlspecialchars($outlet['nama']) ?>: Minuman & Snack Nikmat Mulai Rp 8.000,-</span>
            <a href="#menu" class="underline font-bold text-coffee-dark hover:text-coffee ml-1">Lihat Menu &rarr;</a>
        </div>
        <!-- Live Operational Status Badge (PHP Initial Render + jQuery Dynamic) -->
        <div id="outletStatusBadge" class="inline-flex items-center gap-2 px-2.5 py-1 bg-white border border-cream-300 text-[11px] font-bold">
            <?php if ($statusAwal['status']): ?>
                <span class="relative flex h-2 w-2 mr-1">
                    <span class="animate-ping absolute inline-flex h-full w-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-2 w-2 bg-emerald-600"></span>
                </span>
                <span class="text-emerald-800 font-bold"><?= htmlspecialchars($statusAwal['label']) ?></span>
            <?php else: ?>
                <span class="w-2 h-2 bg-amber-600 inline-block mr-1"></span>
                <span class="text-amber-800 font-bold"><?= htmlspecialchars($statusAwal['label']) ?></span>
            <?php endif; ?>
        </div>
    </div>
</aside>

<!-- NAVBAR UTAMA -->
<header class="sticky top-0 z-40 bg-white border-b border-cream-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Text & Official Logo -->
            <a href="#" class="flex items-center gap-3">
                <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo <?= htmlspecialchars($outlet['nama']) ?>" class="w-12 h-12 object-cover border border-cream-300">
                <div class="flex flex-col">
                    <span class="font-heading font-extrabold text-2xl tracking-tight text-stone-900 leading-none">
                        D'BRIGHT <span class="text-coffee">COFFEE</span>
                    </span>
                    <span class="text-[11px] font-semibold text-stone-500 tracking-wider uppercase mt-1"><?= htmlspecialchars($outlet['sub_slogan']) ?></span>
                </div>
            </a>

            <!-- Desktop Menu Navigation -->
            <nav class="hidden md:flex items-center gap-7 text-sm font-semibold text-stone-700">
                <a href="#beranda" class="hover:text-coffee transition-colors">Beranda</a>
                <a href="#keunggulan" class="hover:text-coffee transition-colors">Keunggulan</a>
                <a href="#menu" class="hover:text-coffee transition-colors">Menu (<?= $totalMenu ?>)</a>
                <a href="#promo" class="hover:text-coffee transition-colors">Paket Hemat</a>
                <a href="#testimoni" class="hover:text-coffee transition-colors">Testimoni</a>
                <a href="#faq" class="hover:text-coffee transition-colors">FAQ</a>
                <a href="#kontak" class="hover:text-coffee transition-colors">Lokasi & Kontak</a>
                <!-- Tombol Riwayat Pesanan -->
                <button type="button" class="btn-buka-pesanan px-2.5 py-1 text-xs bg-amber-100 hover:bg-amber-200 text-stone-900 border border-amber-400 font-bold transition cursor-pointer" title="Lihat riwayat pesanan pelanggan dari database MySQL">
                    📋 Pesanan (<?= $countPesanan ?>)
                </button>

                <!-- Tombol Panel Admin CRUD Langsung -->
                <a href="admin.php" class="px-3 py-1 text-xs bg-stone-900 hover:bg-coffee text-white font-bold transition flex items-center gap-1 border border-stone-800" title="Buka Halaman Panel Admin CRUD Menu & Pesanan">
                    <span>⚙️</span> Panel Admin
                </a>
            </nav>

            <!-- Action Button -->
            <div class="hidden lg:flex items-center gap-4">
                <button class="btn-order-item bg-coffee hover:bg-coffee-dark text-white font-bold px-6 py-2.5 border border-coffee-dark transition cursor-pointer" data-name="Signature D'Bright" data-price="15000" data-category="coffee">
                    Pesan Sekarang
                </button>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobileMenuBtn" aria-label="Buka Menu" class="md:hidden p-2 text-stone-800 border border-cream-300 hover:bg-cream-100 transition font-bold text-sm bg-white cursor-pointer">
                MENU
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-cream-200 bg-white px-6 py-5 shadow-lg">
        <div class="flex flex-col gap-4 text-base font-semibold text-stone-800">
            <a href="#beranda" class="hover:text-coffee py-1">Beranda</a>
            <a href="#keunggulan" class="hover:text-coffee py-1">Keunggulan</a>
            <a href="#menu" class="hover:text-coffee py-1">Menu (<?= $totalMenu ?>)</a>
            <a href="#promo" class="hover:text-coffee py-1">Paket Hemat</a>
            <a href="#testimoni" class="hover:text-coffee py-1">Testimoni</a>
            <a href="#faq" class="hover:text-coffee py-1">FAQ</a>
            <a href="#kontak" class="hover:text-coffee py-1">Lokasi & Kontak</a>
            <button type="button" onclick="$('#mobileMenu').slideUp(); $('#modalRiwayatPesanan').fadeIn(150);" class="text-left hover:text-coffee py-1 text-coffee font-bold">
                📋 Riwayat Pesanan Masuk (<?= $countPesanan ?>)
            </button>
            <a href="admin.php" class="text-left text-stone-900 hover:text-coffee font-bold py-1 flex items-center gap-1.5">
                <span>⚙️</span> Buka Panel Admin (CRUD Menu & Pesanan)
            </a>
            <div class="pt-3 border-t border-cream-200">
                <button class="btn-order-item w-full bg-coffee text-white font-bold py-3 text-center cursor-pointer" data-name="Signature D'Bright" data-price="15000" data-category="coffee">
                    Pesan via WhatsApp
                </button>
            </div>
        </div>
    </div>
</header>
