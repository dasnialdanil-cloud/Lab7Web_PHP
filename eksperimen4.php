<?php
/**
 * eksperimen4.php — Eksperimen Mandiri 4
 * Validasi NIM: hanya berisi angka dan panjang sesuai ketentuan (di sini: 9-10 digit).
 * Validasi yang sama juga diterapkan pada miniproject.php.
 */
$title = 'Eksperimen 4 — Validasi NIM';
require 'partials/top.php';

define('NIM_MIN', 9);
define('NIM_MAX', 10);

$nim = "";
$pesan = null;      // string pesan hasil validasi
$valid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_GET["nim"])) {
    $nimRaw = trim($_POST["nim"] ?? ($_GET["nim"] ?? ""));

    if (isset($_POST["nim"]) || isset($_GET["nim"])) {
        $nim = $nimRaw;

        if ($nim === "") {
            $pesan = "NIM wajib diisi.";
        } elseif (!ctype_digit($nim)) {
            $pesan = "NIM hanya boleh berisi angka 0-9." .
                     (strpbrk($nim, " \t") !== false ? " (terdapat spasi)" : "");
        } elseif (strlen($nim) < NIM_MIN) {
            $pesan = "NIM terlalu pendek: " . strlen($nim) . " digit (ketentuan " . NIM_MIN . "-" . NIM_MAX . " digit).";
        } elseif (strlen($nim) > NIM_MAX) {
            $pesan = "NIM terlalu panjang: " . strlen($nim) . " digit (ketentuan " . NIM_MIN . "-" . NIM_MAX . " digit).";
        } else {
            $pesan = "NIM valid: " . strlen($nim) . " digit angka.";
            $valid = true;
        }
    }
}
?>

<section class="card">
  <span class="tag">Eksperimen Mandiri 4</span>
  <h1>Validasi NIM (Angka &amp; Panjang)</h1>
  <p>
    Ketentuan yang ditetapkan: NIM harus <strong>hanya angka</strong> dan panjangnya
    <strong><?= NIM_MIN ?>&ndash;<?= NIM_MAX ?> digit</strong> (NIM saya = 9 digit).
    Validasi dijalankan di <strong>sisi server</strong> dengan PHP.
  </p>

<form method="POST" action="">
  <label for="nim">Masukkan NIM untuk diuji</label>
  <input type="text" id="nim" name="nim" inputmode="numeric"
         value="<?= htmlspecialchars($nim, ENT_QUOTES, 'UTF-8') ?>">
  <button type="submit">Validasi</button>
</form>

<?php if ($pesan !== null): ?>
<?php if ($valid): ?>
  <div class="success-box"><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></div>
<?php else: ?>
  <div class="error-box"><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>
<?php endif; ?>

  <h3>Dokumentasi uji</h3>
  <table>
    <tr>
      <th>Input NIM</th>
      <th>Hasil</th>
      <th>Penyebab</th>
    </tr>
    <tr>
      <td><code>312510492</code></td>
      <td style="color:#059669;font-weight:700">VALID</td>
      <td>9 digit, semua angka</td>
    </tr>
    <tr>
      <td><code>3125000001</code></td>
      <td style="color:#059669;font-weight:700">VALID</td>
      <td>10 digit, masih dalam batas</td>
    </tr>
    <tr>
      <td><code>31-25-0492</code></td>
      <td style="color:#dc2626;font-weight:700">INVALID</td>
      <td>Mengandung bukan angka (<code>ctype_digit()</code> gagal)</td>
    </tr>
    <tr>
      <td><code>&nbsp;31251049&nbsp;</code> (8 digit)</td>
      <td style="color:#dc2626;font-weight:700">INVALID</td>
      <td>Terlalu pendek (&lt; 9 digit)</td>
    </tr>
    <tr>
      <td><code>31251049212345</code></td>
      <td style="color:#dc2626;font-weight:700">INVALID</td>
      <td>Terlalu panjang (&gt; 10 digit)</td>
    </tr>
    <tr>
      <td><code>&quot;&quot;</code> (kosong)</td>
      <td style="color:#dc2626;font-weight:700">INVALID</td>
      <td>NIM wajib diisi</td>
    </tr>
  </table>

  <h3>Kode validasi</h3>
  <pre>$nim = trim($_POST["nim"] ?? "");

if ($nim === "") {
    $pesan = "NIM wajib diisi.";
} elseif (!ctype_digit($nim)) {
    $pesan = "NIM hanya boleh berisi angka 0-9.";
} elseif (strlen($nim) &lt; NIM_MIN) {
    $pesan = "NIM terlalu pendek.";
} elseif (strlen($nim) &gt; NIM_MAX) {
    $pesan = "NIM terlalu panjang.";
} else {
    $pesan = "NIM valid.";
}</pre>

  <div class="note">
    <strong>Penting:</strong> <code>ctype_digit()</code> menolak string seperti
    <code>&quot;3125 10492&quot;</code> (ada spasi) dan <code>&quot;-123&quot;</code> (tanda negatif),
    jadi NIM benar-benar hanya angka. Validasi yang sama diterapkan pada
    <code>miniproject.php</code>.
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
