<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pesan Anonim | XI RPL</title>
<link rel="icon" href="assets/img/profil.jpg">
<meta name="theme-color" content="#7952b3">
<style>
  body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #121212, #1e1e1e);
    color: #f5f5f5;
    margin: 0;
    padding: 0;
  }
  nav {
    background: #1a1a1a;
    display: flex;
    justify-content: center;
    gap: 35px;
    padding: 15px 0;
    box-shadow: 0 2px 8px rgba(255,255,255,0.05);
  }
  nav a {
    color: #f5f5f5;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
    transition: 0.3s;
  }
  nav a:hover {
    color: #00bcd4;
    transform: scale(1.1);
  }
  header {
    text-align: center;
    margin-top: 40px;
  }
  header h1 {
    font-size: 36px;
    color: #00bcd4;
    text-shadow: 0 0 10px rgba(0,188,212,0.6);
    animation: fadeSlideIn 1.5s ease;
  }
  main {
    max-width: 700px;
    margin: 40px auto;
    background: #1f1f1f;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.5);
  }
  textarea {
    width: 100%;
    height: 120px;
    border: none;
    border-radius: 8px;
    padding: 10px;
    font-family: inherit;
    resize: none;
    background: #2a2a2a;
    color: white;
    font-size: 15px;
  }
  button {
    background: #00bcd4;
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 8px;
    margin-top: 15px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
  }
  button:hover {
    background: #0097a7;
    transform: scale(1.05);
  }
  .messages {
    margin-top: 30px;
    overflow-x: auto;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: #2a2a2a;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.5);
  }
  th, td {
    border-bottom: 1px solid #444;
    padding: 12px 15px;
    text-align: left;
    color: #f5f5f5;
  }
  th {
    background: #00bcd4;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  tr:hover {
    background: #333;
    transition: 0.3s;
  }
  .alert {
    background: #b71c1c;
    padding: 10px;
    border-radius: 6px;
    color: #fff;
    text-align: center;
    margin-bottom: 10px;
  }
  footer {
    background: #1a1a1a;
    color: #999;
    text-align: center;
    padding: 15px;
    margin-top: 50px;
    font-size: 14px;
    border-top: 1px solid #333;
  }
  @keyframes fadeSlideIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @media (max-width: 600px) {
    th, td { font-size: 13px; padding: 10px; }
  }
  .hapus-btn {
    background: #c62828;
    border: none;
    padding: 5px 10px;
    border-radius: 6px;
    color: white;
    cursor: pointer;
    font-size: 13px;
  }
  .hapus-btn:hover {
    background: #ff5252;
  }
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
  <h1>Pesan Anonim Untuk XI RPL </h1>
  <p>Kirim pesan, saran, atau kata semangat untuk kami!</p>
</header>

<main>
  <div id="alertBox"></div>

  <textarea id="messageInput" placeholder="Tulis pesanmu di sini..."></textarea>
  <button onclick="kirimPesan()">Kirim</button>

  <div style="margin-top:20px;">
    <input type="password" id="operatorKey" placeholder="Khusus Operator..." style="width:100%;padding:10px;border:none;border-radius:8px;background:#2a2a2a;color:white;">
    <button onclick="cekOperator()">Masuk sebagai Operator</button>
  </div>

  <div class="messages">
    <table id="messageTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Pesan</th>
          <th>Waktu</th>
          <th id="aksiHeader" style="display:none;">Aksi</th>
        </tr>
      </thead>
      <tbody id="messageBody">
      </tbody>
    </table>
  </div>
</main>

<footer>
  © 2025 XI RPL | SMK Negeri 1 Galang
</footer>

<script>
const forbiddenWords = ["anjing","bangsat","goblok","bodoh","kontol","memek","tolol","babi","ai","anj","caper","kntl","ktl","ppk","bangga"];
const input = document.getElementById("messageInput");
const messageBody = document.getElementById("messageBody");
const alertBox = document.getElementById("alertBox");
const operatorKey = document.getElementById("operatorKey");
const aksiHeader = document.getElementById("aksiHeader");
let operatorMode = false;

function fetchMessages() {
  fetch('ambil_pesan.php')
    .then(res => res.json())
    .then(data => {
      messageBody.innerHTML = "";
      data.forEach((msg,index) => {
        const row = document.createElement("tr");
       // Ambil tanggal dan jam
const dateObj = new Date(msg.waktu);
const tanggal = dateObj.toLocaleDateString('id-ID'); // format: 12/10/2025
const jam = dateObj.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'});

row.innerHTML = `
  <td>${index+1}</td>
  <td>${msg.text}</td>
  <td>${tanggal} ${jam}</td>
  ${operatorMode ? `<td><button class='hapus-btn' onclick='hapusPesan(${msg.id})'>Hapus</button></td>` : ""}
`;

        messageBody.appendChild(row);
      });
      aksiHeader.style.display = operatorMode ? "table-cell" : "none";
    });
}

function kirimPesan() {
  const text = input.value.trim();
  if(!text){ tampilkanAlert("⚠️ Pesan tidak boleh kosong!"); return; }
  for(let word of forbiddenWords){
    const regex = new RegExp("\\b"+word+"\\b","i");
    if(regex.test(text)){
      tampilkanAlert("Yhaha panas ya...??!!!! Kalo Iri Gausah Toxic!!");
      return;
    }
  }
  fetch('kirim_pesan.php',{
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:'text='+encodeURIComponent(text)
  })
  .then(res=>res.json())
  .then(data=>{
    if(data.status==='success'){
      input.value="";
      tampilkanAlert(data.message,true);
      fetchMessages();
    }else{
      tampilkanAlert(data.message);
    }
  });
}

function hapusPesan(id){
  if(confirm("Yakin ingin menghapus pesan ini?")){
    fetch('hapus_pesan.php',{
      method:'POST',
      headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body:'id='+id
    })
    .then(()=>fetchMessages());
  }
}

function cekOperator(){
  const kode = operatorKey.value.trim();
  if(kode==="dodoy07"){
    operatorMode=true;
    tampilkanAlert("Mode operator aktif. Tombol hapus muncul.",true);
    fetchMessages();
  }else{
    tampilkanAlert("Kode operator salah!!!");
  }
}

function tampilkanAlert(pesan,success=false){
  alertBox.innerHTML=`<div class="alert" style="background:${success?'#2e7d32':'#b71c1c'};">${pesan}</div>`;
  setTimeout(()=>alertBox.innerHTML="",3000);
}

fetchMessages();
</script>

</body>
</html>
