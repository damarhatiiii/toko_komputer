<?php
session_start();
include '../../config/db.php';

// Pastikan user login dulu
if (!isset($_SESSION['username'])) {
    header('Location: ' . BASE_PATH . '/auth/login.php');
    exit;
}

// Cek apakah user adalah admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ' . BASE_PATH . '/pages/master/karyawan.php?error=akses_ditolak');
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM karyawan WHERE id_karyawan = '$id'");

header("Location: karyawan.php?deleted=1");
exit;
?>
