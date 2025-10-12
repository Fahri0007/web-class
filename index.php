<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Beranda | Kelas XI RPL</title>
 <link rel="icon" href="assets/img/profil.jpg">
  <meta name="theme-color" content="#7952b3">
<style>
  body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #121212, #1e1e1e);
    color: #f5f5f5;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
  }

  nav {
    background: #1a1a1a;
    color: white;
    display: flex;
    justify-content: center;
    gap: 35px;
    padding: 15px 0;
    box-shadow: 0 2px 8px rgba(255,255,255,0.05);
    position: sticky;
    top: 0;
    z-index: 999;
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
    padding: 90px 20px 70px;
    position: relative;
  }

  header::after {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    width: 300px;
    height: 300px;
    transform: translateX(-50%);
    background: radial-gradient(circle, rgba(0,188,212,0.2), transparent 70%);
    z-index: -1;
  }

  .profile-img {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #00bcd4;
    box-shadow: 0 0 25px rgba(0,188,212,0.5);
    margin-bottom: 25px;
    opacity: 0;
    animation: fadeSlideIn 1.5s ease forwards;
  }

  h1 {
    font-size: 42px;
    margin: 0;
    letter-spacing: 2px;
    color: #00bcd4;
    text-shadow: 0 0 10px rgba(0,188,212,0.6);
    opacity: 0;
    animation: fadeSlideIn 2s ease forwards;
    animation-delay: 0.3s;
  }

  h2 {
    font-size: 30px;
    margin-top: 20px;
    color: #00bcd4;
    letter-spacing: 1px;
    opacity: 0;
    animation: fadeSlideIn 2s ease forwards;
    animation-delay: 0.8s;
  }

  #clock {
    font-size: 20px;
    margin-top: 25px;
    color: #00bcd4;
    letter-spacing: 2px;
    font-weight: bold;
  }

  main {
    max-width: 900px;
    margin: 40px auto;
    background: #1f1f1f;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.5);
    line-height: 1.8;
  }
  main h3 {
    color: #00bcd4;
    margin-bottom: 15px;
  }
  main p {
    color: #d0d0d0;
    font-size: 16px;
  }

  .info-kelas {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-top: 30px;
  }
  .card {
    background: #2a2a2a;
    padding: 15px;
    border-radius: 10px;
    width: 150px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.4);
    transition: 0.3s;
  }
  .card:hover {
    transform: scale(1.05);
    background: #333;
  }
  .card h4 {
    margin-bottom: 8px;
    color: #00bcd4;
  }
  .card p {
    font-size: 14px;
    color: #d0d0d0;
  }

  /* 🏫 Alamat Sekolah */
  .alamat {
    margin-top: 50px;
    text-align: center;
    animation: zoomIn 1s ease;
  }
  .alamat h3 {
    color: #00bcd4;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }
  .alamat h3::before {
    content: "📍";
    font-size: 20px;
  }
  .alamat p {
    color: #d0d0d0;
    font-size: 16px;
    margin-bottom: 20px;
  }
  .alamat iframe {
    width: 100%;
    height: 300px;
    border: 2px solid #00bcd4;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,188,212,0.3);
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
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes zoomIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
  }

  @media (max-width: 600px) {
    h1 { font-size: 28px; }
    h2 { font-size: 20px; }
    .card { width: 45%; }
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
  <img src="assets/img/profil.jpg" alt="Foto Profil Kelas XI RPL" class="profile-img">
  <h1>Selamat Datang di Kelas XI RPL</h1>
  <h2>Rekayasa Perangkat Lunak</h2>
  <div id="clock">--:--:--</div>
</header>

<main>
  <h3>Tentang Kelas Kami</h3>
  <p>Kami adalah Angkatan Pertama jurusan Rekayasa Perangkat Lunak di SMK Negeri 1 Galang, 
  pelopor dunia teknologi di sekolah ini. Kami berkomitmen untuk membangun semangat belajar, kolaborasi, 
  dan kreativitas dalam bidang pemrograman, pengembangan web, serta inovasi digital modern.</p>

  <div class="info-kelas">
    <div class="card">
      <h4>Kepala Sekolah</h4>
      <p>Manuntun Manurung, S.Pd S.Kom</p>
    </div>
    <div class="card">
      <h4>Wali Kelas</h4>
      <p>Ibu Ismayani, S.Pd</p>
    </div>
    <div class="card">
      <h4>Ketua Kelas</h4>
      <p>Aan Prayogi</p>
    </div>
    <div class="card">
      <h4>Wakil Ketua</h4>
      <p>Muhammad Fahri Rangkuti</p>
    </div>
    <div class="card">
      <h4>Sekretaris</h4>
      <p>Syahfiqa Nur Ramadani</p>
    </div>
    <div class="card">
      <h4>Bendahara</h4>
      <p>Reva Aulia</p>
    </div>
  </div>

  <div class="alamat">
    <h3>Alamat Sekolah Kami</h3>
    <p>SMK Negeri 1 Galang<br>
    Jl. Pendidikan No. 15, Galang Kota, Kabupaten Deli Serdang, Sumatera Utara</p>
    
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.466442436661!2d98.92208747439407!3d3.462982696514819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303125dd3f0d8f77%3A0x66b0c94a2b4d26d7!2sSMK%20Negeri%201%20Galang!5e0!3m2!1sid!2sid!4v1728202786321!5m2!1sid!2sid"
      allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>

</main>

<footer>
  © 2025 XI RPL | SMK Negeri 1 Galang
</footer>

<script>
function updateClock() {
  const now = new Date();
  document.getElementById('clock').textContent = 
    now.toLocaleTimeString('id-ID', { hour12: false });
}
setInterval(updateClock, 1000);
updateClock();
</script>

</body>
</html>
