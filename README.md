# Katalog Meja Kafe

Sebuah aplikasi sederhana berbasis Laravel 6 untuk mengelola katalog meja/produk kafe. Aplikasi ini mendukung operasi CRUD (Create, Read, Update, Delete) untuk produk, manajemen user admin, serta fitur keamanan dasar.

Fokus proyek:

-   **Manajemen Produk**: Menyimpan data produk (nama, harga, stok, diskon, kategori, gambar).
-   **Manajemen User**: Menambah dan menghapus user admin yang memiliki akses ke dashboard.
-   **Keamanan**: Login dengan route custom, logout, dan fitur ganti password.
-   **Upload Gambar**: Upload penyimpanan gambar di disk `public/storage` dengan validasi.
-   **Validasi**: Server-side dan client-side (preview + size check).
-   **UI/UX**: Layout Bootstrap dengan tema warna coklat/hitam/putih, SweetAlert2 untuk konfirmasi dan notifikasi.

## Struktur Singkat

-   `resources/views/layouts/main.blade.php` — Layout utama.
-   `resources/views/admin/home.blade.php` — Dashboard daftar produk.
-   `resources/views/admin/users.blade.php` — Dashboard daftar user.
-   `resources/views/admin/addmenu.blade.php` — Form tambah produk.
-   `resources/views/admin/adduser.blade.php` — Form tambah user.
-   `resources/views/admin/changepassword.blade.php` — Form ganti password.
-   `app/Http/Controllers/PageController.php` — Controller "Gado-gado" (Produk, User, & Halaman Statis).
-   `app/Http/Controllers/AuthController.php` — Controller logika Login/Logout & Password.
-   `app/Http/Controllers/VisitorController.php` — Controller halaman depan (Search menu).

## Requirement

-   PHP 7.2+ (sesuai requirement Laravel 6)
-   Composer
-   Node.js + npm (opsional)

## Setup (Lokal)

1. Clone repository dan masuk ke folder project.
2. Install dependensi PHP:
    ```powershell
    composer install
    ```
3. Buat file `.env` dan atur database:
    ```powershell
    copy .env.example .env
    php artisan key:generate
    ```
4. Migrasi dan Seeder:
    ```powershell
    php artisan migrate
    php artisan db:seed
    ```
5. Link Storage:
    ```powershell
    php artisan storage:link
    ```
6. Jalankan Server:
    ```powershell
    php artisan serve
    ```

## Routes Penting

**Akses Publik:**
-   `/` — Halaman depan / Pencarian menu (Visitor).
-   `/login33231244` — **Pintu Masuk Admin** (Login page).

**Akses Admin (Middleware Auth):**
-   `/home` — Daftar produk.
-   `/addmenu` & `/addmenu/save` — Tambah produk.
-   `/editmenu/{id}` & `/editmenu/save/{id}` — Edit produk.
-   `/deletemenu/{id}` — Hapus produk (GET).
-   `/users` — Daftar user admin.
-   `/users/addUser` & `/users/save` — Tambah user.
-   `/users/delete/{id}` — Hapus user (GET).
-   `/changepassword` — Ganti password user login.
-   `/logout` — Keluar sesi.

## Fitur

1.  **Produk**: CRUD lengkap dengan upload gambar (validasi max 2MB, JPG/PNG).
2.  **User**: Admin dapat menambah admin lain dan menghapus akun (kecuali akun sendiri - *logic needs verification*).
3.  **Auth**: Login custom URL untuk menyembunyikan akses admin, ganti password, dan logout.
4.  **Interface**: Preview gambar real-time saat upload, SweetAlert2 untuk konfirmasi hapus (modal) dan notifikasi sukses.
