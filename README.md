# SpaceFlow – Sistem Peminjaman Ruangan Kampus

## 1. Deskripsi Singkat
SpaceFlow adalah aplikasi berbasis web yang memudahkan mahasiswa untuk meminjam ruangan kampus secara online dan membantu petugas (admin) dalam mengelola jadwal serta persetujuan peminjaman ruangan. Sistem ini dilengkapi dengan **logika pencegahan jadwal bentrok** (*conflict detection*) untuk memastikan tidak ada peminjaman ganda di waktu yang sama.

## 2. Daftar Fitur
Berikut adalah fitur utama yang dibangun dalam aplikasi ini:

### 🔐 Autentikasi & Keamanan
- **Register & Login:** Menggunakan Laravel Breeze.
- **Role-based Access:** Middleware khusus untuk membedakan hak akses **Admin** (Petugas) dan **Mahasiswa** (User).
- **Proteksi Rute:** Mencegah mahasiswa mengakses halaman admin dan sebaliknya.

### 👤 Fitur User (Mahasiswa)
- **Dashboard Ruangan:** Melihat daftar ruangan yang tersedia lengkap dengan kapasitas dan fasilitas.
- **Booking Ruangan:** Mengajukan peminjaman ruangan dengan validasi waktu.
- **Anti-Bentrok Jadwal:** Sistem otomatis menolak pengajuan jika jadwal bertabrakan dengan peminjaman lain yang sudah disetujui.
- **Riwayat Peminjaman:** Melihat status pengajuan (Pending, Disetujui, Ditolak).

### 🛠️ Fitur Admin (Petugas)
- **Kelola Ruangan (CRUD):** Menambah, mengedit, dan menghapus data master ruangan.
- **Validasi Peminjaman:** Menerima (Approve) atau Menolak (Reject) pengajuan dari mahasiswa.
- **Monitoring:** Melihat daftar seluruh pengajuan peminjaman masuk.

## 3. Tech Stack
- **Bahasa:** PHP 8.2+
- **Framework:** Laravel 11
- **Database:** MySQL
- **Frontend:** Blade Template + Tailwind CSS
- **Arsitektur:** MVC (Model-View-Controller)

## 4. Skema Database
Aplikasi ini menggunakan 3 tabel utama yang saling berelasi:

### Tabel `users`
- `id` (PK)
- `name`, `email`, `password`
- `nim` (Nullable)
- `role` (Enum: 'admin', 'mahasiswa')

### Tabel `rooms`
- `id` (PK)
- `room_code` (Unique), `name`
- `capacity`, `description`, `image`

### Tabel `bookings`
- `id` (PK)
- `user_id` (FK -> users.id)
- `room_id` (FK -> rooms.id)
- `start_time`, `end_time`, `purpose`
- `status` (Enum: 'pending', 'approved', 'rejected')

## 5. Cara Install / Cara Menjalankan
### 🚀 Langkah Instalasi

1.  **Clone repository**
    ```bash
    git clone [https://github.com/Ghoti-Naki/SpaceFlow.git](https://github.com/Ghoti-Naki/SpaceFlow.git)
    cd SpaceFlow
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    - Copy `.env.example` ke `.env`
    - Atur koneksi database di `.env`

4.  **Generate Key & Migrate**
    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    ```
    > **PENTING:** Perintah `--seed` wajib dijalankan untuk membuat akun Admin default.

5.  **Akun Default (Untuk Login)**
    - **Admin:** `admin@spaceflow.com` / Password: `password`
    - **Mahasiswa:** Silakan register akun baru di menu Register.

6.  **Jalankan Project**
    Jalankan dua perintah ini di terminal berbeda:
    ```bash
    php artisan serve
    npm run dev
    ```

## 6. List Endpoint / Route
### 📌 List Endpoint Utama

| Akses | Method | URL Path | Deskripsi |
| :--- | :--- | :--- | :--- |
| **Public** | `GET` | `/login` | Halaman Login |
| **Public** | `GET` | `/register` | Halaman Register Mahasiswa |
| **User** | `GET` | `/dashboard` | Daftar Ruangan (Homepage) |
| **User** | `GET` | `/bookings/create/{room}` | Form Pengajuan Booking |
| **User** | `POST` | `/bookings` | Proses Simpan Pengajuan |
| **User** | `GET` | `/my-bookings` | Riwayat Peminjaman Saya |
| **Admin** | `GET` | `/admin/dashboard` | Dashboard Admin |
| **Admin** | `RESOURCE`| `/admin/rooms` | CRUD Data Ruangan |
| **Admin** | `GET` | `/admin/bookings` | List Validasi Peminjaman |
| **Admin** | `PATCH` | `/admin/bookings/{id}/approve` | Setujui Peminjaman |
| **Admin** | `PATCH` | `/admin/bookings/{id}/reject` | Tolak Peminjaman |

## 7. Anggota Kelompok
| NIM | Nama | Peran |
| :--- | :--- | :--- |
| 245150700111046 | M. Dhika Ferdiansyah | Backend Logic & Database |
| 245150707111026 | Rafi Al Musa | Frontend (UI/UX) & Auth |
