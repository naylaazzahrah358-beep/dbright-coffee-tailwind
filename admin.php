<?php
/**
 * =========================================================================
 * ☕ D'BRIGHT COFFEE - Panel Admin & Dashboard CRUD Database MySQL
 * =========================================================================
 * Mata Kuliah : Praktikum Pemrograman Web
 * Pengembang  : Nayla Azzahra R
 * NIM / Kelas : Kelas C - Angkatan 2025
 * Program Studi: Teknik Komputer FT-UNM
 * Database    : tugasnela_db (Tabel: menu & pesanan)
 * =========================================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['is_admin'] = true;

require_once __DIR__ . '/data/db.php';
require_once __DIR__ . '/data/admin_handler.php';
require_once __DIR__ . '/data/menu_data.php';

// Ambil seluruh data menu dari MySQL
$menuList = [];
$countCoffee = 0;
$countNonCoffee = 0;
$countSnack = 0;

if (isset($conn) && $conn && !$conn->connect_error) {
    $res = $conn->query("SELECT * FROM `menu` ORDER BY `id` ASC");
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $menuList[] = $row;
            if ($row['kategori'] === 'coffee') $countCoffee++;
            elseif ($row['kategori'] === 'non-coffee') $countNonCoffee++;
            elseif ($row['kategori'] === 'snack') $countSnack++;
        }
    }
}

// Ambil seluruh riwayat pesanan dari MySQL
$orderList = [];
$totalOmset = 0;
if (isset($conn) && $conn && !$conn->connect_error) {
    $resOrder = $conn->query("SELECT * FROM `pesanan` ORDER BY `id` DESC");
    if ($resOrder && $resOrder->num_rows > 0) {
        while ($row = $resOrder->fetch_assoc()) {
            $orderList[] = $row;
            $totalOmset += (int)$row['total_harga'];
        }
    }
}

$totalMenu = count($menuList);
$countPesanan = count($orderList);
$dbStatus = (isset($conn) && !$conn->connect_error);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin CRUD - <?= htmlspecialchars($outlet['nama']) ?></title>
    <link rel="icon" type="image/jpeg" href="<?= htmlspecialchars($outlet['logo']) ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        coffee: {
                            DEFAULT: '#7F5539',
                            dark: '#5A3A25',
                            light: '#9C6644',
                            deep: '#231710'
                        },
                        cream: {
                            50: '#FDFBF7',
                            100: '#FAF6EE',
                            200: '#F4ECE1',
                            300: '#EAE0D0',
                            400: '#DECDB5',
                            500: '#CBB496'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-b from-cream-50 via-cream-100/40 to-cream-50 text-stone-900 font-sans min-h-screen flex flex-col">

    <!-- Top Admin Header Bar -->
    <header class="bg-stone-900 text-cream-100 border-b-4 border-amber-500 sticky top-0 z-40 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo" class="w-10 h-10 rounded-xl border border-amber-400/80 object-cover shadow-xs">
                <div>
                    <h1 class="font-heading font-extrabold text-lg text-white leading-tight">
                        D'BRIGHT <span class="text-amber-400">COFFEE</span> &bull; Panel Admin CRUD
                    </h1>
                    <div class="flex items-center gap-2 text-[11px] text-stone-400">
                        <span>Database: <strong class="text-amber-300"><?= htmlspecialchars($dbName) ?></strong></span>
                        <span>&bull;</span>
                        <span class="<?= $dbStatus ? 'text-emerald-400 font-bold' : 'text-red-400 font-bold' ?> flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full <?= $dbStatus ? 'bg-emerald-400' : 'bg-red-400' ?> inline-block"></span>
                            <?= $dbStatus ? 'MySQL Terhubung' : 'Gagal Koneksi' ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Action Links -->
            <div class="flex flex-wrap items-center gap-2 text-xs font-bold">
                <a href="index.php" class="px-4 py-2 bg-coffee hover:bg-coffee-dark text-white rounded-full transition cursor-pointer flex items-center gap-1.5 shadow-sm">
                    <span>🌐</span> Buka Web Utama
                </a>
                <a href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=<?= urlencode($dbName) ?>" target="_blank" class="px-3.5 py-2 bg-stone-800 hover:bg-stone-700 text-cream-200 border border-stone-700 rounded-full transition cursor-pointer flex items-center gap-1">
                    <span>🗄️</span> phpMyAdmin
                </a>
                <form action="admin.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memulihkan 24 menu default D\'Bright Coffee? Data modifikasi akan di-reset.');" class="inline">
                    <input type="hidden" name="action" value="reset_default_menus">
                    <input type="hidden" name="redirect_to" value="admin.php">
                    <button type="submit" class="px-3.5 py-2 bg-stone-800 hover:bg-stone-700 text-amber-300 border border-stone-700 rounded-full transition cursor-pointer flex items-center gap-1 text-xs font-bold" title="Reset data ke 24 menu awal">
                        <span>🔄</span> Reset Default
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Admin Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full grow">

        <!-- Flash Notice Notification -->
        <?php if ($flash): ?>
            <div id="flashNotice" class="mb-6 p-4 rounded-2xl border shadow-xs text-xs font-bold flex items-center justify-between <?= $flash['type'] === 'success' ? 'bg-emerald-50 text-emerald-900 border-emerald-300' : ($flash['type'] === 'error' ? 'bg-red-50 text-red-900 border-red-300' : 'bg-blue-50 text-blue-900 border-blue-300') ?>">
                <div class="flex items-center gap-2">
                    <span class="text-base"><?= $flash['type'] === 'success' ? '✅' : ($flash['type'] === 'error' ? '⚠️' : 'ℹ️') ?></span>
                    <span><?= htmlspecialchars($flash['message']) ?></span>
                </div>
                <button onclick="$('#flashNotice').fadeOut()" class="text-stone-600 hover:text-stone-900 font-bold px-2 py-0.5 cursor-pointer">&times;</button>
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5 mb-8">
            <div class="bg-white p-4.5 rounded-2xl border border-cream-200/90 shadow-sm hover:shadow-md transition">
                <span class="text-[11px] font-bold text-stone-500 uppercase tracking-wider block">Total Menu</span>
                <p class="text-2xl font-black text-stone-900 mt-1"><?= $totalMenu ?></p>
                <span class="text-[10px] text-stone-400 font-medium">Tersimpan di MySQL</span>
            </div>
            <div class="bg-white p-4.5 rounded-2xl border border-cream-200/90 shadow-sm hover:shadow-md transition">
                <span class="text-[11px] font-bold text-coffee uppercase tracking-wider block">Coffee</span>
                <p class="text-2xl font-black text-coffee mt-1"><?= $countCoffee ?></p>
                <span class="text-[10px] text-stone-400 font-medium">Varian Kopi</span>
            </div>
            <div class="bg-white p-4.5 rounded-2xl border border-cream-200/90 shadow-sm hover:shadow-md transition">
                <span class="text-[11px] font-bold text-stone-600 uppercase tracking-wider block">Non-Coffee</span>
                <p class="text-2xl font-black text-stone-700 mt-1"><?= $countNonCoffee ?></p>
                <span class="text-[10px] text-stone-400 font-medium">Matcha, Cokelat, dll</span>
            </div>
            <div class="bg-white p-4.5 rounded-2xl border border-cream-200/90 shadow-sm hover:shadow-md transition">
                <span class="text-[11px] font-bold text-amber-700 uppercase tracking-wider block">Snack</span>
                <p class="text-2xl font-black text-amber-800 mt-1"><?= $countSnack ?></p>
                <span class="text-[10px] text-stone-400 font-medium">Camilan & Makanan</span>
            </div>
            <div class="bg-white p-4.5 rounded-2xl border border-cream-200/90 shadow-sm hover:shadow-md transition">
                <span class="text-[11px] font-bold text-stone-500 uppercase tracking-wider block">Pesanan</span>
                <p class="text-2xl font-black text-stone-900 mt-1"><?= $countPesanan ?></p>
                <span class="text-[10px] text-stone-400 font-medium">Data Pelanggan</span>
            </div>
            <div class="bg-white p-4.5 rounded-2xl border border-cream-200/90 shadow-sm hover:shadow-md transition">
                <span class="text-[11px] font-bold text-emerald-700 uppercase tracking-wider block">Total Omset</span>
                <p class="text-lg font-black text-emerald-800 mt-2 truncate"><?= formatRupiah($totalOmset) ?></p>
                <span class="text-[10px] text-stone-400 font-medium">Akumulasi Order</span>
            </div>
        </div>

        <!-- Section Grid: Form Create & Menu Table -->
        <div class="grid lg:grid-cols-12 gap-8 items-start mb-10">
            
            <!-- FORM TAMBAH MENU BARU (CREATE) -->
            <div class="lg:col-span-4 bg-white p-6 sm:p-7 rounded-3xl border border-cream-200/90 shadow-lg sticky top-24">
                <div class="border-b border-cream-200 pb-3.5 mb-4">
                    <span class="text-[10px] font-bold bg-amber-500 text-stone-950 px-2.5 py-0.5 uppercase tracking-wider rounded-full inline-block">CREATE MENU</span>
                    <h2 class="font-heading font-black text-lg text-stone-900 mt-1.5">➕ Tambah Menu Baru</h2>
                    <p class="text-xs text-stone-500">Item baru akan langsung tersimpan di database MySQL <span class="font-bold text-coffee">tugasnela_db</span>.</p>
                </div>

                <form action="admin.php" method="POST" class="space-y-3.5 text-xs">
                    <input type="hidden" name="action" value="create_menu">
                    <input type="hidden" name="redirect_to" value="admin.php">

                    <div>
                        <label class="block font-bold text-stone-800 mb-1">Nama Menu *</label>
                        <input type="text" name="nama" required placeholder="Contoh: Kopi Susu Aren Spesial" class="w-full px-3.5 py-2.5 bg-cream-50 rounded-xl border border-cream-300 font-bold text-stone-900 outline-none focus:border-coffee focus:ring-2 focus:ring-coffee/15 transition">
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
                            <label class="block font-bold text-stone-800 mb-1">Badge Promosi</label>
                            <input type="text" name="badge" placeholder="Contoh: Best Seller" class="w-full px-3.5 py-2 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                        </div>
                        <div>
                            <label class="block font-bold text-stone-800 mb-1">Subjudul Varian</label>
                            <input type="text" name="subjudul" placeholder="Contoh: Kopi & Gula Aren Asli" class="w-full px-3.5 py-2 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-stone-800 mb-1">Deskripsi Menu Lengkap</label>
                        <textarea name="deskripsi" rows="3" placeholder="Tuliskan racikan rasa atau komposisi menu..." class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition"></textarea>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" name="is_featured" id="createFeatured" value="1" class="w-4 h-4 text-coffee rounded">
                        <label for="createFeatured" class="font-bold text-stone-800 select-none cursor-pointer">Tampilkan sebagai Menu Unggulan (Featured)</label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 bg-stone-900 hover:bg-coffee text-white font-black uppercase tracking-wider rounded-xl shadow-md hover:shadow-xl transition cursor-pointer">
                            + Simpan Menu ke Database
                        </button>
                    </div>
                </form>
            </div>

            <!-- TABEL KELOLA MENU (READ, UPDATE, DELETE) -->
            <div class="lg:col-span-8 bg-white rounded-3xl border border-cream-200/90 shadow-lg overflow-hidden">
                <div class="p-5 bg-stone-900 text-cream-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b-2 border-amber-500">
                    <div>
                        <span class="text-[10px] font-bold bg-amber-500 text-stone-950 px-2.5 py-0.5 uppercase tracking-wider rounded-full inline-block">READ & MANAGE</span>
                        <h2 class="font-heading font-black text-lg text-white mt-1">📋 Daftar Menu di Database (<?= $totalMenu ?> Item)</h2>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="text" id="adminTableSearch" placeholder="🔍 Cari nama menu..." class="px-4 py-2 text-xs bg-stone-800 border border-stone-700 rounded-full text-white placeholder-stone-400 outline-none focus:border-amber-400">
                    </div>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-cream-100/70 border-b border-cream-200 font-bold text-stone-900">
                                <th class="p-3 w-12 text-center">ID</th>
                                <th class="p-3">Nama Menu</th>
                                <th class="p-3">Kategori</th>
                                <th class="p-3">Badge & Subjudul</th>
                                <th class="p-3 text-right">Harga</th>
                                <th class="p-3 text-center">Status</th>
                                <th class="p-3 text-center w-28">Aksi CRUD</th>
                            </tr>
                        </thead>
                        <tbody id="adminMenuTableBody" class="divide-y divide-cream-200">
                            <?php if (empty($menuList)): ?>
                                <tr>
                                    <td colspan="7" class="p-8 text-center text-stone-500 font-bold">
                                        Tidak ada data menu di tabel `menu`. Silakan tambah menu baru atau klik tombol Reset Default.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($menuList as $m): ?>
                                    <tr class="hover:bg-cream-50/80 transition menu-row" data-name="<?= strtolower(htmlspecialchars($m['nama'])) ?>">
                                        <td class="p-3 text-center font-mono font-bold text-stone-400">#<?= htmlspecialchars($m['id']) ?></td>
                                        <td class="p-3">
                                            <p class="font-bold text-stone-900 text-sm"><?= htmlspecialchars($m['nama']) ?></p>
                                            <p class="text-[11px] text-stone-500 line-clamp-1 max-w-xs"><?= htmlspecialchars($m['deskripsi']) ?></p>
                                        </td>
                                        <td class="p-3">
                                            <span class="px-2.5 py-0.5 font-bold uppercase text-[10px] rounded-full border <?= $m['kategori'] === 'coffee' ? 'bg-amber-50 text-amber-900 border-amber-200' : ($m['kategori'] === 'non-coffee' ? 'bg-emerald-50 text-emerald-900 border-emerald-200' : 'bg-orange-50 text-orange-900 border-orange-200') ?>">
                                                <?= htmlspecialchars($m['kategori_label']) ?>
                                            </span>
                                        </td>
                                        <td class="p-3">
                                            <p class="font-bold text-coffee text-[11px]"><?= htmlspecialchars($m['badge']) ?></p>
                                            <p class="text-[11px] text-stone-500"><?= htmlspecialchars($m['subjudul']) ?></p>
                                        </td>
                                        <td class="p-3 text-right font-black text-coffee whitespace-nowrap text-sm">
                                            <?= formatRupiah($m['harga']) ?>
                                        </td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <?php if (!empty($m['is_featured'])): ?>
                                                <span class="px-2.5 py-0.5 bg-coffee text-white font-bold text-[10px] rounded-full">⭐ Unggulan</span>
                                            <?php else: ?>
                                                <span class="text-stone-400 text-[10px]">Standar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="p-3 text-center whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <!-- Tombol Edit (UPDATE) -->
                                                <button type="button" 
                                                    class="btn-edit-admin px-2.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-stone-950 font-black text-[11px] rounded-lg transition cursor-pointer"
                                                    title="Edit Menu Ini"
                                                    data-id="<?= (int)$m['id'] ?>"
                                                    data-nama="<?= htmlspecialchars($m['nama'], ENT_QUOTES) ?>"
                                                    data-kategori="<?= htmlspecialchars($m['kategori'], ENT_QUOTES) ?>"
                                                    data-harga="<?= (int)$m['harga'] ?>"
                                                    data-badge="<?= htmlspecialchars($m['badge'] ?? '', ENT_QUOTES) ?>"
                                                    data-subjudul="<?= htmlspecialchars($m['subjudul'] ?? '', ENT_QUOTES) ?>"
                                                    data-deskripsi="<?= htmlspecialchars($m['deskripsi'] ?? '', ENT_QUOTES) ?>"
                                                    data-featured="<?= !empty($m['is_featured']) ? 1 : 0 ?>">
                                                    ✏️ Edit
                                                </button>

                                                <!-- Tombol Hapus (DELETE) -->
                                                <form action="admin.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin MENGHAPUS menu: <?= htmlspecialchars($m['nama'], ENT_QUOTES) ?> dari database?');" class="inline">
                                                    <input type="hidden" name="action" value="delete_menu">
                                                    <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                                                    <input type="hidden" name="redirect_to" value="admin.php">
                                                    <button type="submit" class="px-2.5 py-1.5 bg-red-600 hover:bg-red-700 text-white font-bold text-[11px] rounded-lg transition cursor-pointer" title="Hapus Menu Ini">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- TABEL RIWAYAT PESANAN MASUK DARI PELANGGAN (READ) -->
        <div class="bg-white rounded-3xl border border-cream-200/90 shadow-lg overflow-hidden mb-8">
            <div class="p-5 bg-stone-900 text-cream-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b-2 border-emerald-500">
                <div>
                    <span class="text-[10px] font-bold bg-emerald-500 text-stone-950 px-2.5 py-0.5 uppercase tracking-wider rounded-full inline-block">ORDER MONITOR</span>
                    <h2 class="font-heading font-black text-lg text-white mt-1">📋 Riwayat Pesanan Masuk (Tabel `pesanan`)</h2>
                    <p class="text-xs text-stone-400">Total: <strong class="text-white"><?= $countPesanan ?> Pesanan</strong> &bull; Total Omset: <strong class="text-emerald-400"><?= formatRupiah($totalOmset) ?></strong></p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="location.reload()" class="px-4 py-2 bg-coffee hover:bg-coffee-dark text-white font-bold text-xs rounded-full shadow-xs transition cursor-pointer">
                        🔄 Refresh Data Pesanan
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-cream-100/70 border-b border-cream-200 font-bold text-stone-900">
                            <th class="p-3 w-12 text-center">ID</th>
                            <th class="p-3">Waktu Pesan</th>
                            <th class="p-3">Nama Pemesan</th>
                            <th class="p-3">Menu Pilihan</th>
                            <th class="p-3 text-center">Jumlah</th>
                            <th class="p-3">Varian & Opsi</th>
                            <th class="p-3">Catatan</th>
                            <th class="p-3 text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-200">
                        <?php if (empty($orderList)): ?>
                            <tr>
                                <td colspan="8" class="p-8 text-center text-stone-500 font-bold">
                                    Belum ada data pesanan masuk. Anda dapat melakukan tes pemesanan di <a href="index.php" class="text-coffee underline font-bold">Halaman Web Utama</a>.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orderList as $ord): ?>
                                <tr class="hover:bg-cream-50/80 transition">
                                    <td class="p-3 text-center font-mono font-bold text-stone-400">#<?= htmlspecialchars($ord['id']) ?></td>
                                    <td class="p-3 text-stone-600 whitespace-nowrap"><?= htmlspecialchars($ord['waktu_pesan']) ?></td>
                                    <td class="p-3 font-bold text-stone-900"><?= htmlspecialchars($ord['nama_pemesan']) ?></td>
                                    <td class="p-3 font-semibold text-coffee"><?= htmlspecialchars($ord['menu_pilihan']) ?></td>
                                    <td class="p-3 text-center font-bold bg-cream-100/40 rounded"><?= (int)$ord['jumlah'] ?></td>
                                    <td class="p-3 text-stone-600">
                                        <div><?= htmlspecialchars($ord['level_gula']) ?> &bull; <?= htmlspecialchars($ord['ukuran']) ?></div>
                                        <?php if (!empty($ord['topping']) && $ord['topping'] !== 'Tanpa Topping'): ?>
                                            <div class="text-[10px] text-stone-400">Topping: <?= htmlspecialchars($ord['topping']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-3 text-stone-500 italic max-w-xs truncate"><?= htmlspecialchars($ord['catatan'] ?: '-') ?></td>
                                    <td class="p-3 text-right font-black text-coffee whitespace-nowrap text-sm"><?= formatRupiah($ord['total_harga']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- MODAL EDIT MENU (UPDATE) -->
    <div id="adminEditModal" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white max-w-lg w-full p-6 sm:p-7 rounded-3xl border border-cream-200 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button type="button" onclick="$('#adminEditModal').fadeOut(150)" class="absolute top-5 right-5 text-stone-500 hover:text-stone-900 font-bold text-xs w-8 h-8 rounded-full bg-cream-100 hover:bg-cream-200 flex items-center justify-center transition cursor-pointer">
                ✕
            </button>

            <span class="text-[10px] font-bold bg-amber-500 text-stone-950 px-2.5 py-0.5 rounded-full uppercase tracking-wider inline-block">UPDATE MENU</span>
            <h3 class="font-heading font-black text-lg text-stone-900 mb-1 mt-1">✏️ Edit Informasi Menu</h3>
            <p class="text-xs text-stone-500 mb-4">Perubahan akan langsung disimpan ke baris tabel MySQL.</p>

            <form action="admin.php" method="POST" class="space-y-3.5 text-xs">
                <input type="hidden" name="action" value="update_menu">
                <input type="hidden" name="id" id="editModalId" value="0">
                <input type="hidden" name="redirect_to" value="admin.php">

                <div>
                    <label class="block font-bold text-stone-800 mb-1">Nama Menu *</label>
                    <input type="text" name="nama" id="editModalNama" required class="w-full px-3.5 py-2.5 bg-cream-50 rounded-xl border border-cream-300 font-bold text-stone-900 outline-none focus:border-coffee transition">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-stone-800 mb-1">Kategori *</label>
                        <select name="kategori" id="editModalKategori" required class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 font-bold outline-none focus:border-coffee transition">
                            <option value="coffee">Coffee</option>
                            <option value="non-coffee">Non Coffee</option>
                            <option value="snack">Menu Snack</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-stone-800 mb-1">Harga (Rp) *</label>
                        <input type="number" name="harga" id="editModalHarga" required min="1000" step="500" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 font-bold outline-none focus:border-coffee transition">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-stone-800 mb-1">Badge Promosi</label>
                        <input type="text" name="badge" id="editModalBadge" class="w-full px-3.5 py-2 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                    </div>
                    <div>
                        <label class="block font-bold text-stone-800 mb-1">Subjudul Varian</label>
                        <input type="text" name="subjudul" id="editModalSubjudul" class="w-full px-3.5 py-2 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-stone-800 mb-1">Deskripsi Menu</label>
                    <textarea name="deskripsi" id="editModalDeskripsi" rows="3" class="w-full px-3.5 py-2.5 bg-white rounded-xl border border-cream-300 outline-none focus:border-coffee transition"></textarea>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_featured" id="editModalFeatured" value="1" class="w-4 h-4 text-coffee rounded">
                    <label for="editModalFeatured" class="font-bold text-stone-800 select-none cursor-pointer">Jadikan Menu Unggulan (Featured)</label>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 bg-amber-600 hover:bg-amber-700 text-white font-black uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition cursor-pointer">
                        Simpan Perubahan ke Database &rarr;
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Admin Footer -->
    <footer class="bg-stone-900 text-stone-400 py-6 text-center text-xs border-t border-stone-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>&copy; <?= date('Y') ?> <strong><?= htmlspecialchars($outlet['nama']) ?></strong> &bull; Panel Admin CRUD Database</p>
            <p>Pengembang: <strong class="text-white">Nayla Azzahra R</strong> (Kelas C - Angkatan 2025, Teknik Komputer FT-UNM)</p>
        </div>
    </footer>

    <!-- jQuery Controller for Admin Interactivity -->
    <script>
        $(document).ready(function() {
            // Pencarian Instan di Tabel Menu Admin
            $('#adminTableSearch').on('keyup', function() {
                const query = $(this).val().toLowerCase().trim();
                $('.menu-row').each(function() {
                    const name = $(this).data('name') || '';
                    if (name.includes(query) || query === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Klik Tombol Edit -> Tampilkan Modal dengan Data Terisi
            $('.btn-edit-admin').on('click', function(e) {
                e.preventDefault();
                const id        = $(this).data('id');
                const nama      = $(this).data('nama');
                const kategori  = $(this).data('kategori');
                const harga     = $(this).data('harga');
                const badge     = $(this).data('badge');
                const subjudul  = $(this).data('subjudul');
                const deskripsi = $(this).data('deskripsi');
                const featured  = $(this).data('featured') == 1;

                $('#editModalId').val(id);
                $('#editModalNama').val(nama);
                $('#editModalKategori').val(kategori);
                $('#editModalHarga').val(harga);
                $('#editModalBadge').val(badge);
                $('#editModalSubjudul').val(subjudul);
                $('#editModalDeskripsi').val(deskripsi);
                $('#editModalFeatured').prop('checked', featured);

                $('#adminEditModal').css('display', 'flex').hide().fadeIn(150);
            });
        });
    </script>
</body>
</html>
