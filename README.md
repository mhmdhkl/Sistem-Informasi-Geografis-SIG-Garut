# Sistem Informasi Geografis (SIG) Kabupaten Garut
Sebuah platform berbasis web untuk visualisasi data geografis seputar pariwisata dan kebudayaan di Kabupaten Garut.

-----

## 📜 Tentang Proyek

Proyek ini merupakan Sistem Informasi Geografis (SIG) yang dibangun untuk memetakan dan menyajikan data spasial terkait potensi pariwisata, cagar budaya, demografi, dan informasi penting lainnya di wilayah Kabupaten Garut. Aplikasi ini dilengkapi dengan *dashboard* admin untuk mengelola seluruh konten, mulai dari data lokasi hingga lapisan peta GeoJSON.

Proyek ini dikembangkan sebagai bagian dari Kerja Praktik di Dinas Komunikasi dan Informatika (Diskominfo) Kabupaten Garut.

### 📸 Tampilan Web


-----

## ✨ Fitur Utama

  - **Peta Interaktif**: Visualisasi lokasi dan lapisan peta menggunakan **Leaflet.js**.
  - **Katalog Peta Tematik**: Pengelompokan peta berdasarkan kategori seperti pariwisata, budaya, dan batas wilayah.
  - **Visualisasi Data**: Tampilan data demografi dalam bentuk kartu statistik dan grafik dinamis menggunakan **Chart.js**.
  - **Berita Terkini**: Menampilkan berita-berita terbaru yang relevan dari sumber eksternal.
  - **Video Galeri**: *Slideshow* video dari YouTube menggunakan **Swiper.js**.
  - **Dashboard Admin Lengkap**:
      - Sistem otentikasi untuk admin.
      - **CRUD** (Create, Read, Update, Delete) untuk semua jenis data:
          - Lokasi Pariwisata & Budaya (dengan koordinat).
          - Data Statistik Umum.
          - Data Demografi per Kecamatan.
          - Berita.
          - Layer Peta (upload file GeoJSON).
      - Ringkasan data total di halaman utama *dashboard*.

-----

## 🛠️ Teknologi yang Digunakan

  - **Backend**: Laravel 11, PHP 8.2+
  - **Frontend**: Tailwind CSS, Alpine.js
  - **Database**: MySQL
  - **Pustaka (Libraries)**:
      - **Leaflet.js**: Untuk peta interaktif.
      - **Chart.js**: Untuk grafik data.
      - **Swiper.js**: Untuk *carousel* dan *slideshow*.
  - **Development Environment**: Vite, Laragon

-----

## 🚀 Panduan Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal Anda.

### Prasyarat

  - PHP \>= 8.2
  - Composer
  - Node.js & NPM
  - Database Server (contoh: MySQL)

### Langkah-langkah

1.  **Clone repositori ini:**

    ```bash
    git clone Sistem-Informasi-Geografis-SIG-Garut.git
    cd Sistem-Informasi-Geografis-SIG-Garut
    ```

2.  **Instal dependensi PHP:**

    ```bash
    composer install
    ```

3.  **Instal dependensi JavaScript:**

    ```bash
    npm install
    ```

4.  **Salin file `.env.example` menjadi `.env`:**

    ```bash
    copy .env.example .env
    ```

5.  **Generate *application key*:**

    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi database Anda di file `.env`:**

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sig_garut
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Jalankan migrasi database untuk membuat semua tabel:**

    ```bash
    php artisan migrate
    ```

8.  **Jalankan *database seeder* untuk mengisi data awal:**

    ```bash
    php artisan db:seed
    ```

9.  **Buat *symbolic link* untuk *storage*:**

    ```bash
    php artisan storage:link
    ```

10. **Jalankan *Vite development server*:**

    ```bash
    npm run dev
    ```

11. **(Di terminal baru) Jalankan server Laravel:**

    ```bash
    php artisan serve
    ```

Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

### Akun Admin

Untuk masuk ke halaman *dashboard*, gunakan kredensial default berikut:

  - **Email**: `admin@example.com`
  - **Password**: `12345678`

