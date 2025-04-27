<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

$nip = $_GET['nip'];
$query = $conn->query("SELECT * FROM guru WHERE nip='$nip'");
$data = $query->fetch_assoc();

if (!$data) {
    die("Data guru tidak ditemukan!");
}

if (isset($_POST['update'])) {
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

    $conn->query("UPDATE guru SET 
        nm_guru='$nm_guru',
        tmp_lahir_guru='$tmp_lahir_guru',
        tgl_lahir_guru='$tgl_lahir_guru',
        kel_guru='$kel_guru',
        alamat='$alamat',
        telp='$telp',
        kd_matpel='$kd_matpel',
        nm_matpel='$nm_matpel'
        WHERE nip='$nip'
    ");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Edit Data Guru</h3>
    <form method="post">
        <div class="mb-3">
            <label>NIP (Tidak Bisa Diubah)</label>
            <input type="text" value="<?= $data['nip']; ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Nama Guru</label>
            <input type="text" name="nm_guru" value="<?= $data['nm_guru']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tmp_lahir_guru" value="<?= $data['tmp_lahir_guru']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir_guru" value="<?= $data['tgl_lahir_guru']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="kel_guru" class="form-control" required>
                <option value="Laki-laki" <?= ($data['kel_guru'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="Perempuan" <?= ($data['kel_guru'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
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
            <label>Mata Pelajaran</label>
            <select name="kd_matpel" class="form-control" required>
                <?php
                $matpel = $conn->query("SELECT * FROM matpel");
                while ($m = $matpel->fetch_assoc()) {
                    $selected = ($m['kd_matpel'] == $data['kd_matpel']) ? 'selected' : '';
                    echo "<option value='".$m['kd_matpel']."' $selected>".$m['nm_matpel']."</option>";
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
