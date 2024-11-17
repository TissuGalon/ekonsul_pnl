<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();

if (isset($_POST['edit_prodi_id']) && isset($_POST['edit_prodi_name']) && isset($_POST['edit_jurusan_id'])) {

    $prodi_id = $_POST['edit_prodi_id'];
    $jurusan_id = $_POST['edit_jurusan_id'];
    $prodi_name = $_POST['edit_prodi_name'];

    if ($_POST['edit_jurusan_id'] == null || $_POST['edit_jurusan_id'] == '') {
        $query = mysqli_query($conn, "UPDATE prodi SET prodi_name = '$prodi_name' WHERE prodi_id = $prodi_id");
        if ($query) {
            header('location:../../admin-jurusan-prodi.php?status=prodi_edit_success');
        } else {
            header('location:../../admin-jurusan-prodi.php?status=prodi_edit_failed');
        }
    } else {
        $query = mysqli_query($conn, "UPDATE prodi SET prodi_name = '$prodi_name', jurusan_id = $jurusan_id WHERE prodi_id = $prodi_id");
        if ($query) {
            header('location:../../admin-jurusan-prodi.php?status=prodi_edit_success');
        } else {
            header('location:../../admin-jurusan-prodi.php?status=prodi_edit_failed');
        }
    }
} else {
    header('location:../../admin-jurusan-prodi.php?status=prodi_edit_failed');
}

?>