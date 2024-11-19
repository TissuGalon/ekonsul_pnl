<?php
session_start();
require_once '../controller/koneksi.php';

function login($login_id, $password)
{
    // Mengambil koneksi database
    $conn = getConnection();

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE login_id = ?");
    $stmt->bind_param("s", $login_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah ada data pengguna
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role_id'] = $row['role_id'];

            // Ambil data lengkap dari tabel yang sesuai berdasarkan role_id
            switch ($row['role_id']) {
                case 1: // Role Admin
                    // Ambil data admin (jika ada tabel khusus)
                    break;
                case 2: // Role Dosen
                    $stmt_dosen = $conn->prepare("SELECT * FROM dosen WHERE user_id = ?");
                    $stmt_dosen->bind_param("i", $row['user_id']);
                    $stmt_dosen->execute();
                    $result_dosen = $stmt_dosen->get_result();

                    if ($result_dosen->num_rows > 0) {
                        $_SESSION['dosen_data'] = $result_dosen->fetch_assoc();
                    }

                    $stmt_dosen->close();
                    break;
                case 3: // Role Mahasiswa
                    $stmt_mahasiswa = $conn->prepare("SELECT * FROM mahasiswa WHERE user_id = ?");
                    $stmt_mahasiswa->bind_param("i", $row['user_id']);
                    $stmt_mahasiswa->execute();
                    $result_mahasiswa = $stmt_mahasiswa->get_result();

                    if ($result_mahasiswa->num_rows > 0) {
                        $_SESSION['mahasiswa_data'] = $result_mahasiswa->fetch_assoc();
                    }

                    $stmt_mahasiswa->close();
                    break;
                default:
                    // Role tidak dikenali
                    break;
            }

            // Arahkan ke halaman yang sesuai berdasarkan role_id
            switch ($row['role_id']) {
                case 1: // Role Admin
                    header("Location: ../admin/admin-beranda.php");
                    break;
                case 2: // Role Dosen
                    header("Location: ../dosen/dosen-beranda.php");
                    break;
                case 3: // Role Mahasiswa
                    header("Location: ../index.php");
                    break;
                default:
                    header("Location: ../index.php");
                    break;
            }
            exit;
        } else {
            // Jika password salah
            return [
                'status' => 'error',
                'message' => 'Password salah'
            ];
        }
    } else {
        // Jika login_id tidak ditemukan
        return [
            'status' => 'error',
            'message' => 'Pengguna tidak ditemukan'
        ];
    }

    // Menutup koneksi
    $stmt->close();
    $conn->close();
}


function register($login_id, $password, $role_id)
{
    // Mengambil koneksi database
    $conn = getConnection();

    // Cek apakah pengguna dengan login_id sudah ada
    $stmt = $conn->prepare("SELECT * FROM users WHERE login_id = ?");
    $stmt->bind_param("s", $login_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika login_id sudah terdaftar
        return [
            'status' => 'error',
            'message' => 'Login ID sudah digunakan'
        ];
    } else {
        // Hash password sebelum menyimpan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data pengguna baru ke tabel users
        $stmt = $conn->prepare("INSERT INTO users (login_id, password, role_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $login_id, $hashed_password, $role_id);

        if ($stmt->execute()) {
            // Mendapatkan user_id dari pengguna yang baru didaftarkan
            $user_id = $stmt->insert_id;

            // Insert tambahan ke tabel dosen jika role_id = 2
            if ($role_id == 2) {
                $stmt_dosen = $conn->prepare("INSERT INTO dosen (nip, user_id) VALUES (?, ?)");
                $stmt_dosen->bind_param("si", $login_id, $user_id);
                if (!$stmt_dosen->execute()) {
                    return [
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat menyimpan data dosen'
                    ];
                }
            }

            // Insert tambahan ke tabel mahasiswa jika role_id = 3
            if ($role_id == 3) {
                $stmt_mahasiswa = $conn->prepare("INSERT INTO mahasiswa (nim, user_id) VALUES (?, ?)");
                $stmt_mahasiswa->bind_param("si", $login_id, $user_id);
                if (!$stmt_mahasiswa->execute()) {
                    return [
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat menyimpan data mahasiswa'
                    ];
                }
            }

            // Jika pendaftaran dan insert ke tabel dosen atau mahasiswa berhasil
            return [
                'status' => 'success',
                'message' => 'Registrasi berhasil',
                'user_id' => $user_id // Mengembalikan ID pengguna yang baru saja didaftarkan
            ];
        } else {
            // Jika terjadi kesalahan saat memasukkan data ke tabel users
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat registrasi'
            ];
        }
    }

    // Menutup koneksi
    $stmt->close();
    $conn->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        // Login
        $response = login($_POST['id'], $_POST['password']);
        if ($response['status'] === 'success') {
            // Jika login berhasil, redirect ke dashboard
            $_SESSION['success_message'] = 'Login berhasil!';
            header("Location: " . $_SESSION['role_id'] . "../index.php");
        } else {
            // Jika login gagal, redirect ke halaman login dengan pesan error
            $_SESSION['error_message'] = $response['message'];
            header("Location: login.php");
        }

        exit;
    } elseif (isset($_POST['action']) && $_POST['action'] == 'register') {
        // Registrasi
        if (isset($_POST['id']) && isset($_POST['password']) && isset($_POST['role_id'])) {
            $response = register($_POST['id'], $_POST['password'], $_POST['role_id']);
            if ($response['status'] === 'success') {
                // Jika registrasi berhasil, redirect ke halaman login
                $_SESSION['success_message'] = 'Registrasi berhasil! Silakan login.';
                header("Location: login.php");
            } else {
                // Jika registrasi gagal, redirect ke halaman registrasi dengan pesan error
                $_SESSION['error_message'] = $response['message'];
                header("Location: register.php");
            }

            exit;
        } else {
            $_SESSION['error_message'] = 'Data registrasi tidak lengkap';
            header("Location: register.php");
            exit;
        }
    }
}
?>
