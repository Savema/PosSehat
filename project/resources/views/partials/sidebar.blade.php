<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav">

        <li class="nav-item">
        <a class="nav-link" href="/dashboard">
            <i class="bi bi-grid" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Dashboard</span>
        </a>
        </li>

        @if(auth()->user()->role == 'admin')
        <li class="nav-item">
        <a class="nav-link collapsed" href="/users">
            <i class="bi bi-person-circle" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Data Pengguna</span>
        </a>
        </li>
        @endif

        <li class="nav-item">
        <a class="nav-link collapsed" href="/balita">
            <i class="bi bi-emoji-laughing" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Data Balita</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="/ibu_hamil">
            <i class="bi bi-person-check" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Data Ibu Hamil</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="/pengukuran_balita">
            <i class="bi bi-graph-down" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Pengukuran Balita</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="/pengukuran_ibu_hamil">
            <i class="bi bi-graph-down" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Pengukuran Ibu Hamil</span>
        </a>
        </li>

        <li class="nav-item">
        <a class="nav-link collapsed" href="/laporan">
            <i class="bi bi-clipboard-data" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Laporan</span>
        </a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
            <i class="bi bi-broadcast-pin" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Pengaturan Informasi</span>
            </a>
        </li><!-- End Contact Page Nav --> --}}

        <li class="nav-item">
            <a class="nav-link collapsed" href="/edukasi">
            <i class="bi bi-clipboard-plus" style="color: #ff5757;"></i>
            <span style="color: #ff5757;">Template Edukasi</span>
            </a>
        </li><!-- End Contact Page Nav -->

    </ul>
</aside>
