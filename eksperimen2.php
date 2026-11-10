<?php
/**
 * eksperimen2.php — Eksperimen Mandiri 2
 * Mengubah contoh GET (Latihan 5) agar dapat mencari nama dari array data sederhana.
 */
$title = 'Eksperimen 2 — GET Cari dari Array';
require 'partials/top.php';

$mahasiswa = ["Alya", "Bima", "Citra", "Doni", "Eka", "Fajar", "Daniel", "Gita", "Hendri"];

$hasilCari = null;
$kata = "";

if (isset($_GET["kata"])) {
    $kata = trim($_GET["kata"]);
    if ($kata !== "") {
        $hasilCari = [];
        foreach ($mahasiswa as $nama) {
            if (mb_stripos($nama, $kata) !== false) {
                $hasilCari[] = $nama;
            }
        }
    }
}
?>

<section class="card">
  <span class="tag">Eksperimen Mandiri 2</span>
  <h1>Cari Nama dari Array dengan GET</h1>

  <form method="GET" action="">
    <label for="kata">Kata kunci nama:</label>
    <input id="kata" name="kata" type="text" value="<?= htmlspecialchars($kata, ENT_QUOTES, 'UTF-8') ?>">
    <button type="submit">Cari</button>
  </form>

<?php if ($hasilCari === null && isset($_GET["kata"])): ?>
  <div class="error-box">Kata kunci kosong. Tulis nama yang dicari.</div>
<?php elseif ($hasilCari !== null): ?>
  <div class="<?= count($hasilCari) > 0 ? 'success-box' : 'error-box' ?>">
<?php if (count($hasilCari) > 0): ?>
    <p><strong>Ditemukan <?= count($hasilCari) ?> nama</strong> yang mengandung
       &quot;<?= htmlspecialchars($kata, ENT_QUOTES, 'UTF-8') ?>&quot;:</p>
    <ul>
<?php foreach ($hasilCari as $nama): ?>
      <li><strong><?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?></strong></li>
<?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Tidak ada nama yang mengandung
       &quot;<?= htmlspecialchars($kata, ENT_QUOTES, 'UTF-8') ?>&quot;.</p>
    <p>Daftar yang tersedia: <?= htmlspecialchars(implode(", ", $mahasiswa), ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
  </div>
<?php endif; ?>

  <h3>Data array lengkap</h3>
  <p>
<?php foreach ($mahasiswa as $i => $nama): ?>
    <code><?= $i + 1 ?>. <?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?></code>
<?php endforeach; ?>
  </p>

  <h3>Kode inti</h3>
  <pre>foreach ($mahasiswa as $nama) {
    if (mb_stripos($nama, $kata) !== false) {
        $hasilCari[] = $nama; // cocok (tidak peka huruf besar/kecil)
    }
}</pre>

  <div class="note">
    Pencarian menggunakan <code>mb_stripos()</code> sehingga <strong>tidak peka huruf
    besar/kecil</strong>: mencari &quot;dan&quot; tetap menemukan &quot;Daniel&quot;.
    Hasil juga dikelompokkan: nama yang mengandung kata kunci tampil semua.
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
