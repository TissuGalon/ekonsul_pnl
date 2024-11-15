<?php
require_once '../controller/koneksi.php';
$conn = getConnection();

if (isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];

    // Ambil data prodi berdasarkan department_id
    $queryProdi = mysqli_query($conn, "SELECT * FROM study_programs WHERE department_id = '$department_id'");

    $prodiList = [];
    while ($row = mysqli_fetch_array($queryProdi)) {
        $prodiList[] = [
            'study_program_id' => $row['program_id'],
            'study_program_name' => $row['program_name']
        ];
    }

    // Mengembalikan hasil dalam format JSON
    echo json_encode($prodiList);
}
?>
