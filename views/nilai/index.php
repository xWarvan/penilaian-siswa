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
    <title>Data Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Data Nilai Siswa</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">Tambah Nilai</a>

    <table id="dataNilai" class="table table-striped">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Mata Pelajaran</th>
                <th>UTS Ganjil</th>
                <th>UAS Ganjil</th>
                <th>UTS Genap</th>
                <th>UAS Genap</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $conn->query("SELECT nilai.*, siswa.nm_siswa, matpel.nm_matpel 
                                    FROM nilai 
                                    LEFT JOIN siswa ON nilai.nis=siswa.nis 
                                    LEFT JOIN matpel ON nilai.kd_matpel=matpel.kd_matpel");
            while ($row = $query->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['nis']; ?></td>
                <td><?= $row['nm_siswa']; ?></td>
                <td><?= $row['nm_matpel']; ?></td>
                <td><?= $row['uts_sem_ganjil']; ?></td>
                <td><?= $row['uas_sem_ganjil']; ?></td>
                <td><?= $row['uts_sem_genap']; ?></td>
                <td><?= $row['uas_sem_genap']; ?></td>
                <td>
                    <a href="edit.php?kd_nilai=<?= $row['kd_nilai']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?kd_nilai=<?= $row['kd_nilai']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
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
    $('#dataNilai').DataTable();
});
</script>
</body>
</html>
