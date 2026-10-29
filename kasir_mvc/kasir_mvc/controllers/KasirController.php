<?php
// CONTROLLER: mengatur alur, memanggil model, lalu menampilkan view
class KasirController
{
    private $barang;

    public function __construct($barang)
    {
        $this->barang = $barang;
    }

    public function index()
    {
        $pesan = "";
        $kode  = $_GET['kode'] ?? $_POST['kode'] ?? "";

        // proses aksi dari form
        if (isset($_POST['aksi'])) {
            $aksi = $_POST['aksi'];
            $id   = $_POST['id_barang'] ?? 0;

            if ($aksi == "tambah") {
                $b = $this->barang->cariId($id);
                $sekarang = $_SESSION['keranjang'][$id] ?? 0;

                if ($b && $sekarang + 1 <= $b['stok']) {
                    $_SESSION['keranjang'][$id] = $sekarang + 1;
                } else {
                    $pesan = "Stok tidak cukup!";
                }
            }

            if ($aksi == "kurang") {
                $_SESSION['keranjang'][$id]--;
                if ($_SESSION['keranjang'][$id] <= 0) {
                    unset($_SESSION['keranjang'][$id]);
                }
            }

            if ($aksi == "hapus") {
                unset($_SESSION['keranjang'][$id]);
            }

            if ($aksi == "selesai") {
                foreach ($_SESSION['keranjang'] as $id_barang => $jumlah) {
                    $this->barang->kurangiStok($id_barang, $jumlah);
                }
                $_SESSION['keranjang'] = [];
                $pesan = "Transaksi berhasil, stok sudah diperbarui.";
            }
        }

        // data hasil pencarian
        $hasil = null;
        if ($kode != "") {
            $hasil = $this->barang->cariKode($kode);
        }

        // data keranjang
        $keranjang = [];
        $total = 0;
        foreach ($_SESSION['keranjang'] as $id => $jumlah) {
            $b = $this->barang->cariId($id);
            $b['jumlah']   = $jumlah;
            $b['subtotal'] = $b['harga'] * $jumlah;
            $total += $b['subtotal'];
            $keranjang[] = $b;
        }

        // tampilkan view
        require __DIR__ . '/../views/kasir.php';
    }
}
