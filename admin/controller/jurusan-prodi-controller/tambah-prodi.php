<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();

if (isset($_POST['jurusan_id']) && isset($_POST['prodi_name'])) {
    $jurusan_id = $_POST['jurusan_id'];
    $prodi_name = $_POST['prodi_name'];

    $query = mysqli_query($conn, "INSERT INTO prodi (prodi_name, jurusan_id) VALUES ('$prodi_name', $jurusan_id)");
    if ($query) {
        header('location:../../admin-jurusan-prodi.php?status=prodi_add_success');
    } else {
        header('location:../../admin-jurusan-prodi.php?status=prodi_add_failed');
    }
} else {
    header('location:../../admin-jurusan-prodi.php?status=prodi_add_failed');
}

?>