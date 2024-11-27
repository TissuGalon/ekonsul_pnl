<?php
require_once '../../controller/koneksi.php';
$conn = getConnection();
session_start();

$queryLampiran = '';

// Ambil ID konseling dari URL
if (isset($_GET['id_konseling'])) {
    $id_konseling = $_GET['id_konseling'];
    $message = '';

    try {
        // Update status menjadi 'Dibatalkan'
        $update_query = "UPDATE konseling SET status = 'Diajukan'" . $queryLampiran . " WHERE id_konseling = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $id_konseling);
        if ($update_stmt->execute()) {
            $message = "Berhasil dibatalkan.";
            header("Location: ../dosen-permintaan-bimbingan.php?status=success&message=" . urlencode($message));
        } else {
            throw new Exception("Gagal Membatalkan konseling.");
        }

        $stmt->close();
    } catch (Exception $e) {
        $message = $e->getMessage();
        header("Location: ../dosen-permintaan-bimbingan.php?status=failed&message=" . urlencode($message));
    } finally {
        mysqli_close($conn);
    }
} else {
    // Jika ID konseling tidak ditemukan di URL
    header("Location: ../dosen-permintaan-bimbingan.php?status=failed&message=" . urlencode("ID konseling tidak ditemukan."));
}
?>
