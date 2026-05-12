# 🚀 Quick Start - KRS Sederhana

## ⚡ 5 Menit Setup Lokal

### 1. Install Dependencies

```bash
cd krs-copilot
composer install
npm install
```

### 2. Setup Environment

```bash
# Konfigurasi .env sudah siap, hanya sesuaikan:
# DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD sesuai MySQL lokal Anda
```

### 3. Create Database

```sql
CREATE DATABASE krs_sederhana;
```

### 4. Run Migrations & Seed

```bash
php artisan migrate
php artisan db:seed
```

### 5. Start Server

```bash
php artisan serve
npm run dev  # Di terminal lain (untuk hot reload)
```

Akses: **http://localhost:8000**

---

## 📊 Data Testing

Seeder sudah menyediakan:

- **5 Dosen** dengan keahlian berbeda
- **8 Mahasiswa** dengan Dosen PA yang sudah ter-assign

---

## 🧪 Testing CRUD

### Mahasiswa

- **URL**: http://localhost:8000/mahasiswas
- Coba: Tambah, Edit, Hapus mahasiswa

### Dosen

- **URL**: http://localhost:8000/dosens
- Coba: Tambah, Edit, Hapus dosen

---

## 🔑 APP_KEY

Sudah di-generate otomatis di `.env`. Jika kosong:

```bash
php artisan key:generate
```

---

## 📚 File Penting

| File                    | Fungsi                       |
| ----------------------- | ---------------------------- |
| `.env`                  | Konfigurasi database & Redis |
| `database/migrations/`  | Schema database              |
| `app/Models/`           | Model Dosen & Mahasiswa      |
| `app/Http/Controllers/` | Logic CRUD                   |
| `resources/views/`      | Frontend Blade               |
| `routes/web.php`        | Routing                      |

---

## ⚙️ Konfigurasi Redis (Opsional untuk Dev)

Jika Redis tidak tersedia, ubah `.env`:

```env
CACHE_STORE=database
```

Tapi **untuk production/Railway tetap gunakan Redis**.

---

## 🚢 Deploy ke Railway

Lihat `SETUP_GUIDE.md` bagian **"Deployment ke Railway"** untuk panduan lengkap.

---

**Selesai! 🎉 Aplikasi siap digunakan.**
