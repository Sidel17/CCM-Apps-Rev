<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/your-repository/actions">
        <img src="https://github.com/your-repository/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://opensource.org/licenses/MIT">
        <img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License">
    </a>
</p>

# 🚀 Laravel Project Installation Guide

## 🛠 Prerequisites
Sebelum memulai instalasi proyek ini, pastikan Anda telah menginstal beberapa software berikut:

- **PHP** (>=8.0)
- **Composer** (https://getcomposer.org/)
- **Node.js & NPM** (https://nodejs.org/)
- **Database** (MySQL / PostgreSQL / SQLite / SQL Server)
- **Git** (https://git-scm.com/)

## 📥 Clone Repository
Jalankan perintah berikut untuk mendownload proyek ini ke komputer Anda:

```sh
# Clone repository dari GitHub
git clone https://github.com/your-repository.git

# Masuk ke direktori proyek
cd your-repository
```

## 🔧 Install Dependencies
Setelah clone proyek, install semua dependensi Laravel dengan Composer:

```sh
composer install
```

Kemudian, install package frontend dengan NPM:

```sh
npm install && npm run dev
```

## ⚙️ Konfigurasi Environment
Buat file `.env` dari template `.env.example`:

```sh
cp .env.example .env
```

Lalu, atur konfigurasi database di file `.env` sesuai dengan pengaturan lokal Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Setelah itu, generate application key:

```sh
php artisan key:generate
```

## 📊 Migrasi Database
Jalankan perintah berikut untuk melakukan migrasi database:

```sh
php artisan migrate --seed
```

Jika proyek memiliki data awal yang perlu dimasukkan, pastikan untuk menjalankan perintah dengan `--seed` agar seeder juga dijalankan.

## 🚀 Menjalankan Aplikasi
Sekarang saatnya menjalankan proyek Laravel Anda!

```sh
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`. Anda bisa membukanya di browser favorit Anda! 🎉

## 📝 Testing
Untuk memastikan semua fitur berjalan dengan baik, jalankan unit test dengan perintah berikut:

```sh
php artisan test
```

## 🤝 Kontribusi
Jika ingin berkontribusi dalam proyek ini, silakan buat **Pull Request** atau laporkan **Issue** di repository ini.

## 🛡️ License
Proyek ini menggunakan lisensi **MIT**. Silakan baca [LICENSE](https://opensource.org/licenses/MIT) untuk detail lebih lanjut.

---

💡 **Selamat Coding!** 🚀 Jika ada pertanyaan, jangan ragu untuk bertanya atau melihat dokumentasi Laravel di [Laravel Docs](https://laravel.com/docs).

