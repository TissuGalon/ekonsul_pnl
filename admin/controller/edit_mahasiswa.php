<?php
header('Content-Type: application/json');
require_once '../../controller/koneksi.php';

$conn = getConnection();

// Periksa apakah data dikirim
if (
    isset($_POST['user_id'], $_POST['mahasiswaId'], $_POST['nama'], $_POST['nim'], $_POST['prodi'], $_POST['semester'])
) {
    $user_id = $_POST['user_id'];
    $id = $_POST['mahasiswaId'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $semester = $_POST['semester'];
    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : null;

    // Mulai transaksi
    mysqli_begin_transaction($conn);

    try {
        // Periksa apakah foto lama ada di database
        $queryGetFoto = "SELECT profile_photo FROM users WHERE user_id = ?";
        $stmtGetFoto = mysqli_prepare($conn, $queryGetFoto);
        mysqli_stmt_bind_param($stmtGetFoto, "i", $user_id);
        mysqli_stmt_execute($stmtGetFoto);
        mysqli_stmt_bind_result($stmtGetFoto, $oldFoto);
        mysqli_stmt_fetch($stmtGetFoto);
        mysqli_stmt_close($stmtGetFoto);

        // Hapus foto lama jika ada dan foto baru diupload
        if ($foto && !empty($foto['name'])) {
            // Hapus foto lama jika ada
            if ($oldFoto && file_exists("../../media/" . $oldFoto)) {
                unlink("../../media/" . $oldFoto); // Menghapus file foto lama
            }

            // Proses foto baru
            $targetDir = "../../media/";
            $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
            $randomFileName = uniqid() . '_' . time() . '.' . $extension;
            $targetFile = $targetDir . $randomFileName;

            // Validasi gambar
            $check = getimagesize($foto["tmp_name"]);
            if ($check !== false && in_array($extension, ['jpg', 'jpeg', 'png'])) {
                move_uploaded_file($foto["tmp_name"], $targetFile);
                $setFoto = ", profile_photo = '$randomFileName'";
            } else {
                throw new Exception("Format gambar tidak valid. Harus JPG, JPEG, atau PNG.");
            }
        } else {
            // Jika tidak ada foto baru, tidak perlu mengupdate foto
            $setFoto = '';
        }

        // Perbarui tabel `users`
        $query1 = "UPDATE users SET login_id = ? $setFoto WHERE user_id = ?";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1, "si", $nim, $user_id);
        mysqli_stmt_execute($stmt1);

        // Perbarui tabel `mahasiswa`
        $query2 = "UPDATE mahasiswa SET fullname = ?, nim = ?, prodi_id = ?, semester = ? WHERE user_id = ?";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "ssisi", $nama, $nim, $prodi, $semester, $user_id);
        mysqli_stmt_execute($stmt2);

        mysqli_commit($conn);
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
}
?>
