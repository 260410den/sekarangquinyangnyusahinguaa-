<?php
// MODEL: semua query database ada di sini
class Barang
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function cariKode($kode)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM barang WHERE kode_barang = ?");
        $stmt->execute([$kode]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cariId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM barang WHERE id_barang = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function kurangiStok($id, $jumlah)
    {
        $stmt = $this->pdo->prepare("UPDATE barang SET stok = stok - ? WHERE id_barang = ? AND stok >= ?");
        $stmt->execute([$jumlah, $id, $jumlah]);
    }
}
