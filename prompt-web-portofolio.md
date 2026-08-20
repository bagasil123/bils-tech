# Prompt: Website Portofolio Pribadi (Laravel + MySQL)

## Konteks & Tujuan
Buatkan saya sebuah **website portofolio pribadi full-stack** menggunakan **Laravel** (versi terbaru, LTS) dan **MySQL** sebagai database. Website ini terdiri dari:
1. **Halaman publik** — bisa diakses siapa saja tanpa login, menampilkan profil dan daftar project.
2. **Panel admin** — hanya bisa diakses setelah login, berisi CRUD (Create, Read, Update, Delete) untuk mengelola konten yang tampil di halaman publik.

Desain harus **modern, bersih, profesional**, dan **terasa "buatan manusia"** — hindari kesan template generik/AI-generated seperti hero section gradient ungu-biru klise, font default (Inter/Poppins tanpa variasi), icon generic yang berulang, layout simetris kaku, dan copywriting yang terdengar seperti placeholder ("Welcome to my portfolio, I am a passionate developer..."). Utamakan karakter visual yang unik dan detail yang terasa dikurasi dengan sengaja.

---

## 1. Tech Stack
- **Backend**: Laravel (versi terbaru)
- **Database**: MySQL
- **Auth**: Laravel Breeze atau Laravel Fortify untuk autentikasi admin (login only, tanpa registrasi publik)
- **Frontend**: Blade + Tailwind CSS (boleh dikombinasikan dengan Alpine.js untuk interaktivitas ringan, atau Livewire jika ingin CRUD lebih reaktif tanpa reload halaman)
- **Upload gambar**: Laravel Storage (symlink `storage:link`), validasi tipe file (jpg, jpeg, png, webp) dan ukuran maksimal
- **Migration & Seeder**: sertakan migration lengkap + seeder dummy data agar bisa langsung dicoba

---

## 2. Struktur Database

### Tabel `profiles` (single row / singleton — hanya 1 data admin)
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint | primary key |
| name | string | nama lengkap |
| description | text | bio/deskripsi singkat |
| email | string | email kontak |
| photo | string (nullable) | path foto profil |
| created_at, updated_at | timestamp | |

### Tabel `categories` (kategori project)
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint | primary key |
| name | string | contoh: Web Development, UI/UX Design, Mobile App |
| slug | string | untuk filter di URL |
| created_at, updated_at | timestamp | |

### Tabel `projects`
| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint | primary key |
| category_id | foreign key → categories | |
| title | string | judul project |
| image | string | path gambar thumbnail |
| demo_link | string (nullable) | link live demo/test project |
| description | text (opsional, boleh ditambahkan) | |
| created_at, updated_at | timestamp | |

> Catatan: kategori dikelola terpisah (bukan enum) supaya admin bisa menambah/menghapus kategori sendiri lewat CRUD, dan grid publik otomatis menyesuaikan.

---

## 3. Halaman Publik (Front-end)

### Layout & Konten
- **Section Hero/Profile**: foto profil, nama, deskripsi/bio, email (bisa dibuat tombol "Contact via Email" dengan `mailto:`).
- **Section Projects**:
  - Ditampilkan dalam **grid per kategori** (misal: heading kategori "Web Development" → grid card project di bawahnya, lalu heading kategori berikutnya, dst).
  - Tambahkan **filter/tab kategori** di bagian atas grid (opsional tapi direkomendasikan) agar user bisa langsung lompat/filter tanpa scroll panjang.
  - Setiap card project menampilkan: gambar/thumbnail, judul, label kategori, dan tombol/link "Lihat Project" yang mengarah ke `demo_link` (buka tab baru).
  - Gunakan lazy loading untuk gambar dan efek hover halus (subtle, bukan animasi berlebihan).
- **Responsive**: mobile-first, grid menyesuaikan (1 kolom di mobile, 2-3 kolom di tablet/desktop).
- **Dark/Light mode** (opsional, nilai tambah).

### Prinsip Desain (agar tidak "terlalu AI")
- Gunakan tipografi dengan sedikit karakter (contoh: kombinasi font serif untuk heading + sans-serif untuk body, bukan satu font generik untuk semuanya).
- Palet warna spesifik dan personal (bukan default ungu-biru gradient), boleh monokrom + 1 warna aksen.
- Whitespace yang disengaja, grid tidak harus selalu simetris sempurna.
- Micro-interaction halus (hover, transition) — jangan berlebihan/flashy.
- Hindari stock icon set yang terlalu umum tanpa kustomisasi; hindari lorem ipsum di versi final (gunakan placeholder yang masuk akal).

---

## 4. Panel Admin

### Autentikasi
- Login only (tidak ada halaman register publik). Buat 1 user admin lewat seeder.
- Middleware `auth` untuk semua route admin, redirect ke login jika belum autentikasi.

### Dashboard Admin
- Sidebar/navbar dengan menu: **Dashboard**, **Profile**, **Kategori**, **Projects**, **Logout**.
- Ringkasan singkat di dashboard (jumlah project, jumlah kategori).

### CRUD Profile
- Karena hanya 1 profil, buat sebagai **form edit langsung** (bukan list + create/delete), dengan field: nama, deskripsi (textarea/rich text sederhana), email, upload foto (preview sebelum submit, replace foto lama otomatis terhapus dari storage).

### CRUD Kategori
- List kategori (tabel dengan nama, jumlah project terkait, aksi edit/hapus).
- Create/Edit: input nama (slug auto-generate).
- Hapus: validasi — jika masih ada project terkait, beri konfirmasi/peringatan (atau cegah hapus sampai project dipindah/dihapus dulu).

### CRUD Projects
- List project (tabel/grid dengan thumbnail kecil, judul, kategori, aksi edit/hapus), bisa difilter per kategori dan dicari (search).
- Create/Edit form: upload gambar (preview), judul, pilih kategori (dropdown), input link demo/test, deskripsi (opsional).
- Delete dengan modal konfirmasi, dan hapus file gambar dari storage saat project dihapus.
- Gunakan flash message (notifikasi sukses/gagal) setiap aksi CRUD.

### Validasi & UX Admin
- Validasi server-side (Form Request) untuk semua input: required, max length, format email, tipe & ukuran file gambar.
- Tampilkan pesan error yang jelas per field.
- Konfirmasi sebelum delete (modal, bukan langsung hapus).

---

## 5. Non-Functional Requirements
- Struktur folder Laravel yang rapi (Controller terpisah per resource: `ProfileController`, `CategoryController`, `ProjectController`; gunakan Route Model Binding).
- Gunakan **Form Request** untuk validasi, bukan validasi inline di controller.
- Gunakan **Policy/Gate** sederhana atau minimal middleware `auth` untuk proteksi route admin (`/admin/*`).
- Sertakan `.env.example` dengan konfigurasi database.
- Sertakan instruksi instalasi singkat (composer install, migrate, seed, storage:link, npm run build).
- Kode mengikuti konvensi Laravel (PSR-12), reusable Blade component untuk card project, form input, dsb — jangan duplikasi markup.
- SEO dasar untuk halaman publik: meta title, meta description dinamis dari data profil.

---

## 6. Yang Perlu Disertakan saat Pengerjaan
1. Migration + Model + Relationship (Category hasMany Project, Project belongsTo Category).
2. Seeder dengan data dummy realistis (bukan "Lorem Ipsum" generik).
3. Route (web.php) terpisah antara publik dan admin (grup route `prefix('admin')->middleware('auth')`).
4. Blade views: halaman publik (`welcome`/`home`), layout admin terpisah dari layout publik.
5. Reusable Blade components untuk elemen berulang (card, button, alert).
6. Tailwind config custom (jangan default warna Tailwind mentah — sesuaikan palet).

---

**Tolong kerjakan step by step**: mulai dari migration & model, lalu seeder, lalu routing & controller, baru terakhir view (publik dan admin), agar mudah direview per tahap.
