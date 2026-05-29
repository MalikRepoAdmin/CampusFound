@extends('layouts.app')

@section('title', 'CampusFound | Detail')

@section('content')
<main class="content-wrapper">
    @if(session('success_klaim'))
        @include('items.success')
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById('modalKlaim');
            if (modal) {
                modal.classList.add('active');
            }
        });
    </script>
    @endif
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
                

            </div>
        </section>

        <section class="info-section">
            <!-- Badge Kategori -->
            <span class="category-badge">{{ $laporan->kategori_laporan }}</span>
            <span class="category-badge">{{ $laporan->barangs->kategori_barang }}</span>
            
            <h1 class="item-title">{{ $laporan->barangs->nama_barang }}</h1>
            
            <!-- Dinamis: Ditemukan / Hilang pada -->
            <p class="timestamp">
                <i data-lucide="clock"></i> 
                {{ $laporan->kategori_laporan === 'found' ? 'Ditemukan' : 'Hilang' }} pada {{ $laporan->created_at->diffForHumans() }}
            </p>

            <div class="status-grid">
                <div class="status-card"><small>LOKASI</small><p>{{ $laporan->barangs->lokasi }}</p></div>
                <div class="status-card"><small>STATUS LAPORAN</small><p class="status-available">{{ $laporan->status_laporan }}</p></div>
            </div>

            <!-- Dinamis: Deskripsi Temuan / Kehilangan -->
            <div class="description-box">
                <h3>Deskripsi {{ $laporan->kategori_laporan === 'found' ? 'Temuan' : 'Kehilangan' }}</h3>
                <p>{{ $laporan->deskripsi }}</p>
            </div>

            <!-- Pelapor Card -->
            <div class="reporter-card">
                <div class="reporter-content">
                    <div class="avatar-circle">
                        {{ Str::of($laporan->users->nama)->words(2, '')->explode(' ')->map(fn($w) => Str::substr($w, 0, 1))->implode('') }}
                    </div>
                    <div class="reporter-text">
                        <small>DILAPORKAN OLEH {{ $laporan->users->email }}</small>
                        <p>{{ $laporan->users->nama }}</p>
                    </div>
                </div>
                <i data-lucide="shield-check" class="verified-icon"></i>
            </div>

            <div class="action-group">
                @if(isset($laporan->users->no_hp))
                    @php
                        $cleanPhone = preg_replace('/[^0-9]/', '', $laporan->users->no_hp);
                        
                        if (str_starts_with($cleanPhone, '0')) {
                            $cleanPhone = '62' . substr($cleanPhone, 1);
                        }
                        
                        // Dinamis: Menyesuaikan isi pesan template WhatsApp berdasarkan jenis laporan
                        $kataKunci = $laporan->kategori_laporan === 'found' ? "mengetahui barang" : "menemukan barang";
                        $pesanTeks = rawurlencode("Halo " . $laporan->users->nama . ", saya melihat laporan Anda di CampusFound " . $kataKunci . " '" . $laporan->barangs->nama_barang . "'.");
                    @endphp

                    <!-- Dinamis: Hubungi Penemu / Hubungi Pemilik -->
                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ $pesanTeks }}" 
                       target="_blank" 
                       class="btn-primary" 
                       style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                        <i data-lucide="message-circle"></i> Hubungi {{ $laporan->kategori_laporan === 'found' ? 'Penemu' : 'Pemilik' }}
                    </a>
                @else
                    <button class="btn-primary" disabled style="opacity: 0.6; cursor: not-allowed;">
                        <i data-lucide="message-circle"></i> No. HP Tidak Tersedia
                    </button>
                @endif

                <!-- Kondisi: Tombol klaim hanya muncul jika status laporan adalah barang yang ditemukan (found) -->
                @if($laporan->kategori_laporan === 'found')
                    <a class="btn-primary" href="{{ route('klaim', ['laporan' => $laporan]) }}">
                        Sampaikan Klaim
                    </a>
                @endif
            </div>
        </section>

        <div class="claims-discussion-grid">

            @if($laporan->kategori_laporan == 'found' && $laporan->klaims->isNotEmpty())
            <section class="klaim-section">
                <h3 class="item-title">Klaim Barang:</h3>
                @forelse($laporan->klaims as $klaim)
                    <div class="claimer-card">
                        <div class="claimer-content">
                            <div class="image-box">
                                @if(isset($klaim) && $klaim->foto_bukti)
                                    <img src="{{ asset('storage/' . $klaim->foto_bukti) }}"
                                         alt="{{ $klaim->laporans->barangs->nama_barang }}"
                                         class="preview-img">
                                @else
                                    <div class="image-placeholder">
                                        @if($klaim->laporans->kategori_laporan == 'found')
                                            <i data-lucide="package"></i>
                                        @else
                                            <i data-lucide="search"></i>
                                        @endif
                                        <span>No Image</span>
                                    </div>
                                @endif
                            </div>

                            <div class="claimer-text">
                                <small>{{ $klaim->ciri }}</small>
                                <p>{{ $klaim->users->nama }}</p>
                            </div>
                        </div>

                        @php
                            // Clean and force the international country code format (62) if it starts with 0
                            $phone = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $klaim->users->no_hp ?? ''));
                            
                            // Dynamic text template based on item context
                            $message = rawurlencode(sprintf(
                                "Halo %s, saya ingin menghubungi Anda terkait klaim saya pada laporan '%s' di CampusFound.",
                                $klaim->users->nama,
                                $laporan->barangs->nama_barang
                            ));
                        @endphp

                        <div class="claimer-actions">
                            @if(!empty($phone))
                                <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank" class="btn-contact-claimer">
                                    <i data-lucide="phone" style="width: 1rem; height: 1rem;"></i>
                                    Hubungi Pengeklaim
                                </a>
                            @else
                                <button class="btn-contact-claimer" disabled style="opacity: 0.5; cursor: not-allowed;">
                                    <i data-lucide="phone" style="width: 1rem; height: 1rem;"></i>
                                    No. HP Tidak Ada
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    @endforelse
            </section>
            @endif

            <aside class="comment-sidebar">
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
            </aside>
        </div>

    </div> <section class="comment-section">
        <div class="comment-header-main">
            <h3 class="comment-title">Diskusi <span>{{ $laporan->komentars->count() }}</span></h3>
        </div>

        <div class="comment-input-area">
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

                        @if(auth()->check() && $komentar->fk_id_user === auth()->id())
                            <form action="{{ route('komentar.delete', ['komentar' => $komentar]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id_komentar" value="{{ $komentar->id_komentar }}">
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0; display: flex; align-items: center;" title="Hapus Komentar">
                                    <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                </button>
                            </form>
                        @endif

                        <p class="comment-text" style="color: #475569; font-size: 14px; margin: 0; line-height: 1.5;">
                            {{ $komentar->isi_komentar ?? $komentar->komentar }} 
                        </p>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 30px; color: #94a3b8; font-size: 14px;">
                    <i data-lucide="message-square-dashed" style="width: 32px; height: 32px; margin-bottom: 8px; color: #cbd5e1;"></i>
                    <p style="margin: 0;">Belum ada diskusi. Jadilah yang pertama berkomentar!</p>
                </div>
            @endforelse
        </div>
    </section>

    <a href="https://wa.me/6285904417152?text=Halo%20CampusFound,%20saya%20butuh%20bantuan." class="fab-wa" target="_blank">
        <i data-lucide="message-circle"></i>
    </a>
</main>

<script>
// Fungsi showReplyForm telah dihapus karena fitur reply dinonaktifkan
{{-- window.toggleModal = function() {
    const modal = document.getElementById('modalKlaim');
    if (modal) {
        modal.classList.toggle('active');
    }
} --}}
</script>
@endsection
