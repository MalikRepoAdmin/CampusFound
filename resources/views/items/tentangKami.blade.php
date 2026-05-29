@extends('layouts.app')

@section('title', 'CampusFound | Tentang Kami')

@section('content')
<div class="about-wrapper">

    <div class="about-header">
    <div class="about-content"> <span class="about-mini">Siapa Kami</span>
        <h1 class="about-title">Inovasi Kecil yang<br>Memberi Dampak Besar.</h1>
    </div>

    <div class="fot">
        <img src="{{ asset('assets/feed kepengurusan (1).png') }}" alt="Feed Kepengurusan">
    </div>
</div>

    <div class="bento-container">
        <div class="bento-item about-story">
            <h2 style="font-size: 24px; font-weight: 800; margin-bottom: 20px;">Filosofi CampusFound</h2>
            <p style="color: var(--text-light); font-size: 17px; line-height: 1.7;">
                Berawal dari puluhan laporan yang membanjiri grub Whatsapp setiap minggunya, CampusFound berkembang menjadi platform nyata yang memfasilitasi kejujuran. Kami percaya bahwa teknologi terbaik adalah yang mampu menyelesaikan masalah sosial sederhana: mengembalikan apa yang bukan milik kita.
            </p>
        </div>

        <div class="bento-item about-stats">
            <div style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                <span style="font-size: 40px; font-weight: 800;">100%</span>
                <p style="font-size: 14px; opacity: 0.7; text-transform: uppercase; letter-spacing: 1px;">Karya Anak TRPL</p>
                <p style="margin-top: 20px; font-style: italic; opacity: 0.9;">"No act of kindness, no matter how small, is ever wasted"</p>
            </div>
        </div>

        <div class="bento-item how-to-section">
            <div style="border-bottom: 1px solid var(--card-border); padding-bottom: 20px; margin-bottom: 30px;">
                <h2 style="font-size: 24px; font-weight: 800;">Cara Kerja</h2>
            </div>

            <div class="steps-wrapper">
                <div class="step-card">
                    <div class="step-icon-wrapper"><i data-lucide="camera"></i></div>
                    <h3>Dokumentasikan</h3>
                    <p>Potret barang temuan agar pemilik mudah mengenali detailnya.</p>
                </div>

                <div class="step-card">
                    <div class="step-icon-wrapper"><i data-lucide="map-pin"></i></div>
                    <h3>Tentukan Lokasi</h3>
                    <p>Sebutkan lokasi spesifik di mana barang ditemukan untuk verifikasi yang akurat.</p>
                </div>

                <div class="step-card">
                    <div class="step-icon-wrapper"><i data-lucide="check-circle"></i></div>
                    <h3>Tunggu Pemilik Barang</h3>
                    <p>Pemilik barang akan mengajukan klaim pada laporan dan menguhubungi anda.</p>
                </div>
            </div>
        </div>

        <div class="bento-item legal-section">
            <h3 class="legal-title"><i data-lucide="shield-check"></i> Ketentuan Layanan</h3>
            <ul class="legal-list">
                <li>Pengguna wajib memberikan informasi barang yang akurat dan jujur.</li>
                <li>CampusFound tidak bertanggung jawab atas kehilangan atau kerusakan barang selama proses penemuan.</li>
                <li>Dilarang menyalahgunakan platform untuk penipuan atau klaim palsu.</li>
            </ul>
        </div>

        <div class="bento-item legal-section">
            <h3 class="legal-title"><i data-lucide="lock"></i> Kebijakan Privasi</h3>
            <ul class="legal-list">
                <li>Data pribadi Anda (Nama/Kontak) hanya akan digunakan untuk keperluan verifikasi barang.</li>
                <li>Kami tidak akan menyimpan maupun membagikan data chat whatsapp anda.</li>
            </ul>
        </div>

    </div>
    <div style="margin-top: 80px; text-align: center;">
        <p style="color: var(--text-muted); margin-bottom: 24px; font-weight: 500;">Punya pertanyaan lebih lanjut?</p>
        <a href="https://wa.me/6285904417152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." style="text-decoration: none; color: #0f172a; font-weight: 800; border-bottom: 2px solid #2563eb; padding-bottom: 4px;">Hubungi Tim Kami &rarr;</a>
    </div>
</div>
 <a href="https://wa.me/6285904417152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
    <i data-lucide="message-circle"></i>
</a>
@endsection

