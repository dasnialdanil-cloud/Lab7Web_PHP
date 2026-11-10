<?php
/**
 * index.php — Halaman utama / beranda praktikum.
 * Berisi daftar navigasi seluruh latihan, mini project, dan eksperimen.
 */
$title = 'Beranda — Praktikum 7 PHP';
require 'partials/top.php';
?>

<section class="card">
  <span class="tag">Praktikum 7</span>
  <h1>Pemrograman Server-Side dengan PHP</h1>
  <p>
    Modul ini membahas sintaks PHP, variabel, function, form processing
    (GET / POST), validasi &amp; sanitasi input, serta pengolahan data sederhana.
    Seluruh kode dijalankan dari sisi <strong>server</strong>, sehingga yang
    diterima browser adalah hasil HTML, bukan kode PHP mentah.
  </p>
  <table>
    <tr>
      <th>Nama</th>
      <td>Daniel Dasnial</td>
    </tr>
    <tr>
      <th>NIM</th>
      <td>312510492</td>
    </tr>
    <tr>
      <th>Program Studi</th>
      <td>Teknik Informatika</td>
    </tr>
    <tr>
      <th>Mata Kuliah</th>
      <td>Pemrograman Web</td>
    </tr>
    <tr>
      <th>Waktu Server</th>
      <td><?= date('d-m-Y H:i:s') ?></td>
    </tr>
  </table>
  <div class="note">
    <strong>Cara uji:</strong> akses semua halaman melalui
    <code>http://localhost/Lab7Web_PHP/</code> (XAMPP) atau server bawaan
    <code>php -S localhost:8000</code>. Jangan membuka file .php dengan klik ganda.
  </div>
</section>

<section class="card">
  <h2>Daftar Latihan &amp; Mini Project</h2>
  <div class="grid-menu">
    <a class="menu-item" href="latihan1.php">
      <span class="num">Latihan 1</span>
      <h3>Menjalankan PHP</h3>
      <p>index PHP pertama, tampil waktu server pada browser.</p>
    </a>
    <a class="menu-item" href="latihan2.php">
      <span class="num">Latihan 2</span>
      <h3>Variabel &amp; Percabangan</h3>
      <p>Hitung nilai akhir (tugas, UTS, UAS) lalu tentukan predikat.</p>
    </a>
    <a class="menu-item" href="latihan3.php">
      <span class="num">Latihan 3</span>
      <h3>Perulangan &amp; Array</h3>
      <p>Daftar mahasiswa ditampilkan dengan foreach.</p>
    </a>
    <a class="menu-item" href="latihan4.php">
      <span class="num">Latihan 4</span>
      <h3>Membuat Function</h3>
      <p>hitungDiskon(), hitungLuasPersegiPanjang(), tentukanKelulusan().</p>
    </a>
    <a class="menu-item" href="cari.php">
      <span class="num">Latihan 5</span>
      <h3>Form dengan GET</h3>
      <p>Data dikirim lewat parameter URL (cari.php).</p>
    </a>
    <a class="menu-item" href="latihan6.php">
      <span class="num">Latihan 6</span>
      <h3>Form dengan POST</h3>
      <p>Nama &amp; program studi, validasi sisi server.</p>
    </a>
    <a class="menu-item" href="latihan7.php">
      <span class="num">Latihan 7</span>
      <h3>Pengolahan Data</h3>
      <p>Subtotal transaksi: nama barang, harga, dan jumlah.</p>
    </a>
    <a class="menu-item" href="miniproject.php">
      <span class="num">Mini Project</span>
      <h3>Formulir Data Mahasiswa</h3>
      <p>Validasi lengkap: nama, NIM, prodi, semester, email.</p>
    </a>
    <a class="menu-item" href="eksperimen1.php">
      <span class="num">Eksperimen 1</span>
      <h3>Rata-rata Nilai</h3>
      <p>Rata-rata dari tiga komponen nilai.</p>
    </a>
    <a class="menu-item" href="eksperimen2.php">
      <span class="num">Eksperimen 2</span>
      <h3>GET Cari dari Array</h3>
      <p>Mencari nama mahasiswa dari array sederhana.</p>
    </a>
    <a class="menu-item" href="eksperimen3.php">
      <span class="num">Eksperimen 3</span>
      <h3>Function Format Rupiah</h3>
      <p>Mengubah angka menjadi format Rupiah.</p>
    </a>
    <a class="menu-item" href="eksperimen4.php">
      <span class="num">Eksperimen 4</span>
      <h3>Validasi NIM</h3>
      <p>NIM hanya angka dan panjang sesuai ketentuan.</p>
    </a>
    <a class="menu-item" href="eksperimen5.php">
      <span class="num">Eksperimen 5</span>
      <h3>Tombol Reset</h3>
      <p>Tombol reset vs pemrosesan ulang di server.</p>
    </a>
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
