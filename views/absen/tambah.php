<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}

include '../../config/database.php';

// Ambil data semua siswa buat dropdown
$siswa = $conn->query("SELECT nis, nm_siswa FROM siswa ORDER BY nm_siswa ASC");

if (isset($_POST['simpan'])) {
    $kd_absen = uniqid('ABS');
    $nm_bulan = $_POST['nm_bulan'];
    $nis = $_POST['nis'];

    // Ambil nama siswa berdasarkan NIS
    $result = $conn->query("SELECT nm_siswa FROM siswa WHERE nis='$nis'");
    $row = $result->fetch_assoc();
    $nm_siswa = $row['nm_siswa'];

    $jml_hadir = $_POST['jml_hadir'];
    $izin = $_POST['izin'];
    $sakit = $_POST['sakit'];
    $alfa = $_POST['alfa'];

    $conn->query("INSERT INTO absen (kd_absen, nm_bulan, nis, nm_siswa, jml_hadir, izin, sakit, alfa) VALUES (
        '$kd_absen', '$nm_bulan', '$nis', '$nm_siswa', '$jml_hadir', '$izin', '$sakit', '$alfa'
    )");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Biar Nama Siswa auto diisi saat pilih NIS
        function updateNamaSiswa() {
            var nisSelect = document.getElementById('nis');
            var selectedOption = nisSelect.options[nisSelect.selectedIndex];
            var nmSiswaInput = document.getElementById('nm_siswa');
            nmSiswaInput.value = selectedOption.getAttribute('data-nama');
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <h3>Tambah Data Absensi</h3>
    <form method="post">
            <div class="mb-3">
            <label>Bulan</label>
            <select name="nm_bulan" class="form-control" required>
                <option value="">-- Pilih Bulan --</option>
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
            <label>NIS</label>
            <select name="nis" id="nis" class="form-control" onchange="updateNamaSiswa()" required>
                <option value="">-- Pilih NIS --</option>
                <?php while ($row = $siswa->fetch_assoc()): ?>
                    <option value="<?= $row['nis']; ?>" data-nama="<?= htmlspecialchars($row['nm_siswa']); ?>">
                        <?= $row['nis']; ?> - <?= htmlspecialchars($row['nm_siswa']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Nama Siswa</label>
            <input type="text" id="nm_siswa" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label>Jumlah Hadir</label>
            <input type="number" name="jml_hadir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Izin</label>
            <input type="number" name="izin" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Sakit</label>
            <input type="number" name="sakit" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alfa</label>
            <input type="number" name="alfa" class="form-control" required>
        </div>
        <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>

</body>
</html>
