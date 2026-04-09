<nav class="navbar navbar-expand-lg navbar-light bg-white py-2 shadow-sm fixed-top" style="border-bottom: 2px solid #fff5f0;">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="/dashboard" style="color: #FF782D; font-size: 1.5rem; letter-spacing: -0.5px;">
        <i class="bi bi-heart-pulse-fill me-2"></i> PosSehat
    </a>

    <div class="ms-auto d-flex align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <div class="d-flex align-items-center justify-content-center rounded-circle shadow-sm"
                        style="width: 35px; height: 35px; background-color: #fff5f0; border: 1px solid #FF782D;">
                        <i class="bi bi-person-fill" style="color: #FF782D; font-size: 1.2rem;"></i>
                    </div>
                    <span class="d-none d-md-block dropdown-toggle ps-2 fw-semibold" style="color: #2c3e50;">{{ auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile border-0 shadow" style="border-radius: 15px; min-width: 200px;">
                    <li class="dropdown-header text-start pb-3">
                        <h6 class="mb-0 fw-bold" style="color: #2c3e50;">{{ auth()->user()->name }}</h6>
                        <span class="badge text-capitalize mt-1" style="background-color: #fff5f0; color: #FF782D; border: 1px solid #FF782D;">{{ auth()->user()->role }}</span>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person me-2 text-muted"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            <span>Keluar</span>
                        </a>

                        <form id="logout-form" action="/logout" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</nav>
