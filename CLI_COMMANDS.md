# 🖥️ Laravel CLI Commands Reference

Referensi command-command yang sering digunakan untuk development & deployment.

---

## 🚀 Startup Commands

```bash
# Install dependencies
composer install

# Install NPM packages
npm install

# Generate APP_KEY
php artisan key:generate

# Start development server
php artisan serve

# Start Vite development server (di terminal terpisah)
npm run dev

# Run migrations
php artisan migrate

# Seed test data
php artisan db:seed

# Combine: migrate + seed
php artisan migrate:refresh --seed
```

---

## 📦 Dependency Management

```bash
# Update composer packages
composer update

# Require new package
composer require vendor/package-name

# Require dev package
composer require --dev vendor/package-name

# Update NPM packages
npm update

# Install specific NPM package
npm install package-name
```

---

## 🗄️ Database Commands

### Migrations

```bash
# Run migrations
php artisan migrate

# Run migration in production (force)
php artisan migrate --force

# Rollback last batch
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Refresh & seed
php artisan migrate:refresh --seed

# Show migration status
php artisan migrate:status

# Create new migration
php artisan make:migration create_table_name
```

### Seeders

```bash
# Run seeder
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=DatabaseSeeder

# Rollback database & seed
php artisan migrate:refresh --seed
```

---

## 🎨 Code Generation

```bash
# Create Model
php artisan make:model ModelName

# Create Model with migration
php artisan make:model ModelName -m

# Create Controller
php artisan make:controller ControllerName

# Create Controller with resource methods
php artisan make:controller ControllerName --resource

# Create Seeder
php artisan make:seeder SeederName

# Create Request (validation)
php artisan make:request RequestName

# Create Event
php artisan make:event EventName

# Create Listener
php artisan make:listener ListenerName
```

---

## 🔍 Debugging & Analysis

```bash
# Tinker (interactive shell)
php artisan tinker

# Show routes
php artisan route:list

# Show all configuration
php artisan config:show

# Show specific config
php artisan config:show database

# Show cache
php artisan cache:show

# Generate IDE helper (PhpStorm)
php artisan ide-helper:generate
```

---

## 💾 Cache Commands

```bash
# Clear all cache
php artisan cache:clear

# Forget specific cache key
php artisan cache:forget key_name

# Clear view cache
php artisan view:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear application cache
php artisan cache:clear && php artisan config:clear && php artisan route:clear
```

---

## 🧹 Cleanup Commands

```bash
# Clean storage/logs
php artisan logs:clear

# Clean vendor (if corrupted)
rm -rf vendor/
composer install

# Rebuild composer autoload
composer dump-autoload

# Optimize autoload (production)
composer dump-autoload --optimize-autoloader
```

---

## 🏗️ Build & Assets

```bash
# Build assets for development
npm run dev

# Build assets for production
npm run build

# Build with source maps
npm run build -- --sourcemap

# Watch assets (development)
npm run dev

# Clean build
rm -rf public/build && npm run build
```

---

## 📋 Testing

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/DosenTest.php

# Run with coverage
php artisan test --coverage

# Run tests matching pattern
php artisan test --filter=testName
```

---

## 🔐 Security

```bash
# Generate APP_KEY
php artisan key:generate

# Hash password
php artisan tinker
# Di tinker: Hash::make('password')

# Generate JWT token (jika menggunakan JWT)
php artisan jwt:generate

# Verify JWT (jika menggunakan JWT)
php artisan jwt:secret
```

---

## 🚀 Production Deployment

```bash
# Install dependencies (production)
composer install --no-dev --optimize-autoloader

# Build assets
npm install && npm run build

# Generate APP_KEY
php artisan key:generate

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Optimize autoload
composer dump-autoload --optimize-autoloader

# Start application
php artisan serve --host=0.0.0.0 --port=8000
```

---

## 📊 Monitoring & Logs

```bash
# Show application log
tail -f storage/logs/laravel.log

# Show real-time log (Laravel Pail)
php artisan pail

# Show SQL queries
php artisan tinker
# Enable query log: DB::enableQueryLog()
# View queries: DB::getQueryLog()

# Check server status
php artisan status
```

---

## 🔧 Maintenance Mode

```bash
# Enable maintenance mode
php artisan down

# Enable maintenance mode with message
php artisan down --message="Maintenance in progress"

# Enable maintenance mode with secret
php artisan down --secret=laravel_secret

# Disable maintenance mode
php artisan up
```

---

## 🌍 Localization Commands

```bash
# Publish language files
php artisan lang:publish

# List available locales
php artisan lang:list
```

---

## 📱 NPM Commands (Frontend)

```bash
# Development build with hot reload
npm run dev

# Production build
npm run build

# Preview production build locally
npm run preview

# Lint JavaScript (jika setup)
npm run lint

# Format code (jika setup)
npm run format
```

---

## 🐛 Debugging Tips

### Enable Query Logging

```bash
php artisan tinker
DB::enableQueryLog();
# Run your code
DB::getQueryLog(); // View all queries
```

### Check Model Relationships

```bash
php artisan tinker
$dosen = Dosen::find(1);
$dosen->mahasiswas; // Get related mahasiswa
```

### Cache Testing

```bash
php artisan tinker
Cache::remember('test', now()->addMinutes(30), fn() => 'value');
Cache::get('test'); // Get value
Cache::forget('test'); // Remove cache
```

---

## ⚡ Useful Aliases

Tambahkan ke `.bashrc` atau `.zshrc`:

```bash
# Laravel aliases
alias art='php artisan'
alias serve='php artisan serve'
alias tinker='php artisan tinker'
alias migrate='php artisan migrate'
alias seed='php artisan db:seed'
alias clear='php artisan cache:clear && php artisan config:clear && php artisan route:clear'
alias logs='tail -f storage/logs/laravel.log'
```

Penggunaan:

```bash
art serve
art migrate --seed
art tinker
clear
```

---

## 🔗 Combined Commands

### Quick Setup

```bash
composer install && npm install && php artisan key:generate && php artisan migrate --seed
```

### Full Development Setup

```bash
composer install && npm install && php artisan key:generate && php artisan migrate:refresh --seed && php artisan serve
```

### Clean Slate

```bash
php artisan migrate:reset && php artisan migrate:refresh --seed
```

### Production Deploy

```bash
composer install --no-dev --optimize-autoloader && npm run build && php artisan migrate --force
```

---

## 📖 More Help

```bash
# Show help for any command
php artisan help command-name

# List all available commands
php artisan list

# Get detailed command info
php artisan command-name --help
```

---

**For comprehensive Laravel documentation: https://laravel.com/docs**
