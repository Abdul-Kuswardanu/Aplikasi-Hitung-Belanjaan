# Hitung Total Belanja - Proyek PHP

Proyek ini adalah aplikasi web untuk mengelola dan menghitung total belanja menggunakan PHP dan SQLite sebagai database. Sistem ini mencakup fungsionalitas pendaftaran pengguna, login, dan manajemen produk (tambah, ubah, hapus, tampilkan).

## Struktur Proyek

### 1. **Struktur File**

 0.   /project-root-directory/ 
 1.  │ 
 2.  ├── db.php # Skrip untuk koneksi ke database 
 3.  ├── main.php # Halaman utama untuk menampilkan data produk dan perhitungan total belanja 
 4.  ├── signup.php # Halaman pendaftaran pengguna dengan validasi 
 5.  ├── login.php # Halaman login pengguna 
 6.  ├── logout.php # Halaman logout pengguna 
 7.  ├── tambah.php # Halaman untuk menambah produk baru (belanja) 
 8.  ├── edit.php # Halaman untuk mengedit informasi produk yang ada 
 9.  ├── hapus.php # Skrip untuk menghapus produk 
 10. ├── main.css # File stylesheet untuk tata letak dan desain 
 11. └── README.md # Dokumentasi proyek


### 2. **Database**

Proyek ini menggunakan SQLite untuk menyimpan data pengguna dan produk. Database (`database.db`) memiliki tiga tabel:

- **`users`**: Menyimpan informasi kredensial pengguna (username, password).
- **`signup`**: Menyimpan informasi pendaftaran pengguna (nama, username, email, password) sementara sebelum dipindahkan ke tabel `users`.
- **`produk`**: Menyimpan detail produk (tanggal, nama produk, harga, created_at, updated_at).

### 3. **Fungsionalitas**

Aplikasi ini mendukung fungsionalitas pendaftaran pengguna, login, dan operasi CRUD (Create, Read, Update, Delete) untuk mengelola produk.

#### Halaman dan Fitur:

1. **`main.php`**:
   - Menampilkan daftar produk yang dikelompokkan berdasarkan tanggal.
   - Menghitung dan menampilkan total pembelian per tanggal.
   - Menyediakan opsi untuk mengedit atau menghapus produk.
   - Terdapat tombol untuk menambah produk baru (`tambah.php`).

2. **`signup.php`**:
   - Memungkinkan pengguna untuk mendaftar dengan memasukkan nama, username, email, dan password.
   - Password di-hash sebelum disimpan ke dalam database untuk alasan keamanan.
   - Setelah pendaftaran berhasil, pengguna akan diarahkan ke halaman login (`login.php`).

3. **`login.php`**:
   - Pengguna dapat login dengan memasukkan username dan password.
   - Password yang dimasukkan dibandingkan dengan hash yang tersimpan di database.
   - Jika autentikasi berhasil, pengguna akan diarahkan ke halaman utama (`main.php`).
   - Halaman login juga mencakup fitur "Lupa Password" dan tautan ke halaman pendaftaran.

4. **`logout.php`**:
   - Mengeluarkan pengguna dari sesi dengan menghancurkan sesi dan mengarahkan kembali ke halaman login.

5. **`tambah.php`**:
   - Formulir yang memungkinkan pengguna untuk menambah produk baru.
   - Kolom input meliputi: Tanggal, Nama Produk, dan Harga.
   - Setelah pengisian formulir, detail produk dimasukkan ke dalam tabel `produk`.

6. **`edit.php`**:
   - Memungkinkan pengguna untuk mengedit produk yang sudah ada.
   - Menampilkan detail produk berdasarkan ID dan memungkinkan pembaruan nama produk, harga, dan tanggal.

7. **`hapus.php`**:
   - Menghapus produk dari database berdasarkan ID produk.
   - Setelah produk dihapus, pengguna akan diarahkan kembali ke halaman `main.php`.

### 4. **CSS Styling** (`main.css`)

- Aplikasi ini dirancang responsif dan memiliki antarmuka pengguna yang sederhana dan bersih.
- File CSS mendesain berbagai elemen seperti tombol, tabel, input formulir, dan tata letak keseluruhan.
- Tombol memiliki efek hover untuk pengalaman pengguna yang lebih baik.
- Bagian formulir dan tampilan produk diatur agar konten terpusat dan mudah dibaca dan diakses.

#### Gaya Utama:
- **Dashboard**: Didesain dengan warna latar belakang (`rgb(15, 165, 173)`) dan teks putih.
- **Tombol**: Tombol aksi berwarna hijau dengan efek hover, dan tombol hapus diberi warna merah.
- **Tata Letak Konten**: Kolom input dan tabel produk disusun agar terpusat dan lebih mudah dibaca.

### 5. **Alur Aplikasi**

1. **Pendaftaran (Signup)**: Pengguna mendaftar dengan mengisi form yang mencakup nama, username, email, dan password.
   - Sistem memvalidasi input data dan menyimpannya ke tabel `signup` sebelum dipindahkan ke tabel `users`.
   
2. **Login**: Pengguna dapat login dengan username dan password. Jika berhasil, mereka diarahkan ke halaman utama (`main.php`).

3. **Halaman Utama (`main.php`)**:
   - Menampilkan semua produk dalam format tabel yang dikelompokkan berdasarkan tanggal.
   - Menampilkan total pembelian per tanggal dan menyediakan opsi untuk mengedit atau menghapus produk.
   - Termasuk tombol untuk menambah produk baru.

4. **Tambah Produk**: Pengguna dapat memasukkan produk baru pada halaman `tambah.php`, yang kemudian dimasukkan ke dalam database.

5. **Edit Produk**: Pengguna dapat mengubah data produk yang sudah ada pada halaman `edit.php`.

6. **Hapus Produk**: Pengguna dapat menghapus produk dengan mengklik tombol hapus, yang akan menghapus item dari database.

### 6. **Fitur Keamanan**

- **Hashing Password**: Password di-hash menggunakan metode `password_hash()` PHP sebelum disimpan di database.
- **Pencegahan SQL Injection**: Meskipun tidak digunakan secara eksplisit dalam proyek ini, disarankan untuk menggunakan prepared statements pada lingkungan produksi untuk meningkatkan keamanan.

### 7. **Cara Menjalankan Proyek Secara Lokal**

1. **Persyaratan**:
   - PHP >= 7.4
   - SQLite (sudah termasuk dengan PHP)
   - Server web (misalnya, Apache, Nginx, atau server PHP built-in)

2. **Langkah-langkah**:
   - Kloning repositori ke komputer lokal Anda.
   - Siapkan server lokal (misalnya, menggunakan XAMPP, WAMP, atau server PHP built-in).
   - Akses direktori proyek di browser Anda atau jalankan server PHP built-in:

     ```bash
     php -S localhost:8000
     ```

   - Akses aplikasi di `http://localhost:8000/` (atau port yang sesuai).

3. **Menyiapkan Database SQLite**:
   - Pastikan file `database.db` SQLite ada di folder proyek.
   - Jika file tersebut tidak ada, buat secara manual atau jalankan skrip PHP yang sesuai untuk menginisialisasi database dan tabel.

---

### Kontribusi dan Lisensi

Silakan berkontribusi dengan memberikan saran perbaikan, memperbaiki bug, atau menambah fitur baru. Proyek ini terbuka untuk digunakan secara pribadi dan untuk tujuan pendidikan. Selamat berkoding!

---



