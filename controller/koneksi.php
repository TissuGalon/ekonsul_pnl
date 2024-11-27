<?php
function getConnection()
{
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'konsultasi_mhs2';

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    return $conn;
}
?>
