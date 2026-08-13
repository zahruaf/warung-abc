<?php
// edit_pelanggan.php

session_start();
include 'includes/cek_session.php';
include 'config/koneksi.php';

/* =========================================
   AMBIL DATA PELANGGAN
   ========================================= */

if (!isset($_GET['id'])) {
    header('Location: pelanggan.php');
    exit;
}

$id = (int) $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data pelanggan tidak ditemukan.";
    exit;
}


/* =========================================
   PROSES UPDATE DATA
   ========================================= */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_pelanggan']
    );

    $hp = mysqli_real_escape_string(
        $koneksi,
        $_POST['no_hp']
    );

    $alamat = mysqli_real_escape_string(
        $koneksi,
        $_POST['alamat']
    );

    $sql = "UPDATE tbl_pelanggan SET
            nama_pelanggan = '$nama',
            no_hp = '$hp',
            alamat = '$alamat'
            WHERE id_pelanggan = '$id'";

    if (mysqli_query($koneksi, $sql)) {

        /* ==============================
           SIMPAN LOG AKTIVITAS
           ============================== */

        $id_user = $_SESSION['id_user'];
        $waktu = date('Y-m-d H:i:s');

        $aktivitas = "edit pelanggan: $nama";

        $log = "INSERT INTO tbl_log
                (id_user, aktivitas, waktu)
                VALUES
                ('$id_user', '$aktivitas', '$waktu')";

        mysqli_query($koneksi, $log);

        header('Location: pelanggan.php');
        exit;

    } else {

        $pesan_error = "Gagal mengubah data: "
                     . mysqli_error($koneksi);
    }

    /* Update data yang ditampilkan di form */
    $data['nama_pelanggan'] = $nama;
    $data['no_hp'] = $hp;
    $data['alamat'] = $alamat;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Edit Pelanggan - Warung ABC</title>


<style>

/* =========================================
   RESET
   ========================================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}


/* =========================================
   BODY
   ========================================= */

body {
    background: linear-gradient(
        135deg,
        #e8f5e9,
        #f4f6f9
    );

    min-height: 100vh;
}


/* =========================================
   HEADER
   ========================================= */

.header {

    background:
        linear-gradient(
            135deg,
            #43a047,
            #2e7d32
        );

    color: white;

    padding: 20px 40px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    box-shadow:
        0 4px 15px
        rgba(0, 0, 0, 0.15);
}

.header h1 {
    font-size: 26px;
}


/* =========================================
   CONTAINER
   ========================================= */

.container {

    width: 90%;

    max-width: 650px;

    margin: 50px auto;
}


/* =========================================
   CARD
   ========================================= */

.card {

    background: white;

    padding: 30px;

    border-radius: 16px;

    box-shadow:
        0 8px 25px
        rgba(0, 0, 0, 0.12);
}

.card h2 {

    color: #2e7d32;

    text-align: center;

    margin-bottom: 25px;
}


/* =========================================
   PESAN ERROR
   ========================================= */

.error {

    background: #ffebee;

    color: #c62828;

    padding: 12px 15px;

    border-radius: 8px;

    margin-bottom: 20px;

    border-left:
        5px solid #e53935;
}


/* =========================================
   FORM
   ========================================= */

.form-group {

    margin-bottom: 20px;
}

.form-group label {

    display: block;

    margin-bottom: 8px;

    color: #333;

    font-weight: bold;
}

.form-group input,
.form-group textarea {

    width: 100%;

    padding: 12px 15px;

    border:
        1px solid #ccc;

    border-radius: 8px;

    font-size: 15px;

    outline: none;

    transition: 0.3s;
}

.form-group input:focus,
.form-group textarea:focus {

    border-color: #43a047;

    box-shadow:
        0 0 0 3px
        rgba(67, 160, 71, 0.15);
}

.form-group textarea {

    height: 110px;

    resize: vertical;
}


/* =========================================
   BUTTON
   ========================================= */

.button-group {

    display: flex;

    gap: 10px;

    margin-top: 25px;
}

.btn {

    flex: 1;

    padding: 13px;

    border: none;

    border-radius: 8px;

    text-decoration: none;

    text-align: center;

    font-size: 15px;

    cursor: pointer;

    transition: 0.3s;
}


/* Tombol Simpan */

.btn-save {

    background: #43a047;

    color: white;
}

.btn-save:hover {

    background: #2e7d32;

    transform:
        translateY(-2px);

    box-shadow:
        0 5px 12px
        rgba(46, 125, 50, 0.3);
}


/* Tombol Kembali */

.btn-back {

    background: #757575;

    color: white;
}

.btn-back:hover {

    background: #555;

    transform:
        translateY(-2px);
}


/* =========================================
   RESPONSIVE
   ========================================= */

@media (max-width: 600px) {

    .header {

        padding:
            15px 20px;
    }

    .header h1 {

        font-size: 20px;
    }

    .container {

        width: 95%;

        margin:
            25px auto;
    }

    .card {

        padding: 20px;
    }

    .button-group {

        flex-direction: column;
    }

}

</style>

</head>


<body>


<!-- =====================================
     HEADER
     ===================================== -->

<div class="header">

    <h1>
        👥 Edit Pelanggan
    </h1>

    <div>

        Kasir :
        
        <strong>
            <?php
            echo $_SESSION['nama_lengkap'];
            ?>
        </strong>

    </div>

</div>


<!-- =====================================
     CONTAINER
     ===================================== -->

<div class="container">

    <div class="card">

        <h2>
            ✏️ Edit Data Pelanggan
        </h2>


        <?php if (isset($pesan_error)) { ?>

            <div class="error">
                <?php echo $pesan_error; ?>
            </div>

        <?php } ?>


        <!-- =================================
             FORM EDIT
             ================================= -->

        <form
            action=""
            method="POST"
        >


            <div class="form-group">

                <label>
                    Nama Pelanggan
                </label>

                <input
                    type="text"
                    name="nama_pelanggan"
                    value="<?php
                        echo htmlspecialchars(
                            $data['nama_pelanggan']
                        );
                    ?>"
                    placeholder="Masukkan nama pelanggan"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    No. HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="<?php
                        echo htmlspecialchars(
                            $data['no_hp']
                        );
                    ?>"
                    placeholder="Masukkan nomor HP"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat pelanggan"
                    required
                ><?php
                    echo htmlspecialchars(
                        $data['alamat']
                    );
                ?></textarea>

            </div>


            <!-- =================================
                 BUTTON
                 ================================= -->

            <div class="button-group">

                <a
                    href="pelanggan.php"
                    class="btn btn-back"
                >
                    ↩ Kembali
                </a>


                <button
                    type="submit"
                    class="btn btn-save"
                >
                    💾 Simpan Perubahan
                </button>

            </div>


        </form>

    </div>

</div>


</body>

</html>