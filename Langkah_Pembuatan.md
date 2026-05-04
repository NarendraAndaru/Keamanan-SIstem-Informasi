# Dokumentasi Pembuatan Aplikasi Web Keamanan SI

Dokumen ini berisi langkah-langkah pembuatan fitur Autentikasi menggunakan Laravel Breeze, penyesuaian tampilan (Glassmorphism), konfigurasi email (Mailtrap), hingga pengalihan route.

---

## 1. Instalasi Laravel Breeze

Langkah pertama adalah menambahkan package `laravel/breeze` ke dalam project menggunakan Composer:

```bash
composer require laravel/breeze --dev
```

Setelah package terunduh, lakukan instalasi scaffolding Breeze dengan menggunakan Stack Blade dan mode gelap:

```bash
php artisan breeze:install blade --dark
```

---

## 2. Instalasi Node & Build Aset Frontend

Selanjutnya, instal semua dependensi NPM yang diperlukan dan pastikan library `axios` tersedia untuk request HTTP:

```bash
npm install
npm install axios --save-dev
```

Untuk menyusun dan mem-build aset frontend (CSS/JS) agar siap digunakan:

```bash
npm run build
```

---

## 3. Konfigurasi Database & Migrasi

Langkah berikutnya adalah menjalankan migrasi database untuk membuat tabel pengguna, reset password, dll:

```bash
php artisan migrate
```

---

## 4. Konfirmasi Registrasi (Verifikasi Email)

Untuk mengaktifkan fitur verifikasi email saat registrasi akun baru, kita mengimplementasikan interface `MustVerifyEmail` pada model pengguna di `app/Models/User.php`:

```php
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    // ...
}
```

---

## 5. Kustomisasi Tampilan (UI) Autentikasi

Kita mengubah tampilan default Laravel Breeze menjadi premium dengan gaya modern berbasis **Glassmorphism**.

### A. Template Utama (`resources/views/layouts/guest.blade.php`)
Diperbarui dengan latar belakang gradien yang menawan dan efek kaca:

```html
<style>
    .glassmorphism {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>
```

### B. Halaman Login (`resources/views/auth/login.blade.php`)
Ditambahkan input form modern, ikon yang elegan, serta penataan tombol submit yang premium.

### C. Halaman Register (`resources/views/auth/register.blade.php`)
Menyesuaikan dengan gaya halaman login, mengganti placeholder field nama menjadi **"Masukan Nama Anda"**.

---

## 6. Pengalihan Route Utama

Untuk menghapus halaman welcome bawaan Laravel dan langsung mengarahkan pengguna ke halaman registrasi, ubah file `routes/web.php`:

```php
Route::redirect('/', '/register');
```

---

## 7. Konfigurasi Mailtrap untuk Mengirimkan Email

Agar email konfirmasi dapat dikirimkan secara nyata saat pengetesan, ubah pengaturan pada file `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=isi_dengan_username_dari_mailtrap
MAIL_PASSWORD=isi_dengan_password_dari_mailtrap
MAIL_FROM_ADDRESS="no-reply@keamanansi.test"
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 8. Upload ke GitHub

Inisialisasi Git, commit perubahan, dan kirimkan semua kode project ke repository GitHub:

```bash
git init
git add .
git commit -m "Initial commit with Laravel Breeze and Modern Glassmorphism UI"
git remote add origin https://github.com/NarendraAndaru/Keamanan-SIstem-Informasi.git
git branch -M main
git push -u origin main --force
```
