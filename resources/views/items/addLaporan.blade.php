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
            <form action="#">
                <label class="label">Status Barang</label>
                <div class="type-selector">
                    <label class="type-option">
                        <input type="radio" name="st" checked>
                        <div class="type-label">
                            <i data-lucide="search-check"></i> Menemukan
                        </div>
                    </label>
                    <label class="type-option">
                        <input type="radio" name="st">
                        <div class="type-label">
                            <i data-lucide="help-circle"></i> Kehilangan
                        </div>
                    </label>
                </div>

                <div style="margin-bottom: 24px;">
                    <label class="label">Nama Barang</label>
                    <input type="text" class="input" placeholder="Apa nama barangnya?">
                </div>

                <div class="grid-2">
                    <div>
                        <label class="label">Kategori</label>
                        <select class="select">
                            <option>Elektronik</option>
                            <option>Dokumen/KTM</option>
                            <option>Aksesoris</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="label">Lokasi</label>
                        <input type="text" class="input" placeholder="Contoh: Gedung C">
                    </div>
                </div>

                <div style="margin-bottom: 24px;">
                    <label class="label">Deskripsi Tambahan</label>
                    <textarea class="textarea" placeholder="Warna, merk, atau kondisi khusus..."></textarea>
                </div>

                <div style="margin-bottom: 30px;">
                    <label class="label">Foto Barang</label>
                    <div class="upload-area">
                        <i data-lucide="camera" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 12px;"></i>
                        <p style="font-size: 14px; font-weight: 700; color: var(--slate-900);">Klik untuk Unggah Foto</p>
                        <span style="font-size: 11px; color: var(--slate-500);">Mendukung JPG, PNG (Maks. 2MB)</span>
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
