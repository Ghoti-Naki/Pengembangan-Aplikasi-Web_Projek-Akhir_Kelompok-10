# Campus Booking – Sistem Peminjaman Ruangan Kampus

## 1. Deskripsi Singkat
Campus Booking adalah aplikasi berbasis web yang memudahkan mahasiswa untuk meminjam ruangan kampus secara online dan membantu petugas (admin) dalam mengelola jadwal serta persetujuan peminjaman ruangan untuk menghindari bentrok jadwal.

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
- `id` (Primary Key)
- `name` (Varchar)
- `email` (Varchar, Unique)
- `password` (Varchar)
- `role` (Enum: 'admin', 'mahasiswa')
- `created_at`, `updated_at`

### Tabel `rooms`
Menyimpan data master ruangan yang bisa dipinjam.
- `id` (Primary Key)
- `room_code` (Varchar, Unique) - misal: A101
- `name` (Varchar) - misal: Ruang Teori 1
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

## 5. Cara Menjalankan Project (Localhost)

**a. Clone Repository**
```bash
git clone [https://github.com/username/campus-booking.git](https://github.com/username/campus-booking.git)
