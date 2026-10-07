<?php
/**
 * =========================================================================
 * Admin Handler - D'BRIGHT COFFEE
 * Pengontrol logika CRUD Menu & Mode Admin yang terintegrasi di Halaman Utama
 * Mata Kuliah : Praktikum Pemrograman Web
 * Pengembang  : Nayla Azzahra R (Kelas C - Angkatan 2025, FT-UNM)
 * =========================================================================
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

// Kredensial Admin Default
$adminUsername = 'admin';
$adminPassword = 'admin123';

// 1. CEK PARAMETER URL UNTUK AKTIFKAN / NONAKTIFKAN MODE ADMIN
if (isset($_GET['admin'])) {
    if ($_GET['admin'] == '1') {
        $_SESSION['is_admin'] = true;
    } elseif ($_GET['admin'] == '0') {
        unset($_SESSION['is_admin']);
    }
}

if (isset($_GET['toggle_admin'])) {
    if (!empty($_SESSION['is_admin'])) {
        unset($_SESSION['is_admin']);
        $_SESSION['flash'] = ['type' => 'info', 'message' => 'Mode Admin telah dinonaktifkan.'];
    } else {
        $_SESSION['is_admin'] = true;
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Mode Admin Aktif! Anda sekarang dapat menambah, mengedit, dan menghapus menu langsung di halaman ini.'];
    }
    header('Location: index.php#menu');
    exit;
}

if (isset($_GET['logout_admin'])) {
    unset($_SESSION['is_admin']);
    $_SESSION['flash'] = ['type' => 'info', 'message' => 'Mode Admin telah dinonaktifkan.'];
    header('Location: index.php');
    exit;
}

$autoOpenPesanan = !empty($_GET['lihat_pesanan']);

// 2. PROSES FORM POST ADMIN (LOGIN & CRUD)
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $redirectTarget = !empty($_POST['redirect_to']) ? $_POST['redirect_to'] : (!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php#menu');

    // --- A. LOGIN ADMIN ---
    if ($action === 'admin_login') {
        $user = trim($_POST['username'] ?? '');
        $pass = trim($_POST['password'] ?? '');

        if (($user === $adminUsername && $pass === $adminPassword) || !empty($_POST['demo_login'])) {
            $_SESSION['is_admin'] = true;
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Mode Admin Aktif! Anda sekarang dapat mengedit dan menghapus menu langsung di halaman ini.'];
        } else {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Username atau Password salah! (Default: admin / admin123)'];
        }
        header("Location: $redirectTarget");
        exit;
    }

    // --- B. TAMBAH MENU BARU (CREATE) ---
    if ($action === 'create_menu') {
        $nama        = trim($_POST['nama'] ?? '');
        $kategori    = trim($_POST['kategori'] ?? 'coffee');
        $harga       = (int)($_POST['harga'] ?? 0);
        $subjudul    = trim($_POST['subjudul'] ?? '');
        $badge       = trim($_POST['badge'] ?? '');
        $deskripsi   = trim($_POST['deskripsi'] ?? '');
        $is_featured = !empty($_POST['is_featured']) ? 1 : 0;

        $kategori_label = match($kategori) {
            'non-coffee' => 'Non Coffee',
            'snack'      => 'Menu Snack',
            default      => 'Coffee'
        };

        if (empty($nama) || $harga <= 0) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Nama menu dan harga valid wajib diisi!'];
        } else {
            $stmt = $conn->prepare("INSERT INTO `menu` (`nama`, `kategori`, `kategori_label`, `harga`, `subjudul`, `badge`, `deskripsi`, `is_featured`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sssisssi", $nama, $kategori, $kategori_label, $harga, $subjudul, $badge, $deskripsi, $is_featured);
                if ($stmt->execute()) {
                    $_SESSION['flash'] = ['type' => 'success', 'message' => "Menu '$nama' berhasil ditambahkan ke database!"];
                } else {
                    $_SESSION['flash'] = ['type' => 'error', 'message' => "Gagal menambah menu: " . $stmt->error];
                }
                $stmt->close();
            }
        }
        header("Location: $redirectTarget");
        exit;
    }

    // --- C. EDIT MENU (UPDATE) ---
    if ($action === 'update_menu') {
        $id          = (int)($_POST['id'] ?? 0);
        $nama        = trim($_POST['nama'] ?? '');
        $kategori    = trim($_POST['kategori'] ?? 'coffee');
        $harga       = (int)($_POST['harga'] ?? 0);
        $subjudul    = trim($_POST['subjudul'] ?? '');
        $badge       = trim($_POST['badge'] ?? '');
        $deskripsi   = trim($_POST['deskripsi'] ?? '');
        $is_featured = !empty($_POST['is_featured']) ? 1 : 0;

        $kategori_label = match($kategori) {
            'non-coffee' => 'Non Coffee',
            'snack'      => 'Menu Snack',
            default      => 'Coffee'
        };

        if ($id <= 0 || empty($nama) || $harga <= 0) {
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Data menu tidak valid untuk diperbarui!'];
        } else {
            $stmt = $conn->prepare("UPDATE `menu` SET `nama`=?, `kategori`=?, `kategori_label`=?, `harga`=?, `subjudul`=?, `badge`=?, `deskripsi`=?, `is_featured`=? WHERE `id`=?");
            if ($stmt) {
                $stmt->bind_param("sssisssii", $nama, $kategori, $kategori_label, $harga, $subjudul, $badge, $deskripsi, $is_featured, $id);
                if ($stmt->execute()) {
                    $_SESSION['flash'] = ['type' => 'success', 'message' => "Menu ID #$id ('$nama') berhasil diperbarui di database!"];
                } else {
                    $_SESSION['flash'] = ['type' => 'error', 'message' => "Gagal memperbarui menu: " . $stmt->error];
                }
                $stmt->close();
            }
        }
        header("Location: $redirectTarget");
        exit;
    }

    // --- D. HAPUS MENU (DELETE) ---
    if ($action === 'delete_menu') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $stmt = $conn->prepare("DELETE FROM `menu` WHERE `id` = ?");
            if ($stmt) {
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    $_SESSION['flash'] = ['type' => 'success', 'message' => "Menu ID #$id berhasil dihapus dari database!"];
                } else {
                    $_SESSION['flash'] = ['type' => 'error', 'message' => "Gagal menghapus menu: " . $stmt->error];
                }
                $stmt->close();
            }
        }
        header("Location: $redirectTarget");
        exit;
    }

    // --- E. RESET 24 MENU DEFAULT ---
    if ($action === 'reset_default_menus') {
        $conn->query("TRUNCATE TABLE `menu`");
        $stmtInsert = $conn->prepare("INSERT INTO `menu` (`id`, `nama`, `kategori`, `kategori_label`, `badge`, `subjudul`, `deskripsi`, `harga`, `is_featured`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $masterItems = [
            [1, 'Americano (Hot/ice)', 'coffee', 'Coffee', 'Hot / Ice', 'Espresso Murni', 'Seduhan espresso murni dengan air panas atau es batu segar, rasa kopi kuat dan pekat tanpa ampas.', 10000, 0],
            [2, 'Kopi Susu Klasik', 'coffee', 'Coffee', 'Favorit', 'Kopi & Kental Manis', 'Perpaduan seimbang antara racikan kopi hitam mantap dengan gurihnya susu kental manis klasik.', 13000, 0],
            [3, "Signature D'Bright", 'coffee', 'Coffee', 'Best Seller', "Racikan Khas D'Bright", "Menu kopi andalan khas D'Bright Coffee dengan formulasi rahasia yang creamy, gurih, dan nikmat.", 15000, 1],
            [4, 'Kopi Pandan', 'coffee', 'Coffee', 'Aromatik', 'Kopi Susu & Sari Pandan', 'Sensasi kopi susu creamy berpadu keharuman aroma pandan wangi yang segar dan khas di lidah.', 15000, 0],
            [5, 'Caramel Macchiato', 'coffee', 'Coffee', 'Sweet Caramel', 'Espresso, Susu & Saus Karamel', 'Espresso berpadu susu lembut dan lelehan saus karamel gurih manis yang lumer di mulut.', 15000, 0],
            [6, 'Vanilla Latte', 'coffee', 'Coffee', 'Smooth Vanilla', 'Kopi Susu Sirup Vanila', 'Espresso lembut bercampur susu hangat atau dingin dengan sentuhan manis harum ekstrak vanila.', 15000, 0],
            [7, 'Hazelnut Latte', 'coffee', 'Coffee', 'Nutty Flavor', 'Kopi Susu Sirup Hazelnut', 'Kombinasi espresso mantap, susu creamy, dan aroma kacang hazelnut panggang yang gurih khas.', 15000, 0],
            [8, 'Matcha Strawberry', 'non-coffee', 'Non Coffee', 'Best Seller', 'Matcha Jepang & Selai Stroberi', 'Perpaduan premium antara matcha Jepang autentik dengan manis asam segarnya selai stroberi asli.', 15000, 1],
            [9, 'Matcha Latte', 'non-coffee', 'Non Coffee', 'Favorit', 'Matcha Murni & Susu Creamy', 'Teh hijau matcha Jepang berkualitas tinggi diseduh bersama susu segar nan lembut kaya antioksidan.', 13000, 0],
            [10, 'Matcha Choco', 'non-coffee', 'Non Coffee', 'Choco Green', 'Perpaduan Matcha & Cokelat', 'Kombinasi unik antara rasa khas matcha Jepang dengan legitnya saus cokelat manis pekat.', 15000, 0],
            [11, 'Matcha Oreo', 'non-coffee', 'Non Coffee', 'Crunchy Oreo', 'Matcha Creamy & Crumb Oreo', 'Matcha creamy dipadukan remukan biskuit Oreo renyah, sensasi rasa manis nikmat bertekstur.', 15000, 0],
            [12, 'Cokelat Signature', 'non-coffee', 'Non Coffee', 'Rich Cocoa', 'Kakao Pekat & Susu Segar', 'Olahan bubuk kakao cokelat pekat premium dengan susu segar murni, rasa cokelat mewah menenangkan.', 13000, 0],
            [13, 'Red Velvet', 'non-coffee', 'Non Coffee', 'Velvety Smooth', 'Cita Rasa Kue Red Velvet', 'Minuman lembut bernuansa merah khas kue red velvet dengan hint cokelat dan vanila creamy.', 13000, 0],
            [14, 'Taro Creamy', 'non-coffee', 'Non Coffee', 'Sweet Taro', 'Ekstrak Talas Manis Gurih', 'Minuman beraroma talas ungu yang manis, gurih, dan creamy memanjakan lidah di setiap tegukan.', 13000, 0],
            [15, 'Lemon Tea Segar', 'non-coffee', 'Non Coffee', 'Segar Dingin', 'Teh Hitam & Perasan Lemon', 'Seduhan teh melati/hitam wangi berpadu perasan lemon segar asam manis yang langsung melegakan dahaga.', 8000, 0],
            [16, 'Lychee Tea', 'non-coffee', 'Non Coffee', 'Fruity Lychee', 'Teh Wangi Sirup Leci', 'Kesegaran teh melati pilihan berpadu aroma manis buah leci tropis, sangat nikmat disajikan dingin.', 10000, 0],
            [17, 'Kentang Goreng', 'snack', 'Menu Snack', 'Gurih Renyah', 'Kentang Gurih Crispy', 'Potongan kentang stik pilihan yang digoreng garing keemasan dengan bumbu gurih dan saus cocolan.', 12000, 0],
            [18, 'Ubi Goreng Crispy', 'snack', 'Menu Snack', 'Khas Tradisional', 'Ubi Manis Renyah Gurih', 'Irisan ubi manis segar pilihan digoreng krispi dengan bumbu cocolan khas, teman ngopi pas.', 12000, 0],
            [19, 'Tahu Bakso', 'snack', 'Menu Snack', 'Daging Padat', 'Tahu Isi Olahan Bakso Sapi', 'Tahu goreng kenyal gurih berpadu adonan daging bakso sapi lezat, disajikan hangat dengan cabai.', 13000, 0],
            [20, 'Dimsum Mentai', 'snack', 'Menu Snack', 'Viral & Gurih', 'Dimsum Ayam Saus Mentai Bakar', 'Dimsum daging ayam lembut bertabur saus mentai gurih khas Jepang yang ditorch hingga beraroma asap.', 15000, 1],
            [21, 'Banana Stick Choco', 'snack', 'Menu Snack', 'Manis Lumer', 'Pisang Krispi Glaze Cokelat', 'Pisang berbalut tepung renyah keemasan dengan siraman saus cokelat manis lumer yang melimpah.', 12000, 0],
            [22, 'Banana Stick Tiramisu', 'snack', 'Menu Snack', 'Glaze Mewah', 'Pisang Krispi Saus Tiramisu', 'Pisang goreng stik berbalut tepung roti krispi disiram lumuran saus glaze tiramisu beraroma kopi.', 12000, 0],
            [23, 'Platter Komplit', 'snack', 'Menu Snack', 'Porsi Barengan', 'Kentang, Sosis, & Nugget', 'Kombinasi komplit berisi kentang goreng renyah, sosis bakar/goreng gurih, dan nugget ayam renyah.', 18000, 0],
            [24, 'Indomie Komplit', 'snack', 'Menu Snack', 'Telur & Sayur', 'Paket Telur & Topping', 'Indomie lezat disajikan komplit dengan tambahan telur matang/setengah matang dan pelengkap sayur segar.', 13000, 0]
        ];

        foreach ($masterItems as $it) {
            $stmtInsert->bind_param("issssssii", $it[0], $it[1], $it[2], $it[3], $it[4], $it[5], $it[6], $it[7], $it[8]);
            $stmtInsert->execute();
        }
        $stmtInsert->close();

        $_SESSION['flash'] = ['type' => 'success', 'message' => '24 Menu default D\'Bright Coffee berhasil dipulihkan!'];
        header("Location: $redirectTarget");
        exit;
    }
}

// 3. STATUS MODE ADMIN AKTIF
$isAdmin = !empty($_SESSION['is_admin']);

// Ambil pesan flash
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// 4. DATA PESANAN MASUK (UNTUK PANEL ADMIN TERPADU DI HALAMAN UTAMA)
$daftarPesanan = [];
$totalOmset = 0;
if (isset($conn) && !$conn->connect_error) {
    $resPesanan = $conn->query("SELECT * FROM `pesanan` ORDER BY `id` DESC");
    if ($resPesanan) {
        while ($row = $resPesanan->fetch_assoc()) {
            $daftarPesanan[] = $row;
            $totalOmset += (int)$row['total_harga'];
        }
    }
}
$countPesanan = count($daftarPesanan);
