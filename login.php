<?php
session_start();
include 'config/database.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek di tabel ADMIN
    $admin = $conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if ($admin->num_rows > 0) {
        $_SESSION['login'] = true;
        $_SESSION['level'] = 'admin';
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    }

    // Cek di tabel SISWA
    $siswa = $conn->query("SELECT * FROM siswa WHERE username='$username' AND password='$password'");
    if ($siswa->num_rows > 0) {
        $row = $siswa->fetch_assoc();
        $_SESSION['login'] = true;
        $_SESSION['level'] = 'siswa';
        $_SESSION['username'] = $username;
        $_SESSION['nis'] = $row['nis'];
        header("Location: index.php");
        exit;
    }

    // Jika tidak ditemukan
    $error = "Username atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Penilaian Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h4>Login Aplikasi Penilaian</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3 text-muted">SMA NEGERI 91 Jakarta Timur</p>
        </div>
    </div>
</div>
</body>
</html>
