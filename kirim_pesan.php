<?php
require 'database.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = trim($_POST['text']);

    if (empty($text)) {
        echo json_encode(['status' => 'error', 'message' => 'Pesan tidak boleh kosong!']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO pesan (text, waktu) VALUES (?, NOW())");
    $stmt->bind_param("s", $text);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dikirim!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengirim pesan.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan!']);
}
?>
