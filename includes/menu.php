<?php
/**
 * Menu Component - D'BRIGHT COFFEE
 * Katalog 24 Menu Lengkap dengan desain kartu modern, rapi, dan responsif
 */
?>
<!-- MENU KATALOG INTERAKTIF -->
<section id="menu" class="py-16 bg-gradient-to-b from-cream-50 via-cream-100/50 to-cream-50 border-b border-cream-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-200 px-3.5 py-1 rounded-full bg-white shadow-xs">Katalog Minuman & Snack</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-3 mb-2.5">
                Daftar Menu <?= htmlspecialchars($outlet['nama']) ?>
            </h2>
            <p class="text-stone-600 text-sm mb-6">
                Temukan pilihan kopi nikmat, minuman segar, dan camilan hangat favorit Anda dengan pencarian cepat di bawah ini.
            </p>

            <!-- Search Input with jQuery Real-time Filter -->
            <div class="max-w-md mx-auto mb-6">
                <div class="relative flex items-center">
                    <span class="absolute left-4 text-stone-400 text-sm">🔍</span>
                    <input type="text" id="menuSearch" placeholder="Cari nama menu (cth: Matcha, Kopi Susu, Mentai...)" class="w-full pl-10 pr-24 py-3 bg-white border border-cream-300 rounded-full text-xs sm:text-sm font-medium text-stone-800 placeholder-stone-400 focus:border-coffee focus:ring-2 focus:ring-coffee/15 outline-none shadow-xs transition">
                    <button id="clearSearchBtn" type="button" class="hidden absolute right-2.5 px-3 py-1 text-[11px] font-bold bg-cream-100 hover:bg-cream-200 text-stone-700 rounded-full border border-cream-300 transition cursor-pointer">
                        HAPUS
                    </button>
                </div>
                <div class="flex items-center justify-between text-[11px] text-stone-500 mt-2 px-3">
                    <span id="menuCounterText">Menampilkan <strong id="menuCountNumber" class="text-coffee font-bold"><?= $totalMenu ?></strong> dari <?= $totalMenu ?> menu</span>
                    <span class="text-stone-400">Pencarian Instan</span>
                </div>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex items-center justify-center flex-wrap gap-2">
                <button class="filter-btn active-filter px-5 py-2 text-xs font-bold rounded-full bg-coffee text-white shadow-md transition cursor-pointer" data-category="all">
                    Semua (<?= $totalMenu ?>)
                </button>
                <button class="filter-btn px-5 py-2 text-xs font-bold rounded-full bg-white text-stone-700 hover:bg-cream-50 border border-cream-200 shadow-xs transition cursor-pointer" data-category="coffee">
                    ☕ Coffee (<?= $countCoffee ?>)
                </button>
                <button class="filter-btn px-5 py-2 text-xs font-bold rounded-full bg-white text-stone-700 hover:bg-cream-50 border border-cream-200 shadow-xs transition cursor-pointer" data-category="non-coffee">
                    🍵 Non-Coffee (<?= $countNonCoffee ?>)
                </button>
                <button class="filter-btn px-5 py-2 text-xs font-bold rounded-full bg-white text-stone-700 hover:bg-cream-50 border border-cream-200 shadow-xs transition cursor-pointer" data-category="snack">
                    🍟 Snack (<?= $countSnack ?>)
                </button>
            </div>

            <?php if (!empty($isAdmin)): ?>
                <!-- Tombol Tambah Menu Baru Khusus Mode Admin -->
                <div class="mt-5 pt-4 border-t border-cream-200 flex items-center justify-center gap-3">
                    <button type="button" id="btnAdminTambahMenuTop" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-xs uppercase tracking-wider rounded-full shadow-md hover:shadow-lg transition cursor-pointer inline-flex items-center gap-2">
                        <span>+</span> Tambah Menu Baru ke Database
                    </button>
                    <a href="admin.php" class="px-4 py-2.5 bg-stone-900 hover:bg-coffee text-white font-bold text-xs rounded-full shadow-xs transition">
                        Buka Panel Admin CRUD &rarr;
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Grid: 24 Menu Items via PHP Loop -->
        <div id="productGrid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Empty State jika pencarian tidak ditemukan -->
            <div id="noMenuFound" class="hidden col-span-full py-12 text-center bg-white rounded-2xl border-2 border-dashed border-cream-300 p-8 shadow-xs">
                <p class="font-heading font-bold text-stone-800 text-base mb-1">Menu Tidak Ditemukan</p>
                <p class="text-stone-500 text-xs mb-4">Tidak ada menu yang sesuai dengan kata kunci yang Anda cari.</p>
                <button id="resetFilterBtn" type="button" class="px-5 py-2.5 text-xs font-bold bg-coffee text-white rounded-full hover:bg-coffee-dark shadow-sm transition cursor-pointer">
                    Lihat Semua <?= $totalMenu ?> Menu
                </button>
            </div>

            <?php foreach ($menuItems as $item): ?>
                <div class="menu-item bg-white rounded-2xl border border-cream-200/90 hover:border-coffee/40 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between overflow-hidden group" data-category="<?= htmlspecialchars($item['kategori']) ?>">
                    <div class="p-5 sm:p-6">
                        <div class="flex items-center justify-between mb-3 text-xs">
                            <?php if ($item['is_featured']): ?>
                                <span class="font-bold uppercase tracking-wider text-white bg-coffee px-2.5 py-0.5 rounded-full text-[10px] shadow-xs"><?= htmlspecialchars($item['badge']) ?></span>
                                <span class="text-stone-500 font-semibold text-[11px]"><?= htmlspecialchars($item['subjudul']) ?></span>
                            <?php else: ?>
                                <span class="font-bold uppercase tracking-wider text-coffee bg-cream-100 px-2.5 py-0.5 rounded-full text-[10px] border border-cream-200"><?= htmlspecialchars($item['kategori_label']) ?></span>
                                <span class="text-stone-500 font-semibold text-[11px]"><?= htmlspecialchars($item['badge']) ?></span>
                            <?php endif; ?>
                        </div>

                        <h3 class="font-heading font-bold text-base text-stone-900 mb-1 group-hover:text-coffee transition-colors"><?= htmlspecialchars($item['nama']) ?></h3>
                        <p class="text-xs text-coffee-light font-semibold mb-2"><?= htmlspecialchars($item['subjudul']) ?></p>
                        <p class="text-stone-600 text-xs leading-relaxed line-clamp-3">
                            <?= htmlspecialchars($item['deskripsi']) ?>
                        </p>
                    </div>

                    <div class="p-4 bg-cream-50/70 border-t border-cream-100 flex items-center justify-between gap-2 flex-wrap">
                        <span class="font-heading font-extrabold text-base text-coffee"><?= formatRupiah($item['harga']) ?></span>
                        <div class="flex items-center gap-1.5">
                            <?php if (!empty($isAdmin)): ?>
                                <!-- Tombol Edit Menu Admin -->
                                <button type="button" 
                                    class="btn-edit-menu-action px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-xs rounded-lg transition cursor-pointer"
                                    title="Edit Menu Ini"
                                    data-id="<?= (int)$item['id'] ?>"
                                    data-nama="<?= htmlspecialchars($item['nama'], ENT_QUOTES) ?>"
                                    data-kategori="<?= htmlspecialchars($item['kategori'], ENT_QUOTES) ?>"
                                    data-harga="<?= (int)$item['harga'] ?>"
                                    data-badge="<?= htmlspecialchars($item['badge'] ?? '', ENT_QUOTES) ?>"
                                    data-subjudul="<?= htmlspecialchars($item['subjudul'] ?? '', ENT_QUOTES) ?>"
                                    data-deskripsi="<?= htmlspecialchars($item['deskripsi'] ?? '', ENT_QUOTES) ?>"
                                    data-featured="<?= !empty($item['is_featured']) ? 1 : 0 ?>">
                                    ✏️ Edit
                                </button>

                                <!-- Tombol Hapus Menu Admin -->
                                <form action="index.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENGHAPUS menu: <?= htmlspecialchars($item['nama'], ENT_QUOTES) ?> dari database?');" class="inline">
                                    <input type="hidden" name="action" value="delete_menu">
                                    <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">
                                    <button type="submit" class="px-2.5 py-1.5 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-lg transition cursor-pointer" title="Hapus Menu Ini">
                                        🗑️
                                    </button>
                                </form>
                            <?php endif; ?>

                            <!-- Tombol Pesan Pelanggan -->
                            <button class="btn-order-item bg-coffee hover:bg-coffee-dark text-white text-xs font-bold px-4 py-2 rounded-xl shadow-xs hover:shadow-md transition cursor-pointer" data-name="<?= htmlspecialchars($item['nama']) ?>" data-price="<?= $item['harga'] ?>" data-category="<?= htmlspecialchars($item['kategori']) ?>">
                                Pesan +
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- WAVE SECTION DIVIDER -->
<div class="relative w-full overflow-hidden leading-none bg-cream-50 pointer-events-none select-none -mt-1">
    <svg class="relative block w-full h-6 sm:h-10 text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 C200,60 400,-10 650,40 C900,90 1050,15 1200,30 L1200,120 L0,120 Z"></path>
    </svg>
</div>
