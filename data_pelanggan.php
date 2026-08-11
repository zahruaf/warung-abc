<?php 
// data_pelanggan.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT *  FROM  tbl_pelanggan ORDER BY  nama_pelanggan ASC";
$hasil = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data pelanggan - Warung abc</title>
</head>
<body>
    <h1>Data pelanggan</h1>
    <p><a href="dashboard.php">Kembali ke dashboard</a></p> |
    <a href="tambah_pelanggan.php">Tambah pelanggan</a></p>
    <table border="1" cellpadding="6">
        <tr><th>Nama pelanggan</th><th>No. hp</th><th>Alamat</th><th>aksi</th></tr>
        <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>
        <tr>
            <td><?php echo $row['nama pelanggan'] ?></td>
            <td><?php echo $row['no_hp'] ?></td>
            <td><?php echo $row['alamat'] ?></td>
            <td> 
                <a href="edit_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>">edit</a> |
                <a href="hapus_pelanggan.php?id=<?php echo $row['id_pelanggan']; ?>"
                onclick="return confirm('Yakin hapus pelanggan ini?');">hapus</a>
            </td>
        </tr>
      <?php  } ?>
    </table>
    
</body>
</html>