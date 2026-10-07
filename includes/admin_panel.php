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
                <span class="px-2 py-0.5 bg-amber-500 text-stone-950 font-black uppercase text-[10px] tracking-wider">ADMIN AKTIF</span>
                <span class="font-bold">Mode Pengelolaan Menu & Pesanan Database <span class="text-amber-400 font-extrabold">(tugasnela_db)</span></span>
            </div>
            <div class="flex flex-wrap items-center gap-2 font-bold">
                <button type="button" id="btnAdminTambahMenu" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black uppercase tracking-wider transition cursor-pointer">
                    + Tambah Menu Baru
                </button>
                <button type="button" id="btnAdminLihatPesanan" class="px-3 py-1.5 bg-stone-800 hover:bg-stone-700 text-cream-100 border border-stone-600 transition cursor-pointer">
                    📋 Riwayat Pesanan (<?= $countPesanan ?>)
                </button>
                <form action="index.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memulihkan 24 menu default?');" class="inline">
                    <input type="hidden" name="action" value="reset_default_menus">
                    <button type="submit" class="px-2.5 py-1.5 bg-stone-800 hover:bg-stone-700 text-stone-300 border border-stone-700 transition cursor-pointer text-[11px]" title="Reset ke 24 menu awal">
                        🔄 Reset Default
                    </button>
                </form>
                <a href="index.php?logout_admin=1" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white font-bold transition">
                    Keluar Admin ✕
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- 2. FLASH NOTIFICATION TOAST (FEEDBACK CRUD DATABASE) -->
<?php if ($flash): ?>
    <div id="adminFlashNotice" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="p-4 border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917] text-xs font-bold flex items-center justify-between <?= $flash['type'] === 'success' ? 'bg-emerald-100 text-emerald-900 border-emerald-900' : ($flash['type'] === 'error' ? 'bg-red-100 text-red-900 border-red-900' : 'bg-blue-100 text-blue-900 border-blue-900') ?>">
            <div class="flex items-center gap-2">
                <span class="text-base"><?= $flash['type'] === 'success' ? '✅' : ($flash['type'] === 'error' ? '⚠️' : 'ℹ️') ?></span>
                <span><?= htmlspecialchars($flash['message']) ?></span>
            </div>
            <button onclick="$('#adminFlashNotice').fadeOut()" class="text-stone-500 hover:text-stone-900 font-bold px-2 py-0.5 cursor-pointer">&times;</button>
        </div>
    </div>
<?php endif; ?>

<!-- 3. MODAL EDIT MENU (DIPICU SAAT TOMBOL EDIT DI KARTU MENU DIKLIK) -->
<div id="modalEditMenu" class="fixed inset-0 z-50 bg-stone-900/80 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-lg w-full p-6 border-4 border-stone-900 shadow-[10px_10px_0px_0px_#7F5539] relative max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="$('#modalEditMenu').fadeOut(150)" class="absolute top-4 right-4 text-stone-600 hover:text-stone-900 font-bold text-xs px-2 py-1 border-2 border-stone-800 hover:bg-cream-200 transition cursor-pointer">
            TUTUP [X]
        </button>

        <h3 class="font-heading font-black text-lg text-stone-900 mb-1">✏️ Edit Data Menu</h3>
        <p class="text-xs text-stone-500 mb-4">Ubah informasi menu di bawah ini. Perubahan akan langsung disimpan ke database MySQL.</p>

        <form action="index.php" method="POST" class="space-y-3 text-xs">
            <input type="hidden" name="action" value="update_menu">
            <input type="hidden" name="id" id="editMenuId" value="0">

            <div>
                <label class="block font-bold text-stone-800 mb-1">Nama Menu *</label>
                <input type="text" name="nama" id="editMenuNama" required class="w-full p-2.5 bg-cream-50 border-2 border-cream-300 font-bold text-stone-900 outline-none focus:border-coffee">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Kategori *</label>
                    <select name="kategori" id="editMenuKategori" required class="w-full p-2.5 bg-white border-2 border-cream-300 font-bold outline-none focus:border-coffee">
                        <option value="coffee">Coffee</option>
                        <option value="non-coffee">Non Coffee</option>
                        <option value="snack">Menu Snack</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Harga (Rp) *</label>
                    <input type="number" name="harga" id="editMenuHarga" required min="1000" step="500" class="w-full p-2.5 bg-white border-2 border-cream-300 font-bold outline-none focus:border-coffee">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Badge Promo</label>
                    <input type="text" name="badge" id="editMenuBadge" class="w-full p-2 bg-white border border-cream-300 outline-none focus:border-coffee">
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Subjudul Varian</label>
                    <input type="text" name="subjudul" id="editMenuSubjudul" class="w-full p-2 bg-white border border-cream-300 outline-none focus:border-coffee">
                </div>
            </div>

            <div>
                <label class="block font-bold text-stone-800 mb-1">Deskripsi Menu</label>
                <textarea name="deskripsi" id="editMenuDeskripsi" rows="3" class="w-full p-2 bg-white border border-cream-300 outline-none focus:border-coffee"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_featured" id="editMenuFeatured" value="1" class="w-4 h-4 text-coffee">
                <label for="editMenuFeatured" class="font-bold text-stone-800 select-none cursor-pointer">Jadikan Menu Andalan (Featured)</label>
            </div>

            <div class="pt-3">
                <button type="submit" class="w-full py-3 bg-amber-600 hover:bg-amber-700 text-white font-black uppercase tracking-wider border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition cursor-pointer">
                    Simpan Perubahan ke Database &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 4. MODAL TAMBAH MENU BARU -->
<div id="modalTambahMenu" class="fixed inset-0 z-50 bg-stone-900/80 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-lg w-full p-6 border-4 border-stone-900 shadow-[10px_10px_0px_0px_#7F5539] relative max-h-[90vh] overflow-y-auto">
        <button type="button" onclick="$('#modalTambahMenu').fadeOut(150)" class="absolute top-4 right-4 text-stone-600 hover:text-stone-900 font-bold text-xs px-2 py-1 border-2 border-stone-800 hover:bg-cream-200 transition cursor-pointer">
            TUTUP [X]
        </button>

        <h3 class="font-heading font-black text-lg text-stone-900 mb-1">+ Tambah Menu Baru</h3>
        <p class="text-xs text-stone-500 mb-4">Tambahkan item menu baru ke database MySQL D'Bright Coffee.</p>

        <form action="index.php" method="POST" class="space-y-3 text-xs">
            <input type="hidden" name="action" value="create_menu">

            <div>
                <label class="block font-bold text-stone-800 mb-1">Nama Menu *</label>
                <input type="text" name="nama" required placeholder="Contoh: Kopi Susu Aren" class="w-full p-2.5 bg-cream-50 border-2 border-cream-300 font-bold text-stone-900 outline-none focus:border-coffee">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Kategori *</label>
                    <select name="kategori" required class="w-full p-2.5 bg-white border-2 border-cream-300 font-bold outline-none focus:border-coffee">
                        <option value="coffee">Coffee</option>
                        <option value="non-coffee">Non Coffee</option>
                        <option value="snack">Menu Snack</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Harga (Rp) *</label>
                    <input type="number" name="harga" required min="1000" step="500" placeholder="15000" class="w-full p-2.5 bg-white border-2 border-cream-300 font-bold outline-none focus:border-coffee">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Badge (Label Promosi)</label>
                    <input type="text" name="badge" placeholder="Contoh: Menu Baru / Best Seller" class="w-full p-2 bg-white border border-cream-300 outline-none focus:border-coffee">
                </div>
                <div>
                    <label class="block font-bold text-stone-800 mb-1">Subjudul Varian</label>
                    <input type="text" name="subjudul" placeholder="Contoh: Espresso & Gula Aren Asli" class="w-full p-2 bg-white border border-cream-300 outline-none focus:border-coffee">
                </div>
            </div>

            <div>
                <label class="block font-bold text-stone-800 mb-1">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" placeholder="Jelaskan keunikan rasa menu..." class="w-full p-2 bg-white border border-cream-300 outline-none focus:border-coffee"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" name="is_featured" id="tambahMenuFeatured" value="1" class="w-4 h-4 text-coffee">
                <label for="tambahMenuFeatured" class="font-bold text-stone-800 select-none cursor-pointer">Jadikan Menu Andalan (Featured)</label>
            </div>

            <div class="pt-3">
                <button type="submit" class="w-full py-3 bg-coffee hover:bg-coffee-dark text-white font-black uppercase tracking-wider border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition cursor-pointer">
                    Simpan Menu Baru ke Database &rarr;
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 5. MODAL LOGIN ADMIN (MUNCUL SAAT MENGKLIK TOMBOL MODE ADMIN DI NAVBAR) -->
<div id="modalLoginAdmin" class="fixed inset-0 z-50 bg-stone-900/80 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-sm w-full p-6 border-4 border-stone-900 shadow-[10px_10px_0px_0px_#7F5539] relative">
        <button type="button" onclick="$('#modalLoginAdmin').fadeOut(150)" class="absolute top-4 right-4 text-stone-600 hover:text-stone-900 font-bold text-xs px-2 py-1 border-2 border-stone-800 hover:bg-cream-200 transition cursor-pointer">
            TUTUP [X]
        </button>

        <div class="text-center mb-5">
            <span class="text-3xl block mb-1">⚙️</span>
            <h3 class="font-heading font-black text-lg text-stone-900">Masuk ke Mode Admin</h3>
            <p class="text-xs text-stone-500">Kelola, Edit & Hapus Menu langsung di halaman ini</p>
        </div>

        <form action="index.php" method="POST" class="space-y-3 text-xs">
            <input type="hidden" name="action" value="admin_login">
            <div>
                <label class="block font-bold text-stone-800 mb-1">Username:</label>
                <input type="text" name="username" value="admin" required class="w-full p-2.5 bg-cream-50 border-2 border-stone-900 font-bold text-stone-900 outline-none focus:border-coffee">
                <span class="text-[10px] text-stone-400">Default: admin</span>
            </div>
            <div>
                <label class="block font-bold text-stone-800 mb-1">Password:</label>
                <input type="password" name="password" value="admin123" required class="w-full p-2.5 bg-cream-50 border-2 border-stone-900 font-bold text-stone-900 outline-none focus:border-coffee">
                <span class="text-[10px] text-stone-400">Default: admin123</span>
            </div>

            <div class="pt-2 space-y-2">
                <button type="submit" class="w-full py-3 bg-stone-900 hover:bg-coffee text-white font-black uppercase tracking-wider border-2 border-stone-900 shadow-[4px_4px_0px_0px_#7F5539] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition cursor-pointer">
                    Aktifkan Mode Admin &rarr;
                </button>
                <button type="submit" name="demo_login" value="1" class="w-full py-2 bg-amber-100 hover:bg-amber-200 text-stone-900 font-bold border-2 border-amber-600 transition text-[11px] cursor-pointer">
                    ⚡ Klik Disini untuk Masuk Langsung (Login Cepat)
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 6. MODAL RIWAYAT PESANAN MASUK (TERINTEGRASI DI HALAMAN UTAMA) -->
<div id="modalRiwayatPesanan" class="fixed inset-0 z-50 bg-stone-900/80 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-5xl w-full p-6 border-4 border-stone-900 shadow-[10px_10px_0px_0px_#7F5539] relative max-h-[90vh] flex flex-col">
        <div class="flex items-center justify-between pb-4 border-b-2 border-cream-200">
            <div>
                <h3 class="font-heading font-black text-xl text-stone-900">📋 Riwayat Pesanan Masuk (Database MySQL)</h3>
                <p class="text-xs text-stone-500 font-semibold">
                    Database: <span class="text-coffee font-bold">tugasnela_db</span> &bull; Tabel: <span class="text-coffee font-bold">pesanan</span> &bull; Total: <span class="text-coffee font-bold"><?= $countPesanan ?> Pesanan</span> (Omset: <?= formatRupiah($totalOmset) ?>)
                </p>
            </div>
            <button type="button" onclick="$('#modalRiwayatPesanan').fadeOut(150)" class="text-stone-600 hover:text-stone-900 font-bold text-xs px-2.5 py-1.5 border-2 border-stone-800 hover:bg-cream-200 transition cursor-pointer">
                TUTUP [X]
            </button>
        </div>

        <div class="overflow-y-auto mt-4 grow">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-cream-200 border-b-2 border-stone-900 font-bold text-stone-900 sticky top-0">
                        <th class="p-2.5 w-12">ID</th>
                        <th class="p-2.5">Waktu</th>
                        <th class="p-2.5">Nama Pemesan</th>
                        <th class="p-2.5">Menu</th>
                        <th class="p-2.5 text-center">Porsi</th>
                        <th class="p-2.5">Varian & Topping</th>
                        <th class="p-2.5">Catatan</th>
                        <th class="p-2.5 text-right">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cream-300">
                    <?php if (empty($daftarPesanan)): ?>
                        <tr>
                            <td colspan="8" class="p-8 text-center text-stone-500 font-semibold">
                                Belum ada pesanan masuk di database.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($daftarPesanan as $p): ?>
                            <tr class="hover:bg-cream-50 transition">
                                <td class="p-2.5 font-mono font-bold text-stone-500">#<?= htmlspecialchars($p['id']) ?></td>
                                <td class="p-2.5 text-stone-600 whitespace-nowrap"><?= htmlspecialchars($p['waktu_pesan']) ?></td>
                                <td class="p-2.5 font-bold text-stone-900"><?= htmlspecialchars($p['nama_pemesan']) ?></td>
                                <td class="p-2.5 font-semibold text-coffee-dark"><?= htmlspecialchars($p['menu_pilihan']) ?></td>
                                <td class="p-2.5 text-center font-bold bg-cream-100/50"><?= (int)$p['jumlah'] ?></td>
                                <td class="p-2.5 text-stone-600">
                                    <div><?= htmlspecialchars($p['level_gula']) ?> &bull; <?= htmlspecialchars($p['ukuran']) ?></div>
                                    <?php if (!empty($p['topping']) && $p['topping'] !== 'Tanpa Topping'): ?>
                                        <div class="text-[11px] text-stone-400">Topping: <?= htmlspecialchars($p['topping']) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="p-2.5 text-stone-500 italic max-w-xs truncate"><?= htmlspecialchars($p['catatan']) ?></td>
                                <td class="p-2.5 text-right font-black text-coffee whitespace-nowrap"><?= formatRupiah($p['total_harga']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pt-3 border-t border-cream-200 mt-2 flex items-center justify-between">
            <span class="text-xs text-stone-500">Setiap pesanan dari formulir web otomatis langsung tercatat di sini.</span>
            <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=tugasnela_db&table=pesanan" target="_blank" class="text-xs font-bold text-coffee hover:underline">
                Buka di phpMyAdmin &rarr;
            </a>
        </div>
    </div>
</div>
