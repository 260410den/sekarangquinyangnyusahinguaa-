<?php
session_start();

require 'config/database.php';
require 'models/Barang.php';
require 'controllers/KasirController.php';

// keranjang disimpan di session: [id_barang => jumlah]
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}

$barang     = new Barang($pdo);
$controller = new KasirController($barang);
$controller->index();
