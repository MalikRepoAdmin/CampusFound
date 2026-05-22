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
            <form action="{{ route('addLaporan') }}" method="POST" enctype="multipart/form-data">
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
                    
                    <!-- Tambahkan ID dan style kursor pointer -->
                    <div class="upload-area" id="drop-zone" style="border: 2px dashed var(--slate-300); padding: 20px; text-align: center; border-radius: 8px; cursor: pointer; transition: background 0.2s;">
                        
                        <!-- Input file tersembunyi -->
                        <input type="file" id="file-input" name="foto_barang" accept="image/jpeg, image/png" style="display: none;">
                        
                        <i data-lucide="camera" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 12px;"></i>
                        <p style="font-size: 14px; font-weight: 700; color: var(--slate-900);" id="upload-text">Klik atau Tarik Foto ke Sini</p>
                        <span style="font-size: 11px; color: var(--slate-500);">Mendukung JPG, PNG (Maks. 2MB)</span>
                        
                        @error('foto_barang')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <style>
                    /* Efek visual saat file berada di atas area drop */
                    .upload-area.dragover {
                        background-color: var(--slate-100);
                        border-color: var(--primary) !important;
                    }
                </style>

                <button type="submit" class="btn-submit">
                    Publikasikan Sekarang
                    <i data-lucide="send" style="width: 20px;"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();

        document.addEventListener("DOMContentLoaded", () => {
            const dropZone = document.getElementById("drop-zone");
            const fileInput = document.getElementById("file-input");
            const uploadText = document.getElementById("upload-text");

            // 1. Memicu klik input file saat area drop di-klik
            dropZone.addEventListener("click", () => fileInput.click());

            // 2. Efek visual saat file ditarik di atas area
            ["dragenter", "dragover"].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.add("dragover");
                }, false);
            });

            ["dragleave", "drop"].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.remove("dragover");
                }, false);
            });

            // 3. Menangani file yang dijatuhkan (Drop)
            dropZone.addEventListener("drop", (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    fileInput.files = files; // Masukkan file ke dalam input HTML
                    handleFile(files[0]);
                }
            });

            // 4. Menangani file yang dipilih lewat klik manual
            fileInput.addEventListener("change", (e) => {
                if (fileInput.files.length > 0) {
                    handleFile(fileInput.files[0]);
                }
            });

            // 5. Validasi ringan & feedback visual
            function handleFile(file) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                
                if (file.size > maxSize) {
                    alert("Ukuran file terlalu besar! Maksimal 2MB.");
                    fileInput.value = ""; // Reset input
                    uploadText.innerText = "Klik atau Tarik Foto ke Sini";
                    return;
                }

                // Tampilkan nama file yang berhasil dipilih
                uploadText.innerText = `Terpilih: ${file.name}`;
                uploadText.style.color = "var(--primary)";
            }
        });
    </script>
</body>
</html>
