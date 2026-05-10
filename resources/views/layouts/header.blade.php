<header class="navbar">
    <div class="container nav-content">
        <a href="/" class="logo">
            <div class="logo-icon">
                <i data-lucide="map-pin-check"></i>
            </div>
            <span>Campus<span class="text-blue">Found.</span></span>
        </a>

        <nav class="nav-links">
            <a href="{{ route('beranda') }}">Beranda</a>
            <a href="{{ route('jelajahi') }}">Jelajahi</a>
            <a href="#">Tentang Kami</a>
        </nav>

        <div class="nav-actions">
            <a href="{{ route('addLaporan') }}" class="btn-lapor">
                <i data-lucide="plus-circle" class="icon-sm"></i>
                <span>Lapor Barang</span>
            </a>


            <div class="profile-section">
                <div class="profile-dropdown">
                    <button class="profile-trigger">
                        <img src="https://ui-avatars.com/api/?name=User" alt="Profile" class="profile-img">
                        <i data-lucide="chevron-down" class="icon-sm"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a href="/profile"><i data-lucide="user"></i> Profil Saya</a>
                        <hr>
                        <a href="/logout" class="text-danger"><i data-lucide="log-out"></i> Keluar</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
