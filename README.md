# Sistem Informasi Pengaduan Sarana Sekolah

Aplikasi berbasis web untuk mengelola dan melacak
pelaporan fasilitas atau sarana sekolah.

## Teknologi yang Digunakan

- Laravel 12
- Filament 4
- PHP
- MySQL
- Livewire
- Laragon

## Fitur Aplikasi

### Admin
- Melihat seluruh data pengaduan.
- Memberikan tanggapan pengaduan.
- Memperbarui status pengaduan.
- Mengelola kategori pengaduan.
- Mengelola data pengguna.
- Memfilter data pengaduan.

### Siswa
- Login ke aplikasi.
- Membuat pengaduan.
- Melihat pengaduan milik sendiri.
- Melihat status dan tanggapan pengaduan.

## Struktur Repository

1. Folder Proyek Aplikasi
2. Database SQL
3. Dokumentasi
   - ERD
   - Deskripsi Program
   - Dokumentasi Fungsi dan Prosedur
   - Dokumentasi Debugging
4. Laporan Evaluasi Singkat

## Instalasi

1. Clone repository.
2. Masuk ke folder project Laravel.
3. Jalankan `composer install`.
4. Salin `.env.example` menjadi `.env`.
5. Sesuaikan konfigurasi database.
6. Jalankan `php artisan key:generate`.
7. Import database `pengaduan_sarana.sql`.
8. Jalankan `php artisan serve`.

## Tujuan

Project ini dibuat sebagai aplikasi
Sistem Informasi Pengaduan Sarana Sekolah
untuk memenuhi kebutuhan Uji Kompetensi Keahlian (UKK).
