<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('dashboard')]) href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('users')]) href="/users">
                <i class="bi bi-person-circle"></i>
                <span>Data Pengguna</span>
            </a>
        </li>
        @endif

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('balita')]) href="/balita">
                <i class="bi bi-emoji-laughing"></i>
                <span>Data Balita</span>
            </a>
        </li>

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('ibu_hamil')]) href="/ibu_hamil">
                <i class="bi bi-person-check"></i>
                <span>Data Ibu Hamil</span>
            </a>
        </li>

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('pengukuran_balita')]) href="/pengukuran_balita">
                <i class="bi bi-graph-down"></i>
                <span>Pengukuran Balita</span>
            </a>
        </li>

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('pengukuran_ibu_hamil')]) href="/pengukuran_ibu_hamil">
                <i class="bi bi-graph-down"></i>
                <span>Pengukuran Ibu Hamil</span>
            </a>
        </li>

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('laporan')]) href="/laporan">
                <i class="bi bi-clipboard-data"></i>
                <span>Laporan</span>
            </a>
        </li>

        <li class="nav-item">
            <a @class(['nav-link', 'collapsed' => !Request::is('edukasi')]) href="/edukasi">
                <i class="bi bi-clipboard-plus"></i>
                <span>Template Edukasi</span>
            </a>
        </li>

    </ul>
</aside>

