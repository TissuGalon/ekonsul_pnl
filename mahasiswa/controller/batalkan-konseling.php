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
        // Ambil data konseling berdasarkan ID
        $query = "SELECT lampiran FROM konseling WHERE id_konseling = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $konseling_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($lampiran);
        
        if ($stmt->num_rows > 0) {
            $stmt->fetch(); // Mengambil data lampiran

            // Hapus file lampiran jika ada
            if ($lampiran && file_exists("../../media/uploads/" . $lampiran)) {
                unlink("../../media/uploads/" . $lampiran); // Menghapus file
                $queryLampiran = ', lampiran = NULL';
            }           
        }

         // Update status menjadi 'Dibatalkan'
        $update_query = "UPDATE konseling SET status = 'Dibatalkan'".$queryLampiran." WHERE id_konseling = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $id_konseling);
        if ($update_stmt->execute()) {
            $message = "Konseling berhasil dibatalkan.";
            header("Location: ../mahasiswa-data-konseling.php?status=success&message=" . urlencode($message));
        } else {
            throw new Exception("Gagal membatalkan konseling.");
        }

        $stmt->close();
    } catch (Exception $e) {
        $message = $e->getMessage();
        header("Location: ../mahasiswa-data-konseling.php?status=failed&message=" . urlencode($message));
    } finally {
        mysqli_close($conn);
    }
} else {
    // Jika ID konseling tidak ditemukan di URL
    header("Location: ../mahasiswa-data-konseling.php?status=failed&message=" . urlencode("ID konseling tidak ditemukan."));
}
?>
