<?php
// dashboard.php
include 'includes/cek_session.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Warung ABC</title>

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
    color:white;
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 3px 8px rgba(0,0,0,.2);
}

.header h1{
    font-size:28px;
}

.header p{
    font-size:15px;
    margin-top:5px;
}

.logout{
    background:#e53935;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    transition:.3s;
}

.logout:hover{
    background:#c62828;
}

/* Container */
.container{
    max-width:1000px;
    margin:40px auto;
    padding:20px;
}

.welcome{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 12px rgba(0,0,0,.1);
    margin-bottom:30px;
}

.welcome h2{
    color:#2e7d32;
    margin-bottom:10px;
}

.role{
    display:inline-block;
    padding:6px 12px;
    background:#4caf50;
    color:white;
    border-radius:20px;
    font-size:14px;
}

/* Menu */
.menu{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:white;
    border-radius:15px;
    padding:30px;
    text-align:center;
    text-decoration:none;
    color:#333;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
    transition:.3s;
}

.card:hover{
    transform:translateY(-8px);
    background:#4caf50;
    color:white;
}

.card .icon{
    font-size:55px;
    margin-bottom:15px;
}

.card h3{
    margin-bottom:10px;
}

.footer{
    text-align:center;
    color:#777;
    margin-top:40px;
    padding:20px;
}
</style>

</head>
<body>

<div class="header">
    <div>
        <h1>🛒 Dashboard Warung ABC</h1>
        <p>Selamat datang, <b><?php echo $_SESSION['nama_lengkap']; ?></b></p>
    </div>

    <a href="logout.php" class="logout">Logout</a>
</div>

<div class="container">

    <div class="welcome">
        <h2>Halo, <?php echo $_SESSION['nama_lengkap']; ?> 👋</h2>
        <p>Anda login sebagai</p>
        <br>
        <span class="role"><?php echo strtoupper($_SESSION['role']); ?></span>
    </div>

    <div class="menu">

        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'gudang') { ?>
        <a href="data_barang.php" class="card">
            <div class="icon">📦</div>
            <h3>Data Barang</h3>
            <p>Kelola data stok barang.</p>
        </a>
        <?php } ?>

        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') { ?>
        <a href="transaksi.php" class="card">
            <div class="icon">💰</div>
            <h3>Transaksi Kasir</h3>
            <p>Melayani transaksi penjualan.</p>
        </a>

        <a href="riwayat_transaksi.php" class="card">
            <div class="icon">📋</div>
            <h3>Riwayat Transaksi</h3>
            <p>Lihat seluruh transaksi.</p>
        </a>
        <?php } ?>

        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'pelanggan') { ?>
        <a href="tambah_pelanggan.php" class="card">
            <div class="icon">👥</div>
            <h3>pelanggan</h3>
            <p>data pelanggan.</p>
        </a>
        <?php } ?>

    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Warung ABC | Sistem Informasi Kasir
    </div>

</div>

</body>
</html>