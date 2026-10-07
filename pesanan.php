<?php
/**
 * D'BRIGHT COFFEE - Halaman Riwayat Pesanan Masuk (Admin / Kasir)
 * Menampilkan seluruh data pesanan yang tersimpan di MySQL database tugasnela_db
 */

require_once __DIR__ . '/data/menu_data.php';
require_once __DIR__ . '/data/db.php';

// Ambil data pesanan dari database
$daftarPesanan = [];
$totalOmset = 0;

if (isset($conn) && $conn && !$conn->connect_error) {
    $result = $conn->query("SELECT * FROM `pesanan` ORDER BY `id` DESC");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $daftarPesanan[] = $row;
            $totalOmset += (int)$row['total_harga'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - <?= htmlspecialchars($outlet['nama']) ?></title>
    <link rel="icon" type="image/jpeg" href="<?= htmlspecialchars($outlet['logo']) ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        coffee: { DEFAULT: '#7F5539', dark: '#4A3525' },
                        cream: { 50: '#FDFBF7', 100: '#FAF6EE', 200: '#F4ECE1', 300: '#EAE0D0' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cream-100 text-stone-800 min-h-screen p-4 sm:p-8 font-sans">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header -->
        <div class="bg-white p-6 border-2 border-stone-900 shadow-[6px_6px_0px_0px_#7F5539] mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo" class="w-14 h-14 border border-stone-900">
                <div>
                    <h1 class="text-2xl font-black text-stone-900 tracking-tight">Daftar Pesanan Masuk (Database)</h1>
                    <p class="text-xs text-stone-500 font-semibold uppercase tracking-wider">
                        Database: <span class="text-coffee font-bold"><?= htmlspecialchars($dbName) ?></span> &bull; Tabel: <span class="text-coffee font-bold">pesanan</span>
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php" class="px-4 py-2.5 bg-stone-900 hover:bg-coffee text-white font-bold text-xs uppercase tracking-wider transition border-2 border-stone-900">
                    &larr; Web Utama
                </a>
                <a href="admin.php" class="px-4 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs uppercase tracking-wider transition border-2 border-stone-900">
                    ⚙️ Kelola Menu (Admin)
                </a>
                <a href="http://localhost/phpmyadmin/index.php?route=/sql&db=tugasnela_db&table=pesanan" target="_blank" class="px-4 py-2.5 bg-coffee hover:bg-coffee-dark text-white font-bold text-xs uppercase tracking-wider transition border-2 border-stone-900">
                    Buka phpMyAdmin &rarr;
                </a>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-5 border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917]">
                <span class="text-xs text-stone-500 font-semibold uppercase">Total Pesanan Masuk</span>
                <p class="text-3xl font-black text-stone-900 mt-1"><?= count($daftarPesanan) ?> Pesanan</p>
            </div>
            <div class="bg-white p-5 border-2 border-stone-900 shadow-[4px_4px_0px_0px_#7F5539]">
                <span class="text-xs text-stone-500 font-semibold uppercase">Total Nilai Pesanan</span>
                <p class="text-3xl font-black text-coffee mt-1"><?= formatRupiah($totalOmset) ?></p>
            </div>
            <div class="bg-white p-5 border-2 border-stone-900 shadow-[4px_4px_0px_0px_#1c1917]">
                <span class="text-xs text-stone-500 font-semibold uppercase">Status Database</span>
                <p class="text-sm font-bold <?= (isset($conn) && !$conn->connect_error) ? 'text-emerald-700' : 'text-red-600' ?> mt-2">
                    ● <?= (isset($conn) && !$conn->connect_error) ? 'Terhubung (MySQL Aktif)' : 'Gagal Terhubung' ?>
                </p>
            </div>
        </div>

        <!-- Tabel Pesanan -->
        <div class="bg-white border-2 border-stone-900 shadow-[8px_8px_0px_0px_#1c1917] overflow-hidden">
            <div class="p-4 bg-stone-900 text-cream-100 flex items-center justify-between">
                <span class="font-bold text-sm tracking-wider uppercase">Riwayat Transaksi Masuk</span>
                <button onclick="location.reload()" class="text-xs bg-coffee px-3 py-1 font-bold hover:bg-coffee-dark transition">
                    Segarkan Data (Refresh)
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-cream-200 border-b-2 border-stone-900 font-bold text-stone-900">
                            <th class="p-3">ID</th>
                            <th class="p-3">Waktu Pesan</th>
                            <th class="p-3">Nama Pemesan</th>
                            <th class="p-3">Menu</th>
                            <th class="p-3 text-center">Jumlah</th>
                            <th class="p-3">Varian & Topping</th>
                            <th class="p-3">Catatan</th>
                            <th class="p-3 text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-cream-300">
                        <?php if (empty($daftarPesanan)): ?>
                            <tr>
                                <td colspan="8" class="p-8 text-center text-stone-500 font-semibold">
                                    Belum ada data pesanan di database. Coba lakukan pemesanan melalui formulir di <a href="index.php" class="text-coffee underline font-bold">halaman utama</a>!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($daftarPesanan as $p): ?>
                                <tr class="hover:bg-cream-50 transition">
                                    <td class="p-3 font-mono font-bold text-stone-500">#<?= htmlspecialchars($p['id']) ?></td>
                                    <td class="p-3 text-stone-600 whitespace-nowrap"><?= htmlspecialchars($p['waktu_pesan']) ?></td>
                                    <td class="p-3 font-bold text-stone-900"><?= htmlspecialchars($p['nama_pemesan']) ?></td>
                                    <td class="p-3 font-semibold text-coffee-dark"><?= htmlspecialchars($p['menu_pilihan']) ?></td>
                                    <td class="p-3 text-center font-bold bg-cream-100/50"><?= (int)$p['jumlah'] ?></td>
                                    <td class="p-3 text-stone-600">
                                        <div><span class="text-stone-400">Gula:</span> <?= htmlspecialchars($p['level_gula']) ?></div>
                                        <div><span class="text-stone-400">Ukuran:</span> <?= htmlspecialchars($p['ukuran']) ?></div>
                                        <?php if (!empty($p['topping']) && $p['topping'] !== 'Tanpa Topping'): ?>
                                            <div><span class="text-stone-400">Topping:</span> <?= htmlspecialchars($p['topping']) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-3 text-stone-500 italic max-w-xs truncate"><?= htmlspecialchars($p['catatan']) ?></td>
                                    <td class="p-3 text-right font-black text-coffee whitespace-nowrap"><?= formatRupiah($p['total_harga']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>
