<?php
/**
 * Admin Panel Component - D'BRIGHT COFFEE
 * Komponen antarmuka admin terpadu yang menyatu di Halaman Utama:
 * - Admin Top Bar
 * - Modal Edit Menu
 * - Modal Tambah Menu Baru
 * - Modal Login Admin
 * - Modal / Panel Riwayat Pesanan Masuk
 */
?>

<!-- 1. TOP ADMIN BAR (HANYA MUNCUL JIKA MODE ADMIN AKTIF) -->
<?php if ($isAdmin): ?>
    <div id="adminTopBar" class="bg-stone-900 text-cream-100 border-b-4 border-amber-500 py-2.5 px-4 sticky top-0 z-50 shadow-xl">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-3 text-xs">
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-0.5 bg-amber-500 text-stone-950 font-black uppercase text-[10px] tracking-wider rounded-full">ADMIN AKTIF</span>
                <span class="font-bold">Mode Pengelolaan Menu & Pesanan Database <span class="text-amber-400 font-extrabold">(tugasnela_db)</span></span>
            </div>
            <div class="flex flex-wrap items-center gap-2 font-bold">
                <button type="button" id="btnAdminTambahMenu" class="px-3.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black uppercase tracking-wider rounded-full transition cursor-pointer">
                    + Tambah Menu Baru
                </button>
                <button type="button" id="btnAdminLihatPesanan" class="px-3.5 py-1.5 bg-stone-800 hover:bg-stone-700 text-cream-100 border border-stone-600 rounded-full transition cursor-pointer">
                    📋 Riwayat Pesanan (<?= $countPesanan ?>)
                </button>
                <form action="index.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memulihkan 24 menu default?');" class="inline">
                    <input type="hidden" name="action" value="reset_default_menus">
                    <button type="submit" class="px-3 py-1.5 bg-stone-800 hover:bg-stone-700 text-stone-300 border border-stone-700 rounded-full transition cursor-pointer text-[11px]" title="Reset ke 24 menu awal">
                        🔄 Reset Default
                    </button>
                </form>
                <a href="admin.php" class="px-3.5 py-1.5 bg-coffee hover:bg-coffee-dark text-white rounded-full transition">
                    Dashboard CRUD &rarr;
                </a>
                <a href="index.php?logout_admin=1" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full transition">
                    Keluar Admin ✕
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- 2. FLASH NOTIFICATION TOAST -->
<?php if ($flash): ?>
    <div id="adminFlashNotice" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="p-4 rounded-2xl border shadow-sm text-xs font-bold flex items-center justify-between <?= $flash['type'] === 'success' ? 'bg-emerald-50 text-emerald-900 border-emerald-300' : ($flash['type'] === 'error' ? 'bg-red-50 text-red-900 border-red-300' : 'bg-blue-50 text-blue-900 border-blue-300') ?>">
            <div class="flex items-center gap-2">
                <span class="text-base"><?= $flash['type'] === 'success' ? '✅' : ($flash['type'] === 'error' ? '⚠️' : 'ℹ️') ?></span>
                <span><?= htmlspecialchars($flash['message']) ?></span>
            </div>
            <button onclick="$('#adminFlashNotice').fadeOut()" class="text-stone-500 hover:text-stone-900 font-bold px-2 py-0.5 cursor-pointer">&times;</button>
        </div>
    </div>
<?php endif; ?>

<!-- 3. MODAL EDIT MENU -->
<div id="modalEditMenu" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-lg w-full p-6 sm:p-7 rounded-3xl border border-cream-200 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="$('#modalEditMenu').fadeOut(150)" class="absolute top-5 right-5 text-stone-500 hover:text-stone-900 font-bold text-xs w-8 h-8 rounded-full bg-cream-100 hover:bg-cream-200 flex items-center justify-center transition cursor-pointer">
            ✕
        </button>

        <span class="text-[10px] font-bold bg-amber-500 text-stone-950 px-2.5 py-0.5 rounded-full uppercase tracking-wider inline-block">UPDATE MENU</span>
        <h3 class="font-heading font-black text-lg text-stone-900 mb-1 mt-1">✏️ Edit Data Menu</h3>
        <p class="text-xs text-stone-500 mb-4">Ubah informasi menu di bawah ini. Perubahan akan langsung disimpan ke database MySQL.</p>

        <form action="index.php" method="POST" class="space-y-3.5 text-xs">
            <input type="hidden" name="action" value="update_menu">
            <input type="hidden" name="id" id="editMenuId" value="0">

            <div>
                <label class="block font-bold text-stone-800 mb-1">Nama Menu *</label>
                <input type="text" name="nama" id="editMenuNama" required class="w-full px-3.5 py-2.5 bg-cream-50 rounded-xl border border-cream-300 font-bold text-stone-900 outline-none focus:border-coffee focus:ring-2 focus:ring-coffee/15 transition">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Kategori *</label>
                    <select name="kategori" id="editMenuKategori" required class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 font-bold outline-none focus:border-coffee transition">
                        <option value="coffee">Coffee</option>
                        <option value="non-coffee">Non Coffee</option>
                        <option value="snack">Menu Snack</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Harga (Rp) *</label>
                    <input type="number" name="harga" id="editMenuHarga" required min="1000" step="500" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 font-bold outline-none focus:border-coffee transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Badge Promo</label>
                    <input type="text" name="badge" id="editMenuBadge" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Subjudul Varian</label>
                    <input type="text" name="subjudul" id="editMenuSubjudul" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                </div>
            </div>

            <div>
                <label class="block font-bold text-stone-800 mb-1">Deskripsi Menu</label>
                <textarea name="deskripsi" id="editMenuDeskripsi" rows="3" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_featured" id="editMenuFeatured" value="1" class="w-4 h-4 text-coffee rounded">
                <label for="editMenuFeatured" class="font-bold text-stone-800 select-none cursor-pointer">Jadikan Menu Andalan (Featured)</label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-black uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition cursor-pointer">
                    Simpan Perubahan ke Database &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 4. MODAL TAMBAH MENU BARU -->
<div id="modalTambahMenu" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-lg w-full p-6 sm:p-7 rounded-3xl border border-cream-200 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="$('#modalTambahMenu').fadeOut(150)" class="absolute top-5 right-5 text-stone-500 hover:text-stone-900 font-bold text-xs w-8 h-8 rounded-full bg-cream-100 hover:bg-cream-200 flex items-center justify-center transition cursor-pointer">
            ✕
        </button>

        <span class="text-[10px] font-bold bg-amber-500 text-stone-950 px-2.5 py-0.5 rounded-full uppercase tracking-wider inline-block">CREATE MENU</span>
        <h3 class="font-heading font-black text-lg text-stone-900 mb-1 mt-1">+ Tambah Menu Baru</h3>
        <p class="text-xs text-stone-500 mb-4">Tambahkan item menu baru ke database MySQL D'Bright Coffee.</p>

        <form action="index.php" method="POST" class="space-y-3.5 text-xs">
            <input type="hidden" name="action" value="create_menu">

            <div>
                <label class="block font-bold text-stone-800 mb-1">Nama Menu *</label>
                <input type="text" name="nama" required placeholder="Contoh: Kopi Susu Aren" class="w-full px-3.5 py-2.5 bg-cream-50 rounded-xl border border-cream-300 font-bold text-stone-900 outline-none focus:border-coffee transition">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Kategori *</label>
                    <select name="kategori" required class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 font-bold outline-none focus:border-coffee transition">
                        <option value="coffee">Coffee</option>
                        <option value="non-coffee">Non Coffee</option>
                        <option value="snack">Menu Snack</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Harga (Rp) *</label>
                    <input type="number" name="harga" required min="1000" step="500" placeholder="15000" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 font-bold outline-none focus:border-coffee transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Badge (Label Promosi)</label>
                    <input type="text" name="badge" placeholder="Contoh: Menu Baru / Best Seller" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Subjudul Varian</label>
                    <input type="text" name="subjudul" placeholder="Contoh: Espresso & Gula Aren Asli" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                </div>
            </div>

            <div>
                <label class="block font-bold text-stone-800 mb-1">Deskripsi Menu</label>
                <textarea name="deskripsi" rows="3" placeholder="Tuliskan racikan rasa atau komposisi menu..." class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_featured" id="createFeaturedMain" value="1" class="w-4 h-4 text-coffee rounded">
                <label for="createFeaturedMain" class="font-bold text-stone-800 select-none cursor-pointer">Jadikan Menu Andalan (Featured)</label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 bg-stone-900 hover:bg-coffee text-white font-black uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition cursor-pointer">
                    + Simpan Menu ke Database &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 5. MODAL RIWAYAT PESANAN MASUK -->
<div id="modalRiwayatPesanan" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-5xl w-full p-6 sm:p-8 rounded-3xl border border-cream-200 shadow-2xl relative max-h-[90vh] flex flex-col">
        <div class="flex items-center justify-between pb-4 border-b border-cream-200">
            <div>
                <h3 class="font-heading font-black text-xl text-stone-900">📋 Riwayat Pesanan Masuk (Database MySQL)</h3>
                <p class="text-xs text-stone-500 font-medium mt-0.5">
                    Database: <span class="text-coffee font-bold">tugasnela_db</span> &bull; Tabel: <span class="text-coffee font-bold">pesanan</span> &bull; Total: <span class="text-coffee font-bold"><?= $countPesanan ?> Pesanan</span> (Omset: <?= formatRupiah($totalOmset) ?>)
                </p>
            </div>
            <button type="button" onclick="$('#modalRiwayatPesanan').fadeOut(150)" class="text-stone-500 hover:text-stone-900 font-bold text-xs w-8 h-8 rounded-full bg-cream-100 hover:bg-cream-200 flex items-center justify-center transition cursor-pointer" title="Tutup">
                ✕
            </button>
        </div>

        <div class="overflow-y-auto mt-4 grow rounded-2xl border border-cream-200">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-cream-100/70 border-b border-cream-200 font-bold text-stone-900 sticky top-0">
                        <th class="p-3 w-12 text-center">ID</th>
                        <th class="p-3">Waktu</th>
                        <th class="p-3">Nama Pemesan</th>
                        <th class="p-3">Menu</th>
                        <th class="p-3 text-center">Porsi</th>
                        <th class="p-3">Varian & Topping</th>
                        <th class="p-3">Catatan</th>
                        <th class="p-3 text-right">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-200">
                    <?php if (empty($daftarPesanan)): ?>
                        <tr>
                            <td colspan="8" class="p-8 text-center text-stone-500 font-semibold">
                                Belum ada pesanan masuk di database.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarPesanan as $p): ?>
                            <tr class="hover:bg-cream-50/80 transition">
                                <td class="p-3 text-center font-mono font-bold text-stone-400">#<?= htmlspecialchars($p['id']) ?></td>
                                <td class="p-3 text-stone-600 whitespace-nowrap"><?= htmlspecialchars($p['waktu_pesan']) ?></td>
                                <td class="p-3 font-bold text-stone-900"><?= htmlspecialchars($p['nama_pemesan']) ?></td>
                                <td class="p-3 font-semibold text-coffee"><?= htmlspecialchars($p['menu_pilihan']) ?></td>
                                <td class="p-3 text-center font-bold bg-cream-100/40 rounded"><?= (int)$p['jumlah'] ?></td>
                                <td class="p-3 text-stone-600">
                                    <div><?= htmlspecialchars($p['level_gula']) ?> &bull; <?= htmlspecialchars($p['ukuran']) ?></div>
                                    <?php if (!empty($p['topping']) && $p['topping'] !== 'Tanpa Topping'): ?>
                                        <div class="text-[10px] text-stone-400">Topping: <?= htmlspecialchars($p['topping']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="p-3 text-stone-500 italic max-w-xs truncate"><?= htmlspecialchars($p['catatan'] ?: '-') ?></td>
                                <td class="p-3 text-right font-black text-coffee whitespace-nowrap"><?= formatRupiah($p['total_harga']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pt-3 border-t border-cream-200 mt-3 flex items-center justify-between text-xs">
            <span class="text-stone-500">Setiap pemesanan dari form otomatis tercatat ke tabel MySQL ini.</span>
            <div class="flex items-center gap-2">
                <a href="admin.php" class="font-bold text-stone-700 hover:text-coffee transition">
                    Buka Dashboard Admin &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
