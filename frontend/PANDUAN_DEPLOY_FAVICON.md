# Panduan Deploy Favicon — SIVISIT CareVisit Monitor

## Ringkasan

Favicon SIVISIT (logo "SV" biru) sudah tersedia dalam dua format:

| Format | File | Keterangan |
|--------|------|------------|
| SVG | `favicon.svg` | Vektor, untuk browser modern |
| ICO | `favicon.ico` | Fallback untuk browser lama |

---

## 1. Lokasi File

### Frontend (PHP Native)
```
frontend-CareVisitMonitor/
├── favicon.svg          <-- sudah ada
└── Pages/*.php          <-- sudah menyertakan <link rel="icon">
```

### Backend (Laravel)
```
sivisit_CareVisitMonitor/public/
├── favicon.svg          <-- sudah ada
├── favicon.ico          <-- sudah ada

sivisit_CareVisitMonitor/resources/views/
├── layouts/app.blade.php        <-- sudah ada favicon (layout utama, asset helper)
└── admin/login.blade.php        <-- sudah ada favicon (halaman login)
```

---

## 2. Cara Menambahkan Favicon ke Halaman Blade Baru

### Layout `app.blade.php` (otomatis diwariskan ke semua halaman)
```blade
<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
```
Gunakan `asset()` helper agar path menuju folder `public/`.

### Halaman login (standalone, tanpa layout)
Tambahkan langsung di `<head>` dengan `asset()` seperti di atas.

---

## 3. Verifikasi

Setelah deploy, buka halaman di browser dan pastikan:

1. Favicon muncul di tab browser
2. Tidak ada error 404 di tab Network (DevTools → Network → filter `favicon`)

---

## 4. Troubleshooting

### ❌ Favicon tidak muncul
- **Cache browser** — Hard refresh: `Ctrl + F5` (Windows) / `Cmd + Shift + R` (Mac)
- **Cache Laravel** — Jalankan `php artisan view:clear` dan `php artisan config:clear`
- **Path salah** — Cek path file di DevTools → Network → cari request `favicon`

### ❌ Error 404 favicon
- Pastikan file `favicon.svg` dan `favicon.ico` sudah ada di `public/` di server
- Helper `asset()` akan mengarah ke `public/favicon.svg`

### ❌ Browser menampilkan favicon default
- Beberapa browser menyimpan cache favicon agresif. Gunakan mode Incognito/Private untuk verifikasi awal

---

## 5. Deploy ke Web Host (Laravel)

### Upload via FTP / File Manager

```
public_html/
├── favicon.svg          ← upload (jika belum ada)
├── favicon.ico          ← upload (jika belum ada)
├── index.php
└── ... (file Laravel lainnya)
```

> Tidak perlu upload ulang semua file Blade — cukup `favicon.svg`, `favicon.ico`, dan pastikan file Blade yang sudah diedit sudah terdeploy.

### Jika menggunakan Git Deployment

```bash
cd /path/to/sivisit_CareVisitMonitor
git add public/favicon.svg public/favicon.ico \
       resources/views/layouts/app.blade.php \
       resources/views/admin/login.blade.php
git commit -m "feat: add favicon to Blade layouts"
git push origin main
```

### Jika hosting shared (tanpa Git)

Upload ulang 4 file ini:
| File | Path di server |
|------|---------------|
| `favicon.svg` | `public/favicon.svg` |
| `favicon.ico` | `public/favicon.ico` |
| `app.blade.php` | `resources/views/layouts/app.blade.php` |
| `login.blade.php` | `resources/views/admin/login.blade.php` |

---

## 6. Catatan Penting

- Backend Laravel menggunakan **Blade** sebagai template engine — jangan edit file `public/*.php` untuk urusan tampilan
- Helper `asset()` otomatis menghasilkan URL ke folder `public/`
- Semua halaman yang menggunakan layout `app.blade.php` akan otomatis memiliki favicon
