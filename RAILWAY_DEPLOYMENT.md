# 🚀 Railway Deployment Checklist - KRS Sederhana

## ✅ Pre-Deployment Checklist

Sebelum deploy, pastikan:

- [ ] Proyek sudah di-push ke GitHub
- [ ] `.env` sudah dikonfigurasi untuk development
- [ ] `composer install` & `npm install` sudah dijalankan
- [ ] `php artisan migrate` & seeder berjalan sukses di lokal
- [ ] Tidak ada error saat menjalankan `php artisan serve`

---

## 🚀 Step-by-Step Deployment

### Step 1: Persiapan GitHub Repository

```bash
# Jika belum di Git, inisialisasi
git init

# Tambahkan semua file
git add .

# Commit dengan pesan yang jelas
git commit -m "Initial: KRS Sederhana - Laravel application with MySQL & Redis"

# Push ke GitHub
git push origin main
```

> **Note**: Pastikan repositori sudah public atau Railway punya akses private repo.

---

### Step 2: Login ke Railway Dashboard

1. Buka **https://railway.app**
2. Login menggunakan akun GitHub
3. Railway akan redirect ke dashboard

---

### Step 3: Buat Project Baru di Railway

1. Di Railway Dashboard, klik **"+ New Project"**
2. Pilih **"Deploy from GitHub repo"**
3. Railway akan menampilkan daftar repository GitHub
4. Pilih repository **krs-copilot**
5. Tunggu Railway menganalisis repository (akan mendeteksi sebagai Laravel)

> Railway otomatis akan membuat aplikasi dengan nama yang bisa disesuaikan.

---

### Step 4: Tambah Service MySQL

**Di Railway Project Dashboard:**

1. Klik **"+ New Service"** atau **"Add Services"**
2. Pilih **"Database"**
3. Pilih **"MySQL"**
4. Railway akan membuat instance MySQL baru
5. Tunggu status menjadi hijau "Connected"

**Catat kredensial MySQL:**

- Buka tab "MySQL" di Railway
- Klik "Connect" untuk melihat kredensial:
    - **MYSQL_HOST** = `<host>`
    - **MYSQL_PORT** = `<port>` (biasanya 3306)
    - **MYSQL_DB** = `<nama database>`
    - **MYSQL_USER** = `<username>`
    - **MYSQL_PASSWORD** = `<password>`

---

### Step 5: Tambah Service Redis

1. Klik **"+ New Service"** lagi
2. Pilih **"Database"**
3. Pilih **"Redis"**
4. Railway akan membuat Redis instance baru
5. Tunggu status menjadi hijau "Connected"

**Catat kredensial Redis:**

- Buka tab "Redis" di Railway
- Klik "Connect" untuk melihat kredensial:
    - **REDIS_HOST** = `<host>`
    - **REDIS_PORT** = `<port>` (biasanya 6379)
    - **REDIS_PASSWORD** = `<password>` (bisa ada atau null)

---

### Step 6: Konfigurasi Environment Variables

**Di Railway Project Dashboard:**

1. Klik tab **"Variables"** atau **"Environment"** pada service aplikasi Laravel
2. Masukkan semua variable berikut:

```env
# Aplikasi
APP_NAME=KRS Sederhana
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:ZTGuY3osUdKPlUUu405BwPoxPTMRLvCJljZAOn8QZrU=
APP_URL=https://<railway-url>.railway.app

# Database (dari credentials MySQL)
DB_CONNECTION=mysql
DB_HOST=<MYSQL_HOST_dari_railway>
DB_PORT=<MYSQL_PORT_dari_railway>
DB_DATABASE=<MYSQL_DB_dari_railway>
DB_USERNAME=<MYSQL_USER_dari_railway>
DB_PASSWORD=<MYSQL_PASSWORD_dari_railway>

# Cache & Session
CACHE_STORE=redis
CACHE_PREFIX=krs_
SESSION_DRIVER=database

# Queue
QUEUE_CONNECTION=database

# Redis (dari credentials Redis)
REDIS_HOST=<REDIS_HOST_dari_railway>
REDIS_PORT=<REDIS_PORT_dari_railway>
REDIS_PASSWORD=<REDIS_PASSWORD_dari_railway>

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

**Cara mengisi variabel:**

- Klik **"+ Add Variable"** untuk setiap variable
- Copy-paste nama dan nilai dari railway credentials
- Pastikan tidak ada spasi di depan atau belakang

---

### Step 7: Konfigurasi Build & Start Commands

**Di Railway, edit "Deploy" settings:**

1. Cari tab **"Deploy"** atau **"Settings"**
2. Ubah nilai berikut jika ada input untuk:

**Build Command:**

```bash
composer install --no-dev --optimize-autoloader && npm install && npm run build
```

**Start Command:**

```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

> **Penjelasan**:
>
> - `php artisan migrate --force` = Jalankan migration otomatis
> - `--force` = Tidak tanya konfirmasi (untuk production)
> - `--host=0.0.0.0` = Listen di semua interface
> - `--port=$PORT` = Gunakan port yang disediakan Railway

---

### Step 8: Deploy Aplikasi

**Opsi A: Auto-Deploy (Recommended)**

- Railway akan otomatis deploy saat ada push ke GitHub
- Tunggu status berubah menjadi "success" (warna hijau)

**Opsi B: Manual Deploy**

1. Di Railway, klik tombol **"Deploy"** atau **"Redeploy"**
2. Tunggu proses selesai (biasanya 2-5 menit)
3. Lihat log untuk memastikan tidak ada error

---

### Step 9: Verifikasi Deployment

1. **Cek Status Layanan:**
    - Semua service (App, MySQL, Redis) harus status **"Connected"** (hijau)

2. **Cek URL Aplikasi:**
    - Railway otomatis memberikan URL publik
    - Klik URL untuk membuka aplikasi
    - Contoh: `https://krs-copilot-prod.railway.app`

3. **Test Aplikasi:**
    - Buka halaman `/mahasiswas`
    - Pastikan data muncul (dari seeding)
    - Coba tambah/edit/hapus mahasiswa
    - Coba buka halaman `/dosens`

---

### Step 10: Monitor & Debug

**Jika ada error:**

1. **Buka Rails Log:**
    - Di Railway, klik service app → tab "Logs"
    - Lihat error message yang muncul

2. **Common Issues:**

| Error                | Solusi                                                       |
| -------------------- | ------------------------------------------------------------ |
| `Connection refused` | Pastikan MySQL & Redis credentials benar                     |
| `Class not found`    | Jalankan `php artisan migrate --force`                       |
| `View not found`     | Cek path file `.blade.php` di folder `resources/views/`      |
| `Undefined variable` | Pastikan controller mengirim data ke view dengan `compact()` |

3. **Re-deploy jika ada perubahan:**
    ```bash
    git add .
    git commit -m "Fix: xxx"
    git push origin main
    # Railway otomatis akan deploy
    ```

---

## 🔄 Workflow Update & Maintenance

### Setiap ada perubahan kode:

```bash
# 1. Edit kode lokal
# 2. Test di lokal (php artisan serve)
# 3. Commit & push ke GitHub
git add .
git commit -m "Feature: add xxx"
git push origin main

# 4. Railway otomatis deploy (refresh Railway dashboard untuk melihat status)
# 5. Test di production URL
```

### Jika perlu database changes:

```bash
# 1. Edit migration file atau buat migration baru
php artisan make:migration <migration_name>

# 2. Test migration di lokal
php artisan migrate

# 3. Commit & push
git add database/migrations/
git commit -m "Migration: xxx"
git push origin main

# 4. Railway otomatis menjalankan migration saat deploy
```

---

## 📊 Production Checklist

Setelah deploy, pastikan:

- [ ] URL aplikasi dapat diakses
- [ ] Database connection berjalan
- [ ] Redis connection berjalan
- [ ] Halaman mahasiswa & dosen tampil dengan data
- [ ] CRUD operations (Tambah, Edit, Hapus) berfungsi
- [ ] Cache sedang bekerja (check dengan query ulang)
- [ ] Log tidak menunjukkan error yang berkelanjutan
- [ ] APP_DEBUG=false (sudah set di production)

---

## 🆘 Troubleshooting

### Problem: "502 Bad Gateway"

**Penyebab**: Application error atau crash

- **Solusi**:
    1. Buka Railway Logs tab
    2. Lihat error message
    3. Fix error dan push lagi

### Problem: "Database connection refused"

**Penyebab**: DB credentials salah

- **Solusi**:
    1. Double-check credentials di Railway MySQL tab
    2. Copy-paste exact credentials (tanpa typo)
    3. Re-deploy aplikasi

### Problem: "Redis connection refused"

**Penyebab**: Redis password salah atau tidak ada

- **Solusi**:
    1. Cek REDIS_PASSWORD di Railway Redis tab
    2. Jika kosong, set value `null` (tanpa quotes)
    3. Re-deploy

### Problem: "No such table: migrations"

**Penyebab**: Migration tidak jalan otomatis

- **Solusi**:
    1. Pastikan Start Command benar: `php artisan migrate --force && ...`
    2. Manual run di Railway console (jika tersedia)
    3. Re-deploy

### Problem: "View not found"

**Penyebab**: File .blade.php tidak ter-copy atau path salah

- **Solusi**:
    1. Cek file struktur di GitHub
    2. Pastikan path sesuai: `resources/views/...`
    3. Re-deploy

---

## 📱 Testing Production Features

### Test CRUD Mahasiswa:

```
1. Buka https://<railway-url>/mahasiswas
2. Klik "Tambah Mahasiswa"
3. Isi form dengan data
4. Pilih Dosen PA dari dropdown
5. Klik Simpan
6. Verifikasi data muncul di daftar
```

### Test Cache:

```
1. Buka halaman mahasiswa
2. Catat waktu loading
3. Refresh halaman
4. Cache akan membuat loading lebih cepat
```

### Test Database:

```
1. Edit mahasiswa
2. Refresh halaman
3. Verifikasi perubahan muncul
```

---

## 🎉 Success!

Jika semua langkah berhasil:

- ✅ Aplikasi berjalan di URL publik Railway
- ✅ Database MySQL tersimpan data
- ✅ Redis meng-cache query
- ✅ CRUD operations berfungsi sempurna
- ✅ Aplikasi siap untuk production

---

## 📞 Support & Resources

- **Railway Docs**: https://docs.railway.app
- **Laravel Docs**: https://laravel.com/docs
- **Laravel Deployment**: https://laravel.com/docs/deployment

---

**Selamat! KRS Sederhana sudah live di production! 🚀**
