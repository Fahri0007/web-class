<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Momen & Kegiatan | XI RPL</title>
  <link rel="icon" href="assets/img/profil.jpg">
  <meta name="theme-color" content="#7952b3">
  <style>
    body {
      background-color: #121212;
      color: #f5f5f5;
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      text-align: center;
      background: #1f1f1f;
      padding: 25px 10px;
      border-bottom: 2px solid #333;
      box-shadow: 0 2px 8px rgba(255,255,255,0.05);
    }

    header h1 {
      font-size: 30px;
      margin: 0;
      color: #00bcd4;
      animation: fadeSlideIn 1.5s ease;
    }

    nav {
      background: #1a1a1a;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 25px;
      padding: 15px 0;
      position: sticky;
      top: 0;
      z-index: 10;
      box-shadow: 0 2px 5px rgba(0,0,0,0.5);
    }

    nav a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      font-size: 15px;
      transition: 0.3s;
      padding: 6px 12px;
      border-radius: 5px;
    }

    nav a:hover {
      color: #00bcd4;
      background: #333;
      transform: scale(1.05);
    }

    .container {
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 20px;
    }

    .section-title {
      text-align: center;
      font-size: 26px;
      color: #00bcd4;
      margin-bottom: 30px;
      animation: fadeIn 1.2s ease;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      animation: fadeInUp 1.2s ease;
    }

    .gallery-item {
      position: relative;
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.5);
      transition: 0.4s;
      cursor: pointer;
    }

    .gallery-item img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: 0.4s;
      border-radius: 10px;
    }

    .gallery-item:hover img {
      transform: scale(1.1);
      filter: brightness(80%);
    }

    .caption {
      position: absolute;
      bottom: 0;
      background: rgba(0,0,0,0.7);
      color: #00bcd4;
      width: 100%;
      text-align: center;
      padding: 10px 0;
      opacity: 0;
      transition: 0.4s;
      font-weight: 500;
      letter-spacing: 0.5px;
      border-radius: 0 0 10px 10px;
    }

    .gallery-item:hover .caption {
      opacity: 1;
    }

    footer {
      background: #1a1a1a;
      color: #999;
      text-align: center;
      padding: 15px;
      margin-top: 40px;
      font-size: 14px;
      border-top: 1px solid #333;
    }

    /* Lightbox (popup gambar) */
    .lightbox {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.9);
      justify-content: center;
      align-items: center;
      z-index: 999;
      animation: fadeIn 0.4s ease;
    }

    .lightbox img {
      max-width: 90%;
      max-height: 80%;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,188,212,0.6);
    }

    .close-btn {
      position: absolute;
      top: 25px;
      right: 35px;
      color: #00bcd4;
      font-size: 36px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    .close-btn:hover {
      color: #fff;
    }

    /* Tambahan penting agar popup bisa muncul */
    .lightbox:target {
      display: flex;
    }

    @keyframes fadeSlideIn {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 600px) {
      header h1 { font-size: 22px; }
      .section-title { font-size: 20px; }
      .lightbox img { max-width: 95%; }
    }
  </style>
</head>
<body>

  <nav>
    <a href="index.php">Beranda</a>
    <a href="schedule.php">Mapel</a>
    <a href="gallery.php" style="color:#00bcd4;">Galeri</a>
    <a href="contact.php">Pesan</a>
  </nav>

  <header>
    <h1>Galeri & Kegiatan XI RPL</h1>
  </header>

  <div class="container">

    <div class="gallery">
      <a href="#img1" class="gallery-item">
        <img src="assets/img/kegiatan1.jpg" alt="Kegiatan 1">
        <div class="caption">Pelaksanaan P5 v2</div>
      </a>

      <a href="#img2" class="gallery-item">
        <img src="assets/img/kegiatan2.jpg" alt="Kegiatan 2">
        <div class="caption">DiKolam</div>
      </a>

      <a href="#img3" class="gallery-item">
        <img src="assets/img/kegiatan3.jpg" alt="Kegiatan 3">
        <div class="caption">Pelaksaan 17an</div>
      </a>

      <a href="#img4" class="gallery-item">
        <img src="assets/img/kegiatan4.jpg" alt="Kegiatan 4">
        <div class="caption">Bakar-Bakar</div>
      </a>

      <a href="#img5" class="gallery-item">
        <img src="assets/img/kegiatan5.jpg" alt="Kegiatan 5">
        <div class="caption">Pelaksaan P5</div>
      </a>

      <a href="#img6" class="gallery-item">
        <img src="assets/img/kegiatan6.jpg" alt="Kegiatan 6">
        <div class="caption">Nonton Film</div>
      </a>

      <a href="#img7" class="gallery-item">
        <img src="assets/img/kegiatan7.jpg" alt="Kegiatan 7">
        <div class="caption">Gabut</div>
      </a>

      <a href="#img8" class="gallery-item">
        <img src="assets/img/kegiatan8.jpg" alt="Kegiatan 8">
        <div class="caption">Bukber</div>
      </a>

      <a href="#img9" class="gallery-item">
        <img src="assets/img/kegiatann.jpg" alt="Kegiatan 9">
        <div class="caption">Paskib</div>
      </a>

      <a href="#img10" class="gallery-item">
        <img src="assets/img/kegiatan0.jpg" alt="Kegiatan 0">
        <div class="caption">Esbuah</div>
      </a>

      <a href="#img11" class="gallery-item">
        <img src="assets/img/kegiatan.jpg" alt="Kegiatan ">
        <div class="caption">Maulid</div>

      <a href="#img12" class="gallery-item">
        <img src="assets/img/pemuda.jpg" alt="Kegiatan ">
        <div class="caption">Sumpah Pemuda</div>
    </div>
  </div>

  <!-- Lightbox popup -->
  <div id="img1" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan1.jpg" alt="Pelaksanaan P5">
  </div>

  <div id="img2" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan2.jpg" alt="Belajar Pemrograman Web">
  </div>

  <div id="img3" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan3.jpg" alt="Gotong Royong Kelas">
  </div>

  <div id="img4" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan4.jpg" alt="Proyek Aplikasi Pertama">
  </div>

  <div id="img5" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan5.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <div id="img6" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan6.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <div id="img7" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan7.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <div id="img8" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan8.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <div id="img9" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatann.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <div id="img10" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan0.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <div id="img11" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/kegiatan.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <div id="img12" class="lightbox">
    <a href="#" class="close-btn">&times;</a>
    <img src="assets/img/pemuda.jpg" alt="Foto Bersama Angkatan Pertama">
  </div>

  <footer>
    © 2025 XI RPL | SMK Negeri 1 Galang
  </footer>

</body>
</html>
