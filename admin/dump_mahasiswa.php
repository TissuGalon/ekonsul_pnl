<?php
header('Content-Type: application/json');

require_once '../controller/koneksi.php';
$conn = getConnection();

$dataMahasiswa = [
    /* ['Rina Fitria', '2021613060052'],
    ['SARA KIRANA SEPTIANI', '2021613060006'],
    ['Siti Syafiya Ulayya', '2021613060039'],
    ['Suci Wahyuni', '2021613060062'],
    ['ULFA AMARILIS', '2021613060022'],
    ['Zahra', '2021613060011'], */
];




mysqli_begin_transaction($conn);

try {
    foreach ($dataMahasiswa as $mhs) {
        $nama = $mhs[0];
        $nim = $mhs[1];
        $hashedPass = password_hash('default_password', PASSWORD_DEFAULT);

        // Insert ke tabel users
        $query1 = "INSERT INTO users (login_id, password, role_id, profile_photo) VALUES (?, ?, ?, ?)";
        $stmt1 = mysqli_prepare($conn, $query1);
        $role_id = 3;
        mysqli_stmt_bind_param($stmt1, "ssis", $nim, $hashedPass, $role_id, $null);
        mysqli_stmt_execute($stmt1);

        $user_id = mysqli_insert_id($conn);

        // Insert ke tabel mahasiswa
        $query2 = "INSERT INTO mahasiswa (user_id, nim, fullname, prodi_id, semester, bio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "isssis", $user_id, $nim, $nama, $prodi, $semester, $bio);
        mysqli_stmt_execute($stmt2);
    }
    mysqli_commit($conn);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo json_encode(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
}

?>