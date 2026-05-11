<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di CampusFound</title>

    <!-- fontt -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- ikonnn -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        {!! file_get_contents(resource_path('css/welcome.css')) !!}
    </style>
</head>
<body>

    <nav>
        <a href="#" class="logo">Campus<span>Found.</span></a>
        <div class="nav-actions">
            <a href="/login" class="btn-login">Masuk</a>
            <a href="/register" class="btn-register">Daftar Akun</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="badge">🚀 Solusi Kehilangan Barang Kampus</div>

            <h1 class="hero-title">
                Temukan Barangmu yang Hilang di <span>CampusFound.</span>
            </h1>

            <p class="hero-p">
                Platform digital khusus mahasiswa untuk saling membantu menemukan barang yang hilang atau melaporkan temuan di lingkungan kampus secara aman dan terverifikasi.
            </p>

            <div class="cta-group">
                <a href="/login" class="btn-main">Mulai Sekarang</a>
            </div>

        </div>
    </section>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
