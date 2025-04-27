<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nm_siswa = $_POST['nm_siswa'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jkel = $_POST['jkel'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $nm_wali = $_POST['nm_wali'];
    $kd_kelas = $_POST['kd_kelas'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn->query("INSERT INTO siswa (nis, nm_siswa, tmp_lahir, tgl_lahir, jkel, alamat, telp, nm_wali, kd_kelas, username, password) 
                  VALUES ('$nis','$nm_siswa','$tmp_lahir','$tgl_lahir','$jkel','$alamat','$telp','$nm_wali','$kd_kelas','$username','$password')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Data Siswa</h3>
    <form method="post">
        <div class="mb-3">
            <label>NIS</label>
            <input type="text" name="nis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nm_siswa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tmp_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jkel" class="form-control" required>
                <option value="">-Pilih-</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>No. Telp</label>
            <input type="text" name="telp" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Wali</label>
            <input type="text" name="nm_wali" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <select name="kd_kelas" class="form-control" required>
                <option value="">-Pilih Kelas-</option>
                <?php
                $kelas = $conn->query("SELECT * FROM kelas");
                while ($k = $kelas->fetch_assoc()) {
                    echo "<option value='".$k['kd_kelas']."'>".$k['nm_kelas']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
