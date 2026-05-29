
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="{{ asset('css/success.css') }}">


<div class="container">
    <div id="modalKlaim" class="modal-overlay active">
        <div class="modal-content">
            <div class="icon-container">
                <i data-lucide="party-popper" style="width: 48px; height: 48px;"></i>
            </div>

            <h2>Klaim Berhasil Dikirim!</h2>
            <p class="description">
                Laporan klaim Anda sudah masuk ke sistem. Penemu akan menghubungi Anda.
            </p>

            <div class="steps-card">
                <h4 class="steps-title">Langkah Selanjutnya:</h4>
                <div class="step-item">
                    <div class="step-number">1</div>
                    <p class="step-text">Pantau status laporan di menu <strong>"Jelajahi"</strong>.</p>
                </div>
                <div class="step-item" style="margin-bottom: 0;">
                    <div class="step-number">2</div>
                    <p class="step-text">Kamu dapat menghubungi penemu melalui menu Jelajahi, lalu buka detail laporan.</p>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('jelajahi') }}" class="btn-primary">Kembali ke Jelajahi</a>
                 <a href="{{ route('profile') }}" class="btn-ghost">Lihat Daftar Klaim Saya</a>
            </div>
        </div>
    </div>
</div>

    <script>

        lucide.createIcons();

        function toggleModal() {
            const modal = document.getElementById('modalKlaim');
            modal.classList.toggle('active');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modalKlaim');
            if (event.target == modal) {
                toggleModal();
            }
        }
    </script>

