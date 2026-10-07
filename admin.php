<?php
/**
 * Panel Admin - D'BRIGHT COFFEE
 * Pengalihan terpadu: Semua fitur Admin (Edit, Hapus, Tambah Menu & Riwayat Pesanan)
 * sekarang telah DISATUKAN ke dalam Halaman Utama (index.php).
 */

session_start();
$_SESSION['is_admin'] = true;
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Panel Admin telah disatukan di Halaman Utama! Anda dapat mengedit, menghapus, dan menambah menu langsung di sini.'
];

header('Location: index.php?admin=1#menu');
exit;
