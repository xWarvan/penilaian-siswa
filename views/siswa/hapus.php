<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

$nis = $_GET['nis'];

$conn->query("DELETE FROM siswa WHERE nis='$nis'");

header("Location: index.php");
?>
