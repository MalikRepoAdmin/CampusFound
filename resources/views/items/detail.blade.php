@extends('layouts.app')
@if(session('success_klaim'))
    @include('items.success')
@endif

@section('title', 'CampusFound | Detail')

@section('content')
<main class="content-wrapper">
    <div class="detail-grid">
        <section class="image-section">
            <div class="sticky-container">
                <div class="image-card" style="background-color: #f8fafc; display: flex; align-items: center; justify-content: center; overflow: hidden; min-height: 300px; border-radius: 12px;">
                    @if(isset($laporan->barangs) && $laporan->barangs->foto_barang)
                        {{-- MENAMPILKAN FOTO ASLI DARI DATABASE --}}
                        <img src="{{ asset('storage/' . $laporan->barangs->foto_barang) }}" alt="{{ $laporan->barangs->nama_barang }}">
                    @else
                        {{-- MUNCUL JIKA FOTO NULL / KOSONG --}}
                        <div class="detail-placeholder" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; color: #94a3b8; text-align: center; padding: 40px;">
                            @if($laporan->kategori_laporan == 'found')
                                <i data-lucide="package" style="width: 64px; height: 64px; color: #cbd5e1;"></i>
                            @else
                                <i data-lucide="search" style="width: 64px; height: 64px; color: #cbd5e1;"></i>
                            @endif
                            <span style="font-size: 14px; font-weight: 500; color: #94a3b8; font-family: 'Plus Jakarta Sans', sans-serif;">Tidak ada foto untuk laporan ini</span>
                        </div>
                    @endif
                </div>
                
                {{-- DAFTAR THUMBNAIL DI BAWAHNYA --}}
                <div class="thumbnail-list">
                    <div class="thumb active" style="background-color: #f8fafc; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        @if(isset($laporan->barangs) && $laporan->barangs->foto_barang)
                            <img src="{{ asset('storage/' . $laporan->barangs->foto_barang) }}">
                        @else
                            @if($laporan->kategori_laporan == 'found')
                                <i data-lucide="package" style="width: 20px; height: 20px; color: #cbd5e1;"></i>
                            @else
                                <i data-lucide="search" style="width: 20px; height: 20px; color: #cbd5e1;"></i>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if ($laporan->kategori_laporan === 'found')
        <section class="info-section">
            <span class="category-badge">{{ $laporan->kategori_laporan }}</span>
            <span class="category-badge">{{ $laporan->barangs->kategori_barang }}</span>
            <h1 class="item-title">{{ $laporan->barangs->nama_barang }}</h1>
            <p class="timestamp"><i data-lucide="clock"></i> Ditemukan pada {{ $laporan->created_at->diffForHumans() }}</p>

            <div class="status-grid">
                <div class="status-card"><small>LOKASI</small><p>{{ $laporan->barangs->lokasi }}</p></div>
                <div class="status-card"><small>STATUS LAPORAN</small><p class="status-available">{{ $laporan->status_laporan }}</p></div>
            </div>

            <div class="description-box">
                <h3>Deskripsi Temuan</h3>
                <p>{{ $laporan->deskripsi }}</p>
            </div>

            <div class="reporter-card">
                <div class="reporter-content">
                    <!--kode helper untuk membuat insial nama-->
                    <div class="avatar-circle">{{ Str::of($laporan->users->nama)->words(2, '')->explode(' ')->map(fn($w) => Str::substr($w, 0, 1))->implode('') }}</div>
                    <div class="reporter-text"><small>DILAPORKAN OLEH {{ $laporan->users->email }}</small><p>{{ $laporan->users->nama }}</p></div>
                </div>
                <i data-lucide="shield-check" class="verified-icon"></i>
            </div>

            <div class="action-group">
                @if(isset($laporan->users->no_hp))
                    @php
                        // Membersihkan nomor HP dari karakter spasi, strip (-), atau tanda plus (+) jika ada
                        $cleanPhone = preg_replace('/[^0-9]/', '', $laporan->users->no_hp);
                        
                        // Opsional: Otomatis mengubah angka 0 di depan menjadi kode negara 62
                        if (str_starts_with($cleanPhone, '0')) {
                            $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                        
                        // Format template pesan teks otomatis saat WA dibuka
                        $pesanTeks = rawurlencode("Halo " . $laporan->users->nama . ", saya melihat laporan Anda di CampusFound mengenai barang '" . $laporan->barangs->nama_barang . "'. Apakah barang tersebut masih ada?");
                    @endphp

                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ $pesanTeks }}" 
                       target="_blank" 
                       class="btn-primary" 
                       style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                        <i data-lucide="message-circle"></i> Hubungi Penemu
                    </a>
                @else
                    {{-- Tombol Cadangan jika penemu tidak mendaftarkan nomor HP --}}
                    <button class="btn-primary" disabled style="opacity: 0.6; cursor: not-allowed;">
                        <i data-lucide="message-circle"></i> No. HP Tidak Tersedia
                    </button>
                @endif

                <button class="btn-outline" onclick="toggleModal()" >
                    Sampaikan Klaim
                </button>
            </div>
        </section>
        @endif
    </div>

    <section class="comment-section">
        <div class="comment-detail-grid">
            <div class="comment-main-col">
                <div class="comment-header-main">
                    {{-- Menampilkan jumlah total komentar asli secara dinamis --}}
                    <h3 class="comment-title">Diskusi <span>{{ $laporan->komentars->count() }}</span></h3>
                </div>

                {{-- Form input komentar baru --}}
                <div class="comment-input-area">
                    {{-- Mengambil inisial nama user yang sedang login jika ada --}}
                    <div class="avatar-user me">
                        {{ auth()->check() ? Str::substr(auth()->user()->nama, 0, 1) : 'U' }}
                    </div>
                    <div class="input-wrapper">
                        <form action="{{ route('komentar.store', ['id' => $laporan->id_laporan]) }}" method="POST">
                            @csrf

                            <textarea name="isi_komentar" placeholder="Tulis komentar..." rows="1"></textarea>
                            <button type="submit" class="btn-send-minimal"><i data-lucide="send"></i></button>
                        </form>
                    </div>
                </div>

                <div class="comment-list" style="display: flex; flex-direction: column; gap: 16px; margin-top: 20px;">
                    @forelse($laporan->komentars as $komentar)
                        <div class="comment-item" style="display: flex; gap: 12px; align-items: flex-start;">
                            {{-- Inisial nama pemberi komentar --}}
                            <div class="avatar-user" style="flex-shrink: 0;">
                                {{ isset($komentar->users) ? Str::substr($komentar->users->nama, 0, 1) : '?' }}
                            </div>
                            
                            <div class="comment-bubble" style="background-color: #f8fafc; padding: 12px 16px; border-radius: 12px; flex-grow: 1;">
                                <div class="comment-meta" style="display: flex; justify-content: space-between; margin-bottom: 6px; font-size: 13px;">
                                    <span class="user-name" style="font-weight: 700; color: #1e293b;">
                                        {{ $komentar->users->nama ?? 'Anonim' }}
                                    </span>
                                    <span class="comment-time" style="color: #94a3b8; font-size: 12px;">
                                        {{ $komentar->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                {{-- Teks isi komentar dari database --}}
                                <p class="comment-text" style="color: #475569; font-size: 14px; margin: 0; line-height: 1.5;">
                                    {{ $komentar->isi_komentar ?? $komentar->komentar }} 
                                    {{-- Sesuaikan nama kolom di atas jika nama kolom teks Anda bukan 'isi_komentar' --}}
                                </p>
                            </div>
                        </div>
                    @empty
                        {{-- Tampilan jika belum ada komentar sama sekali --}}
                        <div style="text-align: center; padding: 30px; color: #94a3b8; font-size: 14px;">
                            <i data-lucide="message-square-dashed" style="width: 32px; height: 32px; margin-bottom: 8px; color: #cbd5e1;"></i>
                            <p style="margin: 0;">Belum ada diskusi. Jadilah yang pertama berkomentar!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="comment-sidebar">
                <div class="sidebar-card">
                    <div class="illustration-box">
                        <img src="https://illustrations.popsy.co/amber/communication.svg" alt="Illustration">
                    </div>
                    <div class="sidebar-info">
                        <h4>Panduan Diskusi</h4>
                        <ul>
                            <li><i data-lucide="info"></i> Tanyakan detail barang untuk memastikan kepemilikan.</li>
                            <li><i data-lucide="shield-alert"></i> Hindari memberikan data pribadi yang sensitif.</li>
                            <li><i data-lucide="map-pin"></i> Temui penemu di lokasi resmi kampus atau tempat publik.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <a href="https://wa.me/6285708935152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
        <i data-lucide="message-circle"></i>
    </a>
</main>

<script>
// Fungsi showReplyForm telah dihapus karena fitur reply dinonaktifkan
window.toggleModal = function() {
    const modal = document.getElementById('modalKlaim');
    if (modal) {
        modal.classList.toggle('active');
    }
}
</script>
@endsection
