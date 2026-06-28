# SIVISIT CareVisit Monitor

## Deskripsi Singkat

SIVISIT CareVisit Monitor adalah platform web integratif untuk mendigitalisasi alur kerja layanan kunjungan rumah (home care) bagi pasien binaan seperti lansia atau penderita penyakit kronis. Aplikasi ini membagi hak akses secara sistematis untuk Admin, Petugas Kesehatan, dan Pasien/Keluarga dengan pencatatan parameter klinis seperti tanda vital, keluhan, dan catatan observasi.

Petugas kesehatan dapat mengelola tugas harian serta melakukan entri rekam medis dari lapangan, sementara pihak keluarga pasien mendapatkan kemudahan akses untuk memantau grafik riwayat kesehatan pasien cukup dengan menggunakan kode akses dummy.

## Anggota Kelompok

| No | Nama | NIM | Peran |
|----|------|-----|-------|
| 1 | Bagus Artandyo Witjaksono | 24102029 | Backend Developer |
| 2 | Mir'atus Sani Fadillah | 24102047 | Frontend Developer |
| 3 | Salma Nurul Aliyah | 24102036 | UI/UX Designer |
| 4 | Syani Carissa Syawaluna | 24102038 | UI/UX Designer |

## Fitur Aplikasi

- **Login Multi-Role** — Login dengan hak akses Admin dan Petugas Kesehatan
- **Dashboard Interaktif** — Ringkasan statistik pasien, monitoring hari ini, dan grafik status
- **CRUD Pasien** — Tambah, lihat, edit, dan hapus data pasien binaan
- **CRUD Monitoring** — Catat kunjungan home care dengan parameter klinis lengkap
- **CRUD Petugas** — Kelola akun petugas kesehatan
- **Manajemen Jadwal** — Atur jadwal kunjungan pasien
- **Pelacakan Lokasi** — Pantau posisi petugas di lapangan dengan Leaflet.js
- **Pencarian Pasien** — Cari pasien berdasarkan kode atau NIK (keluarga)
- **Rekam Medis** — Riwayat pemeriksaan pasien
- **Laporan & Statistik** — Analisis data monitoring per periode
- **API RESTful** — Backend API untuk integrasi frontend
- **Frontend Responsif** — Tampilan mobile-friendly (375px - 1440px)
- **Validasi Input** — Validasi data klinis (tekanan darah, suhu tubuh, dll)
- **Mode Mock API** — Frontend dapat berjalan dengan data dummy jika backend offline

## Teknologi

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** PHP Native, HTML5, CSS3, JavaScript
- **Styling:** Bootstrap 5, Custom CSS (globals.css, landing.css, auth.css, table.css, modal.css)
- **Database:** MySQL / MariaDB
- **API:** REST API (JSON), Sanctum Authentication
- **Map:** Leaflet.js + OpenStreetMap (free, no API key needed)
- **Icons:** Bootstrap Icons, SVG
- **Maps Integration:** Leaflet.js

## Cara Instalasi

### Prasyarat

- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js & NPM (untuk Vite/Laravel)

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/bagus-26/SIVISIT-CareVisitMonitor-FINAL.git
   cd SIVISIT-CareVisitMonitor-FINAL
   ```

2. **Install dependencies backend**
   ```bash
   cd backend
   composer install
   npm install
   npm run build
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   ```
   Edit `.env` dan atur koneksi database:
   ```
   DB_DATABASE=sivisit_carevisit
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate key**
   ```bash
   php artisan key:generate
   ```

5. **Jalankan migration dan seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan server**
   ```bash
   php artisan serve --port=8000
   ```

7. **Akses frontend**
   
   Buka `http://localhost/sivisit_CareVisitMonitor_FINAL/frontend/` atau deploy ke web server.

## Akun Demo

### Admin

| Field | Value |
|-------|-------|
| Email | `admin@sivisit.com` |
| Password | `Admin123456` |

### Petugas

| Field | Value |
|-------|-------|
| Email | `petugas@sivisit.com` |
| Password | `Petugas123456` |

### Kode Pasien (untuk akses keluarga/frontend)

| Pasien | Kode/NIK Dummy |
|--------|---------------|
| Bpk. Slamet | `3578010101010001` atau `P003` |
| Ibu Aminah | `3578010101010002` atau `P004` |
| Sdr. Rian | `3578010101010003` atau `RM-2026-0003` |

## Link Deploy

| Layanan | URL |
|---------|-----|
| **Frontend** | https://usivisit.gt.tc |
| **Backend/Admin** | https://sivisit.gt.tc/login |

## Endpoint API

### Autentikasi

| Method | Endpoint | Keterangan | Auth |
|--------|----------|------------|------|
| POST | `/api/login` | Login pengguna | No |
| POST | `/api/register` | Registrasi pengguna | No |
| POST | `/api/logout` | Logout | Yes (Sanctum) |

### Pasien (Publik)

| Method | Endpoint | Keterangan | Auth |
|--------|----------|------------|------|
| GET | `/api/pasien/{kode_pasien}/monitoring` | Riwayat monitoring pasien (untuk keluarga) | No |

### Pasien (Protected)

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | `/api/pasien` | Tampilkan semua pasien |
| POST | `/api/pasien` | Tambah pasien baru |
| PUT | `/api/pasien/{kode_pasien}` | Update data pasien |
| DELETE | `/api/pasien/{kode_pasien}` | Hapus pasien |

### Monitoring

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | `/api/monitoring` | Tampilkan semua monitoring |
| POST | `/api/monitoring` | Tambah monitoring baru |
| GET | `/api/monitoring/{id}` | Detail monitoring |
| PUT | `/api/monitoring/{id}` | Update monitoring |
| DELETE | `/api/monitoring/{id}` | Hapus monitoring |
| GET | `/api/monitoring/status/{status}` | Filter berdasarkan status |

### Jadwal Kunjungan

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| GET | `/api/jadwal` | Tampilkan semua jadwal |
| POST | `/api/jadwal` | Tambah jadwal baru |
| GET | `/api/jadwal/{id}` | Detail jadwal |
| PUT | `/api/jadwal/{id}` | Update jadwal |
| DELETE | `/api/jadwal/{id}` | Hapus jadwal |

### Lokasi Petugas

| Method | Endpoint | Keterangan |
|--------|----------|------------|
| POST | `/api/location/update` | Update lokasi petugas |
| GET | `/api/location/petugas` | Lihat lokasi petugas lain |
| GET | `/api/location/history` | Riwayat lokasi |
| GET | `/api/location/nearby` | Pasien terdekat |
| POST | `/api/location/geocode` | Reverse geocode koordinat |

## AI Usage Log

| No | Tanggal | Anggota | Tools AI | Prompt Penting | Hasil dari AI | Verifikasi/Revisi Tim |
|----|---------|---------|----------|----------------|---------------|----------------------|
| 1 | 13 Juni 2026 | Bagus Artandyo W | Google Gemini | Buatkan rancangan database untuk aplikasi monitoring kesehatan home care dengan entitas pasien dan monitoring kesehatan. | Struktur DB: Tabel patients (patient_id, patient_name, nik_dummy, dll) dan monitorings (id, patient_id, user_id, monitoring_date, blood_pressure, dll). | Direvisi ditambahkan kolom respiratory_rate, oxygen_saturation, heart_rate sesuai kebutuhan klinis; nama kolom disesuaikan konvensi Laravel. |
| 2 | 14 Juni 2026 | Bagus Artandyo W | Google Gemini | Perbaiki validasi Laravel untuk input tekanan darah format "120/80" dan suhu tubuh rentang 35–42 derajat Celcius. | Validasi: blood_pressure => regex `/^\d{2,3}\/\d{2,3}$/`, body_temperature => min:35, max:42. | Diuji manual dengan berbagai edge case (185/110, 34.5°C). Regex disesuaikan agar tidak terlalu ketat; rentang suhu dikonfirmasi sesuai standar klinis. |
| 3 | 14 Juni 2026 | Bagus Artandyo W | Google Gemini | Buat API endpoint Laravel GET /api/patients dan GET /api/patients/{id}/monitoring yang dapat diakses frontend PHP native. | API Controller: method index() dan show() mengembalikan data dalam format JSON. | Terverifikasi via Postman dan browser. Endpoint publik (tanpa Sanctum) diverifikasi aman karena hanya read-only. |
| 4 | 14 Juni 2026 | Bagus Artandyo W | Google Gemini | Buatkan tampilan dashboard admin yang modern dengan sidebar dark navy, kartu statistik, dan tabel data pasien responsif menggunakan Bootstrap 5 dan custom CSS. | Dashboard: Sidebar dark navy (#0F172A), stats cards dengan border-top warna berbeda per status, tabel dengan hover effect. | Diimplementasikan ke Blade Laravel. Warna disesuaikan ke #001A42, ditambahkan filter tab status, validasi client-side JavaScript, integrasi data Eloquent ORM, dan Bootstrap Icons. |
| 5 | - | Bagus Artandyo W | Google Gemini | Buat landing page frontend PHP native yang responsif sesuai desain Figma: navbar teal, hero section pencarian pasien, tentang layanan, cara kerja, dan footer ITSK Soepraoen. | Landing Page: Navbar sticky glassmorphism, hero section putih-bersih dengan form pencarian kode pasien, seksi cara kerja 3 langkah, footer informatif. | Diadaptasi ke PHP native dan dihubungkan ke API Laravel. Warna disesuaikan ke teal (#00B894), diuji responsif di mobile 375px dan desktop 1440px. |
| 6 | - | Bagus Artandyo W | Google Gemini | Slicing ini menjadi backend, gunakan warna biru, ganti Google Maps dengan Leaflet, hemat token, responsif untuk seluruh login. | Backend Login: login.blade.php split-panel biru responsif; hamburger mobile di app.blade.php; Leaflet.js + OpenStreetMap di show.blade.php. | Terverifikasi: Login diuji desktop & mobile. Map Leaflet merender lokasi tanpa API Key Google. Logo AI terhapus. |
| 7 | - | Bagus Artandyo W | Google Gemini | Buat API agar tersambung dengan front CareVisit, langsung implementasikan. | Integrasi API: PatientController & MonitoringController CRUD; CorsMiddleware; API_BASE_URL frontend ke endpoint Laragon lokal. | Terverifikasi: Controller terstruktur baik, CORS terlampir, frontend menunjuk ke endpoint API yang tepat. |
| 8 | 24 Juni 2026 | Bagus Artandyo W | Cursor (Agent Mode) | "Sesuaikan dengan ini kirim kesini perubahan secara lengkap" (+ screenshot mockup UI) | Redesign frontend: CSS baru (globals.css, landing.css, auth.css, table.css, modal.css); komponen sidebar.php, topbar.php; halaman index.php, login.php, dashboard.php, pasien.php, monitoring.php. | Baca mockup & file existing; perbaiki referensi CSS; update filter JS di pasien.php. |
| 9 | - | Bagus Artandyo W | Cursor (Agent Mode) | "Tambahkan gambar biar tidak hambar" (+ screenshot landing kosong) | Hero landing: foto Unsplash home care, overlay gradient, kartu floating; thumbnail foto di 3 kartu Layanan Unggulan; animasi hover di CSS. | Baca index.php, landing.css, screenshot user; update responsif mobile. |

## Pembagian Tugas

| No | Nama | Tugas |
|----|------|-------|
| 1 | Bagus Artandyo Witjaksono (24102029) | Backend Developer — Pengembangan API, Controller, Model, Migration, Seeder, Middleware, Routing, Dashboard Admin, Integrasi Frontend-Backend |
| 2 | Mir'atus Sani Fadillah (24102047) | Frontend Developer — Halaman frontend PHP Native (landing, login, dashboard, pasien, monitoring, jadwal, lokasi), CSS, komponen, koneksi API |
| 3 | Salma Nurul Aliyah (24102036) | UI/UX Designer — Desain antarmuka pengguna, wireframe, mockup Figma, styling global |
| 4 | Syani Carissa Syawaluna (24102038) | UI/UX Designer — Desain antarmuka pengguna, wireframe, mockup Figma, styling global |

## Latar Belakang

Transformasi digital pada sistem informasi saat ini memegang peranan krusial dalam mendigitalisasi alur kerja layanan kunjungan rumah (home care) bagi pasien binaan seperti lansia atau penderita penyakit kronis. Dirancangnya proyek SIVISIT CARE sebuah aplikasi web integratif dengan arsitektur data minimal terstruktur yang membagi hak akses secara sistematis untuk Admin, Petugas Kesehatan, dan Pasien/Keluarga. Dengan pencatatan parameter klinis seperti tanda vital, keluhan, dan catatan observasi. Melalui aplikasi ini, petugas kesehatan dapat dengan mudah mengelola tugas harian serta melakukan entri rekam medis dari lapangan, sementara pihak keluarga pasien mendapatkan kemudahan akses untuk memantau grafik riwayat kesehatan pasien cukup dengan menggunakan kode akses dummy.

## Tujuan Aplikasi

Tujuan dari pengembangan aplikasi CareVisit Monitor adalah untuk membangun platform web yang efisien dalam mengelola data pasien binaan, menyederhanakan proses pencatatan kunjungan home care, serta menyediakan visualisasi riwayat kesehatan yang terintegrasi secara real-time.

## Aktor/Pengguna Sistem

Aplikasi ini melibatkan tiga aktor utama dengan hak akses yang terbagi sebagai berikut:

- **Admin** — Bertanggung jawab untuk melakukan login serta mengelola data master pasien binaan dan petugas kesehatan.
- **Petugas Kesehatan** — Berperan untuk mengelola tugas harian, melakukan entri hasil monitoring klinis pasien di lapangan, dan melihat riwayat pemeriksaan.
- **Pasien/Keluarga** — Berperan sebagai pengguna frontend yang dapat mengecek jadwal kunjungan serta memantau grafik ringkasan kesehatan menggunakan kode akses atau NIK dummy tanpa perlu melakukan login.

## Lisensi

Proyek ini dikembangkan untuk memenuhi Tugas Besar Pemrograman Web — ITSK Soepraoen Malang.
