# Use Case Diagram
## Sistem Reservasi Lapangan Futsal

---

# Aktor

## 1. Pelanggan

Aktor yang menggunakan sistem untuk mencari lapangan, melakukan reservasi, serta melihat informasi reservasi dan pembayaran.

---

## 2. Admin

Aktor yang mengelola data lapangan serta mengelola seluruh reservasi pelanggan.

---

# Daftar Use Case

## Use Case Pelanggan

| Kode | Nama Use Case |
|------|----------------|
| UC-01 | Daftar |
| UC-02 | Masuk |
| UC-03 | Keluar |
| UC-04 | Cari Lapangan |
| UC-05 | Lihat Detail Lapangan |
| UC-06 | Buat Reservasi |
| UC-07 | Lihat Daftar Reservasi |
| UC-08 | Lihat Detail Reservasi |
| UC-09 | Batalkan Reservasi |
| UC-10 | Lihat Informasi Pembayaran |

---

## Use Case Admin

| Kode | Nama Use Case |
|------|----------------|
| UC-11 | Masuk Admin |
| UC-12 | Keluar Admin |
| UC-13 | Lihat Dashboard |
| UC-15 | Tambah Lapangan |
| UC-16 | Ubah Lapangan |
| UC-17 | Hapus Lapangan |
| UC-19 | Konfirmasi Reservasi |
| UC-20 | Batalkan Reservasi Admin |
| UC-21 | Tandai Reservasi Selesai |
| UC-22 | Filter Reservasi |

---

# Relasi Aktor

## Pelanggan

Pelanggan dapat melakukan:

- UC-01 Daftar
- UC-02 Masuk
- UC-03 Keluar
- UC-04 Cari Lapangan
- UC-05 Lihat Detail Lapangan
- UC-06 Buat Reservasi
- UC-07 Lihat Daftar Reservasi
- UC-08 Lihat Detail Reservasi
- UC-09 Batalkan Reservasi
- UC-10 Lihat Informasi Pembayaran

---

## Admin

Admin dapat melakukan:

- UC-11 Masuk Admin
- UC-12 Keluar Admin
- UC-13 Lihat Dashboard
- UC-15 Tambah Lapangan
- UC-16 Ubah Lapangan
- UC-17 Hapus Lapangan
- UC-19 Konfirmasi Reservasi
- UC-20 Batalkan Reservasi Admin
- UC-21 Tandai Reservasi Selesai
- UC-22 Filter Reservasi

---

# Relasi Antar Use Case

Diagram menunjukkan adanya relasi dependensi (garis putus-putus) sebagai berikut.

## UC-06 Buat Reservasi → UC-04 Cari Lapangan

Sebelum membuat reservasi, pelanggan terlebih dahulu mencari lapangan yang tersedia.

---

## UC-06 Buat Reservasi → UC-05 Lihat Detail Lapangan

Saat membuat reservasi, pelanggan melihat detail lapangan yang dipilih.

---

## UC-10 Lihat Informasi Pembayaran → UC-08 Lihat Detail Reservasi

Informasi pembayaran ditampilkan berdasarkan detail reservasi yang dipilih.

---

# Ringkasan Use Case

## Pelanggan

```
Daftar
Masuk
Keluar
Cari Lapangan
Lihat Detail Lapangan
Buat Reservasi
Lihat Daftar Reservasi
Lihat Detail Reservasi
Batalkan Reservasi
Lihat Informasi Pembayaran
```

## Admin

```
Masuk Admin
Keluar Admin
Lihat Dashboard
Tambah Lapangan
Ubah Lapangan
Hapus Lapangan
Konfirmasi Reservasi
Batalkan Reservasi Admin
Tandai Reservasi Selesai
Filter Reservasi
```

---

# Ringkasan Diagram

Jumlah Aktor : 2

- Pelanggan
- Admin

Jumlah Use Case : 20

- Pelanggan : 10 Use Case
- Admin : 10 Use Case

Jumlah Relasi Dependency : 3