<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<title>CampusFound</title>
<script src="https://unpkg.com/lucide@latest"></script>

<nav>
    <a href="#" class="logo">Campus<span>Found.</span></a>
    <div class="nav-actions">
        <a href="{{ route('login') }}" class="btn-login">Masuk</a>
        <a href="{{ route('register') }}" class="btn-register">Daftar Akun</a>
    </div>
</nav>

<section class="hero">
    <div class="hero-content">
        <div class="badge">🚀 Solusi Kehilangan dan Penemuan Barang Kampus</div>

        <h1 class="hero-title">
            Temukan Barangmu yang Hilang atau Tertinggal di <span>CampusFound.</span>
        </h1>

        <p class="hero-p">
            Platform digital sebagai media untuk saling membantu menemukan barang yang hilang atau melaporkan temuan di lingkungan kampus.
        </p>

        <div class="cta-group">
            <a href="{{ route('login') }}" class="btn-main">Mulai Sekarang</a>
        </div>
    </div>
</section>
<script>

    lucide.createIcons();

</script>
