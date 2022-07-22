# Dokumentasi Tes Fast Print

Berikut langkah-langkah untuk menggunakan project ini

- Download atau clone repository ini lalu masuk ke folder yang telah di clone/ekstrak
- Buka file .env
- Cari dan isi variabel USERNAME dan PASSWORD dengan nilai yang valid. Dan isi variabel database sesuai dengan database Anda.
Contoh : 
    ```sh
    LINK_API='https://recruitment.fastprint.co.id/tes/api_tes_programmer'
    USERNAME='tesprogrammer210722C12'
    PASSWORD='422984ebbe21b83c5ef71e503834f376'
    
    database.default.hostname = localhost
    database.default.database = nama_database
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi
    database.default.DBPrefix =
    ```
- Masih di dalam folder repository. Buka terminal dengan klik ```SHIFT+kanan mouse```, kemudian klik ‘open PowerShell window here’ kemudian masukan ```composer install``` lalu enter
- Setelah step sebelumnya selesai, kemudian masukan ‘php spark serve’ lalu tekan enter
- Buka browser dan masukan di url ```localhost:8080```
- Klik tombol 'install' untuk membuat table bernama 'produk' dengan isi data dari link api

**Catatan:**
**Daftar produk yang tampil hanya produk yang memiliki status ‘bisa dijual’.**

## Fitur Tambah
Untuk menambah produk, silahkan isi semua data yang diperlukan di halaman bagian paling atas kemudian klik tombol 'tambahkan barang'. Agar tampil pada tabel, silahkan isi kolom 'status' dengan 'bisa dijual'(tanpa tanda baca). Jika berhasil, produk yang Anda masukan akan tampil di paling bawah tabel.

## Fitur Edit
Untuk mengubah produk, silahkan klik 'Edit' pada baris produk yang akan Anda edit. Kemudian klik 'Edit barang' jika sudah selesai. 

## Fitur Hapus
Jika Anda ingin menghapus sebuah produk, silahkan pilih baris produk yang akan Anda hapus kemudian klik 'Hapus'.
