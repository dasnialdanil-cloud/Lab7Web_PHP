<?php
/**
 * latihan6.php — Latihan 6: Memproses form dengan POST
 * Form nama + program studi dengan validasi server-side dan htmlspecialchars().
 */
$title = 'Latihan 6 — Form dengan POST';
require 'partials/top.php';

$nama  = "";
$prodi = "";
$error = "";
$sukses = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama  = trim($_POST["nama"] ?? "");
    $prodi = trim($_POST["prodi"] ?? "");

    if ($nama === "" || $prodi === "") {
        $error = "<p>Semua kolom wajib diisi.</p>";
    } else {
        $sukses = true;
    }
}
?>

<section class="card">
  <span class="tag">Latihan 6</span>
  <h1>Memproses Form dengan POST</h1>

<!-- index.php (versi halaman latihan6.php) -->
<form method="POST" action="">
  <label for="nama">Nama:</label>
  <input id="nama" name="nama" type="text" required
         value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>">

  <label for="prodi">Program Studi:</label>
  <input id="prodi" name="prodi" type="text" required
         value="<?= htmlspecialchars($prodi, ENT_QUOTES, 'UTF-8') ?>">

  <button type="submit" name="kirim">Kirim Data</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($error !== "") {
        echo $error;
    } else {
        echo "<h3>Data diterima</h3>";
        echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, "UTF-8") . "<br>";
        echo "Program Studi: " . htmlspecialchars($prodi, ENT_QUOTES, "UTF-8");
    }
}
?>

<?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
  <div class="<?= $sukses ? 'success-box' : 'note' ?>">
    <?php if ($sukses): ?>
      <p><strong>Validasi server berhasil!</strong> Data diterima melalui POST —
         data <strong>tidak terlihat di URL</strong> (bandingkan dengan Latihan 5).</p>
    <?php else: ?>
      <p><strong>Kasus input tidak valid:</strong> kolom kosong tetap ditolak oleh validasi
         PHP meskipun form memiliki atribut <code>required</code> (HTML5).</p>
    <?php endif; ?>
  </div>
<?php endif; ?>

  <h3>Dokumentasi uji</h3>
  <table>
    <tr>
      <th>Data</th>
      <th>Hasil</th>
    </tr>
    <tr>
      <td>Nama: Daniel Dasnial, Prodi: Teknik Informatika (lengkap)</td>
      <td>&quot;Data diterima&quot; ditampilkan dengan aman</td>
    </tr>
    <tr>
      <td>Nama: <code>&lt;script&gt;alert('x')&lt;/script&gt;</code></td>
      <td>Tampil sebagai <em>teks</em>, bukan dijalankan &mdash; aman karena
          <code>htmlspecialchars()</code></td>
    </tr>
    <tr>
      <td>Salah satu kolom kosong</td>
      <td>&quot;Semua kolom wajib diisi.&quot;</td>
    </tr>
    <tr>
      <td>Kedua kolom kosong</td>
      <td>Ditolak validasi server-side</td>
    </tr>
  </table>
</section>

<?php require 'partials/bottom.php'; ?>
