<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard - PosSehat')</title>

  <!-- SEO Meta -->
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
 <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
<!-- jQuery dulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Baru Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- CSS Select2 di head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <style>
    html {
      font-size: 14px;
    }

    body {
      zoom: 1 !important;
      transform: none !important;
      font-size: 1rem;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      scale: 0.95;
    }

    .card-title {
      font-size: 1rem;
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
      background-color: #fff7f2;
      padding-top: 100px;
    }

    .card {
      background-color: #ffffff;
      padding: 2rem;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 1rem;
      scale: 0.95;
      transition: all 0.3s ease-in-out;
    }

    .card-title {
    font-size: 1rem;
    }

    .card .card-body h6 {
    font-size: 1.25rem;
    }

    .form-control {
      border: 1px solid #ddd;
    }

    .form-control:focus {
      border-color: #ff5757;
      box-shadow: 0 0 0 0.2rem rgba(94, 121, 255, 0.25);
    }

    .footer {
        margin-top: 30px;
        text-align: center;
        font-size: 14px;
    }

    .footer .copyright span {
        font-weight: 700;
    }

    .footer .credits {
        padding-top: 5px;
        font-style: italic;
    }

    .circle-background {
      position: absolute;
      top: 30%;
      left: 10%;
      width: 250px;
      height: 250px;
      background: rgba(255, 234, 220, 0.2);
      border-radius: 50%;
      animation: expandCircle 3s ease-in-out infinite;
    }

    @keyframes expandCircle {
      0% { width: 250px; height: 250px; }
      50% { width: 300px; height: 300px; }
      100% { width: 250px; height: 250px; }
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
    .navbar {
        z-index: 9999 !important; /* Memastikan navbar selalu di depan */
    }
    /* Efek hover pada item dropdown */
    .dropdown-item:hover {
        background-color: #fff5f0 !important;
        color: #FF782D !important;
    }

    /* Biar transisi dropdown lebih halus */
    .dropdown-menu {
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    /* --- Sidebar Styling --- */
    .sidebar {
        background-color: #ffffff;
        padding: 20px 15px;
    }

    .sidebar-nav .nav-item {
        margin-bottom: 8px;
    }

    /* Link Default (Saat Tidak Aktif) */
    .sidebar-nav .nav-link.collapsed {
            background: transparent;
            color: #7a7a7a; /* Warna teks agak abu agar tidak ramai */
            border-radius: 12px;
            transition: all 0.3s ease;
        }

    .sidebar-nav .nav-link.collapsed i {
        color: #FF782D; /* Ikon tetap oranye sebagai identitas */
    }

    /* Link Saat Aktif atau Di-Hover */
    .sidebar-nav .nav-link {
        background: #FFF5F0; /* Background oranye sangat muda */
        color: #FF782D;      /* Teks oranye */
        font-weight: 600;
        border-radius: 12px;
        padding: 12px 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-nav .nav-link i {
        font-size: 1.2rem;
        color: #FF782D;
    }

    .sidebar-nav .nav-link:hover {
        background: #FF782D; /* Saat hover jadi oranye penuh */
        color: #ffffff;      /* Teks jadi putih */
    }

    .sidebar-nav .nav-link:hover i {
        color: #ffffff;      /* Ikon jadi putih saat hover */
    }
  </style>
</head>

<body>

  {{-- Navbar --}}
  @include('partials.navbar')

  {{-- Sidebar --}}
  @include('partials.sidebar')

  {{-- Main Content --}}
  <main id="main" class="main">
      @yield('content')
  </main>

  {{-- Footer --}}
  @include('partials.footer')

  {{-- JS --}}
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  @stack('scripts')
</body>

</html>
