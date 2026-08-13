<?php
// tambah_pelanggan.php
include 'includes/cek_session.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Tambah Pelanggan - Warung ABC</title>

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


/* ==============================
   HEADER
   ============================== */

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


/* ==============================
   CONTAINER
   ============================== */

.container{
    max-width:1000px;
    margin:40px auto;
    padding:20px;
}


/* ==============================
   JUDUL
   ============================== */

.page-title{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 12px rgba(0,0,0,.1);
    margin-bottom:25px;
}

.page-title h2{
    color:#2e7d32;
    margin-bottom:8px;
}

.page-title p{
    color:#666;
}


/* ==============================
   FORM CARD
   ============================== */

.form-card{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}


/* ==============================
   FORM
   ============================== */

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
    color:#333;
}

.form-group input,
.form-group textarea{
    width:100%;
    padding:12px 15px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
    outline:none;
    transition:.3s;
}

.form-group input:focus,
.form-group textarea:focus{
    border-color:#43a047;
    box-shadow:0 0 0 3px rgba(67,160,71,.15);
}

.form-group textarea{
    height:120px;
    resize:vertical;
}


/* ==============================
   BUTTON
   ============================== */

.button-group{
    display:flex;
    gap:10px;
    margin-top:25px;
}

.btn{
    padding:12px 20px;
    border:none;
    border-radius:8px;
    text-decoration:none;
    text-align:center;
    cursor:pointer;
    font-size:15px;
    transition:.3s;
}

.btn-save{
    background:#43a047;
    color:white;
}

.btn-save:hover{
    background:#2e7d32;
    transform:translateY(-2px);
}

.btn-back{
    background:#757575;
    color:white;
}

.btn-back:hover{
    background:#555;
    transform:translateY(-2px);
}


/* ==============================
   FOOTER
   ============================== */

.footer{
    text-align:center;
    color:#777;
    margin-top:40px;
    padding:20px;
}


/* ==============================
   RESPONSIVE
   ============================== */

@media(max-width:600px){

    .header{
        padding:15px 20px;
    }

    .header h1{
        font-size:20px;
    }

    .container{
        width:95%;
        margin:25px auto;
        padding:10px;
    }

    .form-card{
        padding:20px;
    }

    .button-group{
        flex-direction:column;
    }

}

</style>

</head>


<body>


<!-- ==============================
     HEADER
     ============================== -->

<div class="header">

    <div>

        <h1>🛒 Dashboard Warung ABC</h1>

        <p>
            Selamat datang,
            <b>
                <?php
                echo $_SESSION['nama_lengkap'];
                ?>
            </b>
        </p>

    </div>


    <a href="logout.php" class="logout">
        Logout
    </a>

</div>


<!-- ==============================
     CONTAINER
     ============================== -->

<div class="container">


    <!-- JUDUL -->

    <div class="page-title">

        <h2>
            👥 Tambah Pelanggan
        </h2>

        <p>
            Tambahkan data pelanggan baru ke dalam sistem.
        </p>

    </div>


    <!-- FORM -->

    <div class="form-card">

        <form
            action="proses_tambah_pelanggan.php"
            method="POST"
        >


            <!-- NAMA -->

            <div class="form-group">

                <label>
                    Nama Pelanggan
                </label>

                <input
                    type="text"
                    name="nama_pelanggan"
                    placeholder="Masukkan nama pelanggan"
                    required
                >

            </div>


            <!-- NO HP -->

            <div class="form-group">

                <label>
                    No. HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    placeholder="Masukkan nomor HP"
                >

            </div>


            <!-- ALAMAT -->

            <div class="form-group">

                <label>
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    placeholder="Masukkan alamat pelanggan"
                ></textarea>

            </div>


            <!-- BUTTON -->

            <div class="button-group">

                <a
                    href="data_pelanggan.php"
                    class="btn btn-back"
                >
                    ↩ Kembali
                </a>

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    💾 Simpan Pelanggan
                </button>

            </div>


        </form>

    </div>


    <!-- FOOTER -->

    <div class="footer">

        &copy;
        <?php echo date("Y"); ?>
        Warung ABC |
        Sistem Informasi Kasir

    </div>

</div>


</body>

</html>