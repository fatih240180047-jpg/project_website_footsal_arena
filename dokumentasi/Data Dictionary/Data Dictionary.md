# Kamus Data

## Tabel Pengguna

| No | Kolom (ERD) | Kolom (Database) | Tipe Data | Nullable | Constraint | Deskripsi |
|---|---|---|---|---|---|---|
| 1 | id_pengguna | id | BIGINT UNSIGNED | Tidak | Primary Key, AUTO_INCREMENT | ID unik pengguna |
| 2 | nama | nama | VARCHAR(255) | Tidak | - | Nama lengkap pengguna |
| 3 | email | email | VARCHAR(255) | Tidak | UNIQUE | Alamat email (untuk login) |
| 4 | email_terverifikasi_pada | email_terverifikasi_pada | TIMESTAMP | Ya | - | Waktu verifikasi email |
| 5 | kata_sandi | kata_sandi | VARCHAR(255) | Tidak | - | Kata sandi (bcrypt hashed) |
| 6 | no_telepon | no_telepon | VARCHAR(20) | Ya | - | Nomor telepon |
| 7 | peran | peran | ENUM | Tidak | DEFAULT 'pelanggan' | Peran: admin / pelanggan |
| 8 | remember_token | remember_token | VARCHAR(100) | Ya | - | Token "ingat saya" |
| 9 | created_at | created_at | TIMESTAMP | Ya | - | Waktu data dibuat |
| 10 | updated_at | updated_at | TIMESTAMP | Ya | - | Waktu data diubah |

---

## Tabel Lapangan

| No | Kolom (ERD) | Kolom (Database) | Tipe Data | Nullable | Constraint | Deskripsi |
|---|---|---|---|---|---|---|
| 1 | id_lapangan | id | BIGINT UNSIGNED | Tidak | Primary Key, AUTO_INCREMENT | ID unik lapangan |
| 2 | nama_lapangan | nama_lapangan | VARCHAR(255) | Tidak | - | Nama lapangan (mis: Lapangan A) |
| 3 | deskripsi | deskripsi | TEXT | Ya | - | Deskripsi lengkap lapangan |
| 4 | harga_per_jam | harga_per_jam | DECIMAL(10,2) | Tidak | - | Harga sewa per jam |
| 5 | fasilitas | fasilitas | JSON | Ya | - | Daftar fasilitas (contoh: `["AC","Toilet"]`) |
| 6 | foto | foto | VARCHAR(255) | Ya | - | Path file foto di storage |
| 7 | status | status | ENUM | Tidak | DEFAULT 'aktif' | Status: aktif / nonaktif |
| 8 | created_at | created_at | TIMESTAMP | Ya | - | Waktu data dibuat |
| 9 | updated_at | updated_at | TIMESTAMP | Ya | - | Waktu data diubah |

---

## Tabel Reservasi

| No | Kolom (ERD) | Kolom (Database) | Tipe Data | Nullable | Constraint | Deskripsi |
|---|---|---|---|---|---|---|
| 1 | id_reservasi | id | BIGINT UNSIGNED | Tidak | Primary Key, AUTO_INCREMENT | ID unik reservasi |
| 2 | id_pengguna | pengguna_id | BIGINT UNSIGNED | Tidak | FK → pengguna.id_pengguna (ON DELETE CASCADE) | ID pengguna yang memesan |
| 3 | id_lapangan | lapangan_id | BIGINT UNSIGNED | Tidak | FK → lapangan.id_lapangan (ON DELETE CASCADE) | ID lapangan yang dipesan |
| 4 | tanggal | tanggal | DATE | Tidak | - | Tanggal reservasi |
| 5 | jam_mulai | jam_mulai | TIME | Tidak | - | Jam mulai (HH:MM) |
| 6 | jam_selesai | jam_selesai | TIME | Tidak | - | Jam selesai (HH:MM) |
| 7 | durasi | durasi | INTEGER | Tidak | - | Durasi dalam jam |
| 8 | total_harga | total_harga | DECIMAL(12,2) | Tidak | - | Total harga (harga_per_jam × durasi) |
| 9 | status | status | ENUM | Tidak | DEFAULT 'pending' | Status: pending / dikonfirmasi / dibatalkan / selesai |
| 10 | keterangan | keterangan | TEXT | Ya | - | Catatan tambahan (alasan pembatalan, dll.) |
| 11 | created_at | created_at | TIMESTAMP | Ya | - | Waktu data dibuat |
| 12 | updated_at | updated_at | TIMESTAMP | Ya | - | Waktu data diubah |

---

## Tabel Token Reset Kata Sandi

| No | Kolom (ERD) | Kolom (Database) | Tipe Data | Nullable | Constraint | Deskripsi |
|---|---|---|---|---|---|---|
| 1 | email | email | VARCHAR(255) | Tidak | Primary Key, FK Logis → pengguna.email | Email pengguna |
| 2 | token | token | VARCHAR(255) | Tidak | - | Token reset password |
| 3 | dibuat_pada | dibuat_pada | TIMESTAMP | Ya | - | Waktu token dibuat |

---

## Tabel Sesi

| No | Kolom (ERD) | Kolom (Database) | Tipe Data | Nullable | Constraint | Deskripsi |
|---|---|---|---|---|---|---|
| 1 | id_sesi | id | VARCHAR(255) | Tidak | Primary Key | Session ID unik |
| 2 | id_pengguna | user_id | BIGINT UNSIGNED | Ya | FK → pengguna.id_pengguna, INDEX | ID pengguna yang login |
| 3 | ip_address | ip_address | VARCHAR(45) | Ya | - | Alamat IP client |
| 4 | user_agent | user_agent | TEXT | Ya | - | User agent browser |
| 5 | payload | payload | LONGTEXT | Tidak | - | Data sesi (encrypted) |
| 6 | last_activity | last_activity | INTEGER | Tidak | INDEX | Unix timestamp aktivitas terakhir |