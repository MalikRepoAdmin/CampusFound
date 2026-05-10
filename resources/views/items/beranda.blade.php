@extends('layouts.app')

@section('title', 'CampusFound | Beranda')

@section('content')

    <section class="hero-section">
        <div class="hero-text">
            <div class="badge-new">
                <span class="dot-pulse"></span>
                Update Real-time Kampus PNM
            </div>
            <h1>
                Temukan kembali barang yang <span class="hero-gradient">Hilang.</span>
            </h1>
            <p>
                Sistem informasi kehilangan dan penemuan barang terintegrasi untuk menciptakan lingkungan kampus yang lebih jujur dan peduli.
            </p>

            <div class="search-container">
                <div class="search-icon">
                    <i data-lucide="search"></i>
                </div>
                <input type="text" placeholder="Cari barang (KTM, Kunci, HP...)">
                <button class="btn-search">Cari</button>
            </div>
        </div>


        <div class="hero-widget-container">
            <div class="widget-card floating">
                <div class="widget-icon">
                    <i data-lucide="check-circle"></i>
                </div>
                <div class="widget-stats">
                    <h3>84%</h3>
                    <p>Barang Kembali ke Pemiliknya</p>
                </div>
                <div class="widget-users">
                    <div class="avatar-stack">
                        <div class="avatar"></div>
                        <div class="avatar"></div>
                    </div>
                    <span>+200 orang hari ini</span>
                </div>
            </div>
        </div>
    </section>


    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-orange">
                <i data-lucide="package"></i>
            </div>
            <div class="stat-info">
                <p class="stat-value">1,284</p>
                <p class="stat-label">Total Temuan</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <i data-lucide="clock-3"></i>
            </div>
            <div class="stat-info">
                <p class="stat-value">452</p>
                <p class="stat-label">Laporan Aktif</p>
            </div>
        </div>
        <div class="stat-card dark-card">
            <div class="stat-icon icon-glass">
                <i data-lucide="shield-check"></i>
            </div>
            <div class="stat-info text-white">
                <p class="stat-value">Terverifikasi</p>
                <p class="stat-label">Keamanan Terjamin</p>
            </div>
        </div>
    </div>

    <!-- Section Title & Filter -->
    <div class="section-header">
        <div class="title-area">
            <h2>Temuan Terbaru</h2>
            <p>Menampilkan barang-barang yang baru saja ditemukan di sekitar area kampus hari ini.</p>
        </div>

        <div class="filter-group">
            <div class="select-wrapper">
                <i data-lucide="layers" class="icon-left blue"></i>
                <select class="select-custom">
                    <option value="">Semua Kategori</option>
                    <option value="1">Elektronik</option>
                    <option value="2">Dokumen & Kartu</option>
                </select>
            </div>
            <div class="divider"></div>
            <div class="select-wrapper">
                <i data-lucide="arrow-down-up" class="icon-left grey"></i>
                <select class="select-custom">
                    <option value="new">Terbaru</option>
                    <option value="old">Terlama</option>
                </select>
            </div>
        </div>
    </div>

    <div class="cards-grid">
        <div class="card">
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&q=80&w=800" alt="Charger">
                <span class="category-tag">Elektronik</span>
            </div>
            <div class="card-body">
                <h4>Asus ROG Charger</h4>
                <div class="location">
                    <i data-lucide="map-pin"></i> Gedung Teknik Lt. 2
                </div>
                <div class="card-footer">
                    <div class="user">
                        <div class="user-avatar">A</div>
                        <span>Admin PNM</span>
                    </div>
                    <a href="{{ route('barang.detail', ['id' => 1]) }}" class="btn-detail">
                        DETAIL <i data-lucide="chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1627384113743-6bd5a479fffd?auto=format&fit=crop&q=80&w=800" alt="Tumbler">
                <span class="category-tag">Aksesoris</span>
            </div>
            <div class="card-body">
                <h4>Tumbler Hydroflask</h4>
                <div class="location">
                    <i data-lucide="map-pin"></i> Kantin Pusat
                </div>
                <div class="card-footer">
                    <div class="user">
                        <div class="user-avatar">R</div>
                        <span>Rian S.</span>
                    </div>
                    <button class="btn-detail">
                        DETAIL <i data-lucide="chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <a href="https://wa.me/6285708935152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
    <i data-lucide="message-circle"></i>
</a>
@endsection
