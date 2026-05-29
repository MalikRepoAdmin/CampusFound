<header class="navbar">
    <div class="container nav-content">
        <a href="/tentang-kami" class="logo">
            <div class="logo-icon">
                <i data-lucide="compass"></i>
            </div>
            <span>Campus<span class="text-blue">Found.</span></span>
        </a>

        <input type="checkbox" id="menu-toggle-chk" class="nav-checkbox-gate">
        <label for="menu-toggle-chk" class="menu-toggle" aria-label="Toggle Navigation">
            <i data-lucide="menu"></i>
        </label>

        <nav class="nav-links">
            <a href="{{ route('beranda') }}">Beranda</a>
            <a href="{{ route('jelajahi') }}">Jelajahi</a>
            <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
        </nav>

        <div class="nav-actions">
            <a href="{{ route('addLaporan') }}" class="btn-lapor">
                <i data-lucide="plus-circle" class="icon-sm"></i>
                <span>Lapor Barang</span>
            </a>

            <div class="profile-section">
                <div class="profile-dropdown">
                    <input type="checkbox" id="profile-toggle-chk" class="nav-checkbox-gate">
                    <label for="profile-toggle-chk" class="profile-trigger">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&length=1" alt="Profile" class="profile-img">
                        <i data-lucide="chevron-down" class="icon-sm"></i>
                    </label>

                    <div class="dropdown-menu">
                        <a href="{{ route('profile') }}"><i data-lucide="user" class="icon-sm"></i> Profil Saya</a>
                        <hr class="dropdown-divider">
                        <a href="{{ route('logout') }}" class="text-danger"><i data-lucide="log-out" class="icon-sm"></i> Keluar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
