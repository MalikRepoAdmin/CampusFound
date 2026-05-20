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
            <button class="tab-btn active" data-tab="temuan">
                <i data-lucide="package-search" style="width: 16px;"></i>
                Barang Temuan
            </button>
            <button class="tab-btn" data-tab="hilang">
                <i data-lucide="help-circle" style="width: 16px;"></i>
                Barang Hilang
            </button>
        </div>
    </div>

    <div class="filter-card">
        <div class="search-wrapper">
            <i data-lucide="search" class="search-icon"></i>
            <input type="text" id="searchInput" placeholder="Ketik nama barang yang kamu cari (misal: Kunci Motor, Dompet)..." class="search-input">
        </div>

        <div class="filter-row">
            <div class="filter-group">
                <label class="filter-label">
                     <i class="fa-solid fa-tags"></i>
                </label>
                <select id="categoryFilter" class="select-custom" style="color: #868484">
                    <option value="">Semua Kategori</option>
                    <option value="1">Elektronik</option>
                    <option value="2">Dokumen & Kartu</option>
                    <option value="3">Kunci & Aksesoris</option>
                </select>
            </div>

            <div class="filter-group">
                <label class="filter-label" title="Pilih Lokasi">
                    <i class="fa-solid fa-location-dot"></i>
                </label>
                <select id="locationFilter" class="select-custom" style="color: #868484">
                    <option value="">Semua Area Kampus</option>
                    <option value="A">Gedung Teknik</option>
                    <option value="B">Perpustakaan</option>
                    <option value="C">Masjid Kampus</option>
                </select>
            </div>

            <button id="btnApplyFilter" class="btn-filter">Terapkan Filter</button>
        </div>
    </div>

    <!-- Item Grid -->
    <div class="item-grid" id="itemGrid">
        <!-- Card Temuan (Ditandai dengan data-type="temuan") -->
        <div class="card item-card" data-type="temuan" data-category="2" data-location="B">
            <div class="card-img-box">
                <img src="https://images.unsplash.com/photo-1621607512214-68297480165e?auto=format&fit=crop&q=80&w=600" alt="Item">
                <div class="badge badge-blue">Temuan</div>
            </div>
            <div class="card-content">
                <h3 class="card-title">KTM a.n. Budi Setiawan</h3>
                <div class="card-loc">
                    <i data-lucide="map-pin" style="width: 12px; color: #2563eb;"></i>
                    Gazebo Perpustakaan
                </div>
                <div class="card-footer">
                    <span class="card-time">2 jam yang lalu</span>
                    <button class="btn-view btn-view-blue">
                        LIHAT <i data-lucide="arrow-right" style="width: 12px;"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="card item-card" data-type="hilang" data-category="3" data-location="A" style="border-color: #ffe4e6;">
            <div class="card-img-box">
                <img src="https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&q=80&w=600" alt="Item">
                <div class="badge badge-rose">Dicari</div>
            </div>
            <div class="card-content">
                <h3 class="card-title">Dompet Kulit Cokelat</h3>
                <div class="card-loc">
                    <i data-lucide="search" style="width: 12px; color: #e11d48;"></i>
                    Sekitar Kantin Teknik
                </div>
                <div class="card-footer">
                    <span class="card-reward">DAPAT JACKPOT</span>
                    <button class="btn-view btn-view-rose">
                        BANTU <i data-lucide="arrow-right" style="width: 12px;"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="pagination">
        <button class="page-btn"><i data-lucide="chevron-left" style="width: 18px;"></i></button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn"><i data-lucide="chevron-right" style="width: 18px;"></i></button>
    </div>
</main>

<a href="https://wa.me/6285708935152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
    <i data-lucide="message-circle"></i>
</a>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll(".tab-btn");
    const cards = document.querySelectorAll(".item-card");
    const searchInput = document.getElementById("searchInput");
    const categoryFilter = document.getElementById("categoryFilter");
    const locationFilter = document.getElementById("locationFilter");
    const btnApplyFilter = document.getElementById("btnApplyFilter");

    let currentTab = "temuan"; // Default

    function filterItems() {
        const searchText = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;
        const selectedLocation = locationFilter.value;

        cards.forEach(card => {
            const matchesTab = card.getAttribute("data-type") === currentTab;
            const matchesSearch = card.querySelector(".card-title").textContent.toLowerCase().includes(searchText);
            const matchesCategory = selectedCategory === "" || card.getAttribute("data-category") === selectedCategory;
            const matchesLocation = selectedLocation === "" || card.getAttribute("data-location") === selectedLocation;

            // Kartu ditampilkan jklo memenuhi semua kondisi filter
            if (matchesTab && matchesSearch && matchesCategory && matchesLocation) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    // pindah tab
    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            tabs.forEach(t => t.classList.remove("active"));
            this.classList.add("active");

            currentTab = this.getAttribute("data-tab");
            filterItems();
        });
    });

    //Pencarian Tanpa Tombol
    searchInput.addEventListener("input", filterItems);

    //  untuk Tombol Terapkan Filter
    btnApplyFilter.addEventListener("click", filterItems);

    // Jalankan filter pertama kali saat halaman dimuat
    filterItems();
});
</script>
@endsection
