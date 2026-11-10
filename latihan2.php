<?php
/**
 * latihan2.php — Latihan 2: Variabel, operator, dan percabangan
 * Menghitung nilai akhir dari tugas (30%), UTS (30%), UAS (40%), lalu menentukan predikat.
 * Nilai dapat diuji dengan kombinasi berbeda melalui form GET (batas uji tanpa klik ubah kode).
 */
$title = 'Latihan 2 — Variabel, Operator, Percabangan';
require 'partials/top.php';

// Nilai default sesuai modul: Siti, 85, 78, 90
$nama  = "Siti";
$tugas = 85;
$uts   = 78;
$uas   = 90;

// Uji kombinasi lain melalui URL: ?tugas=60&uts=70&uas=55
if (isset($_GET['tugas'], $_GET['uts'], $_GET['uas'])) {
    if (is_numeric($_GET['tugas']) && is_numeric($_GET['uts']) && is_numeric($_GET['uas'])) {
        $tugas = (float) $_GET['tugas'];
        $uts   = (float) $_GET['uts'];
        $uas   = (float) $_GET['uas'];
    }
}

$nilaiAkhir = ($tugas * 0.30) + ($uts * 0.30) + ($uas * 0.40);

if ($nilaiAkhir >= 85) {
    $predikat = "A";
} elseif ($nilaiAkhir >= 75) {
    $predikat = "B";
} elseif ($nilaiAkhir >= 60) {
    $predikat = "C";
} else {
    $predikat = "D";
}
?>

<section class="card">
  <span class="tag">Latihan 2</span>
  <h1>Variabel, Operator, dan Percabangan</h1>

  <div class="success-box">
<?php
echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "<br>";
echo "Nilai akhir: " . number_format($nilaiAkhir, 2) . "<br>";
echo "Predikat: " . $predikat;
?>
  </div>

  <h3>Rincian perhitungan</h3>
  <table>
    <tr>
      <th>Komponen</th>
      <th>Nilai</th>
      <th>Bobot</th>
      <th>Kontribusi</th>
    </tr>
    <tr>
      <td>Tugas</td>
      <td><?= number_format($tugas, 2) ?></td>
      <td>30%</td>
      <td><?= number_format($tugas * 0.30, 2) ?></td>
    </tr>
    <tr>
      <td>UTS</td>
      <td><?= number_format($uts, 2) ?></td>
      <td>30%</td>
      <td><?= number_format($uts * 0.30, 2) ?></td>
    </tr>
    <tr>
      <td>UAS</td>
      <td><?= number_format($uas, 2) ?></td>
      <td>40%</td>
      <td><?= number_format($uas * 0.40, 2) ?></td>
    </tr>
  </table>

  <h3>Uji kombinasi nilai</h3>
  <form method="GET" action="">
    <label for="tugas">Nilai Tugas (0&ndash;100)</label>
    <input type="number" id="tugas" name="tugas" min="0" max="100" step="1"
           value="<?= htmlspecialchars($tugas, ENT_QUOTES, 'UTF-8') ?>" required>

    <label for="uts">Nilai UTS (0&ndash;100)</label>
    <input type="number" id="uts" name="uts" min="0" max="100" step="1"
           value="<?= htmlspecialchars($uts, ENT_QUOTES, 'UTF-8') ?>" required>

    <label for="uas">Nilai UAS (0&ndash;100)</label>
    <input type="number" id="uas" name="uas" min="0" max="100" step="1"
           value="<?= htmlspecialchars($uas, ENT_QUOTES, 'UTF-8') ?>" required>

    <button type="submit">Hitung Ulang</button>
  </form>

  <div class="note">
    <strong>Batas predikat:</strong> &ge;85 = A, 75&ndash;84.99 = B, 60&ndash;74.99 = C,
    di bawah 60 = D. Coba beberapa kombinasi untuk memeriksa hasil perhitungan dan predikat.
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
