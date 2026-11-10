<?php
/**
 * latihan7.php — Latihan 7: Pengolahan data sederhana
 * Form nama barang, harga, jumlah → subtotal dan ringkasan transaksi.
 * Validasi server-side: nama wajib, harga numerik >= 0, jumlah bilangan bulat >= 1.
 */
$title = 'Latihan 7 — Pengolahan Data Sederhana';
require 'partials/top.php';

$hasil = null;
$error = null;
$barang = "";
$hargaInput = "";
$jumlahInput = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $barang      = trim($_POST["barang"] ?? "");
    $hargaInput  = $_POST["harga"] ?? "";
    $jumlahInput = $_POST["jumlah"] ?? "";

    if ($barang === "" || !is_numeric($hargaInput) ||
        !ctype_digit((string) $jumlahInput) ||
        (float) $hargaInput < 0 || (int) $jumlahInput < 1) {
        $error = "Periksa kembali nama barang, harga, dan jumlah.";
    } else {
        $harga     = (float) $hargaInput;
        $jumlah    = (int) $jumlahInput;
        $subtotal  = $harga * $jumlah;
        $hasil     = compact("barang", "harga", "jumlah", "subtotal");
    }
}

function formatRupiah($angka): string
{
    return "Rp" . number_format((float) $angka, 0, ",", ".");
}
?>

<section class="card">
  <span class="tag">Latihan 7</span>
  <h1>Pengolahan Data Sederhana</h1>
  <p>Masukkan data barang untuk menghitung subtotal dan menampilkan ringkasan transaksi.</p>

<form method="POST">
  <label for="barang">Nama barang</label>
  <input name="barang" id="barang" required value="<?= htmlspecialchars($barang, ENT_QUOTES, 'UTF-8') ?>">

  <label for="harga">Harga</label>
  <input name="harga" id="harga" type="number" min="0" step="0.01" required
         value="<?= htmlspecialchars($hargaInput, ENT_QUOTES, 'UTF-8') ?>">

  <label for="jumlah">Jumlah</label>
  <input name="jumlah" id="jumlah" type="number" min="1" step="1" required
         value="<?= htmlspecialchars($jumlahInput, ENT_QUOTES, 'UTF-8') ?>">

  <button type="submit">Hitung</button>
</form>

<?php if ($error !== null): ?>
  <div class="error-box"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<?php if ($hasil !== null): ?>
  <div class="success-box">
    <p><strong>Ringkasan transaksi</strong></p>
    <table>
      <tr>
        <th>Barang</th>
        <td><?= htmlspecialchars($hasil['barang'], ENT_QUOTES, 'UTF-8') ?></td>
      </tr>
      <tr>
        <th>Harga satuan</th>
        <td><?= formatRupiah($hasil['harga']) ?></td>
      </tr>
      <tr>
        <th>Jumlah</th>
        <td><?= $hasil['jumlah'] ?></td>
      </tr>
      <tr>
        <th>Subtotal</th>
        <td><strong><?= formatRupiah($hasil['subtotal']) ?></strong></td>
      </tr>
    </table>
  </div>
<?php endif; ?>

  <h3>Dokumentasi uji validasi</h3>
  <table>
    <tr>
      <th>Kasus</th>
      <th>Input</th>
      <th>Hasil</th>
    </tr>
    <tr>
      <td>Valid</td>
      <td>Kopi, harga 15000.50, jumlah 3</td>
      <td>Subtotal Rp45.002 (harga desimal diterima)</td>
    </tr>
    <tr>
      <td>Valid</td>
      <td>Buku, harga 5000, jumlah 10</td>
      <td>Subtotal Rp50.000</td>
    </tr>
    <tr>
      <td>Tidak valid</td>
      <td>jumlah = 0</td>
      <td>Error: &quot;Periksa kembali nama barang, harga, dan jumlah.&quot;</td>
    </tr>
    <tr>
      <td>Tidak valid</td>
      <td>jumlah = -5</td>
      <td>Ditolak (jumlah &lt; 1)</td>
    </tr>
    <tr>
      <td>Tidak valid</td>
      <td>harga = &quot;abc&quot;</td>
      <td>Ditolak (bukan numerik)</td>
    </tr>
    <tr>
      <td>Tidak valid</td>
      <td>barang kosong</td>
      <td>Ditolak (nama wajib diisi)</td>
    </tr>
  </table>

  <div class="note">
    <strong>Catatan:</strong> validasi HTML (atribut <code>required</code>, <code>min</code>,
    <code>step</code>) hanya membantu pengguna; validasi PHP tetap menjadi pemeriksaan utama.
    Batalkan validasi HTML lewat konsol browser (mis. mengirim manual dengan
    <code>fetch</code>) &mdash; server tetap menolak data yang tidak valid.
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
