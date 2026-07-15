flowchart LR

    %% ==========================
    %% Swimlane Admin
    %% ==========================
    subgraph Admin
        direction TB

        A([Start])
        B[Buka Manajemen Lapangan]
        C{Pilih Tindakan?}

        D[Isi Form Lapangan Baru<br/>& Klik Simpan]

        E[Ubah Data Lapangan<br/>& Klik Simpan]

        F[Klik Tombol Hapus]
    end

    %% ==========================
    %% Swimlane Sistem
    %% ==========================
    subgraph Sistem
        direction TB

        G[Simpan Data Baru ke DB]

        H[Update Data di DB]

        I[Hapus Data dari DB]

        J[Tampilkan Pesan Sukses<br/>& Refresh Halaman]

        K([End])
    end

    %% Flow
    A --> B
    B --> C

    C -->|Tambah| D
    C -->|Ubah| E
    C -->|Hapus| F

    D --> G
    E --> H
    F --> I

    G --> J
    H --> J
    I --> J

    J --> K