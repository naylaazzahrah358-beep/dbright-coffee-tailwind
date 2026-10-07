<?php
/**
 * Menu Component - D'BRIGHT COFFEE
 * Katalog 24 Menu Lengkap yang dirender secara dinamis menggunakan PHP loop
 */
?>
<!-- MENU KATALOG INTERAKTIF (24 MENU D'BRIGHT COFFEE) -->
<section id="menu" class="py-16 bg-cream-100/60 border-b border-cream-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-8">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-300 px-3 py-1 bg-white">Daftar Menu</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-4 mb-3">
                Katalog Lengkap <?= htmlspecialchars($outlet['nama']) ?>
            </h2>
            <p class="text-stone-600 text-sm mb-6">
                Gunakan filter kategori atau kotak pencarian instan di bawah untuk menemukan menu favorit Anda.
            </p>

            <!-- Search Input with jQuery Real-time Filter -->
            <div class="max-w-md mx-auto mb-6">
                <div class="relative flex items-center">
                    <input type="text" id="menuSearch" placeholder="Cari nama menu (cth: Matcha, Kopi Susu, Mentai, Roti...)" class="w-full px-4 py-2.5 bg-white border-2 border-cream-300 text-xs sm:text-sm font-medium text-stone-800 placeholder-stone-400 focus:border-coffee outline-none transition">
                    <button id="clearSearchBtn" type="button" class="hidden absolute right-2 px-2.5 py-1 text-[11px] font-bold bg-cream-100 hover:bg-cream-200 text-stone-700 border border-cream-300 transition cursor-pointer">
                        HAPUS [X]
                    </button>
                </div>
                <div class="flex items-center justify-between text-[11px] text-stone-500 mt-2 px-1">
                    <span id="menuCounterText">Menampilkan <strong id="menuCountNumber" class="text-coffee font-bold"><?= $totalMenu ?></strong> dari <?= $totalMenu ?> menu</span>
                    <span class="text-stone-400">Pencarian Instan jQuery & Data PHP</span>
                </div>
            </div>

            <!-- Category Filters (PHP Dynamic Buttons) -->
            <div class="flex items-center justify-center flex-wrap gap-2">
                <button class="filter-btn active-filter px-4 py-2 text-xs font-bold bg-coffee text-white border border-coffee-dark transition shadow-sm cursor-pointer" data-category="all">
                    Semua Menu (<?= $totalMenu ?>)
                </button>
                <button class="filter-btn px-4 py-2 text-xs font-bold bg-white text-stone-800 border border-cream-300 hover:border-coffee transition cursor-pointer" data-category="coffee">
                    Coffee (<?= $countCoffee ?>)
                </button>
                <button class="filter-btn px-4 py-2 text-xs font-bold bg-white text-stone-800 border border-cream-300 hover:border-coffee transition cursor-pointer" data-category="non-coffee">
                    Non Coffee (<?= $countNonCoffee ?>)
                </button>
                <button class="filter-btn px-4 py-2 text-xs font-bold bg-white text-stone-800 border border-cream-300 hover:border-coffee transition cursor-pointer" data-category="snack">
                    Menu Snack (<?= $countSnack ?>)
                </button>
            </div>

            <?php if (!empty($isAdmin)): ?>
                <!-- Tombol Tambah Menu Baru Khusus Mode Admin -->
                <div class="mt-4 pt-3 border-t border-cream-300">
                    <button type="button" id="btnAdminTambahMenuTop" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-xs uppercase tracking-wider border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition cursor-pointer inline-flex items-center gap-2">
                        <span>+</span> Tambah Menu Baru ke Database
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Grid: 24 Menu Items via PHP Loop -->
        <div id="productGrid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Empty State jika pencarian tidak ditemukan -->
            <div id="noMenuFound" class="hidden col-span-full py-12 text-center bg-white border-2 border-dashed border-cream-300 p-8">
                <p class="font-heading font-bold text-stone-800 text-base mb-1">Menu Tidak Ditemukan</p>
                <p class="text-stone-500 text-xs mb-4">Tidak ada menu yang sesuai dengan kata kunci yang Anda masukkan.</p>
                <button id="resetFilterBtn" type="button" class="px-5 py-2.5 text-xs font-bold bg-coffee text-white border border-coffee-dark hover:bg-coffee-dark transition cursor-pointer">
                    Lihat Semua <?= $totalMenu ?> Menu
                </button>
            </div>

            <?php foreach ($menuItems as $item): ?>
                <?php
                // Tentukan warna shadow hover berdasarkan kategori
                $shadowClass = match($item['kategori']) {
                    'coffee'     => 'hover:shadow-[6px_6px_0px_0px_#7F5539]',
                    'non-coffee' => 'hover:shadow-[6px_6px_0px_0px_#44403c]',
                    'snack'      => 'hover:shadow-[6px_6px_0px_0px_#B08968]',
                    default      => 'hover:shadow-[6px_6px_0px_0px_#7F5539]'
                };
                ?>
                <div class="menu-item bg-white border-2 border-cream-300 hover:border-stone-900 <?= $shadowClass ?> hover:-translate-y-1.5 transition-all duration-200 flex flex-col justify-between" data-category="<?= htmlspecialchars($item['kategori']) ?>">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3 text-xs">
                            <?php if ($item['is_featured']): ?>
                                <span class="font-bold uppercase tracking-wider text-white bg-coffee px-2 py-0.5 border border-coffee-dark"><?= htmlspecialchars($item['badge']) ?></span>
                                <span class="text-stone-500 font-semibold"><?= htmlspecialchars($item['subjudul']) ?></span>
                            <?php else: ?>
                                <span class="font-bold uppercase tracking-wider text-coffee bg-cream-100 px-2 py-0.5 border border-cream-300"><?= htmlspecialchars($item['kategori_label']) ?></span>
                                <span class="text-stone-500 font-semibold"><?= htmlspecialchars($item['badge']) ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-heading font-bold text-base text-stone-900 mb-1"><?= htmlspecialchars($item['nama']) ?></h3>
                        <p class="text-xs text-coffee font-semibold mb-2"><?= htmlspecialchars($item['subjudul']) ?></p>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            <?= htmlspecialchars($item['deskripsi']) ?>
                        </p>
                    </div>
                    <div class="p-4 bg-cream-50 border-t border-cream-200 flex items-center justify-between gap-2 flex-wrap">
                        <span class="font-heading font-extrabold text-base text-coffee"><?= formatRupiah($item['harga']) ?></span>
                        <div class="flex items-center gap-1.5">
                            <?php if (!empty($isAdmin)): ?>
                                <!-- Tombol Edit Menu Admin -->
                                <button type="button" 
                                    class="btn-edit-menu-action px-2 py-1.5 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-xs transition cursor-pointer"
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
                                    <button type="submit" class="px-2 py-1.5 bg-red-600 hover:bg-red-700 text-white font-bold text-xs transition cursor-pointer" title="Hapus Menu Ini">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            <?php endif; ?>

                            <!-- Tombol Pesan Pelanggan -->
                            <button class="btn-order-item bg-coffee hover:bg-coffee-dark text-white text-xs font-bold px-4 py-2 border border-coffee-dark transition cursor-pointer" data-name="<?= htmlspecialchars($item['nama']) ?>" data-price="<?= $item['harga'] ?>" data-category="<?= htmlspecialchars($item['kategori']) ?>">
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- WAVE TRANSITION DIVIDER KE SECTION PROMO -->
<div class="relative w-full overflow-hidden leading-none bg-cream-100/60 pointer-events-none select-none -mt-1">
    <svg class="relative block w-full h-8 sm:h-12 text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 C200,60 400,-10 650,40 C900,90 1050,15 1200,30 L1200,120 L0,120 Z"></path>
    </svg>
</div>
