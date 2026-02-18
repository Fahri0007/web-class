<?php
require __DIR__ . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

date_default_timezone_set('Asia/Jakarta');

// Lokasi file Excel
$path = __DIR__ . '/data/jadwal.xlsx';
if (!file_exists($path)) {
    die("<h2>⚠️ File Excel tidak ditemukan di: data/jadwal.xlsx</h2>");
}

// Buka Excel
$spreadsheet = IOFactory::load($path);
$sheet = $spreadsheet->getActiveSheet();

$highestCol = $sheet->getHighestColumn();
$highestColIndex = Coordinate::columnIndexFromString($highestCol);
$highestRow = $sheet->getHighestRow();

$daysIndo = ['SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU','MINGGU'];

// Cari kolom hari
$dayCol = null;
for ($c = 1; $c <= $highestColIndex; $c++) {
    for ($r = 1; $r <= 20; $r++) {
        $val = strtoupper(trim((string)$sheet->getCell(Coordinate::stringFromColumnIndex($c) . $r)->getValue()));
        if ($val === '') continue;
        foreach ($daysIndo as $day) {
            if (stripos($val, $day) !== false) {
                $dayCol = $c;
                break 2;
            }
        }
    }
}
if (!$dayCol) $dayCol = 1;

// Cari kolom XI RPL
$xiCol = null;
for ($c = 1; $c <= $highestColIndex; $c++) {
    for ($r = 1; $r <= 10; $r++) {
        $val = strtoupper(trim((string)$sheet->getCell(Coordinate::stringFromColumnIndex($c) . $r)->getValue()));
        if (stripos($val, 'XI') !== false && stripos($val, 'RPL') !== false) {
            $xiCol = $c;
            break 2;
        }
    }
}
if (!$xiCol) {
    die("<h3 style='color:red'>Kolom XI RPL tidak ditemukan. Pastikan nama kolom di Excel mengandung 'XI RPL'.</h3>");
}

// Cari kolom jam
$timeCol = null;
for ($c = 1; $c <= $highestColIndex; $c++) {
    for ($r = 1; $r <= 15; $r++) {
        $val = strtoupper(trim((string)$sheet->getCell(Coordinate::stringFromColumnIndex($c) . $r)->getValue()));
        if (stripos($val, 'JAM') !== false || stripos($val, 'WAKTU') !== false || preg_match('/\d{1,2}[:\.]\d{2}/', $val)) {
            $timeCol = $c;
            break 2;
        }
    }
}
if (!$timeCol) $timeCol = 2;

$mapDays = [
    'SENIN' => 'Monday',
    'SELASA' => 'Tuesday',
    'RABU' => 'Wednesday',
    'KAMIS' => 'Thursday',
    'JUMAT' => 'Friday',
    'SABTU' => 'Saturday',
    'MINGGU' => 'Sunday'
];

$rowsByDay = [];
$currentDayEng = null;

for ($r = 1; $r <= $highestRow; $r++) {
    $dayVal = strtoupper(trim((string)$sheet->getCell(Coordinate::stringFromColumnIndex($dayCol) . $r)->getValue()));
    if ($dayVal !== '') {
        foreach ($mapDays as $indo => $eng) {
            if (stripos($dayVal, $indo) !== false) {
                $currentDayEng = $eng;
                continue 2;
            }
        }
    }

    if ($currentDayEng) {
        $subject = trim((string)$sheet->getCell(Coordinate::stringFromColumnIndex($xiCol) . $r)->getValue());
        if ($subject === '') continue;

        $skipWords = ['ISOMA','ISTIRAHAT','UPACARA','APEL'];
        $skip = false;
        foreach ($skipWords as $sw) {
            if (stripos(strtoupper($subject), $sw) !== false) { $skip = true; break; }
        }
        if ($skip) continue;

        $time = trim((string)$sheet->getCell(Coordinate::stringFromColumnIndex($timeCol) . $r)->getValue());
        $teacher = '';
        for ($c = $xiCol + 1; $c <= min($xiCol + 3, $highestColIndex); $c++) {
            $t = trim((string)$sheet->getCell(Coordinate::stringFromColumnIndex($c) . $r)->getValue());
            if ($t !== '') { $teacher = $t; break; }
        }

        $rowsByDay[$currentDayEng][] = [
            'time' => $time,
            'subject' => $subject,
            'teacher' => $teacher
        ];
    }
}

$todayEng = date('l');
$hariIndo = array_search($todayEng, $mapDays);
if (!$hariIndo) $hariIndo = 'Hari Ini';
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Jadwal XI RPL | SMKN 1 Galang</title>
<link rel="icon" href="assets/img/profil.jpg">
<style>
body {font-family: "Poppins", sans-serif;background: #1c1c1c;color: #eee;margin:0;padding:0;}
nav{background:#111;color:white;padding:15px;display:flex;justify-content:center;flex-wrap:wrap;gap:25px;}
nav a{color:#ddd;text-decoration:none;font-size:16px;transition:0.3s;}
nav a:hover{color:#00bcd4;}
header{text-align:center;margin:30px 10px;}
header h1{font-size:28px;color:#00bcd4;animation:fadeIn 1.5s ease;}
header p{color:#ccc;font-size:18px;}
#clock{font-size:20px;margin-top:25px;color:#00bcd4;letter-spacing:2px;font-weight:bold;}
@keyframes fadeIn{from{opacity:0;transform:translateY(-10px);}to{opacity:1;transform:translateY(0);}}
main{max-width:800px;margin:0 auto;background:#2b2b2b;padding:25px;border-radius:12px;box-shadow:0 3px 8px rgba(0,0,0,0.6);}
h2{color:#00bcd4;text-align:center;margin-bottom:15px;animation:fadeIn 1.5s ease;}
table{width:100%;border-collapse:collapse;margin-top:10px;font-size:15px;}
th,td{border:1px solid #444;padding:10px;text-align:center;}
th{background:#00bcd4;color:black;}
tr:nth-child(even){background:#333;}
.today{color:#00bcd4;font-weight:bold;}
.hari-spesial{color:#f7c259;font-weight:bold;}
td .tooltip{display:none;position:absolute;top:5px;left:50%;transform:translateX(-50%);background:#333;color:white;padding:3px 6px;border-radius:5px;font-size:12px;white-space:nowrap;}
td:hover .tooltip{display:block;}
footer{background:#1a1a1a;color:#999;text-align:center;padding:15px;margin-top:50px;font-size:14px;border-top:1px solid #333;}
@media(max-width:600px){td{height:50px;font-size:12px}h2{font-size:20px}}
</style>
</head>
<body>

<nav>
<a href="index.php">Beranda</a>
<a href="schedule.php">Mapel</a>
<a href="gallery.php">Galeri</a>
<a href="contact.php">Pesan</a>
</nav>

<header>
<h1>Jadwal XI RPL</h1>
<p>SMK Negeri 1 Galang </p>
<div id="clock">--:--:--</div>
</header>

<main>
<h2>Jadwal Hari <?= htmlentities(ucfirst(strtolower($hariIndo))) ?></h2>

<?php if (!isset($rowsByDay[$todayEng]) || count($rowsByDay[$todayEng]) === 0): ?>
<p style="text-align:center; color:#ff7777;">Jangan Kerajinan, Lagi Gak Ada Jadwal Hari Ini!!</p>
<?php else: ?>
<table>
<thead>
<tr><th>No</th><th>Jam</th><th>Mata Pelajaran</th><th>Guru</th></tr>
</thead>
<tbody>
<?php $no=1; foreach ($rowsByDay[$todayEng] as $row): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= htmlentities($row['time']) ?></td>
<td><?= htmlentities($row['subject']) ?></td>
<td><?= htmlentities($row['teacher']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
<?php
$calMonth = date("n");
$calYear = date("Y");
$todayDay = date("j");
$bulan_indonesia = [1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$jml_hari = cal_days_in_month(CAL_GREGORIAN,$calMonth,$calYear);
$first_day = date("w",strtotime("$calYear-$calMonth-1"));

$all_hari_spesial = [
    '2025-11-10'=>'Hari Pahlawan',
    '2025-11-25'=>'Hari Guru Nasional',
    '2025-12-24'=>'Malam Natal',
    '2025-12-25'=>'Hari Natal',
    '2025-12-31'=>'Malam Tahun Baru'
];

$hari_spesial = [];
foreach($all_hari_spesial as $tgl=>$ket){
    $parts = explode('-',$tgl);
    if((int)$parts[0]==$calYear && (int)$parts[1]==$calMonth) 
        $hari_spesial[(int)$parts[2]] = $ket;
}
?>

<h2>Kalender <?= $bulan_indonesia[$calMonth] ?> <?= $calYear ?></h2>
<table>
<tr>
<?php
$hari_seminggu = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
foreach($hari_seminggu as $h) echo "<th>$h</th>";
echo "</tr><tr>";
for($i=0;$i<$first_day;$i++) echo "<td></td>";
for($d=1;$d<=$jml_hari;$d++){
    $cls='';
    if(isset($hari_spesial[$d])) $cls='hari-spesial';
    elseif($d==$todayDay) $cls='today';
    echo "<td class='$cls'>$d";
    if(isset($hari_spesial[$d])) echo "<div class='tooltip'>{$hari_spesial[$d]}</div>";
    echo "</td>";
    if(($d+$first_day)%7==0) echo "</tr><tr>";
}
echo "</tr>";
?>
</table>
</main>
<footer>
© 2025 XI RPL | SMK Negeri 1 Galang
</footer>

<script>
function updateClock(){
  const now = new Date();
  document.getElementById('clock').textContent = 
    now.toLocaleTimeString('id-ID',{hour12:false});
}
setInterval(updateClock,1000);
updateClock();
</script>

</body>
</html>
