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

        </div>

        <div class="hero-widget-container">
            <div class="widget-card floating">
                <div class="widget-icon">
                    <i data-lucide="check-circle"></i>
                </div>
                <div class="widget-stats">
                    <h3>84%</h3>
                    <p>Barang Kembali</p>
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

    <div class="section-header">
        <div class="title-area">
            <h2>Temuan Terbaru</h2>
            <p>Menampilkan barang-barang yang baru saja ditemukan di sekitar area kampus hari ini.</p>
        </div>
        <div class="lihat-semua">
            <a href="/jelajahi" class="btn-lihat-semua">
                Lihat Semua
                <i data-lucide="chevron-right"></i>
            </a>
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
                    <a href="{{ route('laporan.detail', ['id' => 1]) }}" class="btn-detail">
                        DETAIL <i data-lucide="chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <a href="https://wa.me/6285708935152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
        <i data-lucide="message-circle"></i>
    </a>
@endsection
