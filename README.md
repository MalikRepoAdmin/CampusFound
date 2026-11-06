# Sistem Informasi Lost and Found Kampus

Sistem Informasi Lost and Found Kampus merupakan aplikasi berbasis web yang dirancang untuk membantu mahasiswa dan civitas akademika dalam melaporkan, mencari, serta menemukan kembali barang yang hilang atau tertinggal di lingkungan kampus.

Proyek ini dikembangkan sebagai solusi atas banyaknya laporan kehilangan dan penemuan barang yang selama ini disampaikan melalui grup WhatsApp kampus. Dengan menyediakan platform khusus, informasi dapat dikelola secara lebih terstruktur, mudah dicari, dan terdokumentasi dengan baik.

## Anggota Kelompok

| No. | Nama | NIM | Peran |
|:---:|---|---|---|
| 1 | Indah Ayu Astuti | 254311002 | Frontend/Presentation Layer |
| 2 | Mohamad Malik Fajar Baihaqi | 254311011 | Backend/Bussiness Logic Layer |
| 3 | Dodo Fansyuri Andrian | 254311023 | Backend/Data Layer |

## Fitur Utama

- **Autentikasi Pengguna** — Registrasi, login, dan logout.
- **Laporan Barang Hilang** — Membuat laporan kehilangan barang di lingkungan kampus.
- **Laporan Barang Temuan** — Melaporkan barang yang ditemukan atau tertinggal.
- **Manajemen Laporan** — Mengelola laporan yang telah dibuat.
- **Komentar dan Diskusi** — Memberikan komentar atau informasi tambahan pada setiap laporan.
- **Pencarian dan Penelusuran** — Mencari serta melihat informasi laporan yang tersedia.

## Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP | Bahasa pemrograman backend |
| Laravel 13 | Framework utama pengembangan aplikasi |
| Blade Template | Rendering halaman frontend |
| Bootstrap / CSS | Pengaturan tampilan dan layout antarmuka |
| Eloquent ORM | Pengelolaan data dan relasi antarmodel |
| Laravel Schema Builder | Pengelolaan struktur database melalui migration |
| PHPUnit | Pengujian otomatis aplikasi |
| MySQL | Sistem manajemen basis data |

## Metode Pengembangan

Pengembangan aplikasi menggunakan metode **Software Development Life Cycle (SDLC) dengan model Waterfall**. Proses pengembangan dilakukan secara berurutan melalui tahapan berikut:

1. **Analisis Kebutuhan** — Mengidentifikasi permasalahan dan menentukan kebutuhan serta fitur sistem.
2. **Perancangan Sistem** — Merancang alur aplikasi, struktur basis data, relasi antartabel, dan antarmuka pengguna.
3. **Implementasi** — Mengembangkan backend menggunakan Laravel serta frontend menggunakan Blade Template dan CSS.
4. **Pengujian** — Melakukan unit testing, integration testing, dan system testing.
5. **Deployment** — Mempublikasikan aplikasi ke lingkungan deployment untuk demonstrasi dan evaluasi.

## Pengujian

Pengujian dilakukan secara bertahap menggunakan beberapa pendekatan:

| Jenis Pengujian | Metode / Tools | Tujuan |
|---|---|---|
| Unit Testing | PHPUnit | Memastikan fungsi controller, model, dan relasi database berjalan sesuai kebutuhan. |
| Integration Testing | Pengujian integrasi aplikasi | Memastikan frontend, route, controller, model, dan database dapat berinteraksi dengan benar. |
| System Testing | Pengujian fungsional | Memastikan seluruh alur dan fitur aplikasi berjalan sesuai kebutuhan sistem. |

## Pengembangan Selanjutnya

Sistem ini memiliki potensi untuk dikembangkan lebih lanjut, tidak hanya sebagai platform pelaporan barang hilang dan temuan, tetapi juga sebagai sumber data untuk mendukung pengelolaan informasi di lingkungan kampus.

Beberapa pengembangan yang dapat dipertimbangkan:

- Dashboard statistik laporan barang hilang dan barang temuan.
- Analisis lokasi yang paling sering menjadi tempat kehilangan atau penemuan barang.
- Analisis kategori barang yang paling sering dilaporkan.
- Riwayat penyelesaian laporan dan tingkat keberhasilan pengembalian barang.
- Sistem notifikasi untuk laporan yang relevan.
- Fitur verifikasi kepemilikan barang.

Data yang dikumpulkan secara terstruktur dapat menjadi landasan pengembangan sistem analitik dan pendukung pengambilan keputusan (Decision Support System) di lingkungan kampus.

## Instalasi dan Menjalankan Project

### Persyaratan

Pastikan perangkat telah memiliki:

- PHP dengan versi yang kompatibel dengan Laravel 13.
- Composer.
- MySQL atau database lain yang didukung Laravel.
- Git.

### 1. Clone Repository

```bash
git clone https://github.com/MalikRepoAdmin/CampusFound
cd CampusFound
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file konfigurasi environment:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lost_and_found
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Database Migration

```bash
php artisan migrate
```

### 6. Jalankan Aplikasi

```bash
php artisan serve
```

Secara default, aplikasi dapat diakses melalui:

http://127.0.0.1:8000


---

**Sistem Informasi Lost and Found Kampus**

_Mengelola informasi barang hilang dan temuan secara terstruktur untuk lingkungan kampus yang lebih terorganisir._
