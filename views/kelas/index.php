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
    <title>Data Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Data Kelas</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Kelas</a>

    <table id="dataKelas" class="table table-striped">
        <thead>
            <tr>
                <th>Kode Kelas</th>
                <th>Nama Kelas</th>
                <th>Jumlah Siswa</th>
                <th>Tahun Ajaran</th>
                <th>Wali Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $conn->query("SELECT kelas.*, guru.nm_guru FROM kelas LEFT JOIN guru ON kelas.nip=guru.nip");
            while ($row = $query->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['kd_kelas']; ?></td>
                <td><?= $row['nm_kelas']; ?></td>
                <td><?= $row['jml_siswa']; ?></td>
                <td><?= $row['thn_ajaran']; ?></td>
                <td><?= $row['nm_guru']; ?></td>
                <td>
                    <a href="edit.php?kd_kelas=<?= $row['kd_kelas']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?kd_kelas=<?= $row['kd_kelas']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
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
    $('#dataKelas').DataTable();
});
</script>
</body>
</html>
