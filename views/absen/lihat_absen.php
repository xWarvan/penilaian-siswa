<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'siswa') {
    header("Location: ../../login.php");
    exit;
}

include '../../config/database.php';

$nis = $_SESSION['nis'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lihat Absensi Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="../../index.php">Penilaian Siswa</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="../../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h3>Rekap Absensi Saya</h3>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>Jumlah Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alfa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = $conn->query("SELECT * FROM absen WHERE nis='$nis' ORDER BY kd_absen ASC");
                while ($row = $query->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nm_bulan']); ?></td>
                    <td><span class="badge bg-success"><?= $row['jml_hadir']; ?></span></td>
                    <td><span class="badge bg-warning text-dark"><?= $row['izin']; ?></span></td>
                    <td><span class="badge bg-info text-dark"><?= $row['sakit']; ?></span></td>
                    <td><span class="badge bg-danger"><?= $row['alfa']; ?></span></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <a href="../../index.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

</body>
</html>
