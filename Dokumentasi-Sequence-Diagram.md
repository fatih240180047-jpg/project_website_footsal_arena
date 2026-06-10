# Sequence Diagram - Sistem Reservasi Pintar Lapangan Futsal

## Deskripsi

Sequence Diagram ini menggambarkan interaksi antar objek dalam sistem secara berurutan berdasarkan waktu. Setiap diagram merepresentasikan skenario penggunaan spesifik, menunjukkan pesan-pesan yang dikirim antar objek (Pelanggan, Browser, Controller, Service, Model, dan Basis Data) untuk menyelesaikan suatu proses.

---

## 1. Sequence Diagram - Proses Masuk (Login)

### Skenario
Pelanggan/Admin masuk ke sistem dengan memasukkan email dan kata sandi. Sistem memvalidasi kredensial dan mengarahkan pengguna ke halaman sesuai peran.

### Kelas yang Terlibat
- `AutentikasiController::prosesMasuk()`
- `CekPeran::handle()`
- `Pengguna` (Model)
- `Auth` (Facade Laravel)

```mermaid
sequenceDiagram
    actor Pengguna
    participant Browser
    participant AutentikasiController
    participant Auth as Auth Facade
    participant DB as Basis Data

    Pengguna->>Browser: Buka halaman /masuk
    Browser->>AutentikasiController: GET /masuk
    AutentikasiController-->>Browser: Return view autentikasi.masuk
    Browser-->>Pengguna: Tampilkan form masuk

    Pengguna->>Browser: Input email, kata_sandi, klik Masuk
    Browser->>AutentikasiController: POST /masuk (email, kata_sandi)
    AutentikasiController->>AutentikasiController: Validasi input (email, kata_sandi)

    alt Input Tidak Valid
        AutentikasiController-->>Browser: Return error validasi
        Browser-->>Pengguna: Tampilkan pesan error
    else Input Valid
        AutentikasiController->>Auth: attempt(email, kata_sandi)
        Auth->>DB: SELECT * FROM pengguna WHERE email = ?
        DB-->>Auth: Data pengguna
        Auth->>Auth: Verifikasi kata sandi (hash)

        alt Kredensial Salah
            Auth-->>AutentikasiController: false
            AutentikasiController-->>Browser: Return error: Email atau kata sandi salah
            Browser-->>Pengguna: Tampilkan pesan error
        else Kredensial Benar
            Auth-->>AutentikasiController: true
            AutentikasiController->>AutentikasiController: Regenerasi session
            AutentikasiController->>AutentikasiController: Cek peran pengguna

            alt Peran = admin
                AutentikasiController-->>Browser: Redirect ke /admin/dashboard
                Browser->>AutentikasiController: GET /admin/dashboard
                AutentikasiController-->>Browser: Tampilkan dashboard admin
            else Peran = pelanggan
                AutentikasiController-->>Browser: Redirect ke /pelanggan/lapangan
                Browser->>AutentikasiController: GET /pelanggan/lapangan
                AutentikasiController-->>Browser: Tampilkan halaman cari lapangan
            end
        end
    end
```

---

## 2. Sequence Diagram - Pencarian Lapangan

### Skenario
Pelanggan mencari lapangan berdasarkan tanggal, jam mulai, dan jam selesai. Sistem menggunakan `LayananKetersediaan` untuk mengecek ketersediaan setiap lapangan aktif.

### Kelas yang Terlibat
- `Pelanggan\LapanganController::index()`
- `LayananKetersediaan::cariLapanganTersedia()`
- `Lapangan` (Model)

```mermaid
sequenceDiagram
    actor Pelanggan
    participant Browser
    participant LapanganController as Pelanggan\LapanganController
    participant LayananKetersediaan
    participant Lapangan as Model Lapangan
    participant DB as Basis Data

    Pelanggan->>Browser: Input tanggal, jam_mulai, jam_selesai, klik Cari
    Browser->>LapanganController: GET /pelanggan/lapangan?tanggal=...&jam_mulai=...&jam_selesai=...&cari=1

    LapanganController->>Lapangan: aktif()->get()
    Lapangan->>DB: SELECT * FROM lapangan WHERE status = 'aktif'
    DB-->>Lapangan: Koleksi lapangan aktif
    Lapangan-->>LapanganController: Daftar lapangan aktif

    LapanganController->>LayananKetersediaan: cariLapanganTersedia(tanggal, jamMulai, jamSelesai)

    loop Untuk setiap lapangan aktif
        LayananKetersediaan->>Lapangan: tersediaUntuk(tanggal, jamMulai, jamSelesai)
        Lapangan->>DB: SELECT COUNT(*) FROM reservasi WHERE lapangan_id = ? AND tanggal = ? AND status != 'dibatalkan' AND jam_mulai < jamSelesai AND jam_selesai > jamMulai
        DB-->>Lapangan: Jumlah bentrokan
        Lapangan-->>LayananKetersediaan: true/false (tersedia atau tidak)
    end

    LayananKetersediaan-->>LapanganController: Koleksi lapangan yang tersedia

    alt Ada kata kunci pencarian
        LapanganController->>LapanganController: Filter hasil berdasarkan kata_kunci pada nama_lapangan
    end

    LapanganController-->>Browser: Return view pelanggan.lapangan.index
    Browser-->>Pelanggan: Tampilkan daftar lapangan tersedia
```

---

## 3. Sequence Diagram - Pembuatan Reservasi

### Skenario
Pelanggan membuat reservasi lapangan. Sistem memvalidasi input, mengecek ketersediaan jadwal, menghitung harga, dan menyimpan data reservasi.

### Kelas yang Terlibat
- `Pelanggan\ReservasiController::simpan()`
- `LayananKetersediaan::cekKetersediaan()`, `hitungDurasi()`, `hitungTotalHarga()`
- `Lapangan::tersediaUntuk()`
- `Reservasi` (Model)

```mermaid
sequenceDiagram
    actor Pelanggan
    participant Browser
    participant ReservasiController as Pelanggan\ReservasiController
    participant LayananKetersediaan
    participant Lapangan as Model Lapangan
    participant Reservasi as Model Reservasi
    participant DB as Basis Data

    Pelanggan->>Browser: Pilih jadwal, klik Pesan pada slot tersedia
    Browser->>ReservasiController: POST /pelanggan/reservasi (lapangan_id, tanggal, jam_mulai, jam_selesai)

    ReservasiController->>ReservasiController: Validasi input (lapangan_id, tanggal, jam_mulai, jam_selesai)

    alt Input Tidak Valid
        ReservasiController-->>Browser: Return error validasi
        Browser-->>Pelanggan: Tampilkan pesan error
    else Input Valid
        ReservasiController->>Lapangan: findOrFail(lapangan_id)
        Lapangan->>DB: SELECT * FROM lapangan WHERE id = ?
        DB-->>Lapangan: Data lapangan
        Lapangan-->>ReservasiController: Object Lapangan

        ReservasiController->>LayananKetersediaan: cekKetersediaan(lapangan_id, tanggal, jamMulai, jamSelesai)
        LayananKetersediaan->>Lapangan: tersediaUntuk(tanggal, jamMulai, jamSelesai)
        Lapangan->>DB: SELECT COUNT(*) FROM reservasi WHERE kondisi bentrok waktu AND status != 'dibatalkan'
        DB-->>Lapangan: Jumlah bentrokan
        Lapangan-->>LayananKetersediaan: true/false

        alt Tidak Tersedia (Bentrokan Jadwal)
            LayananKetersediaan-->>ReservasiController: false
            ReservasiController-->>Browser: Return error: Jadwal sudah dipesan
            Browser-->>Pelanggan: Tampilkan pesan error
        else Tersedia
            LayananKetersediaan-->>ReservasiController: true

            ReservasiController->>LayananKetersediaan: hitungDurasi(jamMulai, jamSelesai)
            LayananKetersediaan-->>ReservasiController: durasi (int, dalam jam)

            ReservasiController->>LayananKetersediaan: hitungTotalHarga(lapangan, durasi)
            LayananKetersediaan-->>ReservasiController: totalHarga (float)

            ReservasiController->>Reservasi: create(pengguna_id, lapangan_id, tanggal, jam_mulai, jam_selesai, durasi, total_harga, status='pending')
            Reservasi->>DB: INSERT INTO reservasi (...)
            DB-->>Reservasi: Data reservasi baru (dengan id)
            Reservasi-->>ReservasiController: Object Reservasi

            ReservasiController-->>Browser: Redirect ke /pelanggan/reservasi/{id}
            Browser->>ReservasiController: GET /pelanggan/reservasi/{id}
            ReservasiController-->>Browser: Return view pelanggan.reservasi.detail (dengan info pembayaran)
            Browser-->>Pelanggan: Tampilkan detail reservasi dan informasi pembayaran
        end
    end
```

---

## 4. Sequence Diagram - Konfirmasi Reservasi oleh Admin

### Skenario
Admin melihat reservasi pending di dashboard, membuka detail, dan mengkonfirmasi reservasi setelah memverifikasi pembayaran.

### Kelas yang Terlibat
- `Admin\DashboardController::index()`
- `Admin\ReservasiController::konfirmasi()`
- `Reservasi` (Model)

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant DashboardController as Admin\DashboardController
    participant ReservasiController as Admin\ReservasiController
    participant Reservasi as Model Reservasi
    participant Lapangan as Model Lapangan
    participant Pengguna as Model Pengguna
    participant DB as Basis Data

    Admin->>Browser: Buka halaman dashboard
    Browser->>DashboardController: GET /admin/dashboard

    DashboardController->>Lapangan: count() dan aktif()->count()
    Lapangan->>DB: SELECT COUNT(*) FROM lapangan
    DB-->>Lapangan: Jumlah
    Lapangan-->>DashboardController: totalLapangan, lapanganAktif

    DashboardController->>Pengguna: where('peran', 'pelanggan')->count()
    Pengguna->>DB: SELECT COUNT(*) FROM pengguna WHERE peran = 'pelanggan'
    DB-->>Pengguna: Jumlah
    Pengguna-->>DashboardController: totalPelanggan

    DashboardController->>Reservasi: denganStatus('pending')->get()
    Reservasi->>DB: SELECT * FROM reservasi WHERE status = 'pending'
    DB-->>Reservasi: Koleksi reservasi pending
    Reservasi-->>DashboardController: reservasiPending

    DashboardController-->>Browser: Return view admin.dashboard
    Browser-->>Admin: Tampilkan dashboard dengan statistik dan daftar reservasi pending

    Admin->>Browser: Klik Konfirmasi pada reservasi pending
    Browser->>ReservasiController: POST /admin/reservasi/{id}/konfirmasi

    ReservasiController->>Reservasi: find(id)
    Reservasi->>DB: SELECT * FROM reservasi WHERE id = ?
    DB-->>Reservasi: Data reservasi
    Reservasi-->>ReservasiController: Object Reservasi

    alt Status != pending
        ReservasiController-->>Browser: Return error: Hanya reservasi pending yang bisa dikonfirmasi
        Browser-->>Admin: Tampilkan pesan error
    else Status = pending
        ReservasiController->>Reservasi: update(status = 'dikonfirmasi')
        Reservasi->>DB: UPDATE reservasi SET status = 'dikonfirmasi' WHERE id = ?
        DB-->>Reservasi: OK
        Reservasi-->>ReservasiController: true

        ReservasiController-->>Browser: Redirect ke /admin/reservasi dengan pesan sukses
        Browser->>ReservasiController: GET /admin/reservasi
        ReservasiController-->>Browser: Return view admin.reservasi.index
        Browser-->>Admin: Tampilkan daftar reservasi dengan pesan: Reservasi berhasil dikonfirmasi
    end
```

---

## 5. Sequence Diagram - Pengelolaan Lapangan (Tambah) oleh Admin

### Skenario
Admin menambah lapangan baru melalui form. Sistem memvalidasi input, memproses fasilitas dan foto, lalu menyimpan data lapangan.

### Kelas yang Terlibat
- `Admin\LapanganController::simpan()`
- `Lapangan` (Model)

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant LapanganController as Admin\LapanganController
    participant Lapangan as Model Lapangan
    participant Storage as File Storage
    participant DB as Basis Data

    Admin->>Browser: Buka halaman /admin/lapangan/tambah
    Browser->>LapanganController: GET /admin/lapangan/tambah
    LapanganController-->>Browser: Return view admin.lapangan.tambah
    Browser-->>Admin: Tampilkan form tambah lapangan

    Admin->>Browser: Input nama, deskripsi, harga, fasilitas, status, dan foto
    Browser->>LapanganController: POST /admin/lapangan (multipart/form-data)

    LapanganController->>LapanganController: Validasi input

    alt Input Tidak Valid
        LapanganController-->>Browser: Return error validasi
        Browser-->>Admin: Tampilkan pesan error
    else Input Valid
        LapanganController->>LapanganController: Parse fasilitas dari textarea menjadi array

        alt Ada file foto di-upload
            LapanganController->>Storage: store('foto', 'lapangan', 'public')
            Storage-->>LapanganController: Path file foto
        end

        LapanganController->>Lapangan: create(data)
        Lapangan->>DB: INSERT INTO lapangan (nama_lapangan, deskripsi, harga_per_jam, fasilitas, foto, status) VALUES (...)
        DB-->>Lapangan: Data lapangan baru (dengan id)
        Lapangan-->>LapanganController: Object Lapangan

        LapanganController-->>Browser: Redirect ke /admin/lapangan dengan pesan sukses
        Browser->>LapanganController: GET /admin/lapangan
        LapanganController-->>Browser: Return view admin.lapangan.index
        Browser-->>Admin: Tampilkan daftar lapangan dengan pesan: Lapangan berhasil ditambahkan
    end
```

---

## 6. Sequence Diagram - Pembatalan Reservasi oleh Pelanggan

### Skenario
Pelanggan membatalkan reservasi miliknya. Sistem memverifikasi kepemilikan dan status reservasi sebelum memproses pembatalan.

### Kelas yang Terlibat
- `Pelanggan\ReservasiController::batalkan()`
- `Reservasi` (Model)

```mermaid
sequenceDiagram
    actor Pelanggan
    participant Browser
    participant ReservasiController as Pelanggan\ReservasiController
    participant Reservasi as Model Reservasi
    participant DB as Basis Data

    Pelanggan->>Browser: Buka detail reservasi
    Browser->>ReservasiController: GET /pelanggan/reservasi/{id}
    ReservasiController->>Reservasi: find(id)
    Reservasi->>DB: SELECT * FROM reservasi WHERE id = ?
    DB-->>Reservasi: Data reservasi
    Reservasi-->>ReservasiController: Object Reservasi

    ReservasiController->>ReservasiController: Cek kepemilikan (reservasi.pengguna_id == auth()->id())

    alt Bukan Milik Pelanggan
        ReservasiController-->>Browser: abort(403): Tidak memiliki akses
        Browser-->>Pelanggan: Tampilkan halaman 403
    else Milik Pelanggan
        ReservasiController-->>Browser: Return view pelanggan.reservasi.detail
        Browser-->>Pelanggan: Tampilkan detail reservasi dengan tombol Batalkan

        Pelanggan->>Browser: Klik Batalkan Reservasi, konfirmasi dialog
        Browser->>ReservasiController: POST /pelanggan/reservasi/{id}/batalkan

        ReservasiController->>ReservasiController: Cek status (selesai atau dibatalkan?)

        alt Status = selesai atau dibatalkan
            ReservasiController-->>Browser: Return error: Reservasi tidak dapat dibatalkan
            Browser-->>Pelanggan: Tampilkan pesan error
        else Status = pending atau dikonfirmasi
            ReservasiController->>Reservasi: update(status = 'dibatalkan')
            Reservasi->>DB: UPDATE reservasi SET status = 'dibatalkan' WHERE id = ?
            DB-->>Reservasi: OK
            Reservasi-->>ReservasiController: true

            ReservasiController-->>Browser: Redirect ke /pelanggan/reservasi dengan pesan sukses
            Browser->>ReservasiController: GET /pelanggan/reservasi
            ReservasiController-->>Browser: Return view pelanggan.reservasi.index
            Browser-->>Pelanggan: Tampilkan daftar reservasi dengan pesan: Reservasi berhasil dibatalkan
        end
    end
```
