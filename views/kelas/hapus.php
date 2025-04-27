<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

$kd_kelas = $_GET['kd_kelas'];

$conn->query("DELETE FROM kelas WHERE kd_kelas='$kd_kelas'");

header("Location: index.php");
?>
