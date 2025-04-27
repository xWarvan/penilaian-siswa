<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}

include '../../config/database.php';

$kd_absen = $_GET['kd_absen'];
$query = $conn->query("SELECT * FROM absen WHERE kd_absen='$kd_absen'");
$data = $query->fetch_assoc();

if (isset($_POST['update'])) {
    $nm_bulan = $_POST['nm_bulan'];
    $jml_hadir = $_POST['jml_hadir'];
    $izin = $_POST['izin'];
    $sakit = $_POST['sakit'];
    $alfa = $_POST['alfa'];

    $conn->query("UPDATE absen SET 
        nm_bulan='$nm_bulan',
        jml_hadir='$jml_hadir',
        izin='$izin',
        sakit='$sakit',
        alfa='$alfa'
        WHERE kd_absen='$kd_absen'
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Edit Data Absensi</h3>
    <form method="post">
    <div class="mb-3">
    <label>Bulan</label>
    <select name="nm_bulan" class="form-control" required>
        <option value=""><?= htmlspecialchars($data['nm_bulan']); ?></option>
        <option value="Januari">Januari</option>
        <option value="Februari">Februari</option>
        <option value="Maret">Maret</option>
        <option value="April">April</option>
        <option value="Mei">Mei</option>
        <option value="Juni">Juni</option>
        <option value="Juli">Juli</option>
        <option value="Agustus">Agustus</option>
        <option value="September">September</option>
        <option value="Oktober">Oktober</option>
        <option value="November">November</option>
        <option value="Desember">Desember</option>
    </select>
</div>

        <div class="mb-3">
            <label>Jumlah Hadir</label>
            <input type="number" name="jml_hadir" value="<?= $data['jml_hadir']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Izin</label>
            <input type="number" name="izin" value="<?= $data['izin']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Sakit</label>
            <input type="number" name="sakit" value="<?= $data['sakit']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alfa</label>
            <input type="number" name="alfa" value="<?= $data['alfa']; ?>" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit" name="update">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
