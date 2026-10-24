<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Skenario Uji Manual Autentikasi dan Otorisasi (RBAC)

Berikut adalah daftar skenario uji manual untuk memastikan sistem autentikasi, otorisasi, serta pembatasan hak akses (*Role-Based Access Control*) berjalan dengan benar pada aplikasi **Simple POS**:

### 1. Skenario Uji Peran: Admin (`admin@pos.test`)
* **Tujuan:** Memastikan pengguna dengan peran admin memiliki akses penuh ke halaman manajemen produk dan kategori.
* **Langkah-langkah:**
  1. Jalankan aplikasi lalu buka halaman `/login`.
  2. Masukkan email `admin@pos.test` dan kata sandi `password`, lalu klik **Masuk**.
  3. Perhatikan bilah navigasi (navbar) atas, pastikan menu **Produk** dan **Kategori** muncul.
  4. Klik menu **Produk** (`/products`).
* **Hasil yang Diharapkan:** Halaman daftar produk tampil secara normal dan dapat diakses tanpa ada kendala error.

### 2. Skenario Uji Peran: Kasir (`kasir@pos.test`)
* **Tujuan:** Memastikan pengguna dengan peran kasir dapat mengakses halaman transaksi/kasir, namun dibatasi (terblokir) saat mencoba mengakses halaman khusus admin.
* **Langkah-langkah:**
  1. Login menggunakan akun kasir (`kasir@pos.test` / `password`).
  2. Perhatikan navbar atas, pastikan menu **Produk** dan **Kategori** disembunyikan/tidak muncul.
  3. Coba akses halaman kasir (`/pos`).
  4. Secara manual, ubah URL pada *address bar* browser menjadi `/products`.
* **Hasil yang Diharapkan:** 
  * Halaman `/pos` terbuka secara normal.
  * Saat mengakses `/products`, sistem menolak akses dengan menampilkan halaman error **403 Forbidden** (pesan: *"Anda tidak memiliki akses untuk halaman ini"* atau sesuai pesan kustom peran).

### 3. Skenario Uji Peran: Tamu / Belum Login (Guest)
* **Tujuan:** Memastikan sistem mengamankan rute privat dan mengarahkannya kembali ke halaman login jika belum terotentikasi.
* **Langkah-langkah:**
  1. Pastikan posisi dalam keadaan **Keluar (Logout)**.
  2. Ketik secara langsung URL `/products` atau `/pos` pada *address bar*.
* **Hasil yang Diharapkan:** Pengguna otomatis diarahkan (*redirect*) ke halaman `/login` (`/login?url=...`), mencegah akses terbuka bagi publik yang belum masuk.