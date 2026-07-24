<!--tambah_barang.php-->
<?php include 'includes/cek_session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah barang - Warung abc</title>
</head>
<body>
    <h1>Tambah barang<h1>
        <form action="proses_tambah_barang.php" method="POST">
            <table>
                <tr><td>kode barang</td></tr>:</td>
                <td><input type="text" name="kode_barang" required></td></tr>
                <tr><td>nama barang</td></tr>:</td>
                <td><input type="text" name="nama_barang" required></td></tr>
                <tr><td>harga satuan</td></tr>:</td>
                <td><input type="number" name="harga_satuan" required></td></tr>
                <tr><td>stok</td></tr>:</td>
                <td><input type="number" name="stok" required></td></tr>
                <tr><td>tanggal kadaluarsa</td></tr>:</td>
                <td><input type="date" name="tanggal_kadaluarsa" required></td></tr>
                <tr><td colspan="3"><input type="submit" value="simpan"></td></tr>
            </table>
</form>
<p><a href="data_barang.php">kembali</a></p>
    
</body>
</html>