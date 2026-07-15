flowchart LR

    %% ==========================
    %% Swimlane Pengguna
    %% ==========================
    subgraph Pengguna
        direction TB

        A([Start])

        B[Pilih Lapangan dari Hasil<br/>Pencarian atau Detail Lapangan]

        C[Buka Form Reservasi]

        D[Pilih Tanggal, Jam Mulai,<br/>dan Jam Selesai]

        E[Klik Tombol Konfirmasi Reservasi]

        F[Tampilkan Pesan Error Validasi]

        G[Tampilkan Error:<br/>Jadwal sudah dipesan]

        M[Arahkan ke Halaman<br/>Detail Reservasi]

        N[Tampilkan Informasi Pembayaran]

        O([End])
    end

    %% ==========================
    %% Swimlane Sistem
    %% ==========================
    subgraph Sistem
        direction TB

        H{Validasi Input?}

        I[Cek Ketersediaan<br/>dan Jadwal di DB]

        J{Jadwal Tersedia?}

        K[Hitung Durasi Lapangan]

        L[Hitung Total Harga:<br/>harga_per_jam × durasi]

        P[Buat Data Reservasi<br/>dengan status = pending]

        Q[Simpan ke Basis Data]
    end

    %% Flow
    A --> B
    B --> C
    C --> D
    D --> E

    E --> H

    H -- Valid --> I
    H -- Tidak Valid --> F
    F --> D

    I --> J

    J -- Ya --> K
    J -- Tidak --> G
    G --> D

    K --> L
    L --> P
    P --> Q

    Q --> M
    M --> N
    N --> O