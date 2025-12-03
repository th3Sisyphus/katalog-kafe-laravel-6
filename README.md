# Katalog Meja Kafe

Sebuah aplikasi sederhana berbasis Laravel 6 untuk mengelola katalog meja/produk kafe. Aplikasi ini mendukung operasi CRUD (Create, Read, Update, Delete) untuk produk, upload gambar produk dengan validasi, preview gambar sebelum upload, dan konfirmasi hapus yang rapi menggunakan SweetAlert2.

Fokus proyek:

-   Menyimpan data produk (nama, harga, stok, diskon, kategori, gambar)
-   Upload dan penyimpanan gambar di disk `public/storage/images`
-   Validasi server-side (maks 2MB, tipe jpg/png) dan client-side (preview + size check)
-   Konfirmasi penghapusan memakai SweetAlert2 dan notifikasi toast setelah aksi berhasil
-   Layout menggunakan Bootstrap dengan tema warna coklat/hitam/putih yang elegan

## Struktur singkat

-   `resources/views/layouts/main.blade.php` — layout utama (header, main, footer)
-   `resources/views/home.blade.php` — daftar produk (dashboard)
-   `resources/views/addmenu.blade.php` — form tambah produk
-   `resources/views/editmenu.blade.php` — form edit produk (dilengkapi preview gambar saat ini)
-   `app/Http/Controllers/PageController.php` — controller utama untuk CRUD
-   `database/migrations/*` — migrasi tabel `produk`

## Requirement

-   PHP 7.2+ (sesuaikan dengan requirement Laravel 6)
-   Composer
-   Node.js + npm (untuk asset/build jika diperlukan)

## Setup (lokal)

1. Clone repository dan masuk ke folder project

2. Install dependensi PHP:

```powershell
composer install
```

3. Buat file `.env` dari template dan atur koneksi database:

```powershell
copy .env.example .env
php artisan key:generate
```

4. Buat database dan jalankan migrasi seeder (opsional):

```powershell
php artisan migrate
php artisan db:seed
```

5. Buat symbolic link storage agar gambar bisa diakses dari `public/storage`:

```powershell
php artisan storage:link
```

6. Jalankan server development:

```powershell
php artisan serve
```

Lalu buka: http://127.0.0.1:8000

## Routes penting

-   `/` — daftar produk (home)
-   `/addmenu` — form tambah produk
-   `/addmenu/save` — POST untuk menyimpan produk baru
-   `/editmenu/{id}` — form edit produk
-   `/editmenu/save/{id}` — PUT untuk menyimpan perubahan
-   `/deletemenu/{id}` — GET route menghapus produk (menjalankan hapus + file gambar)

Catatan: Saat ini route delete menggunakan GET untuk kemudahan demo; untuk produksi disarankan menggunakan form dengan method DELETE + CSRF.

## Fitur yang dibangun

-   Upload gambar produk dengan validasi server-side (Laravel validation) dan client-side (JS): maksimal 2MB, hanya JPG/PNG
-   Preview gambar saat memilih file pada form tambah/edit
-   Preview gambar yang sudah tersimpan di halaman edit
-   Konfirmasi penghapusan memakai SweetAlert2 (modal) lalu redirect
-   Toast notifikasi (SweetAlert2) setelah create/update/delete berhasil

## Warna & Tema

Layout memakai kombinasi warna coklat, hitam, putih dan cream sehingga memberikan kesan elegan. Styling utama memakai Bootstrap 5 via CDN dan sedikit CSS custom.

## Catatan pengembang

-   Pastikan `storage:link` telah dijalankan agar gambar yang diupload dapat diakses.
-   Validasi file di controller (`PageController`) sudah diterapkan: `nullable|image|mimes:jpeg,png,jpg|max:2048` (max 2048 KB = 2MB).
-   Jika ingin menggunakan bundler (npm, webpack/vite), pindahkan dependensi JS (mis. SweetAlert2) ke package.json dan import via bundler.

## Lisensi

Proyek ini mengikuti lisensi MIT (sesuai project Laravel asli). Untuk pertanyaan atau kontak, hubungi Admin proyek di email: admin@katalogmejakafe.com
