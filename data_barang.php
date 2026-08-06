<?php
// data_barang.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT * FROM tbl_barang ORDER BY nama_barang ASC";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Barang - Warung ABC</title>

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

/* Container */
.container{
    width:95%;
    max-width:1200px;
    margin:30px auto;
}

/* Tombol */
.button-group{
    margin-bottom:20px;
}

.btn{
    display:inline-block;
    padding:10px 18px;
    text-decoration:none;
    color:white;
    border-radius:8px;
    margin-right:10px;
    transition:.3s;
    font-size:14px;
}

.btn-dashboard{
    background:#1976d2;
}

.btn-dashboard:hover{
    background:#125ea7;
}

.btn-tambah{
    background:#43a047;
}

.btn-tambah:hover{
    background:#2e7d32;
}

/* Card */
.card{
    background:white;
    border-radius:12px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

table thead{
    background:#43a047;
    color:white;
}

table th,
table td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

table tbody tr:hover{
    background:#f1f8e9;
}

/* Action Button */
.action{
    text-decoration:none;
    padding:6px 12px;
    border-radius:5px;
    color:white;
    font-size:13px;
}

.edit{
    background:#2196f3;
}

.edit:hover{
    background:#1976d2;
}

.delete{
    background:#e53935;
}

.delete:hover{
    background:#c62828;
}

.footer{
    text-align:center;
    margin:30px;
    color:#777;
}

@media(max-width:768px){
    table{
        font-size:13px;
    }

    .btn{
        display:block;
        margin-bottom:10px;
        text-align:center;
    }

    .header{
        flex-direction:column;
        text-align:center;
    }
}
</style>

</head>
<body>

<div class="header">
    <h1>📦 Data Barang</h1>
    <div>
        Selamat Datang,
        <b><?php echo $_SESSION['nama_lengkap']; ?></b>
    </div>
</div>

<div class="container">

    <div class="button-group">
        <a href="dashboard.php" class="btn btn-dashboard">🏠 Dashboard</a>
        <a href="tambah_barang.php" class="btn btn-tambah">➕ Tambah Barang</a>
    </div>

    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Stok</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($hasil)){ ?>

                <tr>
                    <td><?php echo $row['kode_barang']; ?></td>

                    <td><?php echo $row['nama_barang']; ?></td>

                    <td>
                        Rp <?php echo number_format($row['harga_satuan'],0,',','.'); ?>
                    </td>

                    <td><?php echo $row['stok']; ?></td>

                    <td><?php echo $row['tanggal_kadaluarsa']; ?></td>

                    <td>
                        <a class="action edit"
                           href="edit_barang.php?id=<?php echo $row['id_barang']; ?>">
                           ✏ Edit
                        </a>

                        <a class="action delete"
                           href="hapus_barang.php?id=<?php echo $row['id_barang']; ?>"
                           onclick="return confirm('Yakin ingin menghapus barang ini?')">
                           🗑 Hapus
                        </a>
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<div class="footer">
    &copy; <?php echo date("Y"); ?> Warung ABC | Sistem Informasi Kasir
</div>

</body>
</html>