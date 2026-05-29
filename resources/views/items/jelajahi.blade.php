@extends('layouts.app')

@section('title', 'CampusFound | Jelajahi Barang')

@section('content')
<main class="main-container">

    <div class="header-flex">
        <div>
            <h1 class="title-h1">Jelajahi Barang</h1>
            <p class="subtitle-p">Cari barang yang ditemukan atau laporkan kehilanganmu di area kampus.</p>
        </div>

        <div class="tabs-container">
                <!-- data-tab Ge identifikasi JS -->
            <button class="tab-btn active" data-tab="found">
                <i data-lucide="package-search" style="width: 16px;"></i>
                Barang Temuan
            </button>
            <button class="tab-btn" data-tab="lost">
                <i data-lucide="help-circle" style="width: 16px;"></i>
                Barang Hilang
            </button>
        </div>
    </div>

    <div class="filter-card">
        <div class="filter-row" style="display: flex; gap: 16px; align-items: center;">
            <div class="filter-group" style="flex-grow: 1;">
                <label class="filter-label">
                     <i class="fa-solid fa-tags"></i>
                </label>
                {{-- Ubah value di bawah ini agar sama dengan teks di database --}}
                <select id="categoryFilter" class="select-custom" style="color: #868484; width: 100%;">
                    <option value="">Semua Kategori</option>
                    <option value="elektronik">Elektronik</option>
                    <option value="dokumen/ktm">Dokumen/KTM</option>
                    <option value="aksesoris">Aksesoris</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <button id="btnApplyFilter" class="btn-filter">Terapkan Filter</button>
        </div>
    </div>


    <!-- Item Grid -->
    <div class="item-grid" id="itemGrid">
        <!-- Card Temuan (Ditandai dengan data-type="temuan") -->
        @forelse($laporans as $laporan)
            <!-- Perhatikan penambahan ->barangs pada data-category dan data-location -->
            <div class="card item-card"
                 data-type="{{ $laporan->kategori_laporan }}"
                 data-category="{{ $laporan->barangs->kategori_barang ?? '' }}"
                 data-location="{{ $laporan->barangs->lokasi ?? '' }}"
                 style="{{ $laporan->kategori_laporan == 'lost' ? 'border-color: #ffe4e6;' : '' }}">

                <div class="card-img-box" style="position: relative; width: 100%; height: 200px; background-color: #f8fafc; overflow: hidden; display: flex; align-items: center; justify-content: center;">

                    @if(isset($laporan->barangs) && $laporan->barangs->foto_barang)
                        {{-- TAMPILKAN FOTO ASLI JIKA USER MENGUNGGAH FOTO --}}
                        <img src="{{ asset('storage/' . $laporan->barangs->foto_barang) }}"
                             alt="{{ $laporan->barangs->nama_barang }}"
                             style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        {{-- TAMPILKAN PLACEHOLDER CANTIK JIKA FOTO NULL (KOSONG) --}}
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

                    <div class="badge-wrapper" style="position: absolute; top: 12px; left: 12px; display: flex; flex-direction: row; gap: 6px; items-align: center; z-index: 10;">

                        {{-- Badge Utama: Temuan / Dicari --}}
                        @if($laporan->kategori_laporan == 'found')
                            {{-- Kita paksa posisinya jadi static dan hilangkan margin/top/left bawaan CSS lamamu --}}
                            <div class="badge badge-blue" style="position: static !important; top: auto !important; left: auto !important; margin: 0 !important;">
                                Temuan
                            </div>
                        @else
                            <div class="badge badge-rose" style="position: static !important; top: auto !important; left: auto !important; margin: 0 !important;">
                                Dicari
                            </div>
                        @endif

                        {{-- Badge : Resolved --}}
                        @if(isset($laporan->status_laporan) && $laporan->status_laporan == 'resolved')
                            <div class="badge badge-success" style="position: static !important; top: auto !important; left: auto !important; margin: 0 !important; background-color: #10b981; color: white; display: flex; align-items: center; gap: 4px; padding: 4px 8px; border-radius: 4px;">
                                <i data-lucide="check-circle" style="width: 14px; height: 14px;"></i>
                                <span style="font-size: 9px; font-weight: 600; text-transform: uppercase; line-height: 1;">Resolved</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-content" style="padding: 16px; text-align: left;">
                    {{-- Ambil nama barang dari relasi --}}
                    <h3 class="card-title" style="color: #1e293b; font-size: 16px; font-weight: 700; margin-bottom: 8px; display: block;">
                        {{ $laporan->barangs->nama_barang ?? 'Nama Barang Tidak Ditemukan' }}
                    </h3>

                    {{-- Ambil lokasi dari relasi --}}
                    <div class="card-loc" style="color: #475569; font-size: 13px; display: flex; align-items: center; gap: 6px; margin-bottom: 12px;">
                        @if($laporan->kategori_laporan == 'found')
                            <i data-lucide="map-pin" style="width: 14px; height: 14px; color: #2563eb; flex-shrink: 0;"></i>
                        @else
                            <i data-lucide="search" style="width: 14px; height: 14px; color: #e11d48; flex-shrink: 0;"></i>
                        @endif
                        <span style="color: #475569;">{{ $laporan->barangs->lokasi ?? 'Lokasi Tidak Ditemukan' }}</span>
                    </div>

                    <div class="card-footer" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 12px;">
                        <span class="card-time" style="color: #94a3b8; font-size: 12px;">
                            {{ $laporan->created_at->diffForHumans() }}
                        </span>

                        @if($laporan->kategori_laporan == 'found')
                            <a href="{{ route('laporan.detail', ['id' => $laporan->id_laporan]) }}" class="btn-view btn-view-blue">
                                LIHAT <i data-lucide="arrow-right" style="width: 12px;"></i>
                            </a>
                        @else
                            <a href="{{ route('laporan.detail', ['id' => $laporan->id_laporan]) }}" class="btn-view btn-view-rose">
                                BANTU <i data-lucide="arrow-right" style="width: 12px;"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #868484;">
                <i data-lucide="package-open" style="width: 48px; height: 48px; margin-bottom: 12px;"></i>
                <p>Belum ada laporan barang yang terdaftar saat ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{-- Tombol Previous --}}
        @if ($laporans->onFirstPage())
            <button class="page-btn" style="opacity: 0.5; cursor: not-allowed;">
                <i data-lucide="chevron-left" style="width: 18px;"></i>
            </button>
        @else
            <a href="{{ $laporans->previousPageUrl() }}" class="page-btn">
                <i data-lucide="chevron-left" style="width: 18px;"></i>
            </a>
        @endif

        {{-- Tombol Angka Halaman --}}
        @foreach ($laporans->getUrlRange(1, $laporans->lastPage()) as $page => $url)
            @if ($page == $laporans->currentPage())
                <button class="page-btn active">{{ $page }}</button>
            @else
                {{-- Menambahkan appends otomatis untuk parameter tab di URL --}}
                <a href="{{ $laporans->appends(request()->query())->url($page) }}" class="page-btn">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($laporans->hasMorePages())
            <a href="{{ $laporans->nextPageUrl() }}" class="page-btn">
                <i data-lucide="chevron-right" style="width: 18px;"></i>
            </a>
        @else
            <button class="page-btn" style="opacity: 0.5; cursor: not-allowed;">
                <i data-lucide="chevron-right" style="width: 18px;"></i>
            </button>
        @endif
    </div>
</main>

<a href="https://wa.me/6285708935152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
    <i data-lucide="message-circle"></i>
</a>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".tab-btn");
        const cards = document.querySelectorAll(".item-card");
        const categoryFilter = document.getElementById("categoryFilter");
        const btnApplyFilter = document.getElementById("btnApplyFilter");

        // 1. Ambil status tab aktif dari parameter URL (?tab=lost), default ke 'found'
        const urlParams = new URLSearchParams(window.location.search);
        let currentTab = urlParams.get('tab') || "found";

        // 2. Sinkronisasikan class 'active' pada tombol tab HTML sesuai parameter URL
        tabs.forEach(tab => {
            if (tab.getAttribute("data-tab") === currentTab) {
                tab.classList.add("active");
            } else {
                tab.classList.remove("active");
            }
        });

        // 3. Fungsi Utama Penyaringan (Hanya Tab & Kategori)
        function filterItems() {
            const selectedCategory = categoryFilter.value.toLowerCase().trim();

            cards.forEach(card => {
                const cardType = (card.getAttribute("data-type") || "").toLowerCase().trim();
                const cardCategory = (card.getAttribute("data-category") || "").toLowerCase().trim();

                // Cek apakah kartu cocok dengan tab yang aktif saat ini
                const matchesTab = cardType === currentTab;

                // Cek apakah kartu cocok dengan kategori yang dipilih (jika kosong, anggap semua cocok)
                const matchesCategory = selectedCategory === "" || cardCategory === selectedCategory;

                // Tampilkan kartu hanya jika memenuhi KEDUA kondisi filter
                if (matchesTab && matchesCategory) {
                    card.style.setProperty('display', 'block', 'important');
                } else {
                    card.style.setProperty('display', 'none', 'important');
                }
            });
        }

        // 4. Logika klik pindah tab
        tabs.forEach(tab => {
            tab.addEventListener("click", function () {
                tabs.forEach(t => t.classList.remove("active"));
                this.classList.add("active");

                currentTab = this.getAttribute("data-tab");

                // Perbarui URL browser tanpa reload agar pagination mengingat tab pilihan
                const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + currentTab;
                window.history.pushState({ path: newUrl }, '', newUrl);

                // Setiap pindah tab, jalankan penyaringan ulang
                filterItems();
            });
        });

        // 5. Jalankan filter saat tombol "Terapkan Filter" diklik
        if (btnApplyFilter) {
            btnApplyFilter.addEventListener("click", filterItems);
        }

        // Jalankan filter pertama kali saat halaman selesai dimuat oleh browser
        filterItems();
    });
</script>
@endsection
