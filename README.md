# W-log

## Info

<p>Nama aplikasi: W-log</p>
<p></p>Tim pengembang: Kelompok 1</p>

- Yuna Dhuha Sabrina - 231402007<br> Back-End    <i>(Show User, CRUD Profile, Manage User)</i>
- Safna Yuninda - 231402025<br> Back-End    <i>(Show Comments, CRUD Comments, Report Posts/Comments)</i>
- Refael Juari Siagian - 231402055<br> Front-End, Back-End    <i>(Authentication, Authorization)</i>
- Ferdyan Darwis - 231402092<br> Back-End    <i>(Show Posts, CRUD Posts, Post/Comment Reports)</i>
- Jessica Eldamaris Maha - 231402101<br> Back-End    <i>(Show Categories, CRUD Categories, CRUD Reports)</i>

## Desc

<p>W-log <i>( Write-log / We-blog )</i> merupakan sebuah aplikasi web yang memberikan kebebasan bagi semua orang untuk berbagi cerita. Layaknya sebuah blog, aplikasi ini mengizinkan semua orang untuk membagikan tulisan mereka. Dengan beragam kategori tulisan, pengguna dapat mengeksplorasi tulisan mereka, dari informasi menarik, tips dan trik, bahkan berbagi pengalaman pribadi mereka. Pengguna juga dapat menanggapi tulisan dengan memberi komentar.</p>
<p>Untuk menjaga kenyamanan dalam menggunakan aplikasi ini, pengguna juga dapat melaporkan tulisan atau komentar yang dianggap mengganggu. Dengan begitu, pengguna diharapkan mendapatkan pengalaman yang baik ketika menggunakan aplikasi ini.</p>

## Features

### Guest

- Melihat daftar post.
  - Daftar semua post
  - Daftar post berdasarkan kategori
  - Daftar post berdasarkan pengguna
  - Daftar post berdasarkan kata kunci judul
- Melihat tulisan post
- Login & register
- Verifikasi email & lupa sandi

### User

#### Blog

- Mengirim komentar ke postingan
- Melaporkan postingan
- Melaporkan komentar
- Edit profile
- Ganti password dan email
- Logout

#### Dashboard

- Halaman dashboard
- Daftar post.
  - Mencari post sendiri
  - Membuat, menghapus, memperbarui post
  - Mengubah status post (published/draft)
- Daftar comment.
  - Melihat komentar dari post sendiri
- Fitur search di halaman posts & comments

 ### Admin (Dashboard)

 - Halaman dashboard
 - Kelola user
 - Kelola postingan
 - Kelola komentar
 - Kelola kategori (CRUD)
 - Kelola jenis report (CRUD)
 - Kelola laporan post
 - Kelola laporan komentar
 - Fitur di masing-masing pengelolaan
 

<br>
<p>Beberapa sumber daya luar yang dipakai dalam aplikasi ini:</p>

- [Trix Editor](https://github.com/basecamp/trix) untuk membuat tulisan.
- [Eloquent-Sluggable](https://github.com/cviebrock/eloquent-sluggable) untuk membuat slug.
- [Mailtrap](https://mailtrap.io/) untuk mengirim email dalam mode pengembangan.
- [Sweetalert](https://sweetalert2.github.io/) untuk memberi notifikasi di bagian create dan edit post.

<br>

## Environment

<p>Beberapa syarat environment untuk menjalankan aplikasi ini:</p>

- PHP : Versi 8 (8.1.17)
- Database : MySQL
- Laravel : Versi 10 (10.48.9)
- Penyimpanan : Lokal
<p>Terminal :</p>

```
php artisan storage:link
```
<p>.env (Laravel 10) :</p>

```
FILESYSTEM_DISK=public
```
___



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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
