<?php
/**
 * eksperimen3.php — Eksperimen Mandiri 3
 * Function untuk mengubah format harga menjadi Rupiah.
 */
$title = 'Eksperimen 3 — Function Format Rupiah';
require 'partials/top.php';

function formatRupiah($angka): string
{
    // number_format: 0 desimal, pemisah ribuan ",", desimal "."
    return "Rp" . number_format((float) $angka, 0, ",", ".");
}

// Versi lengkap: memakai 2 desimal bila ada pecahan
function formatRupiahDetail($angka): string
{
    $angka = (float) $angka;
    $desimal = ($angka == (int) $angka) ? 0 : 2;
    return "Rp" . number_format($angka, $desimal, ",", ".");
}

$angkaInput = 150000;

if (isset($_GET['angka'])) {
    if (is_numeric($_GET['angka']) && (float) $_GET['angka'] >= 0) {
        $angkaInput = (float) $_GET['angka'];
    }
}
?>

<section class="card">
  <span class="tag">Eksperimen Mandiri 3</span>
  <h1>Function Format Rupiah</h1>

  <div class="success-box">
    <p><strong>Input:</strong> <?= htmlspecialchars($angkaInput, ENT_QUOTES, 'UTF-8') ?></p>
    <p class="big-result" style="margin:0"><?= formatRupiah($angkaInput) ?></p>
    <p style="margin:0"><em>Versi detail:</em> <?= formatRupiahDetail($angkaInput) ?></p>
  </div>

  <form method="GET" action="">
    <label for="angka">Angka harga</label>
    <input type="number" id="angka" name="angka" min="0" step="0.01"
           value="<?= htmlspecialchars($angkaInput, ENT_QUOTES, 'UTF-8') ?>" required>
    <button type="submit">Format</button>
  </form>

  <h3>Demonstrasi dengan berbagai nilai</h3>
  <table>
    <tr>
      <th>Input</th>
      <th>formatRupiah()</th>
      <th>formatRupiahDetail()</th>
    </tr>
<?php
foreach ([150000, 5000.5, 1234567, 25000000, 75.99, 0] as $contoh):
?>
    <tr>
      <td><?= htmlspecialchars($contoh, ENT_QUOTES, 'UTF-8') ?></td>
      <td><strong><?= formatRupiah($contoh) ?></strong></td>
      <td><?= formatRupiahDetail($contoh) ?></td>
    </tr>
<?php endforeach; ?>
  </table>

  <h3>Kode function</h3>
  <pre>function formatRupiah($angka) {
    // number_format: 0 desimal, ribuan ",", desimal "."
    return "Rp" . number_format((float)$angka, 0, ",", ".");
}</pre>

  <div class="note">
    Format ini dipakai pula oleh <code>latihan4.php</code> (diskon) dan
    <code>latihan7.php</code> (subtotal) agar output harga konsisten:
    tanpa desimal tidak perlu (default modul), versi detail menampilkan 2 desimal
    hanya bila inputnya desimal.
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
