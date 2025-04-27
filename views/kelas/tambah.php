<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

if (isset($_POST['simpan'])) {
    $kd_kelas = $_POST['kd_kelas'];
    $nm_kelas = $_POST['nm_kelas'];
    $jml_siswa = $_POST['jml_siswa'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $nip = $_POST['nip'];

    // Ambil nama guru
    $qguru = $conn->query("SELECT nm_guru FROM guru WHERE nip='$nip'");
    $dguru = $qguru->fetch_assoc();
    $nm_guru = $dguru['nm_guru'];

    $conn->query("INSERT INTO kelas (kd_kelas, nm_kelas, jml_siswa, thn_ajaran, nip, nm_guru)
                  VALUES ('$kd_kelas','$nm_kelas','$jml_siswa','$thn_ajaran','$nip','$nm_guru')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Data Kelas</h3>
    <form method="post">
        <div class="mb-3">
            <label>Kode Kelas</label>
            <input type="text" name="kd_kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nm_kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Siswa</label>
            <input type="number" name="jml_siswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun Ajaran</label>
            <input type="text" name="thn_ajaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Wali Kelas (Guru)</label>
            <select name="nip" class="form-control" required>
                <option value="">-Pilih Guru-</option>
                <?php
                $guru = $conn->query("SELECT * FROM guru");
                while ($g = $guru->fetch_assoc()) {
                    echo "<option value='".$g['nip']."'>".$g['nm_guru']."</option>";
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
