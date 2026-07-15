flowchart LR

%% =========================
%% Swimlane Pengguna
%% =========================
subgraph Pengguna
    direction TB

    A([Start])
    B["Buka Detail Reservasi Saya"]
    C["Klik Tombol Batalkan Reservasi"]
    D["Tampilkan Pesan Sukses<br/>& Refresh Halaman"]
    E([End])

    A --> B
    B --> C
    D --> E
end

%% =========================
%% Swimlane Sistem
%% =========================
subgraph Sistem
    direction TB

    S1["Ubah Status Menjadi Dibatalkan"]
    S2["Simpan Perubahan ke DB"]

    S1 --> S2
end

%% =========================
%% Interaksi Antar Swimlane
%% =========================
C --> S1
S2 --> D