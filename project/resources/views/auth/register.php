<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PosSehat - Login</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #f0f8ff;
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: #ff5757;
    }

    .navbar-brand span {
      color: #ff5757;
    }

    .nav-link {
      font-weight: 500;
      color: #333;
    }

    .nav-link:hover {
      color: #ff5757;
    }

    .btn-primary {
      background: linear-gradient(90deg, #ff5757, #ff5757);
      border: none;
    }

    .btn-primary:hover {
      background: linear-gradient(90deg, #ff5757, #ff5757);
    }

    .hero-section {
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    .card {
      background-color: #ffffff;
      padding: 2rem;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 1rem;
    }

    .form-control {
      border: 1px solid #ddd;
    }

    .form-control:focus {
      border-color: #ff5757;
      box-shadow: 0 0 0 0.2rem rgba(94, 121, 255, 0.25);
    }

    .circle-background {
      position: absolute;
      top: 30%;
      left: 10%;
      width: 250px;
      height: 250px;
      background: rgba(173, 216, 230, 0.2);
      border-radius: 50%;
      animation: expandCircle 3s ease-in-out infinite;
    }

    @keyframes expandCircle {
      0% { width: 250px; height: 250px; }
      50% { width: 300px; height: 300px; }
      100% { width: 250px; height: 250px; }
    }

    .animated {
      opacity: 0;
      animation: fadeInUp 1s forwards;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .image-container img {
      max-width: 100%;
      border-radius: 1rem;
      animation-delay: 1.5s;
    }
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
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding-top: 100px; /* Mencegah form tertutup navbar */
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
  color: #ff5757;
}


  </style>
</head>
<body>

  <!-- Navbar langsung dalam file -->
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
          <li class="nav-item"><a class="btn btn-primary rounded-pill px-4 ms-3" href="/register">Daftar</a></li>
        </ul>
      </div>
    </div>
  </nav>


    <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center">
        <!-- Image Content -->
        <div class="col-md-6 text-center">
          <div class="image-container" style="position: relative;">
            <img src="assets/img/posyandu.png" alt="posyandu" class="img-fluid animated fadeInUp" style="animation-delay: 1.5s;">
            <!-- <div class="circle-background"></div> -->
          </div>
        </div>

        <!-- Sign Up Card -->
        <div class="col-md-6">
          <div class="card shadow-lg animated" style="animation-delay: 1s;">
            <h3 class="text-center fw-bold mb-4  animated" style="animation-delay: 0.5s; color: #ff5757">Daftar Akun</h3>
            <p class="text-center text-muted mb-4 animated" style="animation-delay: 0.7s;">Silakan isi informasi Anda untuk mendaftar</p>
            <form action="/prosessignup" method="POST">
              <div class="mb-3 animated" style="animation-delay: 0.9s;">
                <label for="name" class="form-label text-muted">Nama Lengkap</label>
                <input type="text" class="form-control rounded-3" id="name" name="nama" placeholder="Masukkan nama lengkap Anda" required>
              </div>

              <div class="mb-3 animated" style="animation-delay: 1.1s;">
                <label for="email" class="form-label text-muted">Email</label>
                <input type="email" class="form-control rounded-3" id="email" name="email" placeholder="Masukkan email Anda" required>
              </div>

              <div class="mb-3 animated" style="animation-delay: 1.3s;">
                <label for="password" class="form-label text-muted">Password</label>
                <input type="password" class="form-control rounded-3" id="password" name="password" placeholder="Masukkan password Anda" required>
              </div>

              <div class="mb-3 animated" style="animation-delay: 1.6s;">
                <label for="role" class="form-label text-muted">Role</label>
                <select class="form-select rounded-3" id="kecamatan" name="role" required>
                  <option disabled selected>Pilih Role</option>
                  <!-- @foreach ($kec as $k) -->
                      <option value="#"></option>
                  <!-- @endforeach -->
                </select>
              </div>

              <button type="submit" class="btn btn-primary w-100 rounded-pill mt-3 animated" style="animation-delay: 1.7s;">Daftar</button>
            </form>

            <div class="text-center mt-4 animated" style="animation-delay: 1.9s;">
              <p class="small text-muted">Sudachh punya akun? <a href="/login" class="text-primary">Masuk</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const form = document.querySelector('form');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');

    form.addEventListener('submit', function(e) {
      if (password.value !== confirmPassword.value) {
        e.preventDefault();
        alert('Password dan konfirmasi password tidak cocok!');
      }
    });
  </script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
