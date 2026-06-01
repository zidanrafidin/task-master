<?php
// Nyalakan mode debugging untuk memaksa PHP menampilkan error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Memuat file konfigurasi database
require_once 'config/database.php';

// Memuat mesin Routing
require_once 'routes/web.php';

// Menjalankan aplikasi
$app = new App();
?>