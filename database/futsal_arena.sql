-- ============================================================
--  SKRIP DATABASE: futsal_arena
--  Dibuat untuk: XAMPP (MySQL 5.7+ / MariaDB 10.3+)
--  Laravel 12 - Reservasi Futsal Arena
--
--  CARA PENGGUNAAN:
--  1. Buka http://localhost/phpmyadmin
--  2. Klik tab "SQL" di bagian atas
--  3. Tempel (paste) seluruh isi file ini
--  4. Klik tombol "Kirim" / "Go"
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";

-- ------------------------------------------------------------
-- 1. Buat & Pilih Database
-- ------------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `futsal_arena`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `futsal_arena`;

-- ------------------------------------------------------------
-- 2. Tabel: pengguna
--    Menyimpan data akun (admin & pelanggan)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pengguna` (
    `id`                        BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nama`                      VARCHAR(255)    NOT NULL,
    `email`                     VARCHAR(255)    NOT NULL UNIQUE,
    `email_terverifikasi_pada`  TIMESTAMP       NULL DEFAULT NULL,
    `kata_sandi`                VARCHAR(255)    NOT NULL,
    `no_telepon`                VARCHAR(20)     NULL DEFAULT NULL,
    `peran`                     ENUM('admin','pelanggan') NOT NULL DEFAULT 'pelanggan',
    `remember_token`            VARCHAR(100)    NULL DEFAULT NULL,
    `created_at`                TIMESTAMP       NULL DEFAULT NULL,
    `updated_at`                TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 3. Tabel: token_reset_kata_sandi
--    Menyimpan token untuk reset password
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `token_reset_kata_sandi` (
    `email`       VARCHAR(255) NOT NULL,
    `token`       VARCHAR(255) NOT NULL,
    `dibuat_pada` TIMESTAMP    NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 4. Tabel: sesi
--    Menyimpan sesi pengguna (SESSION_DRIVER=database)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `sesi` (
    `id`            VARCHAR(255)    NOT NULL,
    `user_id`       BIGINT UNSIGNED NULL DEFAULT NULL,
    `ip_address`    VARCHAR(45)     NULL DEFAULT NULL,
    `user_agent`    TEXT            NULL DEFAULT NULL,
    `payload`       LONGTEXT        NOT NULL,
    `last_activity` INT             NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sesi_user_id_index` (`user_id`),
    KEY `sesi_last_activity_index` (`last_activity`),
    CONSTRAINT `fk_sesi_pengguna`
        FOREIGN KEY (`user_id`) REFERENCES `pengguna` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 5. Tabel: lapangan
--    Menyimpan data lapangan futsal
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lapangan` (
    `id`           BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `nama_lapangan` VARCHAR(255)    NOT NULL,
    `deskripsi`    TEXT             NULL DEFAULT NULL,
    `harga_per_jam` DECIMAL(10,2)   NOT NULL,
    `fasilitas`    JSON             NULL DEFAULT NULL,
    `foto`         VARCHAR(255)     NULL DEFAULT NULL,
    `status`       ENUM('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
    `created_at`   TIMESTAMP        NULL DEFAULT NULL,
    `updated_at`   TIMESTAMP        NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 6. Tabel: reservasi
--    Menyimpan data pemesanan lapangan oleh pelanggan
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `reservasi` (
    `id`          BIGINT UNSIGNED  NOT NULL AUTO_INCREMENT,
    `pengguna_id` BIGINT UNSIGNED  NOT NULL,
    `lapangan_id` BIGINT UNSIGNED  NOT NULL,
    `tanggal`     DATE             NOT NULL,
    `jam_mulai`   TIME             NOT NULL,
    `jam_selesai` TIME             NOT NULL,
    `durasi`      INT              NOT NULL COMMENT 'Durasi dalam jam',
    `total_harga` DECIMAL(12,2)   NOT NULL,
    `status`      ENUM('pending','dikonfirmasi','dibatalkan','selesai') NOT NULL DEFAULT 'pending',
    `keterangan`  TEXT             NULL DEFAULT NULL,
    `created_at`  TIMESTAMP        NULL DEFAULT NULL,
    `updated_at`  TIMESTAMP        NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_reservasi_pengguna`
        FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_reservasi_lapangan`
        FOREIGN KEY (`lapangan_id`) REFERENCES `lapangan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 7. Tabel: cache
--    Menyimpan data cache aplikasi (CACHE_STORE=database)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `cache` (
    `key`        VARCHAR(255) NOT NULL,
    `value`      MEDIUMTEXT   NOT NULL,
    `expiration` INT          NOT NULL,
    PRIMARY KEY (`key`),
    KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `cache_locks` (
    `key`        VARCHAR(255) NOT NULL,
    `owner`      VARCHAR(255) NOT NULL,
    `expiration` INT          NOT NULL,
    PRIMARY KEY (`key`),
    KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 8. Tabel: jobs, job_batches, failed_jobs
--    Untuk antrian pekerjaan Laravel (QUEUE_CONNECTION=database)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jobs` (
    `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `queue`        VARCHAR(255)    NOT NULL,
    `payload`      LONGTEXT        NOT NULL,
    `attempts`     TINYINT UNSIGNED NOT NULL,
    `reserved_at`  INT UNSIGNED    NULL DEFAULT NULL,
    `available_at` INT UNSIGNED    NOT NULL,
    `created_at`   INT UNSIGNED    NOT NULL,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `job_batches` (
    `id`             VARCHAR(255) NOT NULL,
    `name`           VARCHAR(255) NOT NULL,
    `total_jobs`     INT          NOT NULL,
    `pending_jobs`   INT          NOT NULL,
    `failed_jobs`    INT          NOT NULL,
    `failed_job_ids` LONGTEXT     NOT NULL,
    `options`        MEDIUMTEXT   NULL DEFAULT NULL,
    `cancelled_at`   INT          NULL DEFAULT NULL,
    `created_at`     INT          NOT NULL,
    `finished_at`    INT          NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid`       VARCHAR(255)    NOT NULL UNIQUE,
    `connection` TEXT            NOT NULL,
    `queue`      TEXT            NOT NULL,
    `payload`    LONGTEXT        NOT NULL,
    `exception`  LONGTEXT        NOT NULL,
    `failed_at`  TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- 9. Tabel: migrations
--    Tabel internal Laravel untuk melacak migrasi
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `migrations` (
    `id`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `migration` VARCHAR(255) NOT NULL,
    `batch`     INT          NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Isi tabel migrations agar Laravel tidak menjalankan migrate ulang
INSERT IGNORE INTO `migrations` (`migration`, `batch`) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2024_01_01_000001_buat_tabel_lapangan', 1),
('2024_01_01_000002_buat_tabel_reservasi', 1);

-- ============================================================
-- 10. DATA AWAL (SEEDER)
-- ============================================================

-- Akun Admin (kata sandi: password)
-- Hash bcrypt untuk 'password' dengan 12 rounds
INSERT IGNORE INTO `pengguna` (`nama`, `email`, `kata_sandi`, `peran`, `created_at`, `updated_at`) VALUES
(
    'Administrator',
    'admin@futsalarena.com',
    '$2y$12$AZrZhnhl7o5mjZ4P1Y6S6eJjjxH96u9h/JtaxLcbT.WqXH.QRWGsG',
    'admin',
    NOW(),
    NOW()
);

-- Akun Pelanggan Contoh (kata sandi: password)
INSERT IGNORE INTO `pengguna` (`nama`, `email`, `no_telepon`, `kata_sandi`, `peran`, `created_at`, `updated_at`) VALUES
(
    'Budi Santoso',
    'budi@email.com',
    '081234567890',
    '$2y$12$AZrZhnhl7o5mjZ4P1Y6S6eJjjxH96u9h/JtaxLcbT.WqXH.QRWGsG',
    'pelanggan',
    NOW(),
    NOW()
);

-- Data Lapangan Contoh
INSERT IGNORE INTO `lapangan` (`nama_lapangan`, `deskripsi`, `harga_per_jam`, `fasilitas`, `status`, `created_at`, `updated_at`) VALUES
(
    'Lapangan A - Indoor',
    'Lapangan indoor dengan rumput sintetis premium, cocok untuk latihan dan pertandingan. Dilengkapi pencahayaan LED modern.',
    100000.00,
    '["Rumput Sintetis", "Lampu LED", "Ruang Ganti", "Parkir Gratis", "Toilet"]',
    'aktif',
    NOW(),
    NOW()
),
(
    'Lapangan B - Outdoor',
    'Lapangan outdoor dengan sirkulasi udara alami. Tersedia tribun penonton dan area parkir luas.',
    75000.00,
    '["Rumput Sintetis", "Tribun Penonton", "Parkir Gratis", "Toilet", "Kantin"]',
    'aktif',
    NOW(),
    NOW()
),
(
    'Lapangan C - VIP Indoor',
    'Lapangan VIP dengan fasilitas lengkap, termasuk AC, loker pribadi, dan layanan minuman. Cocok untuk event eksklusif.',
    150000.00,
    '["Rumput Sintetis Premium", "AC", "Loker Pribadi", "Minuman Gratis", "Ruang Ganti VIP", "Parkir Valet"]',
    'aktif',
    NOW(),
    NOW()
);

-- ============================================================
-- SELESAI!
-- Database futsal_arena berhasil dibuat.
-- Login Admin: admin@futsalarena.com / password
-- Login Pelanggan: budi@email.com / password
-- ============================================================
