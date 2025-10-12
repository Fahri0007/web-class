<?php
$gallery = ['photo1.jpg', 'photo2.jpg', 'photo3.jpg'];

$org = [
  'wali' => 'Ismayani S.Pd',
  'ketua' => 'Aan Prayogi',
  'wakil' => 'Muhammad Fahri Rangkuti',
  'sekertaris' => 'Syahfika Nur Ramadani',
  'bendahara' => 'Reva Aulia',
  
];

$schedule = [
  ['subject' => 'Bahasa Inggris', 'time' => '07.00-08.40'],
  ['subject' => 'Sejarah', 'time' => '08.40-09.40'],
];
?>

<?php
date_default_timezone_set("Asia/Jakarta");
require 'vendor/autoload.php'; // library phpspreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

$filePath = __DIR__ . "/data/ROSTER AJARAN BARU 2025-2026.xlsx";
$spreadsheet = IOFactory::load($filePath);
$sheet = $spreadsheet->getActiveSheet();

// --- Atur lokasi kolom kelas XI RPL ---
$colKelas = 20; // kolom ke-20 (biasanya 'T' di Excel) = XI RPL
$jadwal = [];
$currentDay = '';
$hariMap = [
    "SENIN" => "Monday",
    "SELASA" => "Tuesday",
    "RABU" => "Wednesday",
    "KAMIS" => "Thursday",
    "JUMAT" => "Friday"
];

// Loop semua baris Excel
foreach ($sheet->getRowIterator() as $row) {
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    $cells = [];
    foreach ($cellIterator as $cell) {
        $cells[] = trim($cell->getValue());
    }

    // Cek apakah ini nama hari (contoh: "SENIN")
    if (!empty($cells[0]) && isset($hariMap[strtoupper($cells[0])])) {
        $currentDay = $hariMap[strtoupper($cells[0])];
        continue;
    }

    // Simpan jadwal jika hari sudah diketahui dan ada mapel di kolom XI RPL
    if ($currentDay && !empty($cells[$colKelas])) {
        $jam = !empty($cells[2]) ? $cells[2] : "-";
        $mapel = $cells[$colKelas];
        if (!in_array(strtoupper($mapel), ["ISOMA", "ISTIRAHAT", "UPACARA", "APEL PAGI"])) {
            $jadwal[$currentDay][] = [$jam, $mapel];
        }
    }
}

// Tentukan hari sekarang
$today = date('l');
$hari_indo = [
    "Monday" => "Senin",
    "Tuesday" => "Selasa",
    "Wednesday" => "Rabu",
    "Thursday" => "Kamis",
    "Friday" => "Jumat",
    "Saturday" => "Sabtu",
    "Sunday" => "Minggu"
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jadwal XI RPL</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Jadwal Pelajaran XI RPL</h1>
    <h2><?= $hari_indo[$today]; ?></h2>

    <?php if (isset($jadwal[$today])): ?>
    <table>
        <tr>
            <th>Jam</th>
            <th>Mata Pelajaran</th>
        </tr>
        <?php foreach($jadwal[$today] as $j): ?>
        <tr>
            <td><?= htmlspecialchars($j[0]); ?></td>
            <td><?= htmlspecialchars($j[1]); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>Tidak ada jadwal hari ini 🎉</p>
    <?php endif; ?>
</div>
</body>
</html>
