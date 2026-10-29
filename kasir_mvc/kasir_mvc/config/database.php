<?php
// KONEKSI DATABASE
$pdo = new PDO("mysql:host=localhost;dbname=db_toko", "root", "root");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
