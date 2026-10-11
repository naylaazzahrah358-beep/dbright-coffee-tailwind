<?php
/**
 * Koneksi Database MySQL (phpMyAdmin XAMPP)
 * Database: tugasnela_db
 * Mahasiswi : Nayla Azzahra R (Kelas C - Angkatan 2025, FT-UNM)
 */

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'tugasnela_db';

// Matikan mode lempar exception mysqli agar website tidak crash jika MySQL mati
mysqli_report(MYSQLI_REPORT_OFF);

// Menggunakan koneksi mysqli dengan penanganan error aman
try {
    $conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if ($conn && !$conn->connect_error) {
        $conn->set_charset("utf8mb4");
    } else {
        $conn = null;
    }
} catch (Throwable $e) {
    $conn = null;
}
