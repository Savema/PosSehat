<nav class="navbar navbar-expand-lg navbar-light bg-white py-2 shadow-sm fixed-top">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold" href="/" style="color: #ff5757;">PosSehat</a>

    <div class="ms-auto d-flex align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=9c3a5b&color=fff" alt="Profile" class="rounded-circle" width="35">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header text-start">
                        <h6>{{ auth()->user()->name }}</h6>
                        <span class="badge bg-info text-capitalize">{{ auth()->user()->role }}</span>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center text-danger" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
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

