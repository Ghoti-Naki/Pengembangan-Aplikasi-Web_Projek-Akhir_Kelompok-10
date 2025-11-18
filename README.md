# SpaceFlow – Sistem Peminjaman Ruangan Kampus

## 1. Deskripsi Singkat
SpaceFlow adalah aplikasi berbasis web yang memudahkan mahasiswa untuk meminjam ruangan kampus secara online dan membantu petugas (admin) dalam mengelola jadwal serta persetujuan peminjaman ruangan untuk menghindari bentrok jadwal.

## 2. Daftar Fitur
Berikut adalah fitur utama yang dibangun dalam aplikasi ini:
### 🔐 Autentikasi & Hak Akses
- **Register & Login:** Pengguna dapat mendaftar dan masuk ke dalam sistem.
- **Role-based Access:** Sistem membedakan hak akses antara **Admin** (Petugas) dan **User** (Mahasiswa).

### 👤 Fitur User (Mahasiswa)
- **Dashboard:** Melihat daftar ruangan yang tersedia.
- **Booking Ruangan:** Mengajukan peminjaman ruangan berdasarkan tanggal dan waktu.
- **Riwayat Peminjaman:** Melihat status pengajuan (Pending, Disetujui, Ditolak).

### 🛠️ Fitur Admin (Petugas)
- **Kelola Ruangan (CRUD):** Menambah, mengedit, dan menghapus data ruangan.
- **Validasi Peminjaman:** Menyetujui atau menolak pengajuan peminjaman dari mahasiswa.
- **Cek Jadwal:** Melihat kalender peminjaman untuk mencegah jadwal ganda.

## 3. Tech Stack
Teknologi yang digunakan dalam pengembangan proyek ini:
- **Bahasa:** PHP 8.2+
- **Framework:** Laravel 11
- **Database:** MySQL
- **Frontend:** Blade Template + Tailwind CSS (Bawaan Laravel Breeze)
- **Arsitektur:** MVC (Model-View-Controller)

## 4. Skema Database
Aplikasi ini menggunakan database relasional dengan minimal 3 tabel utama:

### Tabel `users`
Menyimpan data pengguna aplikasi.
- `nim` (Primary Key)
- `name` (Varchar)
- `email` (Varchar, Unique)
- `password` (Varchar)
- `role` (Enum: 'admin', 'mahasiswa')
- `created_at`, `updated_at`

### Tabel `rooms`
Menyimpan data master ruangan yang bisa dipinjam.
- `id` (Primary Key)
- `room_code` (Varchar, Unique) - misal: F2.2
- `name` (Varchar) - misal: Ruang GKM 4.1
- `capacity` (Integer)
- `description` (Text)
- `image` (Varchar, Nullable)
- `created_at`, `updated_at`

### Tabel `bookings`
Menyimpan data transaksi peminjaman (menghubungkan User dan Room).
- `id` (Primary Key)
- `user_id` (Foreign Key -> users.id)
- `room_id` (Foreign Key -> rooms.id)
- `start_time` (DateTime)
- `end_time` (DateTime)
- `purpose` (Varchar)
- `status` (Enum: 'pending', 'approved', 'rejected')
- `created_at`, `updated_at`

## 5. Cara Install / Cara Menjalankan
### 🚀 Cara Menjalankan (Local Development)

1.  **Clone repository**
    ```bash
    git clone [https://github.com/username/campus-booking.git](https://github.com/username/campus-booking.git)
    ```

2.  **Masuk Folder Project**
    ```bash
    cd campus-booking
    ```

3.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

4.  **Setup Environment**
    - Copy file `.env.example` menjadi `.env`.
    - Atur konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, dll) di file `.env`.
    
5.  **Generate Key**
    ```bash
    php artisan key:generate
    ```

6.  **Jalankan Migrasi (Membuat Tabel)**
    ```bash
    php artisan migrate
    ```

7.  **Jalankan Project**
    Buka dua terminal dan jalankan kedua perintah ini secara bersamaan:
    ```bash
    # Terminal 1 (Backend Server)
    php artisan serve

    # Terminal 2 (Frontend Assets Watcher)
    npm run dev
    ```

## 6. List Endpoint / Route
### 📌 List Endpoint / Route

| Metode | Jalur (Path) | Keterangan | Akses |
| :--- | :--- | :--- | :--- |
| **AUTH** | | | |
| `GET` | `/login` | Tampilkan form login | Public |
| `POST` | `/login` | Proses autentikasi | Public |
| `POST` | `/logout` | Keluar dari sesi | All Authenticated |
| **ADMIN** | | | |
| `GET` | `/admin/dashboard` | Dashboard utama Admin | Admin Only |
| `GET/POST/PUT/DEL`| `/admin/rooms` | CRUD Ruangan | Admin Only |
| `PATCH` | `/admin/bookings/{id}/approve` | Setujui peminjaman | Admin Only |
| **USER** | | | |
| `GET` | `/dashboard` | Dashboard Mahasiswa (List Ruangan) | Mahasiswa Only |
| `GET` | `/bookings/create/{room_id}` | Form pengajuan peminjaman | Mahasiswa Only |
| `POST` | `/bookings` | Simpan pengajuan peminjaman | Mahasiswa Only |
| `GET` | `/my-bookings` | Riwayat peminjaman | Mahasiswa Only |

## 8. Anggota Kelompok
| NIM | Nama | Peran yang Dianjurkan |
| :--- | :--- | :--- |
| 245150700111046 | M. Dhika Ferdiansyah | Backend Logic & Database |
| 245150707111026 | Rafi Al Musa   | Frontend (UI/UX) & Blade Templating |
