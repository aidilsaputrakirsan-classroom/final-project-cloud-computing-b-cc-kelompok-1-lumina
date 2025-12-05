# Jelajah Balikpapan

Sebuah platform web berbasis Laravel yang dirancang untuk menampilkan informasi mengenai sejarah, wisata, budaya, tokoh, dan kuliner yang ada di Kota Balikpapan.
Seluruh data konten tersimpan di Supabase PostgreSQL, sedangkan gambar diambil dari folder public.
Website ini juga mendukung role Admin dan User, lengkap dengan fitur manajemen konten untuk Admin.

---

# ## Daftar Isi

* [Fitur Utama](#fitur-utama)
* [Tech Stack](#tech-stack)
* [Persyaratan Sistem](#persyaratan-sistem)
* [Instalasi](#instalasi)
* [Konfigurasi](#konfigurasi)
* [Role & Permissions](#role--permissions)
* [Fitur Berdasarkan Role](#fitur-berdasarkan-role)
* [Generate PDF](#generate-pdf)
* [Import Data](#import-data)
* [Screenshot](#screenshot)
* [Struktur Database](#struktur-database)
* [Penggunaan](#penggunaan)
* [Deployment](#deployment)
* [Kontribusi](#kontribusi)
* [Lisensi](#lisensi)

---

# ## Fitur Utama

### 🌆 Halaman Utama

Menampilkan gambaran umum Kota Balikpapan melalui:
* Hero section bertema “Menghidupkan Sejarah, Menggali Pesona Balikpapan”
* Slider gambar landmark kota
* Sekilas info tentang kota (Visi, Misi, Moto, Maskot)
* Navigasi cepat menuju halaman sejarah & wisata

### 🏞 Wisata

* List wisata dari database Supabase
* Detail wisata lengkap (gambar, lokasi, deskripsi)

### 📜 Sejarah

* List artikel sejarah dari berbagai kategori
* Tampilan blog untuk setiap artikel
* Mendukung kategori seperti Budaya, Peristiwa, Tokoh, Kuliner, dll

### 🔍 Pencarian

* Fitur search terintegrasi
* Mencari wisata & sejarah secara bersamaan

### 🏷 Kategori

* Filter berdasarkan kategori
* Data kategori berasal dari Supabase (sejarah)

### 👤 User Profile

* Halaman profil User/Admin
* Informasi dasar akun yang login via Supabase Auth
* Fitur Logout dan manajemen session

---

# ## Tech Stack

### Frontend & Backend

* Laravel 10
* Blade Template Engine
* CSS framework: Tailwind CSS

### Database & Storage

* Supabase PostgreSQL

### Authentication

* Supabase Auth (email/password)

### Deployment

* Laravel (Backend)
* Hostinger (Web Hosting – Apache)
* Supabase (Database PostgreSQL)

---

# ## Persyaratan Sistem

* PHP >= 8.1
* Composer
* Node.js & NPM
* Laravel CLI
* Akun Supabase
* File environment (.env) diisi dengan konfigurasi Supabase
* Extension PHP:
  * OpenSSL
  * PDO & pdo_pgsql
  * Mbstring
  * Tokenizer
  * Ctype
  * JSON

---

# ## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/aidilsaputrakirsan-classroom/final-project-cloud-computing-b-cc-kelompok-1-lumina.git
cd final-project-cloud-computing-b-cc-kelompok-1-lumina
```

### 2. Install Dependencies

```bash
composer install
npm install
npm run build
```

### 3. Copy Environment

```bash
cp .env.example .env
```

### 4. Generate App Key

```bash
php artisan key:generate
```

---

# ## Konfigurasi

## 1. Konfigurasi Supabase

Koneksi Supabase PostgreSQL sudah diatur melalui variabel berikut:

```php
DB_CONNECTION=pgsql
DB_URL=postgresql://postgres.zvtrmrhuzwejscvcksho:Baeeloo11@aws-1-ap-southeast-1.pooler.supabase.com:5432/postgres
```
Dengan format tersebut, Laravel langsung terhubung ke database Supabase tanpa perlu konfigurasi manual seperti host, username, atau password.

## 2. Koneksi API Supabase

Akses data dilakukan melalui endpoint REST Supabase menggunakan `Http::withHeaders()`, dengan API key dan URL yang diambil dari file .env:
```php
Http::withHeaders([
    'apikey' => env('SUPABASE_KEY'),
    'Authorization' => 'Bearer ' . env('SUPABASE_KEY')
])->get(env('SUPABASE_URL') . '/rest/v1/wisata?select=*');
```

---

# ## Role & Permissions

Memiliki role dari Supabase Auth:

| Role      | Akses                                |
| --------- | ------------------------------------ |
| **Admin** | CRUD seluruh konten                  |
| **User**  | Membaca data, mengelola profile      |
| **Guest** | Akses publik (home, wisata, sejarah) |

---

# ## Fitur Berdasarkan Role

### 👑 Admin

* Tambah/Edit/Hapus konten wisata
* Tambah/Edit/Hapus artikel sejarah
* Kelola kategori
* Upload gambar ke Supabase Storage
* Export PDF (opsional)
* Import data dari CSV (opsional)

### 👤 User

* Lihat konten
* Gunakan fitur pencarian
* Edit profile

### 👥 Guest / Tanpa Login

* Mengakses halaman publik
* Melihat daftar wisata & sejarah

---

# ## Generate PDF

Project ini tidak menggunakan fitur export PDF, sehingga package seperti laravel-dompdf atau barryvdh/laravel-dompdf tidak digunakan.

---

# ## Import Data

Project ini belum menggunakan fitur Import Data (CSV/Excel) dan tidak menggunakan package seperti maatwebsite/excel.


Seluruh data pada aplikasi dimasukkan secara manual melalui form input dan kemudian disimpan ke Supabase menggunakan koneksi database PostgreSQL yang sudah dikonfigurasi melalui:
```
DB_CONNECTION=pgsql
DB_URL=...
```
---

# ## Screenshot

### 1. Halaman Login
![Halaman Login](resources/readme-assets/login.png)
Halaman login dengan form email dan password untuk masuk sebagai user atau admin

### 2. Dashboard Admin
![Dashboard Admin](resources/readme-assets/Dashboard-Admin.png)
Dashboard admin untuk mengakses dashboard yang hanya bisa diakses admin untuk menambahkan konten dari website (wisata, sejarah, kategori)

### 3. Home Page
![Home Page](resources/readme-assets/Home-1.png)
![Home Page](resources/readme-assets/Home-2.png)
Home page merupakan halaman utama website yang berisi konten-konten terkait sejarah kota Balikpapan

### 4. Categories Budaya
![Categories Budaya](resources/readme-assets/Categories-Budaya.png)
Category Budaya merupakan halaman dari fitur category dengan opsi budaya, berisikan konten yang masuk dalam category budaya

### 5. Categories Kuliner
![Categories Kuliner](resources/readme-assets/Categories-Kuliner.png)
Category Kuliner merupakan halaman dari fitur category dengan opsi kuliner, berisikan konten yang masuk dalam category kuliner

### 6. Categories Peristiwa
![Categories Peristiwa](resources/readme-assets/Categories-Peristiwa.png)
Category Peristiwa merupakan halaman dari fitur category dengan opsi peristiwa, berisikan konten yang masuk dalam category peristiwa

### 7. Categories Tokoh
![Categories Tokoh](resources/readme-assets/Categories-Tokoh.png)
Category Tokoh merupakan halaman dari fitur category dengan opsi tokoh, berisikan konten yang masuk dalam category tokoh

### 8. Role Profile
![Role Profile](resources/readme-assets/Role-Profile.png)
Profile merupakan halaman dari fitur profile, berisikan informasi terkait user/admin

### 9. Sejarah
![Sejarah](resources/readme-assets/Sejarah.png)
Sejarah merupakan halaman dari fitur sejarah, berisikan informasi terkait sejarah kota Balikpapan

### 10. Wisata
![Wisata](resources/readme-assets/Wisata.png)
Wisata merupakan halaman dari fitur wisata, berisikan informasi terkait wisata yang ada di kota Balikpapan

### 11. Search
![Seaarch](resources/readme-assets/Search.png)
Search merupakan halaman dari fitur search, berisikan informasi terkait seluruh konten pada website dan bisa dicari berdasarkan judul atau kata kunci
```

---

```
### Struktur Database

### Tabel Utama
- **users** : Menyimpan data pengguna sistem (admin/user)
- **categories** : Menyimpan kategori untuk sejarah
- **histories** : Artikel sejarah dari berbagai kategori
- **destinations** : Menyimpan data destinasi wisata
- **activity_logs** : Menyimpan riwayat aktivitas user/admin dalam sistem
- **migrations** : Mencatat file migrasi mana saja yang sudah dijalankan oleh sistem.

### Tabel users

| Name                  | Data Type                     | Format      | Keterangan                                         |
| :---                  | :---                          | :---        | :---                                               |
| **id** | `bigint`                      | `int8`      | *Primary Key*, ID unik pengguna.                   |
| **name** | `character varying`           | `varchar`   | Nama lengkap pengguna.                             |
| **email** | `character varying`           | `varchar`   | Alamat email (biasanya unik).                      |
| **email_verified_at** | `timestamp without time zone` | `timestamp` | Waktu verifikasi email.                            |
| **password** | `character varying`           | `varchar`   | Password pengguna (tersimpan dalam bentuk *hash*). |
| **remember_token** | `character varying`           | `varchar`   | Token acak untuk fitur "Remember Me".              |
| **created_at** | `timestamp without time zone` | `timestamp` | Waktu saat akun pertama kali dibuat.               |
| **updated_at** | `timestamp without time zone` | `timestamp` | Waktu saat data akun terakhir kali diperbarui.     |
| **role** | `text`                        | `text`      | Peran pengguna (misal: `admin`, `user`).           |
| **gender** | `text`                        | `text`      | Jenis kelamin pengguna.                            |
| **age** | `integer`                     | `int4`      | Usia pengguna.                                     |
| **street_name** | `text`                        | `text`      | Nama jalan atau alamat pengguna.                   |

### Tabel categories

| Name          | Data Type                     | Format      | Keterangan                                      |
| :---          | :---                          | :---        | :---                                            |
| **id** | `bigint`                      | `int8`      | *Primary Key*, ID unik data.                    |
| **name** | `character varying`           | `varchar`   | Nama entitas atau item.                         |
| **slug** | `character varying`           | `varchar`   | Versi teks ramah URL (*URL-friendly*) untuk SEO.|
| **is_active** | `boolean`                     | `bool`      | Status aktif (`true`) atau non-aktif (`false`). |
| **description**| `text`                        | `text`      | Penjelasan atau deskripsi lengkap item.         |
| **created_at**| `timestamp without time zone` | `timestamp` | Waktu data pertama kali dibuat.                 |
| **updated_at**| `timestamp without time zone` | `timestamp` | Waktu data terakhir kali diubah.                |

### Tabel histories

| Name          | Data Type                     | Format      | Keterangan                                      |
| :---          | :---                          | :---        | :---                                            |
| **id** | `bigint`                      | `int8`      | *Primary Key*, identitas unik postingan.        |
| **title** | `character varying`           | `varchar`   | Judul artikel atau acara.                       |
| **image** | `character varying`           | `varchar`   | Path atau URL file gambar utama.                |
| **content** | `text`                        | `text`      | Isi konten utama artikel/acara.                 |
| **event_date**| `timestamp without time zone` | `timestamp` | Tanggal dan waktu acara berlangsung.            |
| **created_at**| `timestamp without time zone` | `timestamp` | Waktu pembuatan data.                           |
| **updated_at**| `timestamp without time zone` | `timestamp` | Waktu pembaruan data terakhir.                  |
| **published_at**| `timestamp without time zone`| `timestamp` | Jadwal atau waktu postingan diterbitkan.        |
| **slug** | `text`                        | `text`      | URL slug untuk akses postingan di browser.      |
| **is_published**| `text`                      | `text`      | Status publikasi (misal: "draft", "published"). |
| **category_id**| `bigint`                      | `int8`      | *Foreign Key*, merujuk ke tabel Categories.     |

### Tabel destinations

| Name          | Data Type                     | Format      | Keterangan                                      |
| :---          | :---                          | :---        | :---                                            |
| **id** | `bigint`                      | `int8`      | *Primary Key*, ID unik lokasi.                  |
| **name** | `character varying`           | `varchar`   | Nama tempat atau lokasi.                        |
| **description**| `text`                        | `text`      | Penjelasan detail mengenai tempat tersebut.     |
| **location** | `character varying`           | `varchar`   | Alamat atau nama area lokasi (misal: "Jakarta").|
| **created_at**| `timestamp without time zone` | `timestamp` | Waktu data dibuat.                              |
| **updated_at**| `timestamp without time zone` | `timestamp` | Waktu data terakhir diubah.                     |
| **image** | `character varying`           | `varchar`   | Path/URL gambar lokasi.                         |

### Tabel activity_logs
| Nama Kolom    | Tipe Data                  | Constraints (Batasan)        | Keterangan                                                   |
| :---          | :---                       | :---                         | :---                                                         |
| **id** | `bigint`                   | PRIMARY KEY, Identity        | ID unik yang otomatis bertambah (1, 2, 3...)                 |
| **created_at**| `timestamp with time zone` | NOT NULL, Default: `now()`   | Waktu log dibuat otomatis                                    |
| **user_id** | `bigint`                   | NULL                         | ID pengguna yang melakukan aksi (bisa kosong jika aksi sistem)|
| **action** | `text`                     | NULL                         | Jenis aksi (misal: "LOGIN", "UPDATE")                        |
| **description**| `text`                    | NULL                         | Penjelasan singkat aktivitas                                 |
| **details** | `text`                     | NULL                         | Detail teknis atau JSON string                               |
| **updated_at**| `timestamp with time zone` | NULL                         | Waktu jika log diperbarui (jarang digunakan untuk log murni) |

### Tabel Migrations
| Name          | Data Type                     | Format      | Keterangan                                      |
| :---          | :---                          | :---        | :---                                            |
| **id** | `integer`                     | `int4`      | *Primary Key*, ID urutan migrasi.               |
| **migration** | `character varying`           | `varchar`   | Nama file class migrasi yang dijalankan.        |
| **batch** | `integer`                     | `int4`      | Nomor batch/kelompok eksekusi migrasi.          |
---

# ## Penggunaan

### Jalankan server:

```bash
php artisan serve
```

### Akses di browser:

```
https://lumina.recraft.id/
```

---

# ## Deployment

### 1. Siapkan Repository di GitHub

Pastikan seluruh source code Laravel sudah ada di GitHub.
Struktur folder tidak boleh berada di subfolder — harus di root repository.
Pastikan .env.example lengkap, karena Hostinger akan membuat file .env baru.

### 2. Hubungkan Hostinger ke GitHub

Masuk ke hPanel Hostinger
Buka:
Website → Git → Connect Repository

Isi:
Repository URL → repo GitHub.
Branch → branch yang dipakai (misal: development)
Pilih Deploy to: root folder (atau subfolder jika project tidak di root)
Setelah itu Hostinger akan otomatis:
- clone repo
- menyiapkan environment
- membaca struktur Laravel

### 3. Konfigurasi File .env di Hostinger

Buat file .env di Hostinger lewat File Manager.

Jalankan di terminal Hostinger:

php artisan key:generate --show

### 4. Install Dependency di Hostinger

composer install --optimize-autoloader --no-dev
npm install
npm run build

### 5. Optimasi Laravel
* php artisan config:cache
* php artisan route:cache
* php artisan view:cache

### 6. Set Public Folder yang Benar

Di Hostinger, ubah document root menjadi:

/public

hPanel → Advanced → Configuration → PHP Configuration

Ubah document root ke folder Laravel public/.

### 7. Setelah Semua Berhasil

Akses:

https://lumina.recraft.id/


Website Laravel + Supabase siap digunakan.

### ✔ Pastikan folder:

- `/storage` → writable
- `/bootstrap/cache` → writable

---

# ## Kontribusi

Kontribusi sangat terbuka untuk pengembangan proyek ini.

1. Lakukan **Fork** pada repository
2. Buat branch baru:
```bash
   git checkout -b fitur-baru
```
3. Commit perubahan:
```
git commit -m "Menambahkan fitur baru"
```
4. Kirim Pull Request untuk ditinjau

---

# ## Lisensi

Proyek ini tidak memiliki lisensi terbuka. Semua hak cipta dilindungi (All Rights Reserved). Penggunaan, penyalinan, atau distribusi kode hanya diperbolehkan dengan izin dari pemilik proyek.


---

*Last updated: December 2025*
