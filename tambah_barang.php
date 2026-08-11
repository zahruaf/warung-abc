<!-- tambah_barang.php -->
<?php include 'includes/cek_session.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - Warung ABC</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #137423;
            color: #333;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 550px;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #007e11;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #0b9946;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: 0.2s;
        }

        .btn-simpan {
            background: #009414;
            color: white;
        }

        .btn-simpan:hover {
            background: #1dd845;
        }

        .btn-kembali {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-kembali:hover {
            background: #d2dbd1;
        }

        @media (max-width: 600px) {
            .card {
                padding: 25px 20px;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <div class="header">
            <h1>Tambah Barang</h1>
            <p>Masukkan informasi barang baru</p>
        </div>

        <form action="proses_tambah_barang.php" method="POST">

            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input
                    type="text"
                    id="kode_barang"
                    name="kode_barang"
                    placeholder="Contoh: BRG001"
                    required
                >
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input
                    type="text"
                    id="nama_barang"
                    name="nama_barang"
                    placeholder="Contoh: Indomie Goreng"
                    required
                >
            </div>

            <div class="form-group">
                <label for="harga_satuan">Harga Satuan</label>
                <input
                    type="number"
                    id="harga_satuan"
                    name="harga_satuan"
                    placeholder="Contoh: 3500"
                    step="0.01"
                    min="0"
                    required
                >
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>
                <input
                    type="number"
                    id="stok"
                    name="stok"
                    placeholder="Contoh: 20"
                    min="0"
                    required
                >
            </div>

            <div class="form-group">
                <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa</label>
                <input
                    type="date"
                    id="tanggal_kadaluarsa"
                    name="tanggal_kadaluarsa"
                >
            </div>

            <div class="form-actions">
                <a href="data_barang.php" class="btn btn-kembali">
                    Kembali
                </a>

                <button type="submit" class="btn btn-simpan">
                    Simpan Barang
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>
