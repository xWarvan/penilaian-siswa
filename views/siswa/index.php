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
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Data Siswa</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Siswa</a>

    <table id="dataSiswa" class="table table-striped">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $conn->query("SELECT siswa.*, kelas.nm_kelas FROM siswa LEFT JOIN kelas ON siswa.kd_kelas=kelas.kd_kelas");
            while ($row = $query->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['nis']; ?></td>
                <td><?= $row['nm_siswa']; ?></td>
                <td><?= $row['nm_kelas']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['telp']; ?></td>
                <td>
                    <a href="edit.php?nis=<?= $row['nis']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?nis=<?= $row['nis']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#dataSiswa').DataTable();
});
</script>
</body>
</html>
