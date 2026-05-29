<link rel="stylesheet" href="{{ asset('css/editlaporan.css') }}">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<title>CampusFound |Edit Barang</title>
<script src="https://unpkg.com/lucide@latest"></script>

<main class="main-container">

    <div class="header-wrapper">
        <a href="/profile" class="btn-back">
            <i data-lucide="chevron-left" style="width: 1.25rem; height: 1.25rem;"></i>
        </a>
        <div>
            <h1 class="header-title">Edit Laporan</h1>
            <p class="header-subtitle">Perbarui informasi barang yang ditemukan atau hilang</p>
        </div>
    </div>

    <form action="{{ route('editBarang', ['laporan' => $laporan]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-form">
            <div class="form-group">
                @if($laporan->status_laporan == "active")
                    <span class="badge-profile badge-yellow-profile">{{ $laporan->status_laporan }}</span>
                @else
                    <span class="badge-profile badge-green-profile">{{ $laporan->status_laporan }}</span>
                @endif

                @if($laporan->kategori_laporan == "found")
                    <span class="badge-profile badge-blue-profile">{{ $laporan->kategori_laporan }}</span>
                @else
                    <span class="badge-profile badge-red-profile">{{ $laporan->kategori_laporan }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="label-text">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{ $laporan->barangs->nama_barang }}" class="input-field">
            </div>

            <div class="form-group">
                <label class="label-text">Kategori Laporan</label>
                <select name="kategori_laporan" class="input-field">
                    <option value="lost">Kehilangan</option>
                    <option value="found">Menemukan</option>
                </select>
            </div>

            <div class="form-group">
                <label class="label-text">Lokasi Ditemukan/Hilang</label>
                <input type="text" name="lokasi" value="{{ $laporan->barangs->lokasi }}" class="input-field">
            </div>

            <div class="form-group">
                <label class="label-text">Deskripsi Tambahan</label>
                <textarea name="deskripsi" rows="4" class="input-field">{{ $laporan->deskripsi }}</textarea>
            </div>

            <div class="form-group">
                <label class="label-text">Ganti Foto Barang</label>
                <div class="file-upload-box">
                    
                    @if(isset($laporan->barangs) && $laporan->barangs->foto_barang)
                        {{-- TAMPILKAN FOTO ASLI JIKA USER MENGUNGGAH FOTO --}}
                        <img src="{{ asset('storage/' . $laporan->barangs->foto_barang) }}"
                             alt="{{ $laporan->barangs->nama_barang }}"
                             class="preview-img">
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

                    <div style="flex: 1;">
                        <input type="file" name="foto_barang">
                    </div>

                    @error('foto_barang')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="button-group">
            <a href="#" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-submit">Simpan Perubahan</button>
        </div>
    </form>
</main>

<script>
    lucide.createIcons();
</script>
