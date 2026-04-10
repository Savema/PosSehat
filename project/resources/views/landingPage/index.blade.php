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
        html {
        scroll-behavior: smooth;
        }
        
        body {
        font-family: 'Poppins', 'Segoe UI', sans-serif; /* Poppins terasa lebih modern */
        background-color: #ffffff;
        overflow-x: hidden;
        }

        section {
        scroll-margin-top: 100px;
        }

        /* Warna Utama: Oranye PosSehat */
        .btn-primary {
        background: #FF782D;
        border: none;
        transition: all 0.3s ease;
        }

        .btn-primary:hover {
        background: #e66a25;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 120, 45, 0.3);
        }

        .hero-section {
        background-color: #fffaf7; /* Oranye sangat muda */
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        }

        .section-title {
        font-weight: 800;
        color: #2c3e50;
        }

        .fitur-scroll {
            padding-top: 100px; /* Jarak agar konten turun */
            margin-top: -100px;  /* Menarik section kembali ke atas secara layout */
        }

        .service-card {
        border-radius: 20px;
        padding: 30px;
        background-color: #fff;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        }

        .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(255, 120, 45, 0.1);
        }

        .footer {
        background-color: #2c3e50; /* Gelap elegan agar oranye lebih menyala */
        color: #fff;
        padding: 60px 0 20px 0;
        }

        .footer a { color: #bdc3c7; text-decoration: none; transition: 0.3s; }
        .footer a:hover { color: #FF782D; }

        /* Perbaikan Lingkaran Background */
        .circle-background {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* Menjaga di tengah */
        width: 300px;
        height: 300px;
        background: rgba(255, 120, 45, 0.1); /* Oranye transparan */
        border-radius: 50%;
        z-index: 1; /* Di bawah gambar */
        animation: expandCircle 4s ease-in-out infinite;
        }

        @keyframes expandCircle {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.3); }
        }

        /* Perbaikan Ikon Gradient */
        .gradient-icon {
        background: linear-gradient(135deg, #FF782D, #ffb38e);
        -webkit-background-clip: text; /* WAJIB ADA */
        -webkit-text-fill-color: transparent;
        display: inline-block;
        }

        /* Navbar Style */
        .navbar-brand { font-weight: 800; color: #FF782D !important; letter-spacing: 1px; }
        .navbar-brand span { color: #2c3e50; }
        .nav-link { font-weight: 600; color: #555 !important; margin: 0 10px; }
        .nav-link:hover { color: #FF782D !important; }

        /* Animations Base */
        .fade-left, .fade-right, .fade-up { opacity: 0; }

        @keyframes myFadeInLeft {
        from { opacity: 0; transform: translateX(-50px); }
        to { opacity: 1; transform: translateX(0); }
        }
        @keyframes myFadeInRight {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
        }
        @keyframes myFadeInUp {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
        }

        /* Class yang akan dipicu JavaScript */
        .show-now {
        opacity: 1 !important;
        }
        .animate-left { animation: myFadeInLeft 1s forwards; }
        .animate-right { animation: myFadeInRight 1s forwards; }
        .animate-up { animation: myFadeInUp 1s forwards; }

        /* Dasar transparan agar bisa dianimasikan */
        .fade-left, .fade-right, .fade-up {
            opacity: 0;
            transition: opacity 0.5s ease;
        }
    </style>
</head>

<body>

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


    <section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
        <div class="col-md-6 fade-left">
            <h1 class="mb-3 display-4 fw-bold text-dark">Sistem Informasi Digital <span style="color: #FF782D;">PosSehat</span></h1>
            <p class="lead text-muted mb-4">Gunakan teknologi untuk meningkatkan efisiensi pendataan dan deteksi dini kesehatan Ibu & Balita di Posyandu.</p>
            <div class="d-flex gap-3">
                <a href="/login" class="btn btn-primary btn-lg rounded-pill px-5">Mulai Sekarang</a>
                <a href="#fiturutama" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Pelajari Fitur</a>
            </div>
        </div>
        <div class="col-md-6 text-center fade-right position-relative">
            <div class="circle-background"></div>
            <img src="assets/img/posyandu.png" alt="Posyandu" class="img-fluid position-relative" style="z-index: 2;">
        </div>
        </div>
    </div>
    </section>

    <!-- Fitur -->
    <section class="py-3" id="fiturutama">
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
    document.addEventListener("DOMContentLoaded", function() {
        const observerOptions = {
            threshold: 0.1 // 10% muncul di layar langsung gerak
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    // Paksa opacity jadi 1
                    el.classList.add('show-now');

                    // Tambahkan animasi sesuai class awal
                    if (el.classList.contains('fade-left')) el.classList.add('animate-left');
                    if (el.classList.contains('fade-right')) el.classList.add('animate-right');
                    if (el.classList.contains('fade-up')) el.classList.add('animate-up');

                    observer.unobserve(el);
                }
            });
        }, observerOptions);

        // Ambil semua elemen yang mau dianimasikan
        document.querySelectorAll('.fade-left, .fade-right, .fade-up').forEach(el => {
            observer.observe(el);
        });
    });
</script>
</body>

</html>
