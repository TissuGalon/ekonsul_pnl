<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();

if (isset($_POST['edit_jurusan_id']) && isset($_POST['edit_jurusan_name'])) {
    $jurusan_id = $_POST['edit_jurusan_id'];
    $jurusan_name = $_POST['edit_jurusan_name'];

    $query = mysqli_query($conn, "UPDATE jurusan SET jurusan_name = '$jurusan_name' WHERE jurusan_id = $jurusan_id");
    if ($query) {
        header('location:../../admin-jurusan-prodi.php?status=jurusan_edit_success');
    } else {
        header('location:../../admin-jurusan-prodi.php?status=jurusan_edit_failed');
    }
} else {
    header('location:../../admin-jurusan-prodi.php?status=jurusan_edit_failed');
}

?>