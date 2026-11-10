# Lab7Web_PHP — Praktikum 7: Pemrograman Server-Side dengan PHP

**Mata Kuliah** : Pemrograman Web
**Modul**       : Praktikum 7 — Pemrograman Server-Side dengan PHP
**Nama**        : Daniel Dasnial
**NIM**         : 312510492
**Program Studi** : Teknik Informatika

---

## 1. Tujuan

- Memahami perbedaan pemrosesan client-side dan server-side.
- Mengenali sintaks PHP dan menjalankan file PHP melalui server lokal.
- Menggunakan variabel, tipe data, operator, percabangan, perulangan, dan function.
- Menerima dan memproses data dari form HTML menggunakan metode GET dan POST.
- Melakukan validasi dan sanitasi input dasar sebelum data ditampilkan atau diproses.
- Membangun aplikasi sederhana yang menerima, memproses, dan menampilkan data pengguna.

## 2. Perangkat

| Perangkat | Keterangan |
|---|---|
| Laptop/PC | Windows 10/11 |
| Web browser | Microsoft Edge / Google Chrome |
| Editor | Visual Studio Code |
| PHP | PHP 8.2.12 (dari paket XAMPP) |
| Server lokal | XAMPP (Apache) |

## 3. Cara Menjalankan Server Lokal

### Cara A — XAMPP (direkomendasikan, sesuai modul)

1. Instal XAMPP, lalu buka **XAMPP Control Panel**.
2. Klik **Start** pada modul **Apache**.
3. Salin folder proyek `Lab7Web_PHP` ke direktori web server:
   ```
   C:\xampp\htdocs\Lab7Web_PHP
   ```
4. Buka browser dan akses:
   ```
   http://localhost/Lab7Web_PHP/
   ```
5. Jangan membuka file `.php` dengan klik ganda (double click) — harus dilihat
   lewat http://localhost agar kode PHP diproses server.

### Cara B — PHP built-in server (alternatif, tanpa Apache)

```bash
cd Lab7Web_PHP            # masuk ke folder proyek
php -S localhost:8000     # jalankan server PHP
```
Lalu akses `http://localhost:8000/` pada browser.

## 4. Struktur File

```
Lab7Web_PHP/
├── index.php          # Beranda: identitas + daftar seluruh latihan
├── latihan1.php       # L1 — Menjalankan PHP (echo, date server)
├── latihan2.php       # L2 — Variabel, operator, percabangan (nilai akhir + predikat)
├── latihan3.php       # L3 — Perulangan & array (daftar mahasiswa, foreach)
├── latihan4.php       # L4 — Function (hitungDiskon + 2 function tambahan)
├── cari.php           # L5 — Form GET (kata kunci lewat URL)
├── latihan6.php       # L6 — Form POST (nama + program studi) + validasi
├── latihan7.php       # L7 — Pengolahan data (subtotal transaksi barang)
├── miniproject.php    # Mini Project — Formulir Data Mahasiswa + validasi lengkap
├── eksperimen1.php    # Rata-rata tiga komponen nilai
├── eksperimen2.php    # GET mencari nama dari array (tidak peka huruf besar/kecil)
├── eksperimen3.php    # Function formatRupiah()
├── eksperimen4.php    # Validasi NIM: hanya angka, 9-10 digit
├── eksperimen5.php    # Tombol reset + penjelasan reset vs pemrosesan ulang
├── screenshot/        # 20 screenshot output tiap latihan & hasil validasi
├── style.css          # Satu stylesheet bersama untuk seluruh halaman
├── partials/
│   ├── top.php        # <head>, navigasi atas (include, reuse antarhalaman)
│   └── bottom.php     # Footer identitas + penutup HTML
└── README.md
```

## 5. Ringkasan Hasil

| Halaman | Yang dikerjakan | Catatan hasil |
|---|---|---|
| `latihan1.php` | PHP pertama, `date()` waktu server | Output tampil, kode PHP tidak muncul sebagai teks |
| `latihan2.php` | `$nilaiAkhir = tugas*0.30 + uts*0.30 + uas*0.40`, percabangan predikat A/B/C/D | Kombinasi nilai diuji lewat form GET tanpa mengubah kode |
| `latihan3.php` | Array 7 nama mahasiswa, ditampilkan `foreach` | Melebihi ketentuan minimal 3 nama |
| `latihan4.php` | `hitungDiskon()`, tambahan `hitungLuasPersegiPanjang()`, `tentukanKelulusan()` | Semua function diuji pada tabel halaman |
| `cari.php` | Form GET `?kata=...`, output aman `htmlspecialchars()` | Data terlihat di URL (sesuai sifat GET) |
| `latihan6.php` | Form POST nama+prodi, validasi server, sticky form | Kolom kosong ditolak walau HTML `required` |
| `latihan7.php` | Form barang/harga/jumlah → subtotal, tabel ringkasan kasus uji | Harga desimal diterima, jumlah 0/negatif ditolak |
| `miniproject.php` | Form data mahasiswa (nama, NIM, prodi, semester, email) + validasi server-side, semua pesan error tampil sekaligus, ringkasan data tampil bila valid | Semua output lewat `htmlspecialchars()`, pemrosesan dipisah dari tampilan |
| `eksperimen1..5.php` | Rata-rata nilai, cari dari array, `formatRupiah()`, validasi NIM, tombol reset | Seluruh eksperimen mandiri selesai; validasi NIM juga diterapkan di Mini Project |

## 6. Kasus Uji: Input Valid dan Tidak Valid

### Kasus valid

1. **Mini Project — data lengkap benar semua.**
   Nama: `Daniel Dasnial`, NIM: `312510492`, Prodi: `Teknik Informatika`,
   Semester: `3`, Email: `daniel.dasnial@example.com`.
   Hasil: semua lolos validasi server, muncul **Ringkasan Data Mahasiswa**.
   *Alasan valid*: nama/prodi tidak kosong, NIM 9 digit angka (`ctype_digit` lolos),
   semester bilangan bulat 1–14, dan email lolos `filter_var(FILTER_VALIDATE_EMAIL)`.
2. **Latihan 7 — angka desimal pada harga.**
   Nama barang: `Kopi`, harga: `15000.50`, jumlah: `3` → subtotal `Rp45.002`.
   *Alasan valid*: `is_numeric($harga)` lolos untuk desimal, `ctype_digit($jumlah)`
   lolos untuk bilangan bulat, jumlah ≥ 1, dan nama tidak kosong.

### Kasus tidak valid

1. **Mini Project — NIM berisi selain angka dan email salah format.**
   NIM: `31-25-0492`, email: `daniel@salah`.
   Hasil: ditolak, pesan muncul: **"NIM hanya boleh berisi angka."** dan
   **"Format email tidak valid."** (all error ditampilkan sekaligus).
   *Alasan ditolak*: `ctype_digit("31-25-0492") === false` dan
   `filter_var(..., FILTER_VALIDATE_EMAIL) === false`. Validasi HTML hanya
   membantu; jika form dibypass (mis. request manual lewat fetch/Postman), server tetap menolak.
2. **Latihan 7 — jumlah 0 atau negatif.**
   Jumlah: `0` atau `-5`.
   Hasil: ditolak dengan pesan **"Periksa kembali nama barang, harga, dan jumlah."**
   *Alasan ditolak*: `ctype_digit("0")` lolos sebagai string, tetapi pemeriksaan
   `(int)$jumlah < 1` menolaknya; nilai `-6` juga menggagalkan
   `ctype_digit` (tanda negatif bukan digit). Validasi PHP ini pemeriksaan utama
   karena atribut HTML `min="1"` dapat dilewati.

## 7. Screenshot

Screenshot seluruh halaman (beranda, latihan 1–7, mini project, eksperimen 1–5)
berserta hasil form **valid** dan **tidak valid** tersimpan pada folder `screenshot/`
(20 file PNG, penomoran `01-beranda-index.png` s.d. `20-eksperimen5-tombol-reset.png`).
Screenshot dapat diambil ulang sendiri lewat browser dengan alur di bagian 3.

## 8. Jejak Repository (poin 6 laporan modul)

Git belum terpasang pada komputer praktikum ini, sehingga commit ke repository
dilakukan oleh mahasiswa dengan salah satu cara berikut:

- **Cara A (direkomendasikan):** install Git for Windows (`git-scm.com`), lalu dari
  dalam folder proyek:
  ```bash
  git init
  git add .
  git commit -m "Praktikum 7: Pemrograman Server-Side dengan PHP - Daniel Dasnial (312510492)"
  git remote add origin https://github.com/<username>/Lab7Web_PHP.git
  git push -u origin main
  ```
- **Cara B:** unggah ZIP atau seluruh folder proyek ini secara manual ke repository
  web (GitHub / GitLab) melalui fitur *upload files*, kemudian salin URL-nya untuk
  dikumpulkan sesuai arahan dosen.
