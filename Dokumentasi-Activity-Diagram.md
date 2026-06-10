# Activity Diagram - Sistem Reservasi Pintar Lapangan Futsal

## Deskripsi

Activity Diagram ini menggambarkan alur kerja (workflow) dari proses-proses utama dalam sistem reservasi futsal. Setiap diagram merepresentasikan langkah-langkah sistematis yang terjadi dari awal hingga akhir suatu aktivitas, termasuk percabangan kondisi (decision) dan aktivitas paralel.

---

## 1. Activity Diagram - Proses Masuk (Login)

### Deskripsi
Menggambarkan alur proses autentikasi pengguna saat masuk ke sistem, dimulai dari input kredensial hingga pengalihan berdasarkan peran.

### Kelas Terkait
- `AutentikasiController::prosesMasuk()`
- `CekPeran::handle()`

```mermaid
graph TB
    A([Mulai]) --> B[Buka Halaman Masuk]
    B --> C[Input Email dan Kata Sandi]
    C --> D[Kirim Form Masuk]
    D --> E{Validasi Input}
    E -->|Tidak Valid| F[Tampilkan Pesan Error Validasi]
    F --> C
    E -->|Valid| G{Cek Kredensial di DB}
    G -->|Email/Sandi Salah| H[Tampilkan Error: Email atau kata sandi salah]
    H --> C
    G -->|Kredensial Benar| I[Regenerasi Session]
    I --> J{Cek Peran Pengguna}
    J -->|admin| K[Arahkan ke Dashboard Admin]
    J -->|pelanggan| L[Arahkan ke Halaman Cari Lapangan]
    K --> M([Selesai])
    L --> M
```

---

## 2. Activity Diagram - Proses Pendaftaran (Register)

### Deskripsi
Menggambarkan alur pendaftaran akun pelanggan baru, mulai dari pengisian form hingga otomatis login setelah berhasil.

### Kelas Terkait
- `AutentikasiController::prosesDaftar()`
- `Pengguna` (Model)

```mermaid
graph TB
    A([Mulai]) --> B[Buka Halaman Daftar]
    B --> C[Input Nama, Email, No. Telepon, Kata Sandi, Konfirmasi Kata Sandi]
    C --> D[Kirim Form Daftar]
    D --> E{Validasi Input}
    E -->|Tidak Valid| F[Tampilkan Pesan Error Validasi]
    F --> C
    E -->|Valid| G{Cek Email Unik di DB}
    G -->|Email Sudah Terdaftar| H[Tampilkan Error: Email sudah terdaftar]
    H --> C
    G -->|Email Belum Terdaftar| I[Buat Data Pengguna Baru dengan peran=pelanggan]
    I --> J[Hash Kata Sandi Otomatis oleh Model]
    J --> K[Simpan ke Basis Data]
    K --> L[Login Otomatis]
    L --> M[Arahkan ke Halaman Cari Lapangan]
    M --> N([Selesai])
```

---

## 3. Activity Diagram - Pencarian Lapangan

### Deskripsi
Menggambarkan alur pelanggan mencari lapangan futsal berdasarkan tanggal, jam, dan kata kunci. Sistem menggunakan `LayananKetersediaan` untuk memfilter lapangan yang tersedia.

### Kelas Terkait
- `Pelanggan\LapanganController::index()`
- `LayananKetersediaan::cariLapanganTersedia()`
- `Lapangan` (Model)

```mermaid
graph TB
    A([Mulai]) --> B[Buka Halaman Cari Lapangan]
    B --> C[Input Filter: Tanggal, Jam Mulai, Jam Selesai, Kata Kunci]
    C --> D[Klik Tombol Cari]
    D --> E[Ambil Semua Lapangan Aktif dari DB]
    E --> F[Panggil LayananKetersediaan.cariLapanganTersedia]
    F --> G[Untuk Setiap Lapangan Aktif, Cek Ketersediaan]
    G --> H{Lapangan Tersedia untuk Jadwal yang Dipilih?}
    H -->|Tidak| I[Keluarkan dari Hasil]
    H -->|Ya| J[Masukkan ke Daftar Hasil]
    I --> K{Masih Ada Lapangan?}
    J --> K
    K -->|Ya| G
    K -->|Tidak| L{Ada Kata Kunci?}
    L -->|Ya| M[Filter Hasil Berdasarkan Kata Kunci pada nama_lapangan]
    L -->|Tidak| N[Tampilkan Daftar Lapangan Tersedia]
    M --> N
    N --> O([Selesai])
```

---

## 4. Activity Diagram - Pembuatan Reservasi

### Deskripsi
Menggambarkan alur lengkap pembuatan reservasi oleh pelanggan, mulai dari pemilihan lapangan hingga penyimpanan data reservasi dan penampilkan informasi pembayaran.

### Kelas Terkait
- `Pelanggan\ReservasiController::simpan()`
- `LayananKetersediaan::cekKetersediaan()`, `hitungDurasi()`, `hitungTotalHarga()`
- `Lapangan::tersediaUntuk()`
- `Reservasi` (Model)

```mermaid
graph TB
    A([Mulai]) --> B[Pilih Lapangan dari Hasil Pencarian atau Detail Lapangan]
    B --> C[Buka Form Reservasi]
    C --> D[Pilih Tanggal, Jam Mulai, dan Jam Selesai]
    D --> E[Klik Tombol Konfirmasi Reservasi]
    E --> F{Validasi Input}
    F -->|Tidak Valid| G[Tampilkan Pesan Error Validasi]
    G --> D
    F -->|Valid| H[Panggil LayananKetersediaan.cekKetersediaan]
    H --> I[Lapangan.tersediaUntuk - Cek Bentrokan Jadwal di DB]
    I --> J{Jadwal Tersedia?}
    J -->|Tidak| K[Tampilkan Error: Jadwal sudah dipesan]
    K --> D
    J -->|Ya| L[Hitung Durasi: LayananKetersediaan.hitungDurasi]
    L --> M[Hitung Total Harga: harga_per_jam x durasi]
    M --> N[Buat Data Reservasi dengan status=pending]
    N --> O[Simpan ke Basis Data]
    O --> P[Arahkan ke Halaman Detail Reservasi]
    P --> Q[Tampilkan Informasi Pembayaran]
    Q --> R([Selesai])
```

---

## 5. Activity Diagram - Konfirmasi Reservasi oleh Admin

### Deskripsi
Menggambarkan alur admin dalam mengkonfirmasi reservasi pelanggan. Admin memverifikasi pembayaran dan mengubah status reservasi dari `pending` menjadi `dikonfirmasi`.

### Kelas Terkait
- `Admin\ReservasiController::konfirmasi()`
- `Admin\ReservasiController::batalkan()`
- `Admin\ReservasiController::selesai()`
- `Reservasi` (Model)

```mermaid
graph TB
    A([Mulai]) --> B[Buka Dashboard Admin]
    B --> C[Lihat Daftar Reservasi Pending]
    C --> D[Pilih Reservasi yang Akan Dikonfirmasi]
    D --> E[Buka Detail Reservasi]
    E --> F{Status Reservasi?}
    F -->|pending| G{Admin Memilih Tindakan?}
    F -->|bukan pending| H[Tampilkan Error: Hanya reservasi pending yang bisa dikonfirmasi]
    H --> C
    G -->|Konfirmasi| I[Ubah Status menjadi dikonfirmasi]
    G -->|Batalkan| J[Input Keterangan Pembatalan]
    J --> K[Ubah Status menjadi dibatalkan]
    I --> L[Simpan Perubahan ke DB]
    K --> L
    L --> M[Arahkan Kembali ke Daftar Reservasi]
    M --> N([Selesai])
```

---

## 6. Activity Diagram - Pengelolaan Lapangan oleh Admin

### Deskripsi
Menggambarkan alur admin dalam mengelola data lapangan, termasuk menambah, mengubah, dan menghapus lapangan.

### Kelas Terkait
- `Admin\LapanganController::simpan()`, `perbarui()`, `hapus()`
- `Lapangan` (Model)

```mermaid
graph TB
    A([Mulai]) --> B[Buka Halaman Manajemen Lapangan]
    B --> C{Admin Memilih Tindakan?}

    C -->|Tambah| D[Buka Form Tambah Lapangan]
    D --> E[Input: Nama, Deskripsi, Harga/Jam, Fasilitas, Status]
    E --> F{Upload Foto?}
    F -->|Ya| G[Simpan File Foto ke Storage]
    F -->|Tidak| H[Parse Fasilitas dari Textarea menjadi Array]
    G --> H
    H --> I[Simpan Data Lapangan Baru ke DB]
    I --> J[Tampilkan Pesan Sukses]

    C -->|Ubah| K[Klik Tombol Ubah pada Lapangan]
    K --> L[Buka Form Ubah dengan Data Existing]
    L --> M[Ubah Data dan Kirim Form]
    M --> N{Upload Foto Baru?}
    N -->|Ya| O[Simpan Foto Baru]
    N -->|Tidak| P[Update Data Lapangan di DB]
    O --> P
    P --> J

    C -->|Hapus| Q[Klik Tombol Hapus]
    Q --> R{Lapangan Memiliki Reservasi?}
    R -->|Ya| S[Tampilkan Error: Tidak dapat menghapus lapangan yang memiliki reservasi]
    S --> B
    R -->|Tidak| T[Hapus Data Lapangan dari DB]
    T --> J

    J --> U[Arahkan ke Daftar Lapangan]
    U --> V([Selesai])
```

---

## 7. Activity Diagram - Pembatalan Reservasi oleh Pelanggan

### Deskripsi
Menggambarkan alur pelanggan membatalkan reservasi yang telah dibuat.

### Kelas Terkait
- `Pelanggan\ReservasiController::batalkan()`
- `Reservasi` (Model)

```mermaid
graph TB
    A([Mulai]) --> B[Buka Daftar Reservasi Saya]
    B --> C[Pilih Reservasi]
    C --> D[Buka Detail Reservasi]
    D --> E{Status Reservasi?}
    E -->|selesai atau dibatalkan| F[Tampilkan Error: Reservasi tidak dapat dibatalkan]
    F --> B
    E -->|pending atau dikonfirmasi| G[Klik Tombol Batalkan Reservasi]
    G --> H{Konfirmasi Pembatalan?}
    H -->|Tidak| D
    H -->|Ya| I[Ubah Status menjadi dibatalkan]
    I --> J[Simpan Perubahan ke DB]
    J --> K[Arahkan ke Daftar Reservasi]
    K --> L[Tampilkan Pesan Sukses]
    L --> M([Selesai])
```
