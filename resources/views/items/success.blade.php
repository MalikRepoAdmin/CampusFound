<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klaim Terkirim | CaampusFound</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfd;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 24px;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: white;
            width: 100%;
            max-width: 448px;
            padding: 40px 24px;
            border-radius: 32px;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            transform: scale(0.9);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-overlay.active .modal-content {
            transform: scale(1);
        }

        .icon-container {
            width: 96px;
            height: 96px;
            background-color: #dcfce7;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            box-shadow: 0 10px 15px -3px rgba(220, 252, 231, 0.5);
        }

        h1 { font-size: 1.875rem; font-weight: 800; color: #0f172a; margin-bottom: 16px; }
        .description { color: #64748b; line-height: 1.625; margin-bottom: 40px; font-size: 1rem; }

        .steps-card {
            background: #ffffff;
            padding: 24px;
            border-radius: 32px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            margin-bottom: 32px;
            text-align: left;
        }

        .steps-title {
            font-size: 12px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 16px;
        }

        .step-item { display: flex; gap: 12px; align-items: flex-start; margin-bottom: 16px; }
        .step-number {
            width: 20px; height: 20px; background: #eff6ff; color: #2563eb;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 2px; font-size: 10px; font-weight: 700;
        }
        .step-text { font-size: 12px; color: #475569; font-weight: 500; }

        .btn-primary {
            display: block; width: 100%; background: #0f172a; color: white;
            padding: 16px; border-radius: 16px; font-weight: 700; font-size: 14px;
            text-decoration: none; border: none; transition: all 0.2s; cursor: pointer;
            margin-bottom: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .btn-primary:hover { background: #2563eb; }

        .btn-ghost {
            display: block; width: 100%; background: transparent; color: #64748b;
            padding: 8px; font-weight: 700; font-size: 12px; border: none;
            cursor: pointer; transition: color 0.2s;
        }
        .btn-ghost:hover { color: #1e293b; }

    </style>
</head>
<body>


    <div id="modalKlaim" class="modal-overlay">
        <div class="modal-content">
            <div class="icon-container">
                <i data-lucide="party-popper" style="width: 48px; height: 48px;"></i>
            </div>

            <h1>Klaim Berhasil Dikirim!</h1>
            <p class="description">
                Laporan klaim kamu sudah masuk ke sistem. Penemu atau Admin akan memverifikasi dalam waktu 1x24 jam.
            </p>

            <div class="steps-card">
                <h4 class="steps-title">Langkah Selanjutnya:</h4>
                <div class="step-item">
                    <div class="step-number">1</div>
                    <p class="step-text">Pantau status klaim di menu <strong>"Aktivitas Saya"</strong>.</p>
                </div>
                <div class="step-item" style="margin-bottom: 0;">
                    <div class="step-number">2</div>
                    <p class="step-text">Jika disetujui, kamu akan menerima pesan untuk koordinasi pengambilan.</p>
                </div>
            </div>

            <div class="action-buttons">
                <a href="/jelajahi" class="btn-primary">Kembali ke Jelajahi</a>
                 <a href="/profile" class="btn-ghost">Lihat Status Klaim Saya</a>
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
</body>
</html>
