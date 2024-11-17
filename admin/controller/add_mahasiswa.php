<?php
header('Content-Type: application/json');

require_once '../../controller/koneksi.php';
$conn = getConnection();

// Periksa apakah data dikirim menggunakan metode POST
if (
    !empty($_POST['nama']) && !empty($_POST['nim']) && !empty($_POST['pass']) &&
    !empty($_POST['jurusan']) && !empty($_POST['prodi']) && !empty($_POST['semester'])
) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $pass = $_POST['pass'];
    $jurusan = $_POST['jurusan'];
    $prodi = $_POST['prodi'];
    $semester = $_POST['semester'];

    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    // Default foto jika tidak diunggah
    $randomFileName = null;

    // Jika file foto diunggah, proses file
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto'];
        $targetDir = "../../media/";
        $extension = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $randomFileName = uniqid() . '_' . time() . '.' . $extension;
        $targetFile = $targetDir . $randomFileName;

        $check = getimagesize($foto["tmp_name"]);
        if ($check === false || !in_array($extension, $allowedExtensions)) {
            echo json_encode(['success' => false, 'message' => 'File yang diunggah bukan gambar yang valid.']);
            exit();
        }

        if (!move_uploaded_file($foto["tmp_name"], $targetFile)) {
            echo json_encode(['success' => false, 'message' => 'Gagal mengunggah gambar']);
            exit();
        }
    }

    mysqli_begin_transaction($conn);

    try {
        // Simpan data ke tabel `users`
        $query1 = "INSERT INTO users (login_id, password, role_id, profile_photo) VALUES (?, ?, ?, ?)";
        $stmt1 = mysqli_prepare($conn, $query1);
        $role_id = 3;
        mysqli_stmt_bind_param($stmt1, "ssis", $nim, $hashedPass, $role_id, $randomFileName);
        mysqli_stmt_execute($stmt1);

        $user_id = mysqli_insert_id($conn);

        // Simpan data ke tabel `mahasiswa`
        $query2 = "INSERT INTO mahasiswa (user_id, nim, fullname, prodi_id, semester, bio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $query2);
        $bio = "";
        mysqli_stmt_bind_param($stmt2, "isssis", $user_id, $nim, $nama, $prodi, $semester, $bio);
        mysqli_stmt_execute($stmt2);

        mysqli_commit($conn);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => 'Kesalahan saat menyimpan data: ' . $e->getMessage()]);
    } finally {
        if (isset($stmt1))
            mysqli_stmt_close($stmt1);
        if (isset($stmt2))
            mysqli_stmt_close($stmt2);
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
}
?>
