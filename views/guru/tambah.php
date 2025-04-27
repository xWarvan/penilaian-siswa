<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

if (isset($_POST['simpan'])) {
    $nip = $_POST['nip'];
    $nm_guru = $_POST['nm_guru'];
    $tmp_lahir_guru = $_POST['tmp_lahir_guru'];
    $tgl_lahir_guru = $_POST['tgl_lahir_guru'];
    $kel_guru = $_POST['kel_guru'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $kd_matpel = $_POST['kd_matpel'];

    // Ambil nama matpel
    $qmatpel = $conn->query("SELECT nm_matpel FROM matpel WHERE kd_matpel='$kd_matpel'");
    $dmatpel = $qmatpel->fetch_assoc();
    $nm_matpel = $dmatpel['nm_matpel'];

    $conn->query("INSERT INTO guru (nip, nm_guru, tmp_lahir_guru, tgl_lahir_guru, kel_guru, alamat, telp, kd_matpel, nm_matpel)
                  VALUES ('$nip','$nm_guru','$tmp_lahir_guru','$tgl_lahir_guru','$kel_guru','$alamat','$telp','$kd_matpel','$nm_matpel')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Data Guru</h3>
    <form method="post">
        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Guru</label>
            <input type="text" name="nm_guru" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tmp_lahir_guru" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir_guru" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="kel_guru" class="form-control" required>
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
        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
