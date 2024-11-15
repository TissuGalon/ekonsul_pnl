<?php
header('Content-Type: application/json');
require_once '../../controller/koneksi.php';

$conn = getConnection();

// Periksa apakah data dikirim
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $deletedAt = date('Y-m-d H:i:s'); // Waktu saat ini untuk soft delete

    // Mulai transaksi
    mysqli_begin_transaction($conn);

    try {
        // Ambil nama foto profil dari tabel users
        $queryFoto = "SELECT profile_photo FROM users WHERE user_id = ?";
        $stmtFoto = mysqli_prepare($conn, $queryFoto);
        mysqli_stmt_bind_param($stmtFoto, "i", $user_id);
        mysqli_stmt_execute($stmtFoto);
        mysqli_stmt_bind_result($stmtFoto, $profilePhoto);
        mysqli_stmt_fetch($stmtFoto);
        mysqli_stmt_close($stmtFoto);

        // Jika foto profil ada, hapus file foto
        if ($profilePhoto) {
            $targetDir = "../../media/";
            $filePath = $targetDir . $profilePhoto;

            // Cek apakah file foto ada di server dan hapus
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file foto
            }
        }

        // Perbarui tabel `mahasiswa` dan `users` untuk soft delete berdasarkan user_id
        $query1 = "UPDATE mahasiswa SET deleted_at = ? WHERE user_id = ?";
        $stmt1 = mysqli_prepare($conn, $query1);
        mysqli_stmt_bind_param($stmt1, "si", $deletedAt, $user_id);
        mysqli_stmt_execute($stmt1);

        $query2 = "UPDATE users SET deleted_at = ? WHERE user_id = ?";
        $stmt2 = mysqli_prepare($conn, $query2);
        mysqli_stmt_bind_param($stmt2, "si", $deletedAt, $user_id);
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
