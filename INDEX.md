# 📚 KRS Sederhana - Documentation Index

Selamat datang di **Sistem KRS Sederhana**! Berikut adalah panduan lengkap untuk memulai.

---

## 🎯 Dimulai dari Sini

### 1️⃣ **Setup Cepat (5 Menit)**

👉 Baca: [`QUICKSTART.md`](QUICKSTART.md)

- Install dependencies
- Setup database
- Jalankan aplikasi

### 2️⃣ **Setup Lengkap (Development)**

👉 Baca: [`SETUP_GUIDE.md`](SETUP_GUIDE.md)

- Prasyarat lengkap
- Konfigurasi lokal detail
- Database schema
- Fitur-fitur aplikasi

### 3️⃣ **Deploy ke Railway (Production)**

👉 Baca: [`RAILWAY_DEPLOYMENT.md`](RAILWAY_DEPLOYMENT.md)

- Step-by-step deployment
- Konfigurasi environment variables
- Troubleshooting

### 4️⃣ **Pahami Struktur Proyek**

👉 Baca: [`PROJECT_STRUCTURE.md`](PROJECT_STRUCTURE.md)

- Folder architecture
- Arsitektur aplikasi
- Database relations
- Caching strategy

---

## 📁 Struktur File Dokumentasi

```
krs-copilot/
├── INDEX.md (📍 Anda di sini)
├── QUICKSTART.md                    # Setup 5 menit
├── SETUP_GUIDE.md                  # Setup lengkap
├── RAILWAY_DEPLOYMENT.md           # Deploy ke Railway
├── PROJECT_STRUCTURE.md            # Arsitektur proyek
├── README.md                       # Original readme
└── ... (folder aplikasi)
```

---

## 🚀 Pilih Jalur Anda

### Jika ingin **cepat mencoba**:

```
QUICKSTART.md → (test lokal) → RAILWAY_DEPLOYMENT.md
```

### Jika ingin **setup profesional**:

```
SETUP_GUIDE.md → PROJECT_STRUCTURE.md → (customisasi) → RAILWAY_DEPLOYMENT.md
```

### Jika ingin **memahami arsitektur**:

```
PROJECT_STRUCTURE.md → SETUP_GUIDE.md → kode (app/, routes/, etc)
```

### Jika sudah siap **deploy**:

```
RAILWAY_DEPLOYMENT.md (ikuti step-by-step)
```

---

## ✨ Fitur Utama

✅ **CRUD Lengkap**

- Mahasiswa: Tambah, Edit, Lihat, Hapus
- Dosen: Tambah, Edit, Lihat, Hapus

✅ **Mapping PA**

- Dropdown untuk memilih Dosen PA
- One-to-Many relationship
- Cascade delete handling

✅ **Caching dengan Redis**

- Cache query untuk performance
- Auto invalidation saat ada perubahan
- 30 menit cache duration

✅ **Frontend Modern**

- Laravel Blade templates
- Tailwind CSS styling
- Responsive design

✅ **Database MySQL**

- Proper migrations
- Foreign key constraints
- Seeders untuk test data

---

## 🛠️ Tech Stack

| Layer          | Technology           |
| -------------- | -------------------- |
| **Framework**  | Laravel 13           |
| **Database**   | MySQL                |
| **Caching**    | Redis                |
| **Frontend**   | Blade + Tailwind CSS |
| **Build Tool** | Vite                 |
| **Deployment** | Railway              |

---

## 📊 Database Schema

### Tabel: dosens

```
- id (PK)
- nama
- nip (UNIQUE)
- keahlian
- timestamps
```

### Tabel: mahasiswas

```
- id (PK)
- nama
- nim (UNIQUE)
- jurusan
- dosen_id (FK → dosens.id, ON DELETE SET NULL)
- timestamps
```

### Relations

- Dosen **hasMany** Mahasiswa
- Mahasiswa **belongsTo** Dosen

---

## 🔄 Workflow Pengembangan

### Development Loop:

```
1. Edit kode lokal
   ↓
2. Test dengan: php artisan serve
   ↓
3. Commit ke Git
   ↓
4. Push ke GitHub
   ↓
5. Railway auto-deploy (jika sudah setup)
   ↓
6. Test di production URL
```

---

## 📋 Dokumentasi Terkait

| Dokumen                   | Untuk Siapa                    | Durasi   |
| ------------------------- | ------------------------------ | -------- |
| **QUICKSTART.md**         | Developer baru ingin cepat     | 5 menit  |
| **SETUP_GUIDE.md**        | Development environment detail | 15 menit |
| **PROJECT_STRUCTURE.md**  | Memahami arsitektur            | 10 menit |
| **RAILWAY_DEPLOYMENT.md** | Deploy ke production           | 20 menit |

---

## ⚡ Quick Commands

```bash
# Development
composer install              # Install dependencies
npm install                   # Install npm packages
php artisan serve             # Start dev server
npm run dev                   # Start Vite dev server

# Database
php artisan migrate           # Run migrations
php artisan db:seed          # Seed test data

# Cache
php artisan cache:clear      # Clear all cache
php artisan cache:forget key # Clear specific cache key

# Deployment
php artisan migrate --force   # Migrate on production
npm run build                 # Build assets for production
```

---

## 🎓 Learning Path

1. **Pemula**: Baca QUICKSTART.md → Coba di lokal
2. **Intermediate**: Baca SETUP_GUIDE.md → Pahami kode
3. **Advanced**: Baca PROJECT_STRUCTURE.md → Custom development
4. **Production**: Baca RAILWAY_DEPLOYMENT.md → Deploy ke live

---

## 🆘 Need Help?

### Error saat setup?

→ Lihat bagian **Troubleshooting** di `SETUP_GUIDE.md`

### Error saat deploy?

→ Lihat bagian **Troubleshooting** di `RAILWAY_DEPLOYMENT.md`

### Ingin paham struktur kode?

→ Lihat file-file di folder:

- `app/Http/Controllers/`
- `app/Models/`
- `resources/views/`
- `database/migrations/`

### Ingin custom lebih lanjut?

→ Referensi:

- [Laravel Documentation](https://laravel.com/docs)
- [Railway Documentation](https://docs.railway.app)

---

## 📦 File-File Penting

### Konfigurasi

- `.env` - Environment variables (local)
- `.env.example` - Template environment

### Database

- `database/migrations/` - Schema definitions
- `database/seeders/` - Test data

### Code

- `app/Models/` - Data models
- `app/Http/Controllers/` - Business logic
- `resources/views/` - Frontend templates
- `routes/web.php` - Routing

### Dokumentasi

- `README.md` - Original readme
- `QUICKSTART.md` - Quick setup
- `SETUP_GUIDE.md` - Detailed setup
- `PROJECT_STRUCTURE.md` - Architecture
- `RAILWAY_DEPLOYMENT.md` - Production deployment

---

## 🎉 Siap Mulai?

Pilih satu dan mulai:

- 🏃 **Ingin cepat?** → [`QUICKSTART.md`](QUICKSTART.md)
- 🔧 **Ingin detail?** → [`SETUP_GUIDE.md`](SETUP_GUIDE.md)
- 🏗️ **Ingin faham?** → [`PROJECT_STRUCTURE.md`](PROJECT_STRUCTURE.md)
- 🚀 **Ingin deploy?** → [`RAILWAY_DEPLOYMENT.md`](RAILWAY_DEPLOYMENT.md)

---

**Made with ❤️ for Learning & Production**

_Last Updated: May 13, 2026_
