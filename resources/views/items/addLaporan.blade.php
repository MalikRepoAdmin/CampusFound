<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusFound |Tambah Laporan</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
   <style>
    {!! file_get_contents(resource_path('css/addLaporan.css')) !!}
    </style>
</head>
<body>

    <div class="form-wrapper">
        <header class="header">
            <a href="/beranda" class="btn-back">
                <i data-lucide="arrow-left"></i>
            </a>
            <h1>Laporan Baru</h1>
        </header>

        <div class="form-card">
            <form action="{{ route('addLaporan') }}" method="POST">
                @csrf

                <label class="label">Kategori Laporan</label>
                <div class="type-selector">
                    <label class="type-option">
                        <input type="radio" name="kategori_laporan" value="found" checked>
                        <div class="type-label">
                            <i data-lucide="search-check"></i> Menemukan
                        </div>
                    </label>
                    <label class="type-option">
                        <input type="radio" name="kategori_laporan" value="lost">
                        <div class="type-label">
                            <i data-lucide="help-circle"></i> Kehilangan
                        </div>
                    </label>

                    @error('kategori_laporan')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label class="label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="input" placeholder="Apa nama barangnya?">

                    @error('nama_barang')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid-2">
                    <div>
                        <label class="label">Kategori Barang</label>
                        <select class="select" name="kategori_barang">
                            <option>Elektronik</option>
                            <option>Dokumen/KTM</option>
                            <option>Aksesoris</option>
                            <option>Lainnya</option>
                        </select>

                        @error('kategori_barang')
                            <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="label">Lokasi</label>
                        <input type="text" name="lokasi" class="input" placeholder="Contoh: Gedung C">

                        @error('lokasi')
                            <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="margin-bottom: 24px;">
                    <label class="label">Deskripsi Tambahan</label>
                    <textarea name="deskripsi" class="textarea" placeholder="Warna, merk, atau kondisi khusus..."></textarea>

                    @error('deskripsi')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 30px;">
                    <label class="label">Foto Barang</label>
                    <div class="upload-area">
                        <i data-lucide="camera" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 12px;"></i>
                        <p style="font-size: 14px; font-weight: 700; color: var(--slate-900);">Klik untuk Unggah Foto</p>
                        <span style="font-size: 11px; color: var(--slate-500);" name="foto_barang">Mendukung JPG, PNG (Maks. 2MB)</span>

                        @error('foto_barang')
                            <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Publikasikan Sekarang
                    <i data-lucide="send" style="width: 20px;"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
