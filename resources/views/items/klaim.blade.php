<title>CampusFound | Klaim</title>
<link rel="stylesheet" href="{{ asset('css/klaim.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest"></script>

<div class="form-wrapper">
    <header class="header">
        <a href="javascript:history.back()" class="btn-back">
            <i data-lucide="arrow-left"></i>
        </a>
        <h1>Ajukan Klaim</h1>
    </header>

    <div class="form-card">
        <form action="{{ route('klaim', ['laporan' => $laporan]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom: 24px;">
                <label class="label">Deskripsi Khusus</label>
                <textarea name="ciri" class="textarea" placeholder="Ciri khusus seperti sticker, tanda pengenal, dsb."></textarea>
            </div>

            <div style="margin-bottom: 30px;">
                <label class="label">Foto Bukti Barang/Kepemilikan Barang</label>
                <div class="upload-area" onclick="document.getElementById('foto_bukti').click();">
                    <i data-lucide="camera" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 12px;"></i>
                    <p style="font-size: 14px; font-weight: 700; color: var(--slate-900);">Klik untuk Unggah Foto</p>
                    <span style="font-size: 11px; color: var(--slate-500);">Mendukung JPG, PNG (Maks. 2MB)</span>

                    <input type="file" id="foto_bukti" name="foto_bukti" accept="image/jpeg, image/png, image/jpg" style="display: none;">

                    @error('foto_bukti')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <button onclick="toggleModal()" type="submit" class="btn-submit">
                Submit Sekarang
                <i data-lucide="send" style="width: 20px;"></i>
            </button>
        </form>
    </div>
</div>

<script>
    lucide.createIcons();
    // Fungsi showReplyForm telah dihapus karena fitur reply dinonaktifkan
window.toggleModal = function() {
    const modal = document.getElementById('modalKlaim');
    if (modal) {
        modal.classList.toggle('active');
    }
}
</script>
