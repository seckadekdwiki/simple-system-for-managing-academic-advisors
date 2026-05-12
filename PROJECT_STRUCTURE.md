# 📋 Project Structure & Architecture - KRS Sederhana

## 📁 Struktur Folder Lengkap

```
krs-copilot/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Controller.php (base controller)
│   │   │   ├── DosenController.php ⭐
│   │   │   └── MahasiswaController.php ⭐
│   │   └── Middleware/
│   │
│   ├── Models/
│   │   ├── Dosen.php ⭐
│   │   ├── Mahasiswa.php ⭐
│   │   └── User.php
│   │
│   └── Providers/
│
├── bootstrap/
│   ├── app.php
│   ├── providers.php
│   └── cache/
│
├── config/
│   ├── app.php
│   ├── cache.php (Redis configuration)
│   ├── database.php
│   ├── session.php
│   └── queue.php
│
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_05_13_000000_create_dosens_table.php ⭐
│   │   └── 2026_05_13_000001_create_mahasiswas_table.php ⭐
│   │
│   ├── seeders/
│   │   └── DatabaseSeeder.php ⭐ (with Dosen & Mahasiswa data)
│   │
│   └── factories/
│
├── public/
│   ├── index.php (entry point)
│   ├── .htaccess
│   └── build/ (Vite compiled assets)
│
├── resources/
│   ├── views/
│   │   ├── components/
│   │   │   └── layouts/
│   │   │       └── app.blade.php ⭐ (main layout)
│   │   │
│   │   ├── dosens/
│   │   │   ├── index.blade.php ⭐ (daftar dosen)
│   │   │   └── form.blade.php ⭐ (form dosen)
│   │   │
│   │   ├── mahasiswas/
│   │   │   ├── index.blade.php ⭐ (daftar mahasiswa)
│   │   │   └── form.blade.php ⭐ (form mahasiswa)
│   │   │
│   │   └── welcome.blade.php
│   │
│   └── css/
│       └── app.css
│
├── routes/
│   ├── web.php ⭐ (main routing)
│   ├── api.php
│   └── console.php
│
├── storage/
│   ├── app/
│   ├── logs/
│   ├── framework/
│   └── cache/
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── vendor/ (all dependencies)
├── node_modules/ (npm packages)
│
├── .env ⭐ (local configuration)
├── .env.example ⭐ (template configuration)
├── .gitignore
├── artisan (CLI tool)
├── composer.json
├── composer.lock
├── package.json
├── vite.config.js
│
├── README.md
├── SETUP_GUIDE.md ⭐ (deployment guide)
├── QUICKSTART.md ⭐ (quick setup)
└── PROJECT_STRUCTURE.md (this file)

⭐ = File yang dibuat/dimodifikasi khusus untuk proyek KRS Sederhana
```

---

## 🏗️ Arsitektur Aplikasi

### Layer Architecture

```
┌─────────────────────────────────────┐
│        FRONTEND (Blade Views)        │
│  - resources/views/mahasiswas/      │
│  - resources/views/dosens/          │
│  - Tailwind CSS (CDN)               │
└──────────────────┬──────────────────┘
                   │
┌──────────────────▼──────────────────┐
│     ROUTING (routes/web.php)        │
│  - GET /mahasiswas                  │
│  - POST /mahasiswas                 │
│  - GET /dosens                      │
│  - POST /dosens                     │
└──────────────────┬──────────────────┘
                   │
┌──────────────────▼──────────────────┐
│   CONTROLLERS (Http/Controllers)    │
│  - MahasiswaController.php          │
│  - DosenController.php              │
│  - Business Logic & Caching         │
└──────────────────┬──────────────────┘
                   │
┌──────────────────▼──────────────────┐
│   MODELS & RELATIONSHIPS            │
│  - Dosen.php (hasMany)              │
│  - Mahasiswa.php (belongsTo)        │
└──────────────────┬──────────────────┘
                   │
┌──────────────────▼──────────────────┐
│  CACHE LAYER (Redis)                │
│  - Cache::remember()                │
│  - Cache::forget() (invalidation)   │
└──────────────────┬──────────────────┘
                   │
┌──────────────────▼──────────────────┐
│     DATABASE LAYER (MySQL)          │
│  - dosens table                     │
│  - mahasiswas table                 │
│  - Foreign Key Relations            │
└─────────────────────────────────────┘
```

---

## 🔄 Data Flow & Relations

### 1. Database Relations

```sql
dosens
  ├── id (Primary Key)
  ├── nama
  ├── nip (Unique)
  ├── keahlian
  └── timestamps

mahasiswas
  ├── id (Primary Key)
  ├── nama
  ├── nim (Unique)
  ├── jurusan
  ├── dosen_id (Foreign Key → dosens.id, ON DELETE SET NULL) ⭐
  └── timestamps
```

### 2. Eloquent Relations

**Dosen Model:**

```php
class Dosen extends Model {
    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class, 'dosen_id');
    }
}
```

**Mahasiswa Model:**

```php
class Mahasiswa extends Model {
    public function dosen() {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
```

---

## 💾 Caching Strategy

### Cache Keys

```
├── dosens.index
│   ├── Duration: 30 minutes
│   ├── Data: All dosens ordered by nama
│   └── Trigger: GET /dosens, GET /mahasiswas/create
│
└── mahasiswas.index
    ├── Duration: 30 minutes
    ├── Data: All mahasiswas with dosen relation
    └── Trigger: GET /mahasiswas
```

### Cache Invalidation

Cache dibuang otomatis ketika terjadi operasi:

| Operasi          | Cache Keys Dibuang                 |
| ---------------- | ---------------------------------- |
| Dosen CREATE     | `dosens.index`, `mahasiswas.index` |
| Dosen UPDATE     | `dosens.index`, `mahasiswas.index` |
| Dosen DELETE     | `dosens.index`, `mahasiswas.index` |
| Mahasiswa CREATE | `mahasiswas.index`                 |
| Mahasiswa UPDATE | `mahasiswas.index`                 |
| Mahasiswa DELETE | `mahasiswas.index`                 |

---

## 🎯 Endpoint & Routing

### Dosen CRUD

| Method | Endpoint            | Controller Method         | Deskripsi         |
| ------ | ------------------- | ------------------------- | ----------------- |
| GET    | `/dosens`           | `DosenController@index`   | Daftar dosen      |
| GET    | `/dosens/create`    | `DosenController@create`  | Form tambah dosen |
| POST   | `/dosens`           | `DosenController@store`   | Simpan dosen baru |
| GET    | `/dosens/{id}/edit` | `DosenController@edit`    | Form edit dosen   |
| PUT    | `/dosens/{id}`      | `DosenController@update`  | Update dosen      |
| DELETE | `/dosens/{id}`      | `DosenController@destroy` | Hapus dosen       |

### Mahasiswa CRUD

| Method | Endpoint                | Controller Method             | Deskripsi             |
| ------ | ----------------------- | ----------------------------- | --------------------- |
| GET    | `/mahasiswas`           | `MahasiswaController@index`   | Daftar mahasiswa      |
| GET    | `/mahasiswas/create`    | `MahasiswaController@create`  | Form tambah mahasiswa |
| POST   | `/mahasiswas`           | `MahasiswaController@store`   | Simpan mahasiswa baru |
| GET    | `/mahasiswas/{id}/edit` | `MahasiswaController@edit`    | Form edit mahasiswa   |
| PUT    | `/mahasiswas/{id}`      | `MahasiswaController@update`  | Update mahasiswa      |
| DELETE | `/mahasiswas/{id}`      | `MahasiswaController@destroy` | Hapus mahasiswa       |

---

## 📝 Environment Configuration

### File: `.env`

```env
# Application
APP_NAME="KRS Sederhana"
APP_ENV=local (production di Railway)
APP_DEBUG=true (false di production)
APP_KEY=base64:...

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=krs_sederhana
DB_USERNAME=root
DB_PASSWORD=

# Cache
CACHE_STORE=redis
CACHE_PREFIX=krs_

# Redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null
```

---

## 🧪 Testing Data (Seeder)

File: `database/seeders/DatabaseSeeder.php`

### Dosen yang di-seed:

1. Dr. Budi Santoso - Sistem Basis Data
2. Prof. Siti Nurhaliza - Kecerdasan Buatan & ML
3. Drs. Ahmad Riyanto - Web Development & Cloud
4. Ir. Dewi Lestari - Jaringan & Cybersecurity
5. Dr. Rudi Hermawan - Software Engineering & DevOps

### Mahasiswa yang di-seed:

- 8 mahasiswa dengan PA yang sudah ter-assign

**Run seeder:**

```bash
php artisan db:seed
```

---

## 🚀 Deployment ke Railway

### Build & Deploy Commands

**Build:**

```bash
composer install --no-dev --optimize-autoloader
npm install && npm run build
```

**Start:**

```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

### Environment pada Production

```env
APP_ENV=production
APP_DEBUG=false
DB_HOST=<railway_mysql_host>
DB_PORT=<railway_mysql_port>
DB_DATABASE=<railway_db_name>
DB_USERNAME=<railway_db_user>
DB_PASSWORD=<railway_db_pass>
REDIS_HOST=<railway_redis_host>
REDIS_PORT=<railway_redis_port>
REDIS_PASSWORD=<railway_redis_pass>
```

---

## 🔐 Security Considerations

1. **Database Foreign Keys**: SET NULL untuk cascade safety
2. **Validation**: Input validation pada setiap CRUD operation
3. **Caching**: Cache tidak disimpan sensitive data
4. **CSRF Protection**: Built-in Laravel CSRF tokens
5. **SQL Injection Prevention**: Eloquent ORM dengan parameterized queries

---

## 📦 Dependencies

### Composer (PHP)

```json
{
    "laravel/framework": "^13.7",
    "laravel/tinker": "^3.0"
}
```

### NPM (JavaScript)

- Vite (build tool)
- Tailwind CSS (styling)

### Services

- MySQL (Database)
- Redis (Caching)

---

## 🛠️ Development Commands

```bash
# Setup
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan db:seed

# Development
php artisan serve
npm run dev

# Production Build
php artisan migrate --force
npm run build
php artisan serve --host=0.0.0.0 --port=8000

# Tinker (Interactive Shell)
php artisan tinker

# Cache
php artisan cache:clear
php artisan cache:forget key_name
```

---

## 📚 Dokumentasi Referensi

| Topik           | File                               |
| --------------- | ---------------------------------- |
| Setup Lengkap   | `SETUP_GUIDE.md`                   |
| Quick Start     | `QUICKSTART.md`                    |
| Struktur Proyek | `PROJECT_STRUCTURE.md` (this file) |
| Original README | `README.md`                        |

---

## 🎓 Best Practices yang Diterapkan

✅ **Clean Code**: Single Responsibility Principle di controllers
✅ **Caching**: Redis caching dengan cache invalidation strategy
✅ **Migrations**: Version controlled database schema
✅ **Relationships**: Proper Eloquent relationships
✅ **Validation**: Input validation di controller
✅ **Frontend**: Component-based Blade templates
✅ **Environment**: Environment-based configuration
✅ **Seeding**: Test data untuk development
✅ **Git**: Proper .gitignore setup
✅ **Documentation**: Comprehensive guides

---

**Dibuat dengan standar best practices untuk production-ready Laravel application.**
