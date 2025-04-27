<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

$nis = $_GET['nis'];
$query = $conn->query("SELECT * FROM siswa WHERE nis='$nis'");
$data = $query->fetch_assoc();

if (!$data) {
    die("Data siswa tidak ditemukan!");
}

if (isset($_POST['update'])) {
    $nm_siswa = $_POST['nm_siswa'];
    $tmp_lahir = $_POST['tmp_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jkel = $_POST['jkel'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $nm_wali = $_POST['nm_wali'];
    $kd_kelas = $_POST['kd_kelas'];
    $username = $_POST['username'];

    $conn->query("UPDATE siswa SET 
        nm_siswa='$nm_siswa',
        tmp_lahir='$tmp_lahir',
        tgl_lahir='$tgl_lahir',
        jkel='$jkel',
        alamat='$alamat',
        telp='$telp',
        nm_wali='$nm_wali',
        kd_kelas='$kd_kelas',
        username='$username'
        WHERE nis='$nis'
    ");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Edit Data Siswa</h3>
    <form method="post">
        <div class="mb-3">
            <label>NIS (Tidak Bisa Diubah)</label>
            <input type="text" value="<?= $data['nis']; ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" name="nm_siswa" value="<?= $data['nm_siswa']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tmp_lahir" value="<?= $data['tmp_lahir']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" value="<?= $data['tgl_lahir']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jkel" class="form-control" required>
                <option value="Laki-laki" <?= ($data['jkel'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?= ($data['jkel'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>No. Telp</label>
            <input type="text" name="telp" value="<?= $data['telp']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Nama Wali</label>
            <input type="text" name="nm_wali" value="<?= $data['nm_wali']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kelas</label>
            <select name="kd_kelas" class="form-control" required>
                <?php
                $kelas = $conn->query("SELECT * FROM kelas");
                while ($k = $kelas->fetch_assoc()) {
                    $selected = ($k['kd_kelas'] == $data['kd_kelas']) ? 'selected' : '';
                    echo "<option value='".$k['kd_kelas']."' $selected>".$k['nm_kelas']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit" name="update">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
