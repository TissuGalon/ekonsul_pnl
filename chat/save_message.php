<?php
require_once '../controller/koneksi.php';
$conn = getConnection();
session_start();

$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$message = $_POST['message'] ?? null;
$document = null;

if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
    $upload_dir = '../media/chat_uploads/';
    $document = time() . '_' . basename($_FILES['document']['name']);
    move_uploaded_file($_FILES['document']['tmp_name'], $upload_dir . $document);
}

$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message, document) VALUES (?, ?, ?, ?)");
$stmt->bind_param('iiss', $sender_id, $receiver_id, $message, $document);

if ($stmt->execute()) {
    echo "Message saved!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
