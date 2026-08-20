# Bils Tech — Portfolio Website

Website portofolio pribadi berbasis **Laravel** + **MySQL** dengan tema desain **Paper/Zine** — tampak seperti kertas, editorial, tidak generik.

## Stack
- **Laravel** (v12) — Backend
- **MySQL** — Database
- **Blade + Tailwind CSS** — Frontend
- **Alpine.js** — Interaktivitas (filter, modal, image preview)
- **Laravel Breeze** — Autentikasi

## Instalasi

### 1. Clone & Install Dependencies

```bash
git clone <repo-url> bils-tech
cd bils-tech
composer install
npm install
```

### 2. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bils_tech
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Database

```bash
# Buat database terlebih dahulu di MySQL
# CREATE DATABASE bils_tech CHARACTER SET utf8mb4;

php artisan migrate --seed
```

### 4. Storage

```bash
php artisan storage:link
```

### 5. Build Assets

```bash
npm run build
# atau untuk development:
npm run dev
```

### 6. Jalankan Server

```bash
php artisan serve
```

Buka `http://localhost:8000`

---

## Akun Admin (dari seeder)

| Field    | Value                |
|----------|----------------------|
| Email    | `admin@bilstech.id`  |
| Password | `password`           |

Akses panel admin di: `http://localhost:8000/admin`

---

## Fitur

### Halaman Publik
- ✅ Hero section dengan foto profil, nama, bio, tombol email
- ✅ Grid project dikelompokkan per kategori
- ✅ Filter tab kategori (Alpine.js — tanpa page reload)
- ✅ Lazy loading gambar + hover effects
- ✅ Responsive: 1 kolom mobile → 2 kolom tablet → 3 kolom desktop
- ✅ SEO: meta title + description dinamis dari data profil

### Panel Admin (`/admin`)
- ✅ Login only (tidak ada registrasi publik)
- ✅ Dashboard dengan statistik ringkas
- ✅ **CRUD Profil** — edit nama, bio, email, foto (preview + replace otomatis)
- ✅ **CRUD Kategori** — nama, auto-slug, proteksi hapus jika masih ada project
- ✅ **CRUD Projects** — upload gambar, judul, kategori, link demo, deskripsi
- ✅ Search + filter per kategori di list project
- ✅ Delete modal konfirmasi + hapus file dari storage
- ✅ Flash message sukses/gagal setiap aksi
- ✅ Sidebar responsif + mobile hamburger menu

---

## Desain: Paper/Zine Theme

| Elemen       | Nilai                              |
|--------------|------------------------------------|
| Background   | Cream `#F5F0E8` + noise texture   |
| Accent       | Terracotta/Sienna `#C4652A`        |
| Font Heading | Playfair Display (serif)           |
| Font Body    | DM Sans (geometric sans-serif)     |
| Font Mono    | JetBrains Mono                     |
| Card style   | Flat border, paper shadow on hover |

---

## Struktur Folder

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── ProfileController.php
│   │       ├── CategoryController.php
│   │       └── ProjectController.php
│   └── Requests/
│       ├── ProfileRequest.php
│       ├── CategoryRequest.php
│       └── ProjectRequest.php
└── Models/
    ├── Profile.php
    ├── Category.php
    └── Project.php
```
