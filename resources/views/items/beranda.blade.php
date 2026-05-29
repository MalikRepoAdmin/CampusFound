@extends('layouts.app')

@section('title', 'CampusFound | Beranda')

@section('content')
    <section class="hero-section">
        <div class="hero-text">
            <div class="badge-new">
                <span class="dot-pulse"></span>
                Sistem Informasi Barang Hilang Kampus PNM
            </div>
            <h1>
                Temukan kembali barang yang <span class="hero-gradient">Hilang</span> dan <span class="hero-gradient">Tertinggal.</span>
            </h1>
            <p>
                Sistem informasi kehilangan dan penemuan barang dirancang untuk menyediakan informasi terkait, yang terstruktur dan dapat diaudit. <br><br>
                Tak perlu lagi membanjiri Group Chat Whatsapp.
            </p>
        </div>

        <div class="hero-widget-container">
            <div class="widget-card floating">
                <div class="widget-icon">
                    <i data-lucide="check-circle"></i>
                </div>
                <div class="widget-stats">
                    <h3>{{ $resolvedPercentage }}%</h3>
                    <p>Laporan Terpecahkan</p>
                </div>
                <div class="widget-users">
                    <span>Terima Kasih atas Kontribusi Anda</span>
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
                <p class="stat-value">{{ $laporansCount }}</p>
                <p class="stat-label">Total Laporan</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-blue">
                <i data-lucide="clock-3"></i>
            </div>
            <div class="stat-info">
                <p class="stat-value">{{ $laporansActiveCount }}</p>
                <p class="stat-label">Laporan Aktif</p>
            </div>
        </div>
        <div class="stat-card dark-card">
            <!-- Mengubah ikon ke check-square agar sesuai dengan konteks tugas selesai/resolved -->
            <div class="stat-icon icon-glass">
                <i data-lucide="check-square"></i>
            </div>
            <div class="stat-info text-white">
                <!-- Nilai angka contoh disesuaikan, silakan ganti dengan variabel penampung data dinamis jika ada (misal: {{ $totalResolved ?? '832' }}) -->
                <p class="stat-value">{{ $laporansResolvedCount }}</p>
                <p class="stat-label">Total Resolved</p>
            </div>
        </div>
    </div>

    <div class="section-header">
        <div class="title-area">
            <h2>Laporan Terbaru</h2>
            <p>Menampilkan barang-barang yang hilang dan ditemukan di area kampus baru-baru ini.</p>
        </div>
    </div>

    <div class="cards-grid">
    @forelse($laporans as $laporan)
        @php
            $barang = $laporan->barangs;
        @endphp

        <div class="card">
            <div class="card-image">
                @if(isset($laporan->barangs) && $laporan->barangs->foto_barang)
                    {{-- TAMPILKAN FOTO ASLI JIKA USER MENGUNGGAH FOTO --}}
                    <img src="{{ asset('storage/' . $laporan->barangs->foto_barang) }}"
                         alt="{{ $laporan->barangs->nama_barang }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    {{-- TAMPILKAN PLACEHOLDER JIKA FOTO NULL (KOSONG) --}}
                    <div class="image-placeholder" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; color: #94a3b8; text-align: center; padding: 20px;">
                        @if($laporan->kategori_laporan == 'found')
                            <!-- Icon Box/Paket untuk Barang Temuan -->
                            <i data-lucide="package" style="width: 48px; height: 48px; color: #cbd5e1;"></i>
                        @else
                            <!-- Icon Search/Kaca Pembesar untuk Barang Hilang -->
                            <i data-lucide="search" style="width: 48px; height: 48px; color: #cbd5e1;"></i>
                        @endif
                        <span style="font-size: 12px; font-weight: 500; color: #94a3b8; font-family: 'Plus Jakarta Sans', sans-serif;">Tidak ada foto</span>
                    </div>
                @endif

                <span class="category-tag">{{ $barang->kategori_barang ?? 'Lainnya' }}</span>
            </div>

            <div class="card-body">
                <h4>{{ $barang->nama_barang ?? 'Tanpa Nama' }}</h4>
                <div class="location">
                    <i data-lucide="map-pin"></i> {{ $barang->lokasi ?? 'Lokasi tidak ditentukan' }}
                </div>

                <div class="card-footer">
                    <div class="user">
                        <div class="user-avatar">
                            {{ substr($laporan->users->nama ?? 'A', 0, 1) }}
                        </div>
                        <span>{{ $laporan->users->nama ?? 'Admin PNM' }}</span>
                    </div>

                    <a href="{{ route('laporan.detail', ['id' => $laporan->id_laporan]) }}" class="btn-detail">
                        DETAIL <i data-lucide="chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="no-data" style="grid-column: 1/-1; text-align: center; padding: 40px; color: #666;">
            <p>Belum ada temuan barang terbaru hari ini.</p>
        </div>
    @endforelse
    </div>

    <a href="https://wa.me/6285904417152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
        <i data-lucide="message-circle"></i>
    </a>
@endsection
