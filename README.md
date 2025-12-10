# Platform Rekrutmen Antigravity

Platform rekrutmen berbasis web yang dibangun menggunakan **Laravel 12** dan **Tailwind CSS**. Aplikasi ini memungkinkan pelamar (Guest) untuk melamar pekerjaan dan Admin untuk mengelola lowongan serta lamaran.

## Fitur Utama

### 1. Role: Guest (Pelamar)
*   **Lihat Lowongan**: Dapat melihat daftar lowongan pekerjaan yang tersedia di berbagai departemen.
*   **Detail Lowongan**: Melihat deskripsi lengkap, kuota, dan posisi.
*   **Lamar Pekerjaan**: Mengisi formulir lamaran (Nama, Email, No HP) untuk posisi tertentu.
*   **Autentikasi**: Registrasi dan Login akun pelamar.

### 2. Role: Admin
*   **Kelola Lowongan (CRUD)**: Menambah, mengubah, dan menghapus data lowongan pekerjaan.
*   **Kelola Lamaran**: Melihat daftar lamaran masuk.
*   **Approval**: Menyetujui (Approve) atau Menolak (Reject) lamaran pelamar.
*   **Laporan (Reports)**:
    *   Ringkasan jumlah pelamar per departemen.
    *   Grafik statistik status lamaran (Pending, Approved, Rejected).

## Teknologi

*   **Backend**: Laravel 12
*   **Frontend**: Blade Templates + Tailwind CSS (CDN)
*   **Database**: MySQL
*   **Charting**: Chart.js

## Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di komputer lokal Anda.

### Prasyarat
*   PHP >= 8.2
*   Composer
*   MySQL

### Langkah Instalasi

1.  **Clone Repository** (atau ekstrak zip):
    ```bash
    git clone https://github.com/masfudindc/platform-rekrutmen-antigravity.git
    cd platform-rekrutmen-antigravity
    ```

2.  **Install Dependencies**:
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**:
    Salin file contoh `.env` dan sesuaikan konfigurasi database.
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan atur detail database:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=platform_rekrutmen
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Application Key**:
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi & Seeding Database**:
    Jalankan perintah ini untuk membuat tabel dan mengisi data awal (Departemen & Akun Admin).
    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Server**:
    ```bash
    php artisan serve
    ```
    Akses aplikasi di `http://localhost:8000`.

## Penggunaan

### Akun Admin (Default)
*   **Email**: `admin@gmail.com`
*   **Password**: `password`

### Akun Guest
*   Silakan lakukan **Register** akun baru pada halaman utama aplikasi.

## Struktur Direktori Penting
*   `app/Models`: Model Eloquent (Vacancy, Application, Department).
*   `app/Http/Controllers`: Logika aplikasi (VacancyController, ApplicationController, AuthController).
*   `resources/views`: Tampilan antarmuka (Blade & Tailwind).
*   `routes/web.php`: Definisi rute aplikasi.
