<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

$kd_kelas = $_GET['kd_kelas'];
$query = $conn->query("SELECT * FROM kelas WHERE kd_kelas='$kd_kelas'");
$data = $query->fetch_assoc();

if (!$data) {
    die("Data kelas tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $nm_kelas = $_POST['nm_kelas'];
    $jml_siswa = $_POST['jml_siswa'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $nip = $_POST['nip'];

    // Ambil nama guru
    $qguru = $conn->query("SELECT nm_guru FROM guru WHERE nip='$nip'");
    $dguru = $qguru->fetch_assoc();
    $nm_guru = $dguru['nm_guru'];

    $conn->query("UPDATE kelas SET 
        nm_kelas='$nm_kelas',
        jml_siswa='$jml_siswa',
        thn_ajaran='$thn_ajaran',
        nip='$nip',
        nm_guru='$nm_guru'
        WHERE kd_kelas='$kd_kelas'
    ");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Edit Data Kelas</h3>
    <form method="post">
        <div class="mb-3">
            <label>Kode Kelas (Tidak Bisa Diubah)</label>
            <input type="text" value="<?= $data['kd_kelas']; ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nm_kelas" value="<?= $data['nm_kelas']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah Siswa</label>
            <input type="number" name="jml_siswa" value="<?= $data['jml_siswa']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun Ajaran</label>
            <input type="text" name="thn_ajaran" value="<?= $data['thn_ajaran']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Wali Kelas (Guru)</label>
            <select name="nip" class="form-control" required>
                <?php
                $guru = $conn->query("SELECT * FROM guru");
                while ($g = $guru->fetch_assoc()) {
                    $selected = ($g['nip'] == $data['nip']) ? 'selected' : '';
                    echo "<option value='".$g['nip']."' $selected>".$g['nm_guru']."</option>";
                }
                ?>
            </select>
        </div>
        <button class="btn btn-primary" type="submit" name="update">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
