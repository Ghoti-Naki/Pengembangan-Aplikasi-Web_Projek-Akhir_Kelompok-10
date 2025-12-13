# SpaceFlow – Sistem Manajemen & Undangan Ruangan Kampus

## 1. Deskripsi Singkat
SpaceFlow adalah aplikasi berbasis web yang memodernisasi proses peminjaman ruangan kampus. Tidak hanya sekadar booking, sistem ini memungkinkan mahasiswa untuk **mengundang peserta** (baik sesama mahasiswa maupun pihak eksternal) dan melakukan **broadcast undangan** secara otomatis melalui Email dan WhatsApp.

Dilengkapi dengan **Conflict Detection System** untuk mencegah jadwal bentrok dan **Role-Based Access Control** untuk keamanan data.

## 2. Daftar Fitur Unggulan
Berikut adalah fitur-fitur yang tersedia dalam aplikasi:

### 🔐 Autentikasi & Keamanan
- **Register & Login:** Menggunakan Laravel Breeze.
- **Role-based Access:** Pemisahan hak akses antara **Admin** (Petugas) dan **Mahasiswa**.
- **Middleware Security:** Validasi NIM wajib dan verifikasi email.

### 👤 Fitur User (Mahasiswa)
- **Booking & Invitation:** Mengajukan peminjaman ruangan sekaligus mengundang:
  - **Peserta Internal:** Memilih mahasiswa/dosen yang terdaftar di database.
  - **Tamu Eksternal:** Menginput email pihak luar (Dosen Tamu/Orang Tua) secara manual.
- **Broadcast System:**
  - 📧 **Auto-Email:** Mengirim undangan resmi otomatis ke semua peserta (Internal & Eksternal) via SMTP.
  - 📱 **WhatsApp Integration:** Generate pesan undangan formal otomatis untuk dikirim via WhatsApp.
- **Anti-Bentrok Jadwal:** Sistem otomatis menolak jika waktu bertabrakan dengan kegiatan lain.
- **Riwayat Peminjaman:** Memantau status pengajuan dan akses fitur broadcast setelah disetujui.

### 🛠️ Fitur Admin (Petugas)
- **User Management (BARU):** Admin dapat menambah data Pengguna (Dosen/Mahasiswa) secara manual ke database.
- **Monitoring Peserta:** Admin dapat melihat detail siapa saja yang diundang dalam setiap peminjaman.
- **Approval Workflow:** Tombol Terima/Tolak yang interaktif untuk validasi peminjaman.
- **Kelola Ruangan (CRUD):** Manajemen data master ruangan beserta foto fasilitas.

## 3. Tech Stack
- **Bahasa:** PHP 8.2+
- **Framework:** Laravel 11
- **Database:** MySQL
- **Frontend:** Blade Template + Tailwind CSS
- **Mail Server:** SMTP (Gmail App Password)
- **Third-Party:** WhatsApp URL Scheme (No API Cost)

## 4. Skema Database
Sistem ini menggunakan Relational Database dengan struktur berikut:

### Tabel Utama
1. **`users`**: Data pengguna (Admin/Mahasiswa).
2. **`rooms`**: Data master ruangan (Kapasitas, Foto, Deskripsi).
3. **`bookings`**: Transaksi peminjaman (Waktu, Tujuan, Status).

### Tabel Relasi & Undangan
4. **`booking_participants`** (Pivot): Relasi *Many-to-Many* antara Booking dan User (Peserta Internal).
5. **`booking_guests`**: Menyimpan data Tamu Eksternal (Nama & Email) yang diinput manual.

## 5. Cara Install & Setup (Real Case Email)

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

3.  **Setup Environment (.env)**
    - Copy `.env.example` ke `.env`.
    - Atur koneksi database (`DB_DATABASE`, dll).
    - **PENTING:** Atur konfigurasi SMTP untuk fitur Email Broadcast:
    ```ini
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=email_anda@gmail.com
    MAIL_PASSWORD="password_aplikasi_16_digit"
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=email_anda@gmail.com
    ```
    *(Gunakan Google App Password, bukan password login biasa)*

4.  **Generate Key, Storage Link & Migrate**
    ```bash
    php artisan key:generate
    php artisan storage:link
    php artisan migrate:fresh --seed
    ```

5.  **Jalankan Project**
    ```bash
    npm run dev
    # Buka terminal baru
    php artisan serve
    ```

## 6. List Endpoint Utama

| Role | Method | URL Path | Deskripsi |
| :--- | :--- | :--- | :--- |
| **Admin** | `RESOURCE` | `/admin/users` | Kelola Data Pengguna (CRUD) |
| **Admin** | `RESOURCE` | `/admin/rooms` | Kelola Data Ruangan (CRUD) |
| **Admin** | `PATCH` | `/admin/bookings/{id}/status` | Terima/Tolak Peminjaman |
| **User** | `GET` | `/bookings/create/{room}` | Form Booking & Invite Peserta |
| **User** | `POST` | `/bookings/{id}/broadcast` | Kirim Email Undangan Massal |
| **User** | `GET` | `/my-bookings` | Riwayat & Tombol WhatsApp |

## 7. Anggota Kelompok
| NIM | Nama | Peran |
| :--- | :--- | :--- |
| 245150700111046 | M. Dhika Ferdiansyah | Backend, Database & Email System |
| 245150707111026 | Rafi Al Musa | Frontend, UI/UX & Auth |
