<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();

if (isset($_POST['jurusan_name'])) {
    $jurusan_name = $_POST['jurusan_name'];

    $query = mysqli_query($conn, "INSERT INTO jurusan (jurusan_name) VALUES ('$jurusan_name')");
    if ($query) {
        header('location:../../admin-jurusan-prodi.php?status=jurusan_add_success');
    } else {
        header('location:../../admin-jurusan-prodi.php?status=jurusan_add_failed');
    }
} else {
    header('location:../../admin-jurusan-prodi.php?status=jurusan_add_failed');
}

?>