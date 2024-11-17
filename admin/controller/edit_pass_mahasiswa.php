<?php
header('Content-Type: application/json');
require_once '../../controller/koneksi.php';

$conn = getConnection();

if (isset($_POST['user_id'], $_POST['newpass'])) {
    $user_id = $_POST['user_id'];
    $newpass = $_POST['newpass'];

    mysqli_begin_transaction($conn);

    try {
        // Enkripsi password
        $hashedPassword = password_hash($newpass, PASSWORD_BCRYPT);

        // Perbarui password
        $query = "UPDATE users SET password = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        if (!$stmt) {
            throw new Exception("Kesalahan dalam mempersiapkan query.");
        }
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $user_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) === 0) {
            throw new Exception("User ID tidak ditemukan atau password tidak berubah.");
        }

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
