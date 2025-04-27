<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}

include '../../config/database.php';

$kd_absen = $_GET['kd_absen'];
$conn->query("DELETE FROM absen WHERE kd_absen='$kd_absen'");

header("Location: index.php");
?>
