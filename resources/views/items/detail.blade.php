@extends('layouts.app')
@include('items.success')

@section('title', 'CampusFound | Detail Temuan')

@section('content')
<main class="content-wrapper">
    <div class="detail-grid">
        <section class="image-section">
            <div class="sticky-container">
                <div class="image-card">
                    <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&q=80&w=1200" alt="Detail Barang">
                </div>
                <div class="thumbnail-list">
                    <div class="thumb active"><img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&q=80&w=200"></div>
                    <div class="thumb"><img src="https://images.unsplash.com/photo-1615526675159-e248c3021d3f?auto=format&fit=crop&q=80&w=200"></div>
                </div>
            </div>
        </section>

        <section class="info-section">
            <span class="category-badge">Elektronik</span>
            <h1 class="item-title">Charger Laptop Asus ROG</h1>
            <p class="timestamp"><i data-lucide="clock"></i> Ditemukan pada 24 Oktober 2024 • 14:20 WIB</p>

            <div class="status-grid">
                <div class="status-card"><small>LOKASI SPESIFIK</small><p>Gedung Teknik Lt. 2 (Ruang 204)</p></div>
                <div class="status-card"><small>STATUS BARANG</small><p class="status-available">Tersedia</p></div>
            </div>

            <div class="description-box">
                <h3>Deskripsi Temuan</h3>
                <p>Ditemukan charger laptop merk ASUS ROG warna hitam di area meja pojok ruang kelas 204. Kondisi kabel masih rapi.</p>
            </div>

            <div class="reporter-card">
                <div class="reporter-content">
                    <div class="avatar-circle">A</div>
                    <div class="reporter-text"><small>DILAPORKAN OLEH</small><p>Admin PNM (Staff Keamanan)</p></div>
                </div>
                <i data-lucide="shield-check" class="verified-icon"></i>
            </div>

            <div class="action-group">
                <button class="btn-primary"><i data-lucide="message-circle"></i> Hubungi Penemu</button>
               <button class="btn-outline" onclick="toggleModal()" >
        Sampaikan Klaim
    </button>
            </div>
        </section>
    </div>

    <section class="comment-section">
        <div class="comment-detail-grid">
            <div class="comment-main-col">
                <div class="comment-header-main">
                    <h3 class="comment-title">Diskusi <span>3</span></h3>
                </div>

                <div class="comment-input-area">
                    <div class="avatar-user me">U</div>
                    <div class="input-wrapper">
                        <textarea placeholder="Tulis komentar..." rows="1"></textarea>
                        <button class="btn-send-minimal"><i data-lucide="send"></i></button>
                    </div>
                </div>

                <div class="comment-list">
                    <div class="comment-group" id="comment-1">
                        <div class="comment-item">
                            <div class="avatar-user">R</div>
                            <div class="comment-bubble">
                                <div class="comment-meta">
                                    <span class="user-name">Malik</span>
                                    <span class="comment-time">2 jam lalu</span>
                                </div>
                                <p class="comment-text">Mas, apakah adaptornya yang versi 180W?</p>
                                <button class="btn-reply-action" onclick="showReplyForm(1)">Balas</button>
                            </div>
                        </div>
                        <div id="reply-form-container-1" class="reply-form-container"></div>

                        <div class="comment-replies-container">
                            <div class="comment-item reply">
                                <div class="avatar-user admin">A</div>
                                <div class="comment-bubble">
                                    <div class="comment-meta">
                                        <span class="user-name">Admin PNM</span>
                                        <span class="comment-time">1 jam lalu</span>
                                    </div>
                                    <p class="comment-text">Bisa langsung cek ke pos keamanan kak.</p>
                                    <button class="btn-reply-action" onclick="showReplyForm('admin-1')">Balas</button>
                                </div>
                            </div>
                            <div id="reply-form-container-admin-1" class="reply-form-container"></div>
                        </div>
                    </div>
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
function showReplyForm(commentId) {
    document.querySelectorAll('.reply-form-container').forEach(c => c.innerHTML = '');
    const container = document.getElementById(`reply-form-container-${commentId}`);
    container.innerHTML = `
        <div class="comment-input-area" style="margin: 8px 0 15px 42px;">
            <div class="avatar-user me" style="width: 26px; height: 26px; font-size: 10px;">U</div>
            <div class="input-wrapper">
                <textarea placeholder="Balas..." rows="1" autofocus style="font-size:12px;"></textarea>
                <button class="btn-send-minimal"><i data-lucide="send" style="width: 14px;"></i></button>
            </div>
            <button onclick="this.parentElement.remove()" style="background:none; border:none; font-size:11px; color:#94a3b8; cursor:pointer; margin-left:8px;">Batal</button>
        </div>
    `;
    lucide.createIcons();
}
window.toggleModal = function() {
    const modal = document.getElementById('modalKlaim');
    modal.classList.toggle('active');
}
</script>
@endsection
