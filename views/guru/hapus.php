<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
include '../../config/database.php';

$nip = $_GET['nip'];

$conn->query("DELETE FROM guru WHERE nip='$nip'");

header("Location: index.php");
?>
