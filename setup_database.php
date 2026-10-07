<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'tugasnela_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error . PHP_EOL);
}
echo "Terhubung ke database $db berhasil!" . PHP_EOL;

// 1. Buat Tabel menu
$sqlMenu = "CREATE TABLE IF NOT EXISTS `menu` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nama` VARCHAR(100) NOT NULL,
    `kategori` VARCHAR(50) NOT NULL,
    `kategori_label` VARCHAR(50) NOT NULL,
    `badge` VARCHAR(50) NOT NULL,
    `subjudul` VARCHAR(100) NOT NULL,
    `deskripsi` TEXT NOT NULL,
    `harga` INT(11) NOT NULL,
    `is_featured` TINYINT(1) DEFAULT 0,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sqlMenu)) {
    echo "Tabel 'menu' siap!" . PHP_EOL;
} else {
    echo "Error tabel menu: " . $conn->error . PHP_EOL;
}

// 2. Buat Tabel pesanan
$sqlPesanan = "CREATE TABLE IF NOT EXISTS `pesanan` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `nama_pemesan` VARCHAR(100) NOT NULL,
    `menu_pilihan` VARCHAR(100) NOT NULL,
    `jumlah` INT(11) NOT NULL DEFAULT 1,
    `ukuran` VARCHAR(50) DEFAULT 'Regular',
    `level_gula` VARCHAR(50) DEFAULT 'Normal',
    `topping` VARCHAR(50) DEFAULT 'Tanpa Topping',
    `catatan` TEXT DEFAULT NULL,
    `total_harga` INT(11) NOT NULL,
    `waktu_pesan` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($sqlPesanan)) {
    echo "Tabel 'pesanan' siap!" . PHP_EOL;
} else {
    echo "Error tabel pesanan: " . $conn->error . PHP_EOL;
}

// 3. Masukkan 24 Data Menu
require_once __DIR__ . '/data/menu_data.php';

// Cek apakah tabel menu sudah terisi
$cek = $conn->query("SELECT COUNT(*) AS total FROM `menu`");
$row = $cek->fetch_assoc();

if ($row['total'] == 0) {
    $stmt = $conn->prepare("INSERT INTO `menu` (`id`, `nama`, `kategori`, `kategori_label`, `badge`, `subjudul`, `deskripsi`, `harga`, `is_featured`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    foreach ($menuItems as $m) {
        $id = $m['id'];
        $nama = $m['nama'];
        $kategori = $m['kategori'];
        $kategori_label = $m['kategori_label'];
        $badge = $m['badge'];
        $subjudul = $m['subjudul'];
        $deskripsi = $m['deskripsi'];
        $harga = $m['harga'];
        $is_featured = $m['is_featured'] ? 1 : 0;

        $stmt->bind_param("issssssii", $id, $nama, $kategori, $kategori_label, $badge, $subjudul, $deskripsi, $harga, $is_featured);
        $stmt->execute();
    }
    echo "Berhasil memasukkan 24 menu ke tabel 'menu'!" . PHP_EOL;
} else {
    echo "Tabel 'menu' sudah memiliki " . $row['total'] . " data menu." . PHP_EOL;
}

$conn->close();
echo "Setup database selesai!" . PHP_EOL;
