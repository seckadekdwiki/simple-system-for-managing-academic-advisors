# Panduan Setup Sistem KRS Sederhana

## 📋 Ringkasan Proyek

**Sistem KRS Sederhana** adalah aplikasi Laravel untuk memetakan Dosen Pembimbing Akademik (PA) dengan Mahasiswa. Aplikasi ini menggunakan:

- **Framework**: Laravel 13
- **Database**: MySQL
- **Caching**: Redis
- **Frontend**: Laravel Blade + Tailwind CSS

---

## 🛠️ Setup Lokal (Development)

### Prasyarat

Pastikan sudah terinstall:

- PHP 8.2 atau lebih tinggi
- Composer
- MySQL Server
- Redis Server

### Langkah-Langkah

#### 1. Clone Repository dan Install Dependencies

```bash
# Masuk ke folder proyek
cd d:\DWIKI_DEV\topik-khusus-sistem-informasi\krs-copilot

# Install PHP dependencies
composer install

# Install Node dependencies (untuk Vite)
npm install

# Build frontend assets
npm run dev
```

#### 2. Konfigurasi Environment

File `.env` sudah disiapkan dengan konfigurasi default:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=krs_sederhana
DB_USERNAME=root
DB_PASSWORD=

# Cache Configuration
# For local development, use database cache if phpredis extension is not installed.
CACHE_STORE=database
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null
```

**Untuk Windows Local Development:**

Jika menggunakan XAMPP atau Laragon:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
```

#### 3. Generate APP_KEY (jika belum ada)

```bash
php artisan key:generate
```

#### 4. Buat Database

Buka MySQL dan jalankan:

```sql
CREATE DATABASE krs_sederhana CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau gunakan GUI seperti phpMyAdmin.

#### 5. Jalankan Migration

```bash
php artisan migrate
```

#### 6. (Opsional) Seed Data untuk Testing

```bash
php artisan db:seed
```

#### 7. Jalankan Development Server

```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

---

## 📁 Struktur Folder Proyek

```
krs-copilot/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DosenController.php      # CRUD Dosen
│   │   │   └── MahasiswaController.php  # CRUD Mahasiswa
│   │   └── Middleware/
│   └── Models/
│       ├── Dosen.php                    # Model Dosen dengan relation
│       └── Mahasiswa.php                # Model Mahasiswa dengan relation
├── database/
│   ├── migrations/
│   │   ├── 2026_05_13_000000_create_dosens_table.php
│   │   └── 2026_05_13_000001_create_mahasiswas_table.php
│   └── seeders/
├── resources/
│   └── views/
│       ├── components/
│       │   └── layouts/
│       │       └── app.blade.php        # Layout utama
│       ├── dosens/
│       │   ├── index.blade.php          # Daftar Dosen
│       │   └── form.blade.php           # Form Dosen
│       └── mahasiswas/
│           ├── index.blade.php          # Daftar Mahasiswa
│           └── form.blade.php           # Form Mahasiswa
├── routes/
│   └── web.php                          # Routing aplikasi
├── .env                                 # Environment configuration
└── README.md
```

---

## 🔐 Database Schema

### Tabel: `dosens`

```sql
CREATE TABLE dosens (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nama VARCHAR(255) NOT NULL,
  nip VARCHAR(50) UNIQUE NOT NULL,
  keahlian VARCHAR(255) NULLABLE,
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

### Tabel: `mahasiswas`

```sql
CREATE TABLE mahasiswas (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nama VARCHAR(255) NOT NULL,
  nim VARCHAR(50) UNIQUE NOT NULL,
  jurusan VARCHAR(255) NOT NULL,
  dosen_id BIGINT UNSIGNED NULLABLE,
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  FOREIGN KEY (dosen_id) REFERENCES dosens(id) ON DELETE SET NULL
);
```

---

## 🎯 Fitur Utama

### 1. Manajemen Dosen

- **Daftar Dosen**: Lihat semua dosen PA
- **Tambah Dosen**: Tambah dosen baru dengan NIP unik
- **Edit Dosen**: Ubah informasi dosen
- **Hapus Dosen**: Hapus dosen (mahasiswa akan ter-unassign otomatis)

### 2. Manajemen Mahasiswa

- **Daftar Mahasiswa**: Lihat semua mahasiswa dengan PA-nya
- **Tambah Mahasiswa**: Tambah mahasiswa baru
- **Edit Mahasiswa**: Ubah data atau ganti PA-nya
- **Hapus Mahasiswa**: Hapus data mahasiswa
- **Dropdown PA**: Pilih Dosen PA dari dropdown di form

### 3. Caching & Performance

- Query dosen di-cache dengan Redis selama 30 menit
- Query mahasiswa dengan relasi di-cache dengan Redis selama 30 menit
- Cache otomatis di-invalidate saat ada perubahan data (CREATE, UPDATE, DELETE)

---

## 🚀 Deployment ke Railway

### Langkah 1: Persiapan GitHub Repository

```bash
# Inisialisasi git (jika belum)
git init

# Add semua file
git add .

# Commit
git commit -m "Initial commit: KRS Sederhana application"

# Push ke GitHub
git push origin main
```

### Langkah 2: Buat Project di Railway

1. Buka **https://railway.app**
2. Login dengan akun GitHub
3. Klik **"New Project"**
4. Pilih **"Deploy from GitHub repo"**
5. Pilih repository `krs-copilot`
6. Railway akan otomatis mendeteksi bahwa ini adalah proyek Laravel

### Langkah 3: Tambah Layanan MySQL dan Redis

Setelah project dibuat di Railway dashboard:

1. Klik tombol **"+ New Service"**
2. Pilih **"Database"** → **"MySQL"**
3. Railway akan membuat instance MySQL baru
4. Ulangi: Klik **"+ New Service"** → Pilih **"Database"** → **"Redis"**

Railway akan menampilkan kredensial untuk kedua layanan.

### Langkah 4: Konfigurasi Environment Variables

Di halaman project Railway, buka tab **"Variables"** dan masukkan:

```env
# Copy dari Railway MySQL service
DB_CONNECTION=mysql
DB_HOST=<HOST_DARI_MYSQL>
DB_PORT=<PORT_DARI_MYSQL>
DB_DATABASE=<NAMA_DATABASE_DARI_MYSQL>
DB_USERNAME=<USERNAME_DARI_MYSQL>
DB_PASSWORD=<PASSWORD_DARI_MYSQL>

# Copy dari Railway Redis service
REDIS_HOST=<HOST_DARI_REDIS>
REDIS_PORT=<PORT_DARI_REDIS>
REDIS_PASSWORD=<PASSWORD_DARI_REDIS>

# Konfigurasi aplikasi
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:ZTGuY3osUdKPlUUu405BwPoxPTMRLvCJljZAOn8QZrU=
CACHE_STORE=redis
```

> **Catatan**: Buka kredensial MySQL dan Redis di Railway dashboard untuk mendapatkan nilai yang tepat.

### Langkah 5: Konfigurasi Build & Start Command

Di Railway, edit **"Deploy"** settings:

- **Build Command**:

    ```
    composer install --no-dev --optimize-autoloader && npm install && npm run build
    ```

- **Start Command**:
    ```
    php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
    ```

### Langkah 6: Deploy

1. Klik tombol **"Deploy"** atau biarkan auto-deploy teraktivasi
2. Railway akan membangun dan menjalankan aplikasi
3. Tunggu hingga deployment selesai (berwarna hijau)
4. Akses aplikasi melalui URL yang diberikan Railway

### Langkah 7: Verifikasi Deployment

- Buka URL aplikasi dari Railway
- Cek halaman Mahasiswa
- Coba tambah/edit/hapus data untuk memastikan semuanya berfungsi

---

## 🔧 Troubleshooting

### Error: "could not find driver"

**Solusi**: Pastikan MySQL dijalankan dan DB credentials benar di `.env`

### Error: Redis Connection Refused

**Solusi**:

- Lokal: Jalankan Redis server (`redis-server` atau via GUI)
- Railway: Pastikan Redis service sudah dibuat dan kredensial benar di Environment Variables

### Error: Migration Failed

**Solusi**:

```bash
# Reset database
php artisan migrate:reset

# Jalankan migration ulang
php artisan migrate
```

### Error: "view not found"

**Solusi**: Pastikan file `.blade.php` berada di folder `resources/views/` dengan struktur yang benar

---

## 📚 Referensi & Best Practices

1. **Caching Strategy**:
    - Cache diset 30 menit dengan `Cache::remember()`
    - Invalidasi terjadi otomatis pada CREATE/UPDATE/DELETE

2. **Database Relations**:
    - `Dosen::hasMany(Mahasiswa)` → One Dosen memiliki banyak Mahasiswa
    - `Mahasiswa::belongsTo(Dosen)` → Mahasiswa dimiliki oleh satu Dosen

3. **Validasi**:
    - `nama`, `nip`, `nim` wajib diisi
    - `nip` dan `nim` harus unik di database
    - `dosen_id` optional (dapat NULL)

4. **Frontend**:
    - Menggunakan Tailwind CSS via CDN
    - Responsive design untuk desktop dan mobile
    - Konfirmasi sebelum delete

---

## 📞 Support

Untuk bantuan lebih lanjut, lihat:

- [Dokumentasi Laravel](https://laravel.com/docs)
- [Dokumentasi Railway](https://docs.railway.app)
- [Laravel Blade Documentation](https://laravel.com/docs/blade)

---

**Dibuat dengan ❤️ untuk Sistem Informasi**
