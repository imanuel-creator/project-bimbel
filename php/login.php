<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND status='aktif'");

    if (mysqli_num_rows($query) == 1) {

        $data = mysqli_fetch_assoc($query);

        if (password_verify($password, $data['password'])) {

            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];

            /* tambahan */
            $_SESSION['nama'] = $data['username'];
            if ($data['role'] == "admin") {
                header("Location: admin/dashboard.php");
            } elseif ($data['role'] == "pengajar") {
                header("Location: pengajar/dashboard.php");
            } else {
                header("Location: siswa/dashboard.php");
            }

            exit;

        } else {
            $error = "Password salah!";
        }

    } else {
        $error = "Username tidak ditemukan!";
    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Login Sistem Bimbel</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
        }

        .login {
            width: 350px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px gray;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>

    <div class="login">

        <h2 align="center">LOGIN</h2>

        <?php
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }
        ?>

        <form method="POST">

            <input type="text" name="username" placeholder="Username" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">
                Login
            </button>

        </form>

    </div>

</body>

</html>