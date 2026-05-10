<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusFound | Edit Penemuan </title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfd;
            color: #1e293b;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            background-image: radial-gradient(#e2e8f0 0.8px, transparent 0.8px);
            background-size: 24px 24px;
        }

        .main-container {
            max-width: 42rem;
            margin: 0 auto;
            padding: 5rem 1.5rem;
        }

        .header-wrapper {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-back {
            width: 2.5rem;
            height: 2.5rem;
            background: white;
            border: 1px solid #f1f5f9;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.2s;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-back:hover {
            color: #2563eb;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
        }

        .header-subtitle {
            font-size: 0.75rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 0.25rem;
        }

        .card-form {
            background: white;
            padding: 2rem;
            border-radius: 2.5rem;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.04);
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .label-text {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            color: #334155;
            margin-left: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .input-field {
            width: 100%;
            padding: 1rem 1.25rem;
            background-color: #f8fafc;
            border: none;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            font-family: inherit;
            transition: all 0.2s;
            outline: none;
        }

        .input-field:focus {
            box-shadow: 0 0 0 2px #3b82f6;
        }

        .file-upload-box {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f8fafc;
            border: 1px dashed #e2e8f0;
            border-radius: 1rem;
        }

        .preview-img {
            width: 4rem;
            height: 4rem;
            border-radius: 0.75rem;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        input[type="file"]::file-selector-button {
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            border: 0;
            font-size: 10px;
            font-weight: 700;
            background-color: #2563eb;
            color: white;
            cursor: pointer;
            transition: background 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #1d4ed8;
        }

        input[type="file"] {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Button Group */
        .button-group {
            display: flex;
            gap: 1rem;
            padding-top: 1rem;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            text-decoration: none;
            text-align: center;
        }

        .btn-cancel {
            flex: 1;
            background: white;
            border: 1px solid #e2e8f0;
            color: #475569;
        }

        .btn-cancel:hover {
            background: #f8fafc;
        }

        .btn-submit {
            flex: 2;
            background: #2563eb;
            border: none;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.2);
        }

        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <main class="main-container">

        <div class="header-wrapper">
            <a href="/profile" class="btn-back">
                <i data-lucide="chevron-left" style="width: 1.25rem; height: 1.25rem;"></i>
            </a>
            <div>
                <h1 class="header-title">Edit Penemuan</h1>
                <p class="header-subtitle">Perbarui informasi barang yang ditemukan</p>
            </div>
        </div>

        <form action="/items/1" method="POST" enctype="multipart/form-data">

            <div class="card-form">
                <div class="form-group">
                    <label class="label-text">Nama Barang</label>
                    <input type="text" name="name" value="Botol Minum Corkcicle Biru" class="input-field">
                </div>

                <div class="form-group">
                    <label class="label-text">Lokasi Ditemukan</label>
                    <select name="location" class="input-field">
                        <option value="Gedung Teknik">Gedung Teknik</option>
                        <option value="Perpustakaan" selected>Perpustakaan</option>
                        <option value="Kantin Pusat">Kantin Pusat</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="label-text">Deskripsi Tambahan</label>
                    <textarea name="description" rows="4" class="input-field">Ditemukan di bangku panjang lantai 2 dekat lift.</textarea>
                </div>

                <div class="form-group">
                    <label class="label-text">Ganti Foto (Opsional)</label>
                    <div class="file-upload-box">
                        <img src="https://images.unsplash.com/photo-1544724569-5f546fd6f2b5?w=100" class="preview-img">
                        <div style="flex: 1;">
                            <input type="file" name="image">
                        </div>
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
</body>
</html>
