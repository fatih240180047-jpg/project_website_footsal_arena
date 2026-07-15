flowchart LR

%% =========================
%% Swimlane Admin
%% =========================
subgraph Admin
    direction TB

    A([Start])
    B["Buka Detail Reservasi Pending"]
    C{"Pilih Tindakan?"}

    D["Setujui Reservasi"]
    E["Isi Alasan Batal"]

    A --> B
    B --> C

    C -- "Klik Konfirmasi" --> D
    C -- "Klik Batalkan" --> E
end

%% =========================
%% Swimlane Sistem
%% =========================
subgraph Sistem
    direction TB

    F["Update Status di DB"]
    G["Kembali ke Halaman Utama"]
    H([End])

    F --> G
    G --> H
end

%% =========================
%% Interaksi Antar Swimlane
%% =========================
D --> F
E --> F