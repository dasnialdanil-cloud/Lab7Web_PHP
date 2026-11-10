<?php
/**
 * latihan1.php — Latihan 1: Menjalankan PHP
 * Membuktikan kode PHP diproses oleh server dan pasangan HTML yang diterima browser.
 */
$title = 'Latihan 1 — Menjalankan PHP';
require 'partials/top.php';

$waktuServer = date('d-m-Y H:i:s');
?>

<section class="card">
  <span class="tag">Latihan 1</span>
  <h1>Belajar PHP</h1>

  <div class="success-box">
<?php
echo "<p>PHP berhasil dijalankan.</p>";
echo "<p>Waktu server: " . $waktuServer . "</p>";
?>
  </div>

  <h3>Yang diamati</h3>
  <ul>
    <li>Web server harus berjalan sebelum halaman diakses.</li>
    <li>Output <em>"PHP berhasil dijalankan."</em> dan waktu server berasal dari
        <code>echo</code> PHP. Jika kode PHP masih tampil sebagai teks di browser,
        berarti file diakses tanpa melalui web server.</li>
    <li>Nilai <code>date()</code> dihitung di server, bukan di browser.</li>
  </ul>

  <h3>Kode inti</h3>
  <pre>&lt;?php
  echo "&lt;p&gt;PHP berhasil dijalankan.&lt;/p&gt;";
  echo "&lt;p&gt;Waktu server: " . date("d-m-Y H:i:s") . "&lt;/p&gt;";
?&gt;</pre>
</section>

<?php require 'partials/bottom.php'; ?>
