<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<title>CampusFound |Register</title>
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<div class="blue-blob"></div>

<main>
    <div class="login-wrapper">
        <div class="floating-card">
            <div class="logo-container">
                <div class="logo-box">
                    <i data-lucide="compass"></i>
                </div>
                <span class="brand-name">Campus<span class="brand-dot">Found.</span></span>
            </div>

            <h1>Sign Up</h1>
            <p class="subtitle">Buat akun baru untuk memulai.</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan Nama" class="input-minimal">

                    @error('nama')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan Email" class="input-minimal">

                    @error('email')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>No. Handphone</label>
                    <input type="tel" name="no_hp" value="{{ old('no_hp') }}" required placeholder="628xxxxxxxxxx" class="input-minimal">

                    @error('no_hp')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="label-row">
                        <label>Password</label>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••" class="input-minimal">

                    @error('password')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••" class="input-minimal">

                    @error('password_confirmation')
                        <span style="color: red; font-size: 12px; display: block; margin-top: 5px;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-dark" style="width: 100%;">
                    Daftar Sekarang
                </button>
            </form>

            <div class="card-footer">
                <p>
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="register-link">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>

    <div class="info-section">
        <div class="info-glass">
            <div class="glass-icon-box">
                 <div class="logo-box">
                    <i data-lucide="compass"></i>
                </div>
            </div>
            <h2>Terverifikasi & Aman</h2>
            <p>
                Setiap barang yang ditemukan akan melalui proses verifikasi sistem yang ketat.
            </p>
            <div class="pagination">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
        <p class="copyright">PNM Digital Services • 2026</p>
    </div>
</main>

<script>

    lucide.createIcons();

    gsap.from(".blue-blob", {
        x: 100,
        opacity: 0,
        duration: 1.5,
        ease: "power4.out"
    });

    gsap.from(".floating-card", {
        y: 40,
        opacity: 0,
        duration: 1.2,
        ease: "expo.out",
        delay: 0.2
    });

    // Efek Parallax Move 3D pada Kartu Info
    document.addEventListener('mousemove', (e) => {
        const x = (window.innerWidth / 2 - e.pageX) / 40;
        const y = (window.innerHeight / 2 - e.pageY) / 40;
        gsap.to(".info-glass", {
            rotationY: x,
            rotationX: -y,
            duration: 1,
            ease: "power2.out"
        });
    });
</script>
