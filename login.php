<!-- login.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung ABC</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:linear-gradient(135deg,#4CAF50,#2E7D32);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            width:380px;
            background:#fff;
            padding:35px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,.25);
        }

        .login-box h2{
            text-align:center;
            color:#2E7D32;
            margin-bottom:25px;
        }

        .error{
            background:#ffebee;
            color:#c62828;
            padding:10px;
            border-radius:5px;
            margin-bottom:15px;
            text-align:center;
        }

        table{
            width:100%;
        }

        td{
            padding:8px 0;
        }

        input[type=text],
        input[type=password]{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:8px;
            outline:none;
            transition:.3s;
        }

        input[type=text]:focus,
        input[type=password]:focus{
            border-color:#4CAF50;
            box-shadow:0 0 5px rgba(76,175,80,.5);
        }

        input[type=submit]{
            width:100%;
            padding:12px;
            background:#4CAF50;
            color:#fff;
            border:none;
            border-radius:8px;
            font-size:16px;
            cursor:pointer;
            transition:.3s;
            margin-top:10px;
        }

        input[type=submit]:hover{
            background:#388E3C;
        }

        .footer{
            text-align:center;
            margin-top:20px;
            color:#666;
            font-size:13px;
        }
    </style>
</head>
<body>

<div class="login-box">

    <h2>🛒 Login Aplikasi Kasir Warung ABC</h2>

    <?php
    session_start();
    if(isset($_SESSION['pesan_error'])){
        echo "<div class='error'>".$_SESSION['pesan_error']."</div>";
        unset($_SESSION['pesan_error']);
    }
    ?>

    <form action="proses_login.php" method="POST">
        <table>
            <tr>
                <td>Username</td>
            </tr>
            <tr>
                <td><input type="text" name="username" placeholder="Masukkan Username" required></td>
            </tr>

            <tr>
                <td>Password</td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Masukkan Password" required></td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login">
                </td>
            </tr>
        </table>
    </form>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Warung ABC
    </div>

</div>

</body>
</html>