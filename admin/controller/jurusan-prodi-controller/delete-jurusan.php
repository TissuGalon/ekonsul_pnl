<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();

if (isset($_GET['delete_jurusan_id'])) {
    $jurusan_id = $_GET['delete_jurusan_id'];

    $query = mysqli_query($conn, "DELETE FROM jurusan WHERE jurusan_id = $jurusan_id");
    if ($query) {
        header('location:../../admin-jurusan-prodi.php?status=jurusan_delete_success');
    } else {
        header('location:../../admin-jurusan-prodi.php?status=jurusan_delete_failed');
    }
} else {
    header('location:../../admin-jurusan-prodi.php?status=jurusan_delete_failed');
}

?>