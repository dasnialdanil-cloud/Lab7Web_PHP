<?php
/**
 * latihan3.php — Latihan 3: Perulangan dan array
 * Menampilkan daftar mahasiswa menggunakan foreach (modul menambah min. 3 nama, di sini 7 nama).
 */
$title = 'Latihan 3 — Perulangan dan Array';
require 'partials/top.php';

// Array awal modul: ["Alya", "Bima", "Citra", "Doni"] + 3 nama tambahan
$mahasiswa = ["Alya", "Bima", "Citra", "Doni", "Eka", "Fajar", "Daniel"];
?>

<section class="card">
  <span class="tag">Latihan 3</span>
  <h1>Perulangan dan Array</h1>

<?php
echo "<h3>Daftar Mahasiswa</h3><ol>";
foreach ($mahasiswa as $nama) {
    echo "<li>" . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "</li>";
}
echo "</ol>";
?>

  <div class="success-box">
    <p><strong>Jumlah mahasiswa saat ini:</strong> <?= count($mahasiswa) ?> nama (array awal 4 + 3 tambahan).</p>
    <p>Nama ditampilkan satu per satu oleh <code>foreach</code>, tanpa menuliskan
       <code>echo</code> manual per baris.</p>
  </div>

  <h3>Alternatif: menampilkan nama + nomor urut</h3>
  <table>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Panjang karakter</th>
    </tr>
<?php foreach ($mahasiswa as $i => $nama): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?></td>
      <td><?= strlen($nama) ?></td>
    </tr>
<?php endforeach; ?>
  </table>
</section>

<?php require 'partials/bottom.php'; ?>
