<?php
/**
 * Navbar Component - D'BRIGHT COFFEE
 * Berisi Top Promo Bar dan Navigasi Header Modern & Bersih
 */
$statusAwal = getStatusOperasional();
?>
<!-- TOP PROMO BAR -->
<aside class="bg-cream-100 text-stone-700 text-xs py-2 px-4 font-medium border-b border-cream-200">
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-3 flex-wrap">
        <div class="flex items-center gap-2 flex-wrap">
            <span class="px-2.5 py-0.5 text-[11px] font-bold bg-coffee text-white rounded-full uppercase tracking-wider shadow-xs">Promo</span>
            <span>Menu Resmi <strong><?= htmlspecialchars($outlet['nama']) ?></strong>: Kopi, Non-Kopi & Snack Mulai Rp 8.000,-</span>
            <a href="#menu" class="font-bold text-coffee hover:text-coffee-dark underline ml-1">Lihat Menu &rarr;</a>
        </div>
        <!-- Live Operational Status Badge -->
        <div id="outletStatusBadge" class="inline-flex items-center gap-2 px-3 py-1 bg-white rounded-full border border-cream-200 text-[11px] font-bold shadow-xs">
            <?php if ($statusAwal['status']): ?>
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-600"></span>
                </span>
                <span class="text-emerald-800 font-bold"><?= htmlspecialchars($statusAwal['label']) ?></span>
            <?php else: ?>
                <span class="w-2 h-2 rounded-full bg-amber-600 inline-block"></span>
                <span class="text-amber-800 font-bold"><?= htmlspecialchars($statusAwal['label']) ?></span>
            <?php endif; ?>
        </div>
    </div>
</aside>

<!-- NAVBAR UTAMA -->
<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-cream-200/80 shadow-xs transition-all">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Brand Text & Official Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo <?= htmlspecialchars($outlet['nama']) ?>" class="w-12 h-12 object-cover rounded-xl border border-cream-300 shadow-xs group-hover:scale-105 transition-transform duration-200">
                <div class="flex flex-col">
                    <span class="font-heading font-extrabold text-2xl tracking-tight text-stone-900 leading-none">
                        D'BRIGHT <span class="text-coffee">COFFEE</span>
                    </span>
                    <span class="text-[11px] font-semibold text-stone-500 tracking-wider uppercase mt-1"><?= htmlspecialchars($outlet['sub_slogan']) ?></span>
                </div>
            </a>

            <!-- Desktop Menu Navigation -->
            <nav class="hidden xl:flex items-center gap-6 text-sm font-semibold text-stone-700">
                <a href="#beranda" class="hover:text-coffee transition-colors py-1">Beranda</a>
                <a href="#keunggulan" class="hover:text-coffee transition-colors py-1">Keunggulan</a>
                <a href="#menu" class="hover:text-coffee transition-colors py-1">Menu (<?= $totalMenu ?>)</a>
                <a href="#promo" class="hover:text-coffee transition-colors py-1">Paket Hemat</a>
                <a href="#testimoni" class="hover:text-coffee transition-colors py-1">Testimoni</a>
                <a href="#faq" class="hover:text-coffee transition-colors py-1">FAQ</a>
                <a href="#kontak" class="hover:text-coffee transition-colors py-1">Lokasi</a>
            </nav>

            <!-- Action Buttons Group -->
            <div class="hidden md:flex items-center gap-3">
                <!-- Tombol Riwayat Pesanan -->
                <button type="button" class="btn-buka-pesanan px-3.5 py-2 text-xs bg-amber-50 hover:bg-amber-100 text-stone-900 border border-amber-300/80 rounded-full font-bold transition shadow-xs cursor-pointer flex items-center gap-1.5" title="Lihat riwayat pesanan pelanggan dari database MySQL">
                    <span>📋</span>
                    <span>Pesanan (<?= $countPesanan ?>)</span>
                </button>

                <!-- Tombol Panel Admin CRUD Langsung -->
                <a href="admin.php" class="px-3.5 py-2 text-xs bg-stone-900 hover:bg-coffee text-amber-300 hover:text-white rounded-full font-bold transition flex items-center gap-1.5 border border-stone-800 shadow-xs" title="Buka Halaman Panel Admin CRUD Menu & Pesanan">
                    <span>⚙️</span>
                    <span>Panel Admin</span>
                </a>

                <!-- Tombol Pesan Sekarang -->
                <button class="btn-order-item bg-coffee hover:bg-coffee-dark text-white font-bold px-5 py-2.5 rounded-full text-xs shadow-md hover:shadow-lg transition cursor-pointer flex items-center gap-1" data-name="Signature D'Bright" data-price="15000" data-category="coffee">
                    <span>Pesan Sekarang &rarr;</span>
                </button>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobileMenuBtn" aria-label="Buka Menu" class="xl:hidden p-2.5 text-stone-800 rounded-xl border border-cream-300 hover:bg-cream-100 transition font-bold text-xs bg-white cursor-pointer flex items-center gap-1">
                <span>☰</span>
                <span>MENU</span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobileMenu" class="hidden xl:hidden border-t border-cream-200 bg-white/98 backdrop-blur-md px-6 py-5 shadow-xl animate-fadeIn">
        <div class="flex flex-col gap-3.5 text-sm font-semibold text-stone-800">
            <a href="#beranda" class="hover:text-coffee py-1 border-b border-cream-100">Beranda</a>
            <a href="#keunggulan" class="hover:text-coffee py-1 border-b border-cream-100">Keunggulan</a>
            <a href="#menu" class="hover:text-coffee py-1 border-b border-cream-100">Menu (<?= $totalMenu ?>)</a>
            <a href="#promo" class="hover:text-coffee py-1 border-b border-cream-100">Paket Hemat</a>
            <a href="#testimoni" class="hover:text-coffee py-1 border-b border-cream-100">Testimoni</a>
            <a href="#faq" class="hover:text-coffee py-1 border-b border-cream-100">FAQ</a>
            <a href="#kontak" class="hover:text-coffee py-1 border-b border-cream-100">Lokasi & Kontak</a>
            
            <div class="pt-2 flex flex-col gap-2.5">
                <button type="button" onclick="$('#mobileMenu').slideUp(); $('#modalRiwayatPesanan').fadeIn(150);" class="w-full text-left px-4 py-2.5 bg-amber-50 hover:bg-amber-100 text-stone-900 rounded-xl border border-amber-200 font-bold text-xs flex items-center gap-2">
                    <span>📋</span>
                    <span>Riwayat Pesanan Masuk (<?= $countPesanan ?>)</span>
                </button>
                <a href="admin.php" class="w-full text-left px-4 py-2.5 bg-stone-900 hover:bg-coffee text-amber-300 rounded-xl font-bold text-xs flex items-center gap-2">
                    <span>⚙️</span>
                    <span>Buka Panel Admin (CRUD Menu & Pesanan)</span>
                </a>
                <button class="btn-order-item w-full bg-coffee hover:bg-coffee-dark text-white font-bold py-3 rounded-xl text-center text-xs shadow-md transition cursor-pointer" data-name="Signature D'Bright" data-price="15000" data-category="coffee">
                    Pesan Cepat via WhatsApp &rarr;
                </button>
            </div>
        </div>
    </div>
</header>
