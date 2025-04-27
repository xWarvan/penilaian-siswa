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
    <title>Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Data Guru</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Guru</a>

    <table id="dataGuru" class="table table-striped">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama</th>
                <th>Mata Pelajaran</th>
                <th>Telp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $conn->query("SELECT guru.*, matpel.nm_matpel FROM guru LEFT JOIN matpel ON guru.kd_matpel=matpel.kd_matpel");
            while ($row = $query->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['nip']; ?></td>
                <td><?= $row['nm_guru']; ?></td>
                <td><?= $row['nm_matpel']; ?></td>
                <td><?= $row['telp']; ?></td>
                <td>
                    <a href="edit.php?nip=<?= $row['nip']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?nip=<?= $row['nip']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
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
    $('#dataGuru').DataTable();
});
</script>
</body>
</html>
