<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();
$message = '';

try {
    if (isset($_FILES['add-foto']) && isset($_POST['add-fullname']) && isset($_POST['add-nip']) && isset($_POST['add-password'])) {
        $foto = $_FILES['add-foto'];
        $fullname = $_POST['add-fullname'];
        $nip = $_POST['add-nip'];
        $password = $_POST['add-password'];

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        // Jika file foto diunggah, proses file
        if (isset($_FILES['add-foto']) && $_FILES['add-foto']['error'] === UPLOAD_ERR_OK) {
            $foto = $_FILES['add-foto'];
            $targetDir = "../../../media/";
            $extension = strtolower(pathinfo($foto["name"], PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $randomFileName = uniqid() . '_' . time() . '.' . $extension;
            $targetFile = $targetDir . $randomFileName;

            $check = getimagesize($foto["tmp_name"]);
            if ($check === false || !in_array($extension, $allowedExtensions)) {
                throw new Exception('File yang diunggah bukan gambar yang valid.');
            }

            if (!move_uploaded_file($foto["tmp_name"], $targetFile)) {
                throw new Exception('Gagal mengunggah gambar.');
            }
        }

        $query = mysqli_query($conn, "INSERT INTO users (login_id, password, role_id, profile_photo) VALUES ('$nip', '$hashedPass', 2, '$randomFileName')");
        if (!$query) {
            throw new Exception('Gagal menambahkan data ke tabel users: ' . mysqli_error($conn));
        }

        $user_id = mysqli_insert_id($conn);
        $query2 = mysqli_query($conn, "INSERT INTO dosen (user_id, nip, fullname) VALUES ('$user_id', '$nip', '$fullname')");
        if (!$query2) {
            throw new Exception('Gagal menambahkan data ke tabel dosen: ' . mysqli_error($conn));
        }

        header('location:../../admin-data-dosen.php?status=success');
    } else {
        throw new Exception('Data yang dikirim tidak lengkap.');
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    header('location:../../admin-data-dosen.php?status=failed&message=' . urlencode($message));
}
?>
