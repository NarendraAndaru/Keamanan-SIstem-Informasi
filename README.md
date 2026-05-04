Narendra Andaru - 72230614
Keamanan Sistem Informasi

---

# Dokumentasi Pembuatan Aplikasi Web Keamanan SI

Dokumentasi ini menjelaskan proses pembuatan aplikasi web berbasis Laravel yang memiliki fitur autentikasi pengguna. Fitur utama yang dibuat meliputi login, registrasi, penyimpanan password dalam bentuk hash, konfirmasi registrasi (verifikasi email), dan reset password.

---

## 1. Instalasi Laravel Breeze

Pada tahap awal, saya menggunakan package **Laravel Breeze** untuk mempermudah pembuatan sistem autentikasi.

Perintah yang digunakan:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
```

Breeze dipilih karena sudah menyediakan fitur login dan register secara otomatis tanpa harus membuat dari awal.

---

## 2. Menjalankan Frontend dan Migrasi

Setelah Breeze terinstall, saya menjalankan beberapa perintah untuk mengaktifkan tampilan dan database:

```bash
npm install
npm run dev
php artisan migrate
```

Migrasi ini akan membuat tabel penting seperti:

* users
* password_reset_tokens

---

## 3. Fitur Login

Fitur login sudah otomatis tersedia dari Laravel Breeze. User dapat masuk ke sistem menggunakan email dan password yang sudah didaftarkan.

---

## 4. Penyimpanan Password (Hashing)

Laravel secara otomatis menyimpan password dalam bentuk hash menggunakan sistem keamanan bawaan. Jadi password tidak disimpan dalam bentuk asli, melainkan sudah terenkripsi.

Hal ini penting untuk menjaga keamanan data pengguna.

---

## 5. Fitur Registrasi

Fitur registrasi memungkinkan pengguna membuat akun baru dengan mengisi:

* Nama
* Email
* Password

Data ini akan disimpan ke database setelah melalui proses validasi.

---

## 6. Konfirmasi Registrasi (Verifikasi Email)

Untuk memastikan email yang digunakan valid, saya mengaktifkan fitur verifikasi email.

Caranya dengan menambahkan `MustVerifyEmail` pada model User:

```php
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
}
```

Setelah itu, setiap user yang mendaftar harus melakukan verifikasi melalui email sebelum bisa mengakses sistem.

---

## 7. Fitur Reset Password

Laravel juga sudah menyediakan fitur reset password. Jika user lupa password, mereka bisa:

* Menginput email
* Mendapatkan link reset melalui email
* Mengatur password baru

---

## 8. Konfigurasi Email dengan Mailtrap

Untuk keperluan testing pengiriman email, saya menggunakan **Mailtrap**.

Konfigurasi pada file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=diisi_dari_mailtrap
MAIL_PASSWORD=diisi_dari_mailtrap
```

Mailtrap digunakan agar email verifikasi dan reset password bisa diuji tanpa benar-benar dikirim ke email asli.

---
