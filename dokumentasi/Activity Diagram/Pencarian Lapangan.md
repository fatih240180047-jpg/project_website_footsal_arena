flowchart LR

    %% ==========================
    %% Swimlane Pengguna
    %% ==========================
    subgraph Pengguna
        direction TB

        A([Start])

        B[Buka Halaman Cari Lapangan]

        C[Input Filter:<br/>Tanggal, Jam Mulai,<br/>Jam Selesai, Kata Kunci]

        D[Klik Tombol Cari]

        M[Tampilkan Daftar<br/>Lapangan Tersedia]

        N([End])
    end

    %% ==========================
    %% Swimlane Sistem
    %% ==========================
    subgraph Sistem
        direction TB

        E[Ambil Semua Lapangan Aktif<br/>dari DB]

        F[Untuk Setiap Lapangan Aktif,<br/>Cek Ketersediaan]

        G{Lapangan Tersedia<br/>untuk Jadwal yang Dipilih?}

        H[Keluarkan dari Hasil]

        I[Masukkan ke Daftar Hasil]

        J{Masih Ada<br/>Lapangan?}

        K[Filter Hasil Berdasarkan<br/>Kata Kunci]
    end

    %% Flow
    A --> B
    B --> C
    C --> D

    D --> E
    E --> F

    F --> G

    G -- Ya --> I
    G -- Tidak --> H

    I --> J
    H --> J

    J -- Tidak --> F
    J -- Ya --> K

    K --> M
    M --> N