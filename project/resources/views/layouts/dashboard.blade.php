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

    <style>
    html {
      font-size: 14px;
    }

    body {
      zoom: 1 !important;
      transform: none !important;
      font-size: 1rem;
      background-color: #fff7f2;
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

  @stack('scripts')
</body>

</html>
