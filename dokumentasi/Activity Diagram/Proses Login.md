flowchart LR

    %% Swimlane Pengguna
    subgraph Pengguna
        direction TB
        A([Start])
        B[Masuk Aplikasi]
        C[Memasukkan username<br/>dan password]
    end

    %% Swimlane Sistem
    subgraph Sistem
        direction TB
        D[Tampil Form Login]
        E{Benar?}
        F[Tampil Menu Utama]
        G([End])
    end

    A --> B
    B --> D
    D --> C
    C --> E
    E -- Ya --> F
    F --> G
    E -- Tidak --> D