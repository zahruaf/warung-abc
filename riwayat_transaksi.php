<?php
// riwayat_transaksi.php
include 'includes/cek_session.php';
include 'config/koneksi.php';

$sql = "SELECT t.no_transaksi, t.tanggal, t.total_bayar, 
               u.nama_lengkap AS nama_kasir
        FROM tbl_transaksi t
        JOIN tbl_user u ON t.id_kasir = u.id_user
        ORDER BY t.tanggal DESC";

$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Transaksi - Warung ABC</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f2;
            color: #26352b;
            min-height: 100vh;
        }

        /* HEADER */
        .header {
            background: #079231;
            color: white;
            padding: 22px 40px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
        }

        .header h1 {
            font-size: 28px;
        }

        .header p {
            margin-top: 5px;
            color: #d1fae5;
            font-size: 14px;
        }

        /* CONTAINER */
        .container {
            max-width: 1100px;
            margin: 35px auto;
            padding: 0 20px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.07);
            overflow: hidden;
        }

        .card-header {
            padding: 22px 25px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            color: #079231;
            font-size: 20px;
        }

        /* TABLE */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #079231;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 14px 15px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #ecfdf5;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* NOMOR TRANSAKSI */
        .no-transaksi {
            font-weight: bold;
            color: #079231;
        }

        /* TOTAL */
        .total {
            font-weight: bold;
            color: #079231;
        }

        /* BUTTON */
        .btn-kembali {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 18px;
            background: #079231;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-kembali:hover {
            background: #079231;
        }

        /* EMPTY DATA */
        .empty {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {

            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 23px;
            }

            .container {
                margin-top: 20px;
                padding: 0 12px;
            }

            .card-header {
                padding: 18px;
            }

            th,
            td {
                padding: 12px;
                white-space: nowrap;
            }

            .btn-kembali {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h1>Riwayat Transaksi</h1>
        <p>Warung ABC - Daftar transaksi yang telah dilakukan</p>
    </div>

    <!-- CONTENT -->
    <div class="container">

        <div class="card">

            <div class="card-header">
                <h2>Data Transaksi</h2>
            </div>

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($hasil) > 0) { ?>

                            <?php while ($row = mysqli_fetch_assoc($hasil)) { ?>

                                <tr>
                                    <td class="no-transaksi">
                                        <?php echo htmlspecialchars($row['no_transaksi']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['tanggal']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['nama_kasir']); ?>
                                    </td>

                                    <td class="total">
                                        Rp
                                        <?php echo number_format(
                                            $row['total_bayar'],
                                            0,
                                            ',',
                                            '.'
                                        ); ?>
                                    </td>
                                </tr>

                            <?php } ?>

                        <?php } else { ?>

                            <tr>
                                <td colspan="4" class="empty">
                                    Belum ada transaksi.
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

        <a href="dashboard.php" class="btn-kembali">
            ← Kembali ke Dashboard
        </a>

    </div>

</body>

</html>
