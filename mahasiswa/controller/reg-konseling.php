<?php
require_once '../../controller/koneksi.php';
$conn = getConnection();
session_start();
$mahasiswa_data = $_SESSION['mahasiswa_data'];

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Ambil data dari form
        $mahasiswa_id = $mahasiswa_data['mahasiswa_id'];
        $dosen_id = $_POST['lecturer_id'];
        $tipe_konseling = $_POST['tipe_konseling'];
        $tujuan_konseling = $_POST['tujuan_konseling'];
        $jenis_konseling = $_POST['jenis_konseling'];
        $tanggal_konseling = $_POST['date'];
        $waktu_mulai = $_POST['time-start'];
        $waktu_selesai = $_POST['time-end'];
        $status = 'Diajukan'; // Status default

        // Proses upload file lampiran
        $lampiran = null; // Default jika tidak ada file diunggah
        if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
            $target_dir = "../../media/uploads/"; // Direktori penyimpanan file
            $lampiran_name = time() . '_' . basename($_FILES['lampiran']['name']); // Rename file dengan timestamp
            $lampiran_path = $target_dir . $lampiran_name;

            // Validasi tipe file
            $allowed_types = ['pdf', 'doc', 'docx', 'jpg', 'png'];
            $file_type = pathinfo($lampiran_path, PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_type), $allowed_types)) {
                $message = "Format file tidak diperbolehkan. Hanya PDF, DOC, DOCX, JPG, dan PNG.";
                throw new Exception($message);
            }

            // Validasi ukuran file (maksimal 2MB)
            if ($_FILES['lampiran']['size'] > 25 * 1024 * 1024) {
                $message = "Ukuran file terlalu besar. Maksimal 25MB.";
                throw new Exception($message);
            }

            // Pindahkan file ke direktori tujuan
            if (!move_uploaded_file($_FILES['lampiran']['tmp_name'], $lampiran_path)) {
                $message = "Gagal mengunggah file lampiran.";
                throw new Exception($message);
            }

            $lampiran = $lampiran_name; // Simpan nama file untuk database
        }

        // Buat query untuk insert data
        $query = "INSERT INTO konseling (mahasiswa_id, dosen_id, tujuan_konseling, jenis_konseling, tanggal_konseling, waktu_mulai, waktu_selesai, status, lampiran) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisssssss", $mahasiswa_id, $dosen_id, $tujuan_konseling, $jenis_konseling, $tanggal_konseling, $waktu_mulai, $waktu_selesai, $status, $lampiran);

        // Eksekusi query
        if ($stmt->execute()) {
            $message = "Data konseling berhasil disimpan.";
            header("Location: ../mahasiswa-reg-konseling.php?status=success&message=" . urlencode($message));
            exit;
        } else {
            $message = "Error: " . $stmt->error;
            throw new Exception($message);
        }
    } catch (Exception $e) {
        $message = $e->getMessage();
        header("Location: ../mahasiswa-reg-konseling.php?status=failed&message=" . urlencode($message));
        exit;
    } finally {
        // Tutup statement dan koneksi
        if (isset($stmt)) {
            $stmt->close();
        }
        mysqli_close($conn);
    }
}
?>
