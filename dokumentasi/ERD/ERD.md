# Dokumentasi ERD Sistem Reservasi Lapangan

## Tujuan

Dokumen ini merupakan representasi tekstual dari ERD pada gambar.

# Entitas

## 1. PENGGUNA

  Atribut                    Kunci
  -------------------------- -------
  Id_Pengguna                PK
  Nama                       
  Email                      
  Kata_Sandi                 
  No_Telepon                 
  Peran                      
  Remember_Token             
  Email_Terverifikasi_Pada   
  Created_At                 
  Updated_At                 

## 2. LAPANGAN

  Atribut         Kunci
  --------------- -------
  Id_Lapangan     PK
  Nama_Lapangan   
  Deskripsi       
  Harga_Per_Jam   
  Fasilitas       
  Foto            
  Status          
  Created_At      
  Updated_At      

## 3. RESERVASI

  Atribut        Kunci
  -------------- -----------------------------
  Id_Reservasi   PK
  Id_Pengguna    FK -\> PENGGUNA.Id_Pengguna
  Id_Lapangan    FK -\> LAPANGAN.Id_Lapangan
  Tanggal        
  Jam_Mulai      
  Jam_Selesai    
  Durasi         
  Keterangan     
  Total_Harga    
  Status         

## 4. SESI

  Atribut         Kunci
  --------------- -----------------------------
  Id_Sesi         PK
  Id_Pengguna     FK -\> PENGGUNA.Id_Pengguna
  Ip_Address      
  User_Agent      
  Payload         
  Last_Activity   

## 5. TOKEN RESET KATA SANDI

  Atribut       Kunci
  ------------- -------
  Email         
  Token         
  Dibuat_pada   

# Relasi

1.  PENGGUNA melakukan RESERVASI

-   Kardinalitas: 1 : N
-   Satu pengguna dapat melakukan banyak reservasi.
-   Satu reservasi hanya dimiliki satu pengguna.

2.  LAPANGAN dipakai pada RESERVASI

-   Kardinalitas: 1 : N
-   Satu lapangan dapat muncul pada banyak reservasi.
-   Satu reservasi hanya menggunakan satu lapangan.

3.  PENGGUNA memulai SESI

-   Kardinalitas: 1 : N
-   Satu pengguna dapat memiliki banyak sesi.
-   Satu sesi dimiliki satu pengguna.

4.  PENGGUNA mengajukan TOKEN RESET KATA SANDI

-   Kardinalitas: 1 : N
-   Seorang pengguna dapat mengajukan beberapa token reset.
-   Setiap token reset terkait satu pengguna melalui Email.
