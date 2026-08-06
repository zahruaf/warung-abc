<?php
// transaksi.php
session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$daftar_barang = mysqli_query($koneksi, "SELECT * FROM tbl_barang WHERE stok > 0");

$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['subtotal'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaksi - Warung ABC</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#f4f6f9;
}

/* Header */
.header{
    background:linear-gradient(135deg,#43a047,#2e7d32);
    color:#fff;
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.header h1{
    font-size:28px;
}

/* Container */
.container{
    width:95%;
    max-width:1100px;
    margin:30px auto;
}

/* Card */
.card{
    background:#fff;
    border-radius:12px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.card h3{
    color:#2e7d32;
    margin-bottom:15px;
}

/* Form */
.form-group{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
}

select,
input[type=number]{
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
    min-width:220px;
}

input[type=number]{
    width:120px;
}

button,
input[type=submit]{
    padding:10px 18px;
    border:none;
    border-radius:8px;
    color:#fff;
    cursor:pointer;
    transition:.3s;
    font-size:14px;
}

.btn-green{
    background:#43a047;
}

.btn-green:hover{
    background:#2e7d32;
}

.btn-blue{
    background:#1976d2;
}

.btn-blue:hover{
    background:#125ea7;
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#43a047;
    color:#fff;
    padding:12px;
}

table td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

table tbody tr:hover{
    background:#f1f8e9;
}

/* Tombol hapus */
.btn-delete{
    background:#e53935;
    color:#fff;
    padding:6px 12px;
    text-decoration:none;
    border-radius:5px;
}

.btn-delete:hover{
    background:#c62828;
}

/* Total */
.total{
    text-align:right;
    margin-top:15px;
    font-size:22px;
    font-weight:bold;
    color:#2e7d32;
}

/* Error */
.error{
    background:#ffebee;
    color:#c62828;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
}

/* Footer */
.footer{
    text-align:center;
    margin:30px;
}

.footer a{
    color:#1976d2;
    text-decoration:none;
    font-weight:bold;
}

.footer a:hover{
    text-decoration:underline;
}
</style>

</head>
<body>

<div class="header">
    <h1>🛒 Transaksi Penjualan</h1>
    <div>
        Kasir :
        <strong><?php echo $_SESSION['nama_lengkap']; ?></strong>
    </div>
</div>

<div class="container">

<?php
if(isset($_SESSION['pesan_error'])){
    echo "<div class='error'>".$_SESSION['pesan_error']."</div>";
    unset($_SESSION['pesan_error']);
}
?>

<div class="card">

<h3>➕ Tambah Barang</h3>

<form action="proses_tambah_keranjang.php" method="POST">

<div class="form-group">

<select name="id_barang" required>

<?php while($b=mysqli_fetch_assoc($daftar_barang)){ ?>

<option value="<?php echo $b['id_barang']; ?>">
<?php
echo $b['nama_barang'];
echo " | Stok : ".$b['stok'];
echo " | Rp ".number_format($b['harga_satuan'],0,",",".");
?>
</option>

<?php } ?>

</select>

<input type="number" name="jumlah" min="1" placeholder="Jumlah" required>

<input type="submit" value="Tambah" class="btn-green">

</div>

</form>

</div>

<div class="card">

<h3>🛍 Keranjang Belanja</h3>

<table>

<thead>
<tr>
<th>Nama Barang</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Subtotal</th>
<th>Aksi</th>
</tr>
</thead>

<tbody>

<?php if(count($_SESSION['keranjang'])>0){ ?>

<?php foreach($_SESSION['keranjang'] as $id_barang=>$item){ ?>

<tr>

<td><?php echo $item['nama_barang']; ?></td>

<td>
Rp <?php echo number_format($item['harga'],0,",","."); ?>
</td>

<td><?php echo $item['jumlah']; ?></td>

<td>
Rp <?php echo number_format($item['subtotal'],0,",","."); ?>
</td>

<td>
<a class="btn-delete"
href="hapus_keranjang.php?id=<?php echo $id_barang; ?>">
🗑 Hapus
</a>
</td>

</tr>

<?php } ?>

<?php } else { ?>

<tr>
<td colspan="5">Keranjang masih kosong.</td>
</tr>

<?php } ?>

</tbody>

</table>

<div class="total">
Total : Rp <?php echo number_format($total,0,",","."); ?>
</div>

<br>

<form action="proses_simpan_transaksi.php" method="POST">
<input type="submit" value="💾 Simpan Transaksi" class="btn-blue">
</form>

</div>

<div class="footer">
<a href="dashboard.php">⬅ Kembali ke Dashboard</a>
</div>

</div>

</body>
</html>