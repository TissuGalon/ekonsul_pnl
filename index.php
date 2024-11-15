<?php
session_start();
if (!isset($_SESSION['role_id'])) {
    header('location:auth/login.php');
} else {
    if ($_SESSION['role_id'] == 1) {
        header('location:admin/admin-beranda.php');
    } elseif ($_SESSION['role_id'] == 3) {
        header('location:mahasiswa-beranda.php');
    } elseif ($_SESSION['role_id'] == 2) {
        header('location:dosen-beranda.php');
    } else {
        header('location:login.php');
    }
}
?>