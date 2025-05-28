<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🏥 Aplikasi Klinik Sederhana - Laravel 12

Sistem informasi klinik berbasis web yang dibangun menggunakan Laravel 12. Aplikasi ini mendukung peran multi-user (pendaftaran, perawat, dokter, dan apoteker) untuk memudahkan proses pemeriksaan pasien, pengelolaan data obat, dan pencatatan diagnosis secara terstruktur.

---

## 🚀 Fitur Utama

-   **Login Multi Role**: Akses berbeda untuk `receptionist`, `nurse`, `doctor`, dan `pharmacist`.
-   **Manajemen Pasien**: Tambah, edit, dan lihat data pasien.
-   **Pemeriksaan Vital**: Perawat dapat menginput berat badan dan tekanan darah.
-   **Diagnosa Dokter**: Dokter dapat melihat data vital dan memberikan diagnosis.
-   **Resep Obat**: Apoteker dapat memberikan resep dari daftar obat.
-   **Dashboard Role-based**: Setiap role melihat dashboard berbeda sesuai tugasnya.
-   **Manajemen Obat**: Tambah, lihat, dan kelola daftar obat.

---

## 🔐 Login Default

Seeder sudah disediakan untuk login role-role berikut:

| Role         | Email                  | Password |
| ------------ | ---------------------- | -------- |
| Receptionist | receptionist@gmail.com | password |
| Nurse        | nurse@gmail.com        | password |
| Doctor       | doctor@gmail.com       | password |
| Pharmacist   | pharmacist@gmail.com   | password |

---

## 🛠️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/fozimat/e-klinik.git
cd e-klinik
```

### 2. Install dependency

```bash
composer install
```

### 3. Copy file environment dan atur konfigurasi database

```bash
cp .env.example .env
```

### 4. Generate aplikasi key dan migrasi + seeder database

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=MedicineSeeder
php artisan db:seed --class=PatientSeeder
```

### 5. Jalankan server

```bash
php artisan serve
```

Database
File SQL untuk import manual tersedia di database/sql/klinik.sql

Relasi antar model sudah terdefinisi dalam model Laravel
