<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

if (isset($_POST['simpan'])) {
    $kd_nilai = $_POST['kd_nilai'];
    $nis = $_POST['nis'];
    $kd_matpel = $_POST['kd_matpel'];
    $uts_ganjil = $_POST['uts_sem_ganjil'];
    $uas_ganjil = $_POST['uas_sem_ganjil'];
    $uts_genap = $_POST['uts_sem_genap'];
    $uas_genap = $_POST['uas_sem_genap'];

    // Ambil nama siswa dan nama matpel
    $qsiswa = $conn->query("SELECT nm_siswa FROM siswa WHERE nis='$nis'");
    $dsiswa = $qsiswa->fetch_assoc();
    $nm_siswa = $dsiswa['nm_siswa'];

    $qmatpel = $conn->query("SELECT nm_matpel FROM matpel WHERE kd_matpel='$kd_matpel'");
    $dmatpel = $qmatpel->fetch_assoc();
    $nm_matpel = $dmatpel['nm_matpel'];

    $conn->query("INSERT INTO nilai (kd_nilai, nis, nm_siswa, kd_matpel, nm_matpel, uts_sem_ganjil, uas_sem_ganjil, uts_sem_genap, uas_sem_genap)
                  VALUES ('$kd_nilai', '$nis', '$nm_siswa', '$kd_matpel', '$nm_matpel', '$uts_ganjil', '$uas_ganjil', '$uts_genap', '$uas_genap')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Data Nilai</h3>
    <form method="post">
        <div class="mb-3">
            <label>Kode Nilai</label>
            <input type="text" name="kd_nilai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Siswa</label>
            <select name="nis" class="form-control" required>
                <option value="">-Pilih Siswa-</option>
                <?php
                $siswa = $conn->query("SELECT * FROM siswa");
                while ($s = $siswa->fetch_assoc()) {
                    echo "<option value='".$s['nis']."'>".$s['nm_siswa']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Mata Pelajaran</label>
            <select name="kd_matpel" class="form-control" required>
                <option value="">-Pilih Mata Pelajaran-</option>
                <?php
                $matpel = $conn->query("SELECT * FROM matpel");
                while ($m = $matpel->fetch_assoc()) {
                    echo "<option value='".$m['kd_matpel']."'>".$m['nm_matpel']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>UTS Semester Ganjil</label>
            <input type="number" step="0.01" name="uts_sem_ganjil" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>UAS Semester Ganjil</label>
            <input type="number" step="0.01" name="uas_sem_ganjil" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>UTS Semester Genap</label>
            <input type="number" step="0.01" name="uts_sem_genap" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>UAS Semester Genap</label>
            <input type="number" step="0.01" name="uas_sem_genap" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
