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
DB_DATABASE=db_penjualan_material_bangunan
DB_USERNAME=root
DB_PASSWORD=
```


### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Buat Database

Buat database baru di MySQL/MariaDB dengan nama sesuai yang ada di file `.env`:

```sql
CREATE DATABASE db_penjualan_material_bangunan;
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


### 8. Jalankan Aplikasi

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

