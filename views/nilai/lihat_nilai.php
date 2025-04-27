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
    <title>Lihat Nilai Saya</title>
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
    <h3>Nilai Saya</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>UTS Ganjil</th>
                    <th>UAS Ganjil</th>
                    <th>UTS Genap</th>
                    <th>UAS Genap</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = $conn->query("SELECT * FROM nilai WHERE nis='$nis'");
                while ($row = $query->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nm_matpel']); ?></td>
                    <td><?= htmlspecialchars($row['uts_sem_ganjil']); ?></td>
                    <td><?= htmlspecialchars($row['uas_sem_ganjil']); ?></td>
                    <td><?= htmlspecialchars($row['uts_sem_genap']); ?></td>
                    <td><?= htmlspecialchars($row['uas_sem_genap']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <a href="../../index.php" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

</body>
</html>
