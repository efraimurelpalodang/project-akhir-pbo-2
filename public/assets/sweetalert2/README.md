# MatStock - Sistem Manajemen Stok & Penjualan

Aplikasi manajemen stok dan penjualan bahan bangunan berbasis web menggunakan Laravel dan Livewire.

---

## 📋 Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL >= 5.7 atau MariaDB >= 10.3
- Node.js & NPM
- Web Server (Apache/Nginx) atau PHP Built-in Server

---

## 🚀 Cara Instalasi & Menjalankan Aplikasi

### 1. Install Dependencies PHP

```bash
composer install
```

### 2. Konfigurasi Environment

Copy file `.env.example` menjadi `.env`:

**Linux/Mac:**
```bash
cp .env.example .env
```

**Windows:**
```cmd
copy .env.example .env
```

### 3. Edit File .env

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=
```

> Ganti `nama_database_anda` dengan nama database yang akan digunakan.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

Buat database baru di MySQL/MariaDB dengan nama sesuai yang ada di file `.env`:

```sql
CREATE DATABASE nama_database_anda;
```

### 6. Jalankan Migration

```bash
php artisan migrate
```

### 7. Jalankan Seeder

```bash
php artisan db:seed
```

> Seeder akan membuat data awal termasuk akun untuk login.

### 8. Install Dependencies JavaScript (Opsional)

Jika ada assets yang perlu di-compile:

```bash
npm install
npm run build
```

### 9. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

---

## 🔐 Informasi Login

Setelah seeder berhasil dijalankan, gunakan akun berikut untuk login:

- **Username:** `ovfpnnnvtrvsxfa`
- **Password:** `password`
- **Peran   :** `admin`

---

## 📂 Struktur Folder Penting

```
├── app/
│   ├── Http/Controllers/     # Controller
│   ├── Models/               # Model Eloquent
│   └── Livewire/             # Komponen Livewire
├── database/
│   ├── migrations/           # File Migration
│   └── seeders/              # File Seeder
├── resources/
│   └── views/                # Blade Templates
├── routes/
│   └── web.php               # Routing
└── .env                      # Konfigurasi Environment
```

---

## 🛠️ Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "No application encryption key"
```bash
php artisan key:generate
```

### Error: "Access denied for user"
Pastikan konfigurasi database di `.env` sudah benar.

### Error: "SQLSTATE[HY000] [2002]"
Pastikan MySQL/MariaDB sudah berjalan.

### Storage Permission Error (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

---

## 📦 Fitur Utama Aplikasi

- ✅ Manajemen Stok Barang
- ✅ Manajemen Sales Order (SO)
- ✅ Manajemen Surat Jalan
- ✅ Manajemen Pembeli
- ✅ Manajemen User & Role
- ✅ Laporan Penjualan (PDF)
- ✅ Laporan Stok Barang (PDF)

---

## 📞 Bantuan

Jika mengalami kendala saat instalasi atau menjalankan aplikasi, silakan hubungi pengembang atau buka dokumentasi Laravel di: https://laravel.com/docs

---

## 📝 Catatan Tambahan

- Aplikasi ini menggunakan **Laravel 10.x** dan **Livewire 3.x**
- Pastikan semua dependencies terinstall dengan benar
- Jangan lupa jalankan `php artisan migrate` dan `php artisan db:seed`
- Untuk development, gunakan `php artisan serve`
- Untuk production, deploy menggunakan Apache/Nginx dengan Virtual Host

---

**Terima kasih telah menggunakan MatStock!** 🚀