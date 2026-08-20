<?php 
// laporan_bulanan.php

include 'includes/cek_session.php';
include 'config/koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('Y-m');
$bulan = mysqli_real_escape_string($koneksi, $bulan);

$sql = "SELECT 
            t.no_transaksi, 
            t.tanggal, 
            t.total_bayar, 
            u.nama_lengkap AS nama_kasir
        FROM tbl_transaksi t
        JOIN tbl_user u ON t.id_kasir = u.id_user
        WHERE DATE_FORMAT(t.tanggal, '%Y-%m') = '$bulan'
        ORDER BY t.tanggal ASC";

$hasil = mysqli_query($koneksi, $sql);

$total_bulanan = 0;
$jumlah_transaksi = 0;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Bulanan - Warung ABC</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f0fdf4;
            color: #009414;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: #009414;
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
        }

        /* FORM FILTER */
        .form-filter {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
            padding: 15px;
            background: #dcfce7;
            border-radius: 10px;
        }

        .form-filter label {
            font-weight: bold;
            color: #009414;
        }

        input[type="month"] {
            padding: 10px 12px;
            border: 1px solid #009414;
            border-radius: 7px;
            font-size: 14px;
            background: white;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background: #009414;
            color: white;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background: #009414;
        }

        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            overflow: hidden;
            border-radius: 8px;
        }

        th {
            background: #009414;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #bbf7d0;
        }

        tr:nth-child(even) {
            background: #f0fdf4;
        }

        tr:hover {
            background: #dcfce7;
        }

        /* RINGKASAN */
        .ringkasan {
            display: flex;
            gap: 20px;
            margin-top: 25px;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 12px;
            background: #dcfce7;
            border-left: 5px solid #009414;
        }

        .card h3 {
            margin: 0 0 8px;
            color: #009414;
            font-size: 16px;
        }

        .card p {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            color: #15803d;
        }

        /* TOMBOL KEMBALI */
        .kembali {
            display: inline-block;
            margin-top: 25px;
            padding: 11px 20px;
            background: #166534;
            color: white;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
        }

        .kembali:hover {
            background: #14532d;
        }

        /* RESPONSIVE HP */
        @media (max-width: 600px) {

            body {
                padding: 15px;
            }

            .container {
                padding: 20px;
            }

            .form-filter {
                flex-direction: column;
                align-items: stretch;
            }

            input[type="month"],
            input[type="submit"] {
                width: 100%;
            }

            .ringkasan {
                flex-direction: column;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>📊 Laporan Transaksi Bulanan</h1>

        <!-- FILTER BULAN -->
        <form method="GET" class="form-filter">

            <label for="bulan">Pilih Bulan:</label>

            <input 
                type="month" 
                id="bulan"
                name="bulan" 
                value="<?php echo htmlspecialchars($bulan); ?>"
            >

            <input type="submit" value="Tampilkan">

        </form>

        <!-- TABEL TRANSAKSI -->
        <div class="table-wrapper">

            <table>

                <tr>
                    <th>No. Transaksi</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total Bayar</th>
                </tr>

                <?php 

                if (mysqli_num_rows($hasil) > 0) {

                    while ($row = mysqli_fetch_assoc($hasil)) {

                        $total_bulanan += $row['total_bayar'];
                        $jumlah_transaksi++;

                ?>

                <tr>

                    <td>
                        <?php echo htmlspecialchars($row['no_transaksi']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['tanggal']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['nama_kasir']); ?>
                    </td>

                    <td>
                        Rp <?php echo number_format($row['total_bayar'], 0, ',', '.'); ?>
                    </td>

                </tr>

                <?php 
                    }

                } else {
                ?>

                <tr>
                    <td colspan="4" style="text-align:center; padding:25px; color:#6b7280;">
                        Tidak ada transaksi pada bulan ini.
                    </td>
                </tr>

                <?php } ?>

            </table>

        </div>

        <!-- RINGKASAN -->
        <div class="ringkasan">

            <div class="card">

                <h3>🧾 Jumlah Transaksi</h3>

                <p>
                    <?php echo $jumlah_transaksi; ?> Transaksi
                </p>

            </div>


            <div class="card">

                <h3>💰 Total Pendapatan</h3>

                <p>
                    Rp <?php echo number_format($total_bulanan, 0, ',', '.'); ?>
                </p>

            </div>

        </div>

        <!-- KEMBALI -->
        <a href="dashboard.php" class="kembali">
            ← Kembali ke Dashboard
        </a>

    </div>

</body>

</html>
