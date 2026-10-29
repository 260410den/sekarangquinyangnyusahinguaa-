<!DOCTYPE html>
<html>
<head>
    <title>Kasir Toko</title>
</head>
<body>
    <h1>Kasir Toko</h1>

    <?php if ($pesan != "") { ?>
        <p><b><?= $pesan ?></b></p>
    <?php } ?>

    <!-- FORM CARI -->
    <h2>Cari Barang</h2>
    <form method="get">
        <input type="text" name="kode" value="<?= htmlspecialchars($kode) ?>" placeholder="Contoh: BRG001" required>
        <button type="submit">Cari</button>
    </form>

    <?php if ($kode != "") { ?>
        <?php if ($hasil) { ?>
            <p>
                Kode: <?= $hasil['kode_barang'] ?><br>
                Nama: <?= $hasil['nama_barang'] ?><br>
                Kategori: <?= $hasil['kategori'] ?><br>
                Harga: Rp <?= number_format($hasil['harga'], 0, ',', '.') ?><br>
                Stok: <?= $hasil['stok'] ?>
            </p>
            <form method="post">
                <input type="hidden" name="aksi" value="tambah">
                <input type="hidden" name="id_barang" value="<?= $hasil['id_barang'] ?>">
                <input type="hidden" name="kode" value="<?= htmlspecialchars($kode) ?>">
                <button type="submit">Tambah ke Keranjang</button>
            </form>
        <?php } else { ?>
            <p>Barang tidak ditemukan.</p>
        <?php } ?>
    <?php } ?>

    <!-- KERANJANG -->
    <h2>Keranjang</h2>
    <?php if (count($keranjang) == 0) { ?>
        <p>Keranjang masih kosong.</p>
    <?php } else { ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($keranjang as $item) { ?>
            <tr>
                <td><?= $item['nama_barang'] ?></td>
                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                <td><?= $item['jumlah'] ?></td>
                <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
                <td>
                    <form method="post" style="display:inline">
                        <input type="hidden" name="id_barang" value="<?= $item['id_barang'] ?>">
                        <input type="hidden" name="kode" value="<?= htmlspecialchars($kode) ?>">
                        <button name="aksi" value="kurang">-</button>
                        <button name="aksi" value="tambah">+</button>
                        <button name="aksi" value="hapus">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3"><b>Total</b></td>
                <td colspan="2"><b>Rp <?= number_format($total, 0, ',', '.') ?></b></td>
            </tr>
        </table>

        <br>
        <form method="post">
            <input type="hidden" name="aksi" value="selesai">
            <button type="submit">Selesaikan Transaksi</button>
        </form>
    <?php } ?>
</body>
</html>
