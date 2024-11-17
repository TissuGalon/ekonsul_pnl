<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();
$message = '';

try {
    if (isset($_POST['edit_user_id']) && isset($_POST['edit-fullname']) && isset($_POST['edit-nip'])) {
        $id = $_POST['edit_user_id'];
        $fullname = $_POST['edit-fullname'];
        $nip = $_POST['edit-nip'];

        // Mendapatkan nama file foto lama
        $result = mysqli_query($conn, "SELECT profile_photo FROM users WHERE user_id = '$id'");
        if (!$result) {
            throw new Exception('Gagal mengambil data foto lama: ' . mysqli_error($conn));
        }
        $userData = mysqli_fetch_assoc($result);
        $oldPhoto = $userData['profile_photo'] ?? null;

        // Update Foto jika ada
        $updateFoto = '';
        if (isset($_FILES['edit-foto']) && $_FILES['edit-foto']['error'] === UPLOAD_ERR_OK) {
            $foto = $_FILES['edit-foto'];
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

            $updateFoto = ", profile_photo = '$randomFileName'";

            // Hapus foto lama jika ada
            if ($oldPhoto && file_exists($targetDir . $oldPhoto)) {
                if (!unlink($targetDir . $oldPhoto)) {
                    throw new Exception('Gagal menghapus file foto lama.');
                }
            }
        }

        // Update data pada tabel `users`
        $query = mysqli_query(
            $conn,
            "UPDATE users 
             SET login_id = '$nip' $updateFoto
             WHERE user_id = '$id'"
        );
        if (!$query) {
            throw new Exception('Gagal mengupdate data pada tabel users: ' . mysqli_error($conn));
        }

        // Update data pada tabel `dosen`
        $query2 = mysqli_query(
            $conn,
            "UPDATE dosen 
             SET nip = '$nip', fullname = '$fullname' 
             WHERE user_id = '$id'"
        );
        if (!$query2) {
            throw new Exception('Gagal mengupdate data pada tabel dosen: ' . mysqli_error($conn));
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
