<?php
/**
 * =========================================================================
 * Process Order Backend - D'BRIGHT COFFEE
 * Memproses form pemesanan via metode POST PHP & Menyimpan ke Database MySQL (tugasnela_db)
 * Mata Kuliah : Praktikum Pemrograman Web
 * Pengembang  : Nayla Azzahra R (Kelas C - Angkatan 2025, FT-UNM)
 * =========================================================================
 */

require_once __DIR__ . '/data/menu_data.php';
require_once __DIR__ . '/data/db.php';

// Pastikan request menggunakan metode POST
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';
if ($requestMethod !== 'POST') {
    if (!headers_sent()) {
        header('Location: index.php');
    }
    exit;
}

$formType = $_POST['form_type'] ?? 'fast_order';

if ($formType === 'modal_order') {
    // 1. Ambil data dari Form Modal
    $nama    = htmlspecialchars(trim($_POST['modal_cust_name'] ?? 'Pelanggan'));
    $menu    = htmlspecialchars(trim($_POST['modal_drink_name'] ?? "Signature D'Bright"));
    $qty     = max(1, (int)($_POST['modal_qty'] ?? 1));
    $size    = htmlspecialchars(trim($_POST['modal_cup_size'] ?? 'Regular (Medium)'));
    $sugar   = htmlspecialchars(trim($_POST['modal_sugar_level'] ?? 'Normal Sugar (100%)'));
    $topping = htmlspecialchars(trim($_POST['modal_topping'] ?? 'Tanpa Topping Tambahan'));
    $catatan = htmlspecialchars(trim($_POST['modal_notes'] ?? '-'));
    if (empty($catatan)) {
        $catatan = '-';
    }

    // Cari harga dasar dari array master menu di PHP
    $basePrice = 15000;
    foreach ($menuItems as $m) {
        if ($m['nama'] === $menu) {
            $basePrice = $m['harga'];
            break;
        }
    }
    foreach ($comboPackages as $c) {
        if ($c['item_name'] === $menu) {
            $basePrice = $c['price'];
            break;
        }
    }

    // Biaya tambahan
    $sizeExtra = str_contains($size, 'Large') ? 3000 : 0;
    $toppingExtra = match(true) {
        str_contains($topping, 'Boba')  => 3000,
        str_contains($topping, 'Jelly') => 3000,
        str_contains($topping, 'Keju')  => 4000,
        default                         => 0
    };

    $subtotal = ($basePrice + $sizeExtra + $toppingExtra) * $qty;
    $totalFormatted = formatRupiah($subtotal);

    // Format Pesan WhatsApp
    $pesan = "Halo D'BRIGHT COFFEE!\n\n"
           . "Saya ingin memesan via Web (PHP & MySQL):\n"
           . "----------------------------\n"
           . "Nama Pemesan: " . $nama . "\n"
           . "Menu Pilihan: " . $menu . "\n"
           . "Jumlah Porsi: " . $qty . "\n"
           . "Ukuran: " . $size . "\n"
           . "Level Gula: " . $sugar . "\n"
           . "Topping Tambahan: " . $topping . "\n"
           . "Catatan: " . $catatan . "\n"
           . "Estimasi Total: " . $totalFormatted . "\n"
           . "----------------------------\n"
           . "Mohon konfirmasi dan info pemesanan ya. Terima kasih!";

} else {
    // 2. Ambil data dari Form Order Cepat (Fast Order)
    $nama    = htmlspecialchars(trim($_POST['cust_name'] ?? 'Pelanggan'));
    $menu    = htmlspecialchars(trim($_POST['cust_drink'] ?? "Signature D'Bright"));
    $qty     = max(1, (int)($_POST['cust_qty'] ?? 1));
    $size    = 'Regular (Medium)';
    $sugar   = htmlspecialchars(trim($_POST['cust_sugar'] ?? 'Normal Sugar (100%)'));
    $topping = 'Tanpa Topping';
    $catatan = htmlspecialchars(trim($_POST['cust_note'] ?? '-'));
    if (empty($catatan)) {
        $catatan = '-';
    }

    // Cari harga dasar dari array master menu di PHP
    $basePrice = 15000;
    foreach ($menuItems as $m) {
        if ($m['nama'] === $menu) {
            $basePrice = $m['harga'];
            break;
        }
    }
    foreach ($comboPackages as $c) {
        if ($c['item_name'] === $menu || $c['title'] === $menu) {
            $basePrice = $c['price'];
            break;
        }
    }

    $subtotal = $basePrice * $qty;
    $totalFormatted = formatRupiah($subtotal);

    // Format Pesan WhatsApp
    $pesan = "Halo D'BRIGHT COFFEE!\n\n"
           . "Saya ingin memesan via Form Cepat Web (PHP & MySQL):\n"
           . "----------------------------\n"
           . "Nama Pemesan: " . $nama . "\n"
           . "Menu Pilihan: " . $menu . "\n"
           . "Jumlah Porsi: " . $qty . "\n"
           . "Varian / Gula: " . $sugar . "\n"
           . "Catatan: " . $catatan . "\n"
           . "Estimasi Total: " . $totalFormatted . "\n"
           . "----------------------------\n"
           . "Mohon segera diproses ya, terima kasih!";
}

// =========================================================================
// SIMPAN DATA PESANAN KE DATABASE MYSQL (tugasnela_db -> tabel pesanan)
// =========================================================================
$dbSaved = false;
$orderId = 0;
$dbError = '';

if (isset($conn) && $conn && !$conn->connect_error) {
    $stmtPesanan = $conn->prepare("INSERT INTO `pesanan` (`nama_pemesan`, `menu_pilihan`, `jumlah`, `ukuran`, `level_gula`, `topping`, `catatan`, `total_harga`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmtPesanan) {
        $stmtPesanan->bind_param("ssissssi", $nama, $menu, $qty, $size, $sugar, $topping, $catatan, $subtotal);
        if ($stmtPesanan->execute()) {
            $dbSaved = true;
            $orderId = $stmtPesanan->insert_id;
        } else {
            $dbError = $stmtPesanan->error;
        }
        $stmtPesanan->close();
    } else {
        $dbError = $conn->error;
    }
} else {
    $dbError = "Koneksi database MySQL ke tugasnela_db tidak aktif.";
}

// URL Pengalihan ke WhatsApp Resmi D'Bright Coffee
$waUrl = "https://wa.me/" . $outlet['whatsapp_full'] . "?text=" . rawurlencode($pesan);

// Cek apakah request berasal dari AJAX
$isAjax = !empty($_POST['ajax']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');

if ($isAjax) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'status'    => 'success',
        'db_saved'  => $dbSaved,
        'order_id'  => $orderId,
        'db_error'  => $dbError,
        'message'   => $dbSaved ? "Pesanan berhasil disimpan ke database (ID #$orderId)!" : "Pesanan diproses langsung.",
        'wa_url'    => $waUrl
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil Disimpan - <?= htmlspecialchars($outlet['nama']) ?></title>
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
<body class="bg-cream-100 min-h-screen flex items-center justify-center p-4 font-sans text-stone-800">
    <div class="max-w-lg w-full bg-white border-4 border-stone-900 shadow-[10px_10px_0px_0px_#7F5539] p-6 sm:p-8 relative">
        
        <!-- Header Konfirmasi -->
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-700 border-2 border-emerald-600 rounded-full flex items-center justify-center text-3xl font-black mx-auto mb-3">
                ✓
            </div>
            <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 border border-emerald-400 font-bold text-xs uppercase tracking-wider mb-2">
                Berhasil Masuk ke Database
            </span>
            <h1 class="text-2xl font-black text-stone-900 tracking-tight">Pesanan Berhasil Dicatat!</h1>
            <p class="text-xs text-stone-500 mt-1">
                Data Anda telah resmi tersimpan di database <strong class="text-coffee">tugasnela_db</strong> tabel <strong class="text-coffee">pesanan</strong>.
            </p>
        </div>

        <!-- Rincian Pesanan Masuk (Bukti Nyata) -->
        <div class="bg-cream-50 p-4 border-2 border-cream-300 text-xs space-y-2 mb-6">
            <div class="flex justify-between border-b border-cream-200 pb-2">
                <span class="text-stone-500 font-semibold">Nomor ID Pesanan:</span>
                <span class="font-mono font-bold text-stone-900 text-sm">#<?= $orderId > 0 ? $orderId : 'Tercatat' ?></span>
            </div>
            <div class="flex justify-between border-b border-cream-200 pb-2">
                <span class="text-stone-500 font-semibold">Nama Pemesan:</span>
                <span class="font-bold text-stone-900"><?= htmlspecialchars($nama) ?></span>
            </div>
            <div class="flex justify-between border-b border-cream-200 pb-2">
                <span class="text-stone-500 font-semibold">Menu yang Dipesan:</span>
                <span class="font-bold text-coffee"><?= htmlspecialchars($menu) ?> (<?= $qty ?> porsi)</span>
            </div>
            <div class="flex justify-between border-b border-cream-200 pb-2">
                <span class="text-stone-500 font-semibold">Varian / Gula:</span>
                <span class="text-stone-700"><?= htmlspecialchars($sugar) ?> &bull; <?= htmlspecialchars($size) ?></span>
            </div>
            <?php if (!empty($topping) && $topping !== 'Tanpa Topping Tambahan' && $topping !== 'Tanpa Topping'): ?>
                <div class="flex justify-between border-b border-cream-200 pb-2">
                    <span class="text-stone-500 font-semibold">Topping:</span>
                    <span class="text-stone-700"><?= htmlspecialchars($topping) ?></span>
                </div>
            <?php endif; ?>
            <div class="flex justify-between pt-1 text-sm font-black text-stone-900">
                <span>Total Biaya:</span>
                <span class="text-coffee text-base"><?= $totalFormatted ?></span>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="space-y-3">
            <a id="btnLanjutWa" href="<?= $waUrl ?>" target="_blank" class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-center block text-xs uppercase tracking-wider border-2 border-stone-900 shadow-[3px_3px_0px_0px_#1c1917] transition">
                📲 Lanjutkan Chat ke WhatsApp Sekarang &rarr;
            </a>

            <div class="grid grid-cols-2 gap-3 pt-2">
                <a href="pesanan.php" class="py-2.5 bg-stone-900 hover:bg-coffee text-white font-bold text-center text-xs border border-stone-900 transition">
                    Lihat di Riwayat Web
                </a>
                <a href="index.php" class="py-2.5 bg-white hover:bg-cream-100 text-stone-900 font-bold text-center text-xs border border-cream-300 transition">
                    &larr; Pesan Menu Lain
                </a>
            </div>
        </div>

        <p class="text-[10px] text-stone-400 text-center mt-6">
            WhatsApp akan otomatis terbuka dalam <span id="countdown" class="font-bold text-coffee">3</span> detik...
        </p>
    </div>

    <!-- Script Redirect Otomatis ke WhatsApp -->
    <script>
        let detik = 3;
        const countdownEl = document.getElementById('countdown');
        const waUrl = <?= json_encode($waUrl) ?>;

        const interval = setInterval(function() {
            detik--;
            if (countdownEl) countdownEl.innerText = detik;
            if (detik <= 0) {
                clearInterval(interval);
                window.location.href = waUrl;
            }
        }, 1000);
    </script>
</body>
</html>
