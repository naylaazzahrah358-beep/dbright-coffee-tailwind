<?php
/**
 * =========================================================================
 * 🥤 D'BRIGHT COFFEE - Website Promosi & Pemesanan Menu Berbasis PHP
 * =========================================================================
 * Mata Kuliah : Praktikum Pemrograman Web
 * Pengembang  : Nayla Azzahra R
 * NIM / Kelas : Kelas C - Angkatan 2025
 * Program Studi: Teknik Komputer FT-UNM
 * Teknologi   : PHP 8+, Tailwind CSS (CDN), jQuery 3.7.1
 * =========================================================================
 */

// 0. Memuat Handler Logika Admin (CRUD Menu & Riwayat Pesanan di Halaman Utama)
require_once __DIR__ . '/data/admin_handler.php';

// 1. Memuat Data Konfigurasi, 24 Menu, Promo, dan Fungsi Helper
require_once __DIR__ . '/data/menu_data.php';

// 2. Memuat Komponen Header & Head Dokumen HTML
require_once __DIR__ . '/includes/header.php';

// 3. Memuat Layar Pembuka Animasi (Splash Screen)
require_once __DIR__ . '/includes/splash.php';

// 3.5. Memuat Panel Admin Terpadu (Top Bar, Modals Edit & Tambah Menu, Login, Riwayat Pesanan)
require_once __DIR__ . '/includes/admin_panel.php';

// 4. Memuat Top Promo Bar & Navbar Navigasi Utama
require_once __DIR__ . '/includes/navbar.php';

// 5. Memuat Hero Section & Showcase Banner
require_once __DIR__ . '/includes/hero.php';

// 6. Memuat Running Marquee Banner (Teks Berjalan)
require_once __DIR__ . '/includes/marquee.php';

// 7. Memuat Section Keunggulan Kualitas Minuman & Rasa
require_once __DIR__ . '/includes/keunggulan.php';

// 8. Memuat Section Katalog 24 Menu Dinamis (Looping PHP)
require_once __DIR__ . '/includes/menu.php';

// 9. Memuat Section Paket Combo Hemat & Countdown Promo
require_once __DIR__ . '/includes/promo.php';

// 10. Memuat Section Panduan 3 Langkah Cara Memesan
require_once __DIR__ . '/includes/cara_pesan.php';

// 11. Memuat Section Testimoni Pelanggan
require_once __DIR__ . '/includes/testimoni.php';

// 12. Memuat Section FAQ Accordion (Tanya Jawab)
require_once __DIR__ . '/includes/faq.php';

// 13. Memuat Section Lokasi Outlet, Form Order Cepat, & Google Maps
require_once __DIR__ . '/includes/kontak.php';

// 14. Memuat Modal Dialog Pemesanan Detail
require_once __DIR__ . '/includes/modal.php';

// 15. Memuat Footer & Profil Pengembang
require_once __DIR__ . '/includes/footer.php';

// 16. Memuat Script Logika jQuery & Penutup Dokumen HTML
require_once __DIR__ . '/includes/scripts.php';
