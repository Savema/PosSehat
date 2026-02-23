<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PosSehat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet" />
  <style>
    /* === Styles kamu yang lama dipertahankan === */
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9ff;
    }

    .btn-primary {
      background: linear-gradient(90deg, #ff5757, #ff5757);
      border: none;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #ff5757, #ff5757);
    }

    .hero-section {
      background-color: #fff7f2;
      height: 100vh;
      display: flex;
      align-items: center;
    }

    .hero-section img {
      max-width: 100%;
    }

    .section-title {
      font-weight: bold;
      color: #27304b;
    }

    .service-card {
      border-radius: 16px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }

    .footer {
      background-color: #d47c64;
      color: #fff;
      padding: 40px 0;
    }

    .footer a {
      color: #fff;
      text-decoration: none;
    }

    .footer a:hover {
      color: #fff;
    }

    .circle-background {
      position: absolute;
      top: 30%;
      left: 10%;
      width: 250px;
      height: 250px;
      background: #ffeadc(173, 216, 230, 0.2);
      border-radius: 50%;
      animation: expandCircle 3s ease-in-out infinite;
    }

    @keyframes expandCircle {
      0% {
        width: 250px;
        height: 250px;
      }

      50% {
        width: 300px;
        height: 300px;
      }

      100% {
        width: 250px;
        height: 250px;
      }
    }

    .gradient-icon {
      background: linear-gradient(90deg, #ff5757, #ff5757);
      /* -webkit-background-clip: text; */
      -webkit-text-fill-color: transparent;
    }

    .fade-left,
    .fade-right,
    .fade-up {
      opacity: 0;
      transition: opacity 1s ease-out;
    }

    .fade-left.animate__fadeInLeft {
      animation: fadeInLeft 1s forwards;
    }

    .fade-right.animate__fadeInRight {
      animation: fadeInRight 1s forwards;
    }

    .fade-up.animate__fadeInUp {
      animation: fadeInUp 1s forwards;
    }

    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .shadow-card {
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
      height: 300px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .shadow-card:hover {
      box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.15);
      transform: translateY(-5px);
      transition: all 0.3s ease-in-out;
    }

    .navbar-brand {
  font-weight: bold;
  font-size: 1.5rem;
  color: #ff5757;
}

.navbar-brand span {
  color: #00bcd4;
}

.nav-link {
  font-weight: 500;
  color: #333;
}

.nav-link:hover {
  color: #5e79ff;
}

  </style>
</head>

<body>
  <!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/">PosSehat<span></span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#fiturutama">Fitur</a></li>
        <li class="nav-item"><a class="nav-link" href="#footer">Kontak</a></li>
        <li class="nav-item"><a class="btn btn-primary rounded-pill px-4 ms-3" href="/login">Login</a></li>
      </ul>
    </div>
  </div>
</nav>


  <!-- Hero Section -->
  <section class="hero-section pt-5">
    <div class="container pt-5">
      <div class="row align-items-center pt-5">
        <div class="col-md-6 fade-left">
          <h1 class="mb-3 display-5 fw-bold text-dark">Sistem Informasi yang Mendukung Kegiatan Posyandu</h1>
          <p class="lead text-dark mb-4">Gunakan Teknologi untuk Meningkatkan Pendataan dan Pelayanan Posyandu Secara Efisien dan Terintegrasi.</p>
        </div>
        <div class="col-md-6 text-center fade-right">
          <div class="image-container position-relative">
            <img src="assets/img/posyandu.png" alt="Anak" class="img-fluid animated fadeInUp" style="animation-delay: 1.5s;">
            <div class="circle-background"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Fitur -->
 <section class="py-5" id="fiturutama">
  <div class="container">
    <h3 class="section-title text-center mb-5 display-6 fade-up">Fitur Utama</h3>
    <div class="row g-5">

      <!-- Fitur 1 -->
      <div class="col-md-4 fade-left">
        <div class="service-card text-center h-100 p-4">
          <div class="mb-4">
            <i class="fas fa-chart-line fa-3x gradient-icon"></i>
          </div>
          <h5 class="fw-bold mb-3">Pencatatan Data Balita</h5>
          <p class="text-muted">Catat informasi balita dengan cepat, mulai dari identitas hingga status pertumbuhannya.</p>
        </div>
      </div>

      <!-- Fitur 2 -->
      <div class="col-md-4 fade-up">
        <div class="service-card text-center h-100 p-4">
          <div class="mb-4">
            <i class="fas fa-book-open fa-3x gradient-icon"></i>
          </div>
          <h5 class="fw-bold mb-3">Deteksi Stunting</h5>
          <p class="text-muted">Lakukan deteksi stunting berdasarkan data berat, tinggi, dan usia balita secara otomatis.</p>
        </div>
      </div>

      <!-- Fitur 3 -->
      <div class="col-md-4 fade-right">
        <div class="service-card text-center h-100 p-4">
          <div class="mb-4">
            <i class="fas fa-hospital-alt fa-3x gradient-icon"></i>
          </div>
          <h5 class="fw-bold mb-3">Pencatatan Ibu Hamil</h5>
          <p class="text-muted">Pantau kondisi ibu hamil dengan pencatatan kehamilan secara sistematis dan rapi.</p>
        </div>
      </div>

    </div>
  </div>
</section>


  <!-- Footer -->
  <footer class="footer" id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>PosSehat<span class="text-info">.</span></h5>
          <p>Perum Villa Kembang Asri Sukowiryo, Kec. Bondowoso, Kabupaten Bondowoso, Jawa Timur 68219</p>
          <div>
            <a href="#"><i class="fab fa-facebook-f me-3"></i></a>
            <a href="#"><i class="fab fa-instagram me-3"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
        <div class="col-md-2">
          <h6>Informasi</h6>
          <ul class="list-unstyled">
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Pusat Bantuan</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6>Wilayah Layanan</h6>
          <p>Bondowoso, Jawa Timur</p>
        </div>
        <div class="col-md-3">
          <h6>Kontak</h6>
          <p>+6285646546543<br>info@possehat.id<br>Telp: +6285331904446</p>
        </div>
      </div>
      <div class="text-center mt-4">
        <small>&copy; PosSehat 2026</small>
      </div>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Scroll animation handler
    const addFadeInClass = (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const section = entry.target;
          if (section.classList.contains('fade-left')) {
            section.classList.add('animate__fadeInLeft');
          } else if (section.classList.contains('fade-right')) {
            section.classList.add('animate__fadeInRight');
          } else if (section.classList.contains('fade-up')) {
            section.classList.add('animate__fadeInUp');
          }
          observer.unobserve(section);
        }
      });
    };

    const observer = new IntersectionObserver(addFadeInClass, { threshold: 0.5 });
    document.querySelectorAll('.fade-left, .fade-right, .fade-up').forEach(el => observer.observe(el));
  </script>
</body>

</html>
