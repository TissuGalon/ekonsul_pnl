<?php
require_once '../../../controller/koneksi.php';
$conn = getConnection();
$message = '';

try {
    // Validasi input
    if (isset($_POST['gantipass-userId']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
        $user_id = $_POST['gantipass-userId'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Pastikan password baru sesuai dengan konfirmasi
        if ($newPassword !== $confirmPassword) {
            $message = 'Password baru dan konfirmasi password tidak sesuai.';
            header('location:../../admin-data-dosen.php?status=failed&message=' . urlencode($message));
            exit;
        }

        // Hash password baru
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password di database
        $query = mysqli_query($conn, "UPDATE users SET password = '$hashedPassword' WHERE user_id = '$user_id'");
        if ($query) {
            $message = 'Password berhasil diperbarui.';
            header('location:../../admin-data-dosen.php?status=success&message=' . urlencode($message));
        } else {
            throw new Exception('Gagal memperbarui password: ' . mysqli_error($conn));
        }
    } else {
        throw new Exception('Data input tidak lengkap.');
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    header('location:../../admin-data-dosen.php?status=failed&message=' . urlencode($message));
}
?>
