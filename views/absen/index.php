<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}

include '../../config/database.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Absensi</title>
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
    <h3>Manajemen Data Absensi</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Data Absensi</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Bulan</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alfa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = $conn->query("SELECT * FROM absen ORDER BY kd_absen ASC");
                while ($row = $query->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nm_bulan']); ?></td>
                    <td><?= htmlspecialchars($row['nis']); ?></td>
                    <td><?= htmlspecialchars($row['nm_siswa']); ?></td>
                    <td><?= $row['jml_hadir']; ?></td>
                    <td><?= $row['izin']; ?></td>
                    <td><?= $row['sakit']; ?></td>
                    <td><?= $row['alfa']; ?></td>
                    <td>
                        <a href="edit.php?kd_absen=<?= $row['kd_absen']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?kd_absen=<?= $row['kd_absen']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <a href="../../index.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

</body>
</html>
