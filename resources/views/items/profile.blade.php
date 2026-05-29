@extends('layouts.app')

@section('title', 'CampusFound | Profil Saya')

@section('content')
<main class="container-profile">
    <div class="profile-grid-profile">
        <div class="col-left-profile">
            <div class="card-profile-profile">
                <!-- Avatar profile -->
                <div class="avatar-wrapper-profile">
                    <img src="https://ui-avatars.com/api/?name={{ $user->nama }}&length={{ $nameWordCount }}&background=0D8ABC&color=fff&size=128" class="avatar-img-profile">
                </div>
                <h2 class="profile-name-profile">{{ $user->nama }}</h2>

                <div class="stats-grid-profile">
                    <div class="stat-box-profile">
                        <p class="stat-label-profile">Klaim</p>
                        <p class="stat-value-profile">{{ $klaimCount }}</p>
                    </div>
                    <div class="stat-box-profile">
                        <p class="stat-label-profile">Laporan</p>
                        <p class="stat-value-profile">{{ $laporanCount }}</p>
                    </div>
                </div>

                <div class="contact-section-profile">
                    <p class="stat-label-profile" style="margin-left: 0.5rem; margin-bottom: 0.75rem;">Informasi Kontak</p>
                    <div class="contact-item-profile">
                        <i data-lucide="mail" style="width:1rem; height:1rem; color:#94a3b8;"></i>
                        {{ $user->email }}
                    </div>
                    <div class="contact-item-profile">
                        <i data-lucide="phone" style="width:1rem; height:1rem; color:#94a3b8;"></i>
                        {{ $user->no_hp }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-right-profile">
            <div class="card-content-profile">
                <div class="tabs-header-profile">
                    <button onclick="switchTab('klaim')" id="btn-klaim" class="tab-btn-profile active">Klaim Saya</button>
                    <button onclick="switchTab('temuan')" id="btn-temuan" class="tab-btn-profile">Laporan Saya</button>
                </div>

                <!-- Tab Klaim -->
                <div id="tab-klaim" class="tab-pane-profile">
                    @forelse($user->klaims as $klaim)
                        <div class="item-card-profile">
                            <div class="card-img-box" style="position: relative; width: 50%; height: 300px; background-color: #f8fafc; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                @if(isset($klaim) && $klaim->foto_bukti)
                                    {{-- TAMPILKAN FOTO ASLI JIKA USER MENGUNGGAH FOTO --}}
                                    <img src="{{ asset('storage/' . $klaim->foto_bukti) }}"
                                         alt="{{ $klaim->laporans->barangs->nama_barang }}"
                                         class="preview-img">
                                @else
                                    {{-- TAMPILKAN PLACEHOLDER JIKA FOTO NULL (KOSONG) --}}
                                    <div class="image-placeholder" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; color: #94a3b8; text-align: center; padding: 20px;">
                                        @if($klaim->laporans->kategori_laporan == 'found')
                                            <!-- Icon Box/Paket untuk Barang Temuan -->
                                            <i data-lucide="package" style="width: 48px; height: 48px; color: #cbd5e1;"></i>
                                        @else
                                            <!-- Icon Search/Kaca Pembesar untuk Barang Hilang -->
                                            <i data-lucide="search" style="width: 48px; height: 48px; color: #cbd5e1;"></i>
                                        @endif
                                        <span style="font-size: 12px; font-weight: 500; color: #94a3b8; font-family: 'Plus Jakarta Sans', sans-serif;">Tidak ada foto</span>
                                    </div>
                                @endif
                            </div>


                            <div class="item-info-profile">
                                {{-- <span class="badge-profile badge-amber-profile">Verifikasi</span> --}}
                                <h4 class="item-title-profile">{{ $klaim->laporans->barangs->nama_barang }}</h4>
                                <p class="item-date-profile">{{ $klaim->ciri }}</p>
                                <p class="item-date-profile">Diajukan {{ $klaim->created_at->diffForHumans() }}</p>
                            </div>

                            <form action="{{ route('klaim.cancel', ['klaim' => $klaim]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action-profile btn-cancel-profile" type="submit">Batalkan</button>
                            </form>
                        </div>
                    @empty
                    @endforelse
                </div>

                <!-- Tab Laporan -->
                <div id="tab-temuan" class="tab-pane-profile hidden-tab-profile">

                    @forelse($user->laporans as $laporan)
                        <div class="item-card-profile">
                            @if(isset($laporan->barangs) && $laporan->barangs->foto_barang)
                                {{-- TAMPILKAN FOTO ASLI JIKA USER MENGUNGGAH FOTO --}}
                                <img src="{{ asset('storage/' . $laporan->barangs->foto_barang) }}"
                                     alt="{{ $laporan->barangs->nama_barang }}"
                                     class="item-img-profile">
                            @else
                                {{-- TAMPILKAN PLACEHOLDER JIKA FOTO NULL (KOSONG) --}}
                                <div class="image-placeholder" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px; color: #94a3b8; text-align: center; padding: 20px;">
                                    @if($laporan->kategori_laporan == 'found')
                                        <!-- Icon Box/Paket untuk Barang Temuan -->
                                        <i data-lucide="package" style="width: 48px; height: 48px; color: #cbd5e1;"></i>
                                    @else
                                        <!-- Icon Search/Kaca Pembesar untuk Barang Hilang -->
                                        <i data-lucide="search" style="width: 48px; height: 48px; color: #cbd5e1;"></i>
                                    @endif
                                    <span style="font-size: 12px; font-weight: 500; color: #94a3b8; font-family: 'Plus Jakarta Sans', sans-serif;">Tidak ada foto</span>
                                </div>
                            @endif


                            <div class="item-info-profile">
                                @if($laporan->status_laporan == "active")
                                    <span class="badge-profile badge-yellow-profile">{{ $laporan->status_laporan }}</span>
                                @else
                                    <span class="badge-profile badge-green-profile">{{ $laporan->status_laporan }}</span>
                                @endif

                                @if($laporan->kategori_laporan == "found")
                                    <span class="badge-profile badge-blue-profile">{{ $laporan->kategori_laporan }}</span>
                                @else
                                    <span class="badge-profile badge-red-profile">{{ $laporan->kategori_laporan }}</span>
                                @endif


                                <h4 class="item-title-profile">{{ $laporan->barangs->nama_barang }}</h4>

                                @if($laporan->kategori_laporan == 'found')
                                    <p class="item-date-profile" style="color:var(--primary); font-weight:700; background:var(--primary-light); width:fit-content; padding:2px 8px; border-radius:6px; margin-top:8px;">
                                        {{ $laporan->klaims->count() }} Klaim
                                    </p>
                                @endif
                            </div>
                            <div style="display:flex; flex-direction:column; gap:0.5rem;">
                                <a href="{{ route('editBarang', ['laporan' => $laporan]) }}" class="btn-action-profile btn-edit-item-profile" style="display:flex; align-items:center; gap:0.5rem; justify-content:center;">
                                    <i data-lucide="edit-2" style="width:1.0rem; height:1.0rem;"></i> Edit
                                </a>

                                <a href="{{ route('laporan.detail', ['id' => $laporan->id_laporan]) }}" class="btn-action-profile btn-edit-item-profile" style="display:flex; align-items:center; gap:0.5rem; justify-content:center;">
                                    <i data-lucide="list-check" style="width:1.0rem; height:1.0rem;"></i> Detail
                                </a>

                                @if($laporan->status_laporan == 'active')
                                    <form action="{{ route('resolveLaporan', ['laporan' => $laporan]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <button type="submit" class="btn-action-profile btn-resolve-profile" style="display:flex; align-items:center; gap:0.5rem; justify-content:center; border:none; background:none; cursor:pointer;">                                    
                                            <i data-lucide="circle-check" style="width:1.0rem; height:1.0rem;"></i> Selesai                                
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</main>

<script>

    function switchTab(tab) {
        const isKlaim = tab === 'klaim';
        document.getElementById('tab-klaim').classList.toggle('hidden-tab-profile', !isKlaim);
        document.getElementById('tab-temuan').classList.toggle('hidden-tab-profile', isKlaim);

        document.getElementById('btn-klaim').classList.toggle('active', isKlaim);
        document.getElementById('btn-temuan').classList.toggle('active', !isKlaim);
    }

    function confirmResolve(id, name) {
        Swal.fire({
            title: 'Tandai Laporan sebagai Resolved?',
            text: `Resolve "${name}"? Tindakan ini permanen.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'swal-custom-radius' }
        });
    }
</script>
@endsection
