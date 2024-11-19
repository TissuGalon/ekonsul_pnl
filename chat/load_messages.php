<?php
require_once '../controller/koneksi.php';
$conn = getConnection();
session_start();

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];


$sql = "SELECT * FROM messages 
        WHERE (sender_id = $sender_id AND receiver_id = $receiver_id) 
           OR (sender_id = $receiver_id AND receiver_id = $sender_id) 
        ORDER BY timestamp ASC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $msg = $row['message'] ? htmlspecialchars($row['message']) : '';
    $doc = $row['document'] ? "<a href='uploads/{$row['document']}' target='_blank'>[Document]</a>" : '';
    echo "<p><strong>User {$row['sender_id']}:</strong> $msg $doc <span class='text-muted' style='font-size: 0.8em;'>[{$row['timestamp']}]</span></p>";
}

$conn->close();
?>
