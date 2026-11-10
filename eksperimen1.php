<?php
/**
 * eksperimen1.php — Eksperimen Mandiri 1
 * Menambahkan perhitungan nilai rata-rata dari tiga komponen nilai.
 */
$title = 'Eksperimen 1 — Rata-rata Nilai';
require 'partials/top.php';

function hitungRataRata($a, $b, $c): float
{
    return ($a + $b + $c) / 3;
}

function predikatDari($nilai): string
{
    if ($nilai >= 85) return "A";
    elseif ($nilai >= 75) return "B";
    elseif ($nilai >= 60) return "C";
    else return "D";
}

$tugas = 80; $uts = 75; $uas = 70;

if (isset($_GET['tugas'], $_GET['uts'], $_GET['uas'])) {
    if (is_numeric($_GET['tugas']) && is_numeric($_GET['uts']) && is_numeric($_GET['uas'])) {
        $tugas = (float) $_GET['tugas'];
        $uts   = (float) $_GET['uts'];
        $uas   = (float) $_GET['uas'];
    }
}

$rataRata = hitungRataRata($tugas, $uts, $uas);
?>

<section class="card">
  <span class="tag">Eksperimen Mandiri 1</span>
  <h1>Perhitungan Nilai Rata-Rata</h1>

  <div class="success-box">
    <p class="big-result" style="margin:0"><?= number_format($rataRata, 2) ?></p>
    <p style="margin:0"><strong>Predikat:</strong> <?= predikatDari($rataRata) ?></p>
  </div>

  <h3>Demonstrasi function</h3>
  <pre>hitungRataRata(<?= number_format($tugas, 0) ?>, <?= number_format($uts, 0) ?>, <?= number_format($uas, 0) ?>)
= (<?= number_format($tugas, 0) ?> + <?= number_format($uts, 0) ?> + <?= number_format($uas, 0) ?>) / 3
= <strong><?= number_format($rataRata, 2) ?></strong></pre>

  <form method="GET" action="">
    <label for="tugas">Tugas</label>
    <input type="number" id="tugas" name="tugas" value="<?= htmlspecialchars($tugas, ENT_QUOTES, 'UTF-8') ?>" required>

    <label for="uts">UTS</label>
    <input type="number" id="uts" name="uts" value="<?= htmlspecialchars($uts, ENT_QUOTES, 'UTF-8') ?>" required>

    <label for="uas">UAS</label>
    <input type="number" id="uas" name="uas" value="<?= htmlspecialchars($uas, ENT_QUOTES, 'UTF-8') ?>" required>

    <button type="submit">Hitung Rata-Rata</button>
  </form>

  <div class="note">
    Berbeda dengan Latihan 2 yang memakai bobot (30/30/40), eksperimen ini menghitung
    <strong>rata-rata sederhana</strong> (proporsi sama) lalu memetakan hasilnya ke predikat
    menggunakan function <code>predikatDari()</code>.
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
