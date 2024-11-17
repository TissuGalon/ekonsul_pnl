<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();
$message = '';

try {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $deletedAt = date('Y-m-d H:i:s');

        /* Hapus foto sebelumnya */
        $queryFoto = "SELECT profile_photo FROM users WHERE user_id = ?";
        $stmtFoto = mysqli_prepare($conn, $queryFoto);
        mysqli_stmt_bind_param($stmtFoto, "i", $user_id);
        mysqli_stmt_execute($stmtFoto);
        mysqli_stmt_bind_result($stmtFoto, $profilePhoto);
        mysqli_stmt_fetch($stmtFoto);
        mysqli_stmt_close($stmtFoto);

        if ($profilePhoto) {
            $targetDir = "../../../media/";
            $filePath = $targetDir . $profilePhoto;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $query = mysqli_query($conn, "UPDATE users SET deleted_at = '$deletedAt', profile_photo = NULL WHERE user_id = $user_id");
        if ($query) {
            $query2 = mysqli_query($conn, "UPDATE dosen SET deleted_at = '$deletedAt' WHERE user_id = $user_id");

            if ($query2) {
                $message = 'Data berhasil dihapus.';
                header('location:../../admin-data-dosen.php?status=success&message=' . urlencode($message));
            } else {
                throw new Exception('Gagal menghapus data: ' . mysqli_error($conn));
            }
        } else {
            throw new Exception('Gagal menghapus data: ' . mysqli_error($conn));
        }
    } else {
        throw new Exception('Data input tidak lengkap.');
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    header('location:../../admin-data-dosen.php?status=failed&message=' . urlencode($message));
}
?>
