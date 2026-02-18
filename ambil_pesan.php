<?php
require 'database.php';
header('Content-Type: application/json');

$result = $conn->query("SELECT id, text, waktu FROM pesan ORDER BY id DESC");
$pesan = [];

while ($row = $result->fetch_assoc()) {
    $pesan[] = $row;
}

echo json_encode($pesan);
$conn->close();
?>
