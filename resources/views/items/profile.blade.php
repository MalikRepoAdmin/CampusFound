@extends('layouts.app')

@section('title', 'CampusFound | Profil Saya')

@section('content')
<main class="container-profile">
    <div class="profile-grid-profile">
        <div class="col-left-profile">
            <div class="card-profile-profile">
                <div class="avatar-wrapper-profile">
                    <img src="https://ui-avatars.com/api/?name=Budi+Setiawan&background=0D8ABC&color=fff&size=128" class="avatar-img-profile">
                </div>
                <h2 class="profile-name-profile">Budi Setiawan</h2>
                <p class="profile-nim-profile">NIM: 220102030</p>

                <div class="stats-grid-profile">
                    <div class="stat-box-profile">
                        <p class="stat-label-profile">Klaim</p>
                        <p class="stat-value-profile">3</p>
                    </div>
                    <div class="stat-box-profile">
                        <p class="stat-label-profile">Penemuan</p>
                        <p class="stat-value-profile">12</p>
                    </div>
                </div>

                <div class="contact-section-profile">
                    <p class="stat-label-profile" style="margin-left: 0.5rem; margin-bottom: 0.75rem;">Informasi Kontak</p>
                    <div class="contact-item-profile">
                        <i data-lucide="mail" style="width:1rem; height:1rem; color:#94a3b8;"></i>
                        budi.s@student.pnm.ac.id
                    </div>
                    <div class="contact-item-profile">
                        <i data-lucide="phone" style="width:1rem; height:1rem; color:#94a3b8;"></i>
                        0812-3456-7890
                    </div>
                    <button class="btn-edit-profile-profile">
                        <i data-lucide="edit-3" style="width:1rem; height:1rem;"></i> Edit Profil
                    </button>
                </div>
            </div>
        </div>

        <div class="col-right-profile">
            <div class="card-content-profile">
                <div class="tabs-header-profile">
                    <button onclick="switchTab('klaim')" id="btn-klaim" class="tab-btn-profile active">Klaim Saya</button>
                    <button onclick="switchTab('temuan')" id="btn-temuan" class="tab-btn-profile">Penemuan Saya</button>
                </div>

                <div id="tab-klaim" class="tab-pane-profile">
                    <div class="item-card-profile">
                        <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=200" class="item-img-profile">
                        <div class="item-info-profile">
                            <span class="badge-profile badge-amber-profile">Verifikasi</span>
                            <h4 class="item-title-profile">Charger Asus ROG</h4>
                            <p class="item-date-profile">Diajukan: 24 Okt 2024</p>
                        </div>
                        <button class="btn-action-profile btn-cancel-profile">Batalkan</button>
                    </div>
                </div>

                <div id="tab-temuan" class="tab-pane-profile hidden-tab-profile">
                    <div class="item-card-profile">
                        <img src="https://images.unsplash.com/photo-1544724569-5f546fd6f2b5?w=200" class="item-img-profile">
                        <div class="item-info-profile">
                            <span class="badge-profile badge-blue-profile">Aktif</span>
                            <h4 class="item-title-profile">Botol Minum Corkcicle Biru</h4>
                            <p class="item-date-profile" style="color:var(--primary); font-weight:700; background:var(--primary-light); width:fit-content; padding:2px 8px; border-radius:6px; margin-top:8px;">2 Klaim Baru</p>
                        </div>
                        <div style="display:flex; flex-direction:column; gap:0.5rem;">
                            <a href="/items/1/editbarang" class="btn-action-profile btn-edit-item-profile" style="display:flex; align-items:center; gap:0.5rem; justify-content:center;">
                                <i data-lucide="edit-2" style="width:0.8rem; height:0.8rem;"></i> Edit
                            </a>
                            <button onclick="confirmDelete(1, 'Botol Minum')" class="btn-action-profile btn-delete-profile" style="display:flex; align-items:center; gap:0.5rem; justify-content:center;">
                                <i data-lucide="trash-2" style="width:0.8rem; height:0.8rem;"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    lucide.createIcons();
    function switchTab(tab) {
        const isKlaim = tab === 'klaim';
        document.getElementById('tab-klaim').classList.toggle('hidden-tab-profile', !isKlaim);
        document.getElementById('tab-temuan').classList.toggle('hidden-tab-profile', isKlaim);

        document.getElementById('btn-klaim').classList.toggle('active', isKlaim);
        document.getElementById('btn-temuan').classList.toggle('active', !isKlaim);
    }

    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Hapus Postingan?',
            text: `Hapus "${name}"? Tindakan ini permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'swal-custom-radius' }
        });
    }
</script>
@endsection
