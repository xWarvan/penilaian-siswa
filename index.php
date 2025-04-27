<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$level = $_SESSION['level'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Penilaian Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Penilaian Siswa</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h3>Selamat Datang, <?= htmlspecialchars($_SESSION['username']); ?>!</h3>

    <?php if ($level == 'admin'): ?>
        <div class="mt-4">
            <a href="views/siswa/index.php" class="btn btn-outline-primary">Manajemen Siswa</a>
            <a href="views/guru/index.php" class="btn btn-outline-success">Manajemen Guru</a>
            <a href="views/nilai/index.php" class="btn btn-outline-warning">Manajemen Nilai</a>
            <a href="views/kelas/index.php" class="btn btn-outline-info">Manajemen Kelas</a>
            <a href="views/absen/index.php" class="btn btn-outline-danger">Manajemen Absensi</a>
        </div>
    <?php elseif ($level == 'siswa'): ?>
        <div class="mt-4">
            <a href="views/nilai/lihat_nilai.php" class="btn btn-outline-primary">Lihat Nilai Saya</a>
            <a href="views/absen/lihat_absen.php" class="btn btn-outline-success">Lihat Absensi</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
