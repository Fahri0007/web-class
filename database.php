<?php
$servername = "sql109.infinityfree.com";
$username = "if0_40150614";
$password = "xirplkece"; 
$dbname = "if0_40150614_classxirpl";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("❌ Koneksi gagal: " . $conn->connect_error);
} else {
     //echo "✅ Koneksi berhasil!"; // aktifkan ini kalau mau tes koneksi
}
?>
