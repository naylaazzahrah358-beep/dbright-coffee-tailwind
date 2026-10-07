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

// Menggunakan koneksi mysqli
$conn = @new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn && !$conn->connect_error) {
    $conn->set_charset("utf8mb4");
}
