# Sistem Reservasi Pintar Lapangan Futsal

## Overview
Full-stack Laravel 12 application with MySQL database. Customer-facing reservation system + basic admin panel. All file names, class names, function names, and database columns in Bahasa Indonesia.

## Database Schema

### Tabel `pengguna` (extend Laravel users table)
- id, nama, email, password, no_telepon, peran (admin/pelanggan), created_at, updated_at

### Tabel `lapangan`
- id, nama_lapangan, deskripsi, harga_per_jam, fasilitas (text/json), foto (nullable), status (aktif/nonaktif), created_at, updated_at

### Tabel `reservasi`
- id, pengguna_id, lapangan_id, tanggal, jam_mulai, jam_selesai, durasi, total_harga, status (pending/dikonfirmasi/dibatalkan/selesai), keterangan (nullable), created_at, updated_at

---

## Task 1: Setup & Configuration
- Update `.env`: switch DB_CONNECTION to `mysql`, set DB_DATABASE=`futsal_arena`, configure MySQL credentials for XAMPP
- Set APP_NAME to "Reservasi Futsal Arena"
- Set APP_LOCALE to `id`

## Task 2: Database Migrations
Create 3 migration files:
- `database/migrations/xxxx_create_pengguna_table.php` - modify users table to add `no_telepon`, `peran` columns, rename table to `pengguna`
- `database/migrations/xxxx_create_lapangan_table.php`
- `database/migrations/xxxx_create_reservasi_table.php`

## Task 3: Models (in `app/Models/`)
- `Pengguna.php` - extends Authenticatable, has role check methods, hasMany Reservasi
- `Lapangan.php` - hasMany Reservasi, scope for active courts, accessor for formatted price
- `Reservasi.php` - belongsTo Pengguna & Lapangan, scope for status filtering, accessor for duration calculation

## Task 4: Authentication System
- `app/Http/Controllers/AutentikasiController.php` - login, register, logout
- `resources/views/autentikasi/masuk.blade.php` - login form
- `resources/views/autentikasi/daftar.blade.php` - registration form
- Middleware `app/Http/Middleware/CekPeran.php` - role-based access (admin vs pelanggan)

## Task 5: Customer-Facing Features (Pelanggan)

### 5a: Pencarian Lapangan (Court Search)
- `app/Http/Controllers/Pelanggan/LapanganController.php` - index (search by date/time), show (detail)
- `resources/views/pelanggan/lapangan/index.blade.php` - search form + court list
- `resources/views/pelanggan/lapangan/detail.blade.php` - court detail with facilities, price, available slots

### 5b: Reservasi (Booking)
- `app/Http/Controllers/Pelanggan/ReservasiController.php` - create (form), store (process), index (my bookings), show (detail)
- `resources/views/pelanggan/reservasi/buat.blade.php` - booking form (select date, time slots, auto-calculate price)
- `resources/views/pelanggan/reservasi/index.blade.php` - my reservation list
- `resources/views/pelanggan/reservasi/detail.blade.php` - reservation detail + payment info display

### 5c: Availability Logic
- Service class `app/Services/LayananKetersediaan.php` - check court availability for given date/time, prevent double booking

## Task 6: Admin Panel

### 6a: Dashboard
- `app/Http/Controllers/Admin/DashboardController.php` - stats (total courts, active reservations today, revenue)
- `resources/views/admin/dashboard.blade.php`

### 6b: Manajemen Lapangan (Court Management)
- `app/Http/Controllers/Admin/LapanganController.php` - CRUD
- `resources/views/admin/lapangan/index.blade.php` - list
- `resources/views/admin/lapangan/tambah.blade.php` - create form
- `resources/views/admin/lapangan/ubah.blade.php` - edit form

### 6c: Manajemen Reservasi (Reservation Management)
- `app/Http/Controllers/Admin/ReservasiController.php` - list all, confirm/cancel
- `resources/views/admin/reservasi/index.blade.php` - list with filters
- `resources/views/admin/reservasi/detail.blade.php` - detail + confirm/cancel buttons

## Task 7: Routes (`routes/web.php`)
- Guest routes: login, register
- Pelanggan routes (middleware: auth + role:pelanggan): search courts, make/view reservations
- Admin routes (middleware: auth + role:admin): dashboard, manage courts, manage reservations
- Auth routes: logout

## Task 8: Database Seeder
- `database/seeders/PenggunaSeeder.php` - create 1 admin user and 1 test customer
- `database/seeders/LapanganSeeder.php` - create 3-5 sample courts with varied prices/facilities
- Update `database/seeders/DatabaseSeeder.php` to call both

## Task 9: Layout & Base Views
- `resources/views/tata_letak/utama.blade.php` - base layout with nav (dynamic based on role)
- `resources/views/tata_letak/admin.blade.php` - admin layout with sidebar
- Keep UI minimal as requested, use basic HTML + minimal CSS

## Task 10: Testing & Verification
- Run migrations
- Seed database
- Verify all routes work
- Test reservation flow: search -> book -> admin confirm

---

## File Structure Summary
```
app/
  Http/
    Controllers/
      AutentikasiController.php
      Pelanggan/
        LapanganController.php
        ReservasiController.php
      Admin/
        DashboardController.php
        LapanganController.php
        ReservasiController.php
    Middleware/
      CekPeran.php
  Models/
    Pengguna.php
    Lapangan.php
    Reservasi.php
  Services/
    LayananKetersediaan.php
database/
  migrations/
    ..._create_pengguna_table.php
    ..._create_lapangan_table.php
    ..._create_reservasi_table.php
  seeders/
    PenggunaSeeder.php
    LapanganSeeder.php
    DatabaseSeeder.php
resources/views/
  tata_letak/
    utama.blade.php
    admin.blade.php
  autentikasi/
    masuk.blade.php
    daftar.blade.php
  pelanggan/
    lapangan/
      index.blade.php
      detail.blade.php
    reservasi/
      buat.blade.php
      index.blade.php
      detail.blade.php
  admin/
    dashboard.blade.php
    lapangan/
      index.blade.php
      tambah.blade.php
      ubah.blade.php
    reservasi/
      index.blade.php
      detail.blade.php
```
