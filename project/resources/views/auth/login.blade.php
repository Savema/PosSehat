<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PosSehat - Login</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"/>

  <style>
    body {
      background-color: #fffaf7; /* Warna oranye sangat muda */
      font-family: 'Poppins', sans-serif;
    }

    /* Navbar Brand */
    .navbar-brand { font-weight: bold; font-size: 1.5rem; color: #FF782D !important; }
    .nav-link { font-weight: 500; color: #333 !important; }
    .nav-link:hover { color: #FF782D !important; }

    /* Buttons */
    .btn-primary {
      background: #FF782D;
      border: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background: #e66a25;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 120, 45, 0.3);
    }

    /* Hero & Card */
    .hero-section {
      height: 100vh;
      display: flex;
      align-items: center;
      padding-top: 80px;
    }
    .login-card {
      background-color: #ffffff;
      padding: 2.5rem;
      border: none;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      border-radius: 20px;
    }

    .form-control {
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #eee;
    }
    .form-control:focus {
      border-color: #FF782D;
      box-shadow: 0 0 0 0.25rem rgba(255, 120, 45, 0.1);
    }

    /* Animasi Lingkaran */
    .circle-background {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 350px;
      height: 350px;
      background: rgba(255, 120, 45, 0.08);
      border-radius: 50%;
      z-index: -1;
      animation: expandCircle 4s ease-in-out infinite;
    }

    @keyframes expandCircle {
      0%, 100% { transform: translate(-50%, -50%) scale(1); }
      50% { transform: translate(-50%, -50%) scale(1.2); }
    }

    /* Animasi Muncul */
    .animate-up {
      animation: fadeInUp 1s forwards;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .image-container img {
      max-width: 100%;
      z-index: 2;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">PosSehat</a>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
          <li class="nav-item"><a class="btn btn-primary rounded-pill px-4 ms-3" href="/login">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="hero-section">
    <div class="container">
      <div class="row align-items-center g-5">

        <div class="col-md-6 text-center position-relative d-none d-md-block">
          <div class="circle-background"></div>
          <div class="image-container animate-up">
            <img src="{{ asset('assets/img/posyandu.png') }}" alt="PosSehat Illustration">
          </div>
        </div>

        <div class="col-md-6">
          <div class="login-card animate-up" style="animation-delay: 0.3s;">
            <div class="mb-4">
                <h3 class="fw-bold" style="color: #FF782D">Selamat Datang</h3>
                <p class="text-muted">Silakan masuk ke akun petugas Anda</p>
            </div>

            @if(session('error'))
            <div class="alert alert-danger border-0 small" style="border-radius: 10px;">
                <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
            </div>
            @endif

            <form action="/proseslogin" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label small fw-bold text-muted">Email</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                  <input type="email" class="form-control border-start-0" id="email" name="email" placeholder="nama@email.com" required>
                </div>
              </div>

              <div class="mb-4">
                <label for="password" class="form-label small fw-bold text-muted">Password</label>
                <div class="input-group">
                  <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                  <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="••••••••" required>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">
                Masuk Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
              </button>
            </form>

            <div class="text-center mt-4">
              <a href="#" class="text-muted small text-decoration-none">Lupa password? Hubungi Admin</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
