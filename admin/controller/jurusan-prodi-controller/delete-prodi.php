<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();

if (isset($_GET['delete_prodi_id'])) {
    $prodi_id = $_GET['delete_prodi_id'];

    $query = mysqli_query($conn, "DELETE FROM prodi WHERE prodi_id = $prodi_id");
    if ($query) {
        header('location:../../admin-jurusan-prodi.php?status=prodi_delete_success');
    } else {
        header('location:../../admin-jurusan-prodi.php?status=prodi_delete_failed');
    }
} else {
    header('location:../../admin-jurusan-prodi.php?status=prodi_delete_failed');
}

?>