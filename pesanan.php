<?php
/**
 * Riwayat Pesanan - D'BRIGHT COFFEE
 * Pengalihan Terpadu: Fitur Riwayat Pesanan telah DISATUKAN ke dalam Halaman Utama (index.php).
 * Mengakses tautan ini akan otomatis membuka modal Riwayat Pesanan di Halaman Utama.
 */
session_start();
header('Location: index.php?lihat_pesanan=1');
exit;
