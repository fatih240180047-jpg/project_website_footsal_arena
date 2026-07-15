flowchart LR

    %% ==========================
    %% Swimlane Pengguna
    %% ==========================
    subgraph Pengguna
        direction TB

        A([Start])
        B[Buka Halaman Daftar]
        C[Input Nama, Email,<br/>No. Telepon,<br/>Kata Sandi,<br/>Konfirmasi Kata Sandi]

        D[Tampilkan Pesan Error Validasi]
        E[Tampilkan Error:<br/>Email sudah terdaftar]
    end

    %% ==========================
    %% Swimlane Sistem
    %% ==========================
    subgraph Sistem
        direction TB

        F[Kirim Form Daftar]

        G{Validasi Input?}

        H{Cek Email Unik di DB?}

        I[Buat Data Pengguna Baru<br/>dengan peran = pelanggan]

        J[Hash Kata Sandi Otomatis]

        K[Simpan ke Basis Data]

        L[Login Otomatis]

        M[Arahkan ke Halaman<br/>Cari Lapangan]

        N([End])
    end

    %% Flow
    A --> B
    B --> C
    C --> F

    F --> G

    G -- Ya --> H
    G -- Tidak --> D
    D --> C

    H -- Ya --> I
    H -- Tidak --> E
    E --> C

    I --> J
    J --> K
    K --> L
    L --> M
    M --> N