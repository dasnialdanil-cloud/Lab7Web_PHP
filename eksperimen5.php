<?php
/**
 * eksperimen5.php — Eksperimen Mandiri 5
 * Menambahkan tombol reset pada form dan menjelaskan perbedaannya
 * dengan pemrosesan ulang di server.
 */
$title = 'Eksperimen 5 — Tombol Reset';
require 'partials/top.php';

$nama = "";
$pesan = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["nama"] ?? "");

    if ($nama === "") {
        $pesan = ["tipe" => "error", "isi" => "Nama wajib diisi. (Server memproses request POST lagi)"];
    } else {
        $pesan = ["tipe" => "success", "isi" => "Data diproses oleh server! Nama: " . htmlspecialchars($nama, ENT_QUOTES, 'UTF-8')];
    }
}
?>

<section class="card">
  <span class="tag">Eksperimen Mandiri 5</span>
  <h1>Tombol Reset pada Form</h1>

<form method="POST" action="">
  <label for="nama">Nama</label>
  <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>">

  <button type="submit">Kirim (diproses server)</button>
  <button type="reset">Reset</button>
</form>

<?php if ($pesan !== null): ?>
  <div class="<?= $pesan['tipe'] === 'success' ? 'success-box' : 'error-box' ?>">
    <?= $pesan['tipe'] === 'success' ? $pesan['isi'] : htmlspecialchars($pesan['isi'], ENT_QUOTES, 'UTF-8') ?>
  </div>
<?php endif; ?>

  <h2>Reset vs Pemrosesan Ulang di Server</h2>
  <table>
    <tr>
      <th>Aspek</th>
      <th>Tombol Reset</th>
      <th>Pemrosesan Ulang di Server</th>
    </tr>
    <tr>
      <td>Penanganan</td>
      <td>100% di <strong>browser</strong> (client-side)</td>
      <td><strong>Server</strong> menerima HTTP request baru</td>
    </tr>
    <tr>
      <td>Request ke server?</td>
      <td><strong>Tidak ada</strong> &mdash; tidak ada data dikirim</td>
      <td><strong>Ada</strong> &mdash; POST/GET baru dikirim dan diproses PHP</td>
    </tr>
    <tr>
      <td>Efek pada form</td>
      <td>Mengosongkan input kembali nilai awal; server tidak tahu apa-apa</td>
      <td>Server memvalidasi ulang seluruh data yang dikirim</td>
    </tr>
    <tr>
      <td>Terlihat di URL network?</td>
      <td>Tidak muncul apa pun di tab Network</td>
      <td>Muncul request baru dengan payload form</td>
    </tr>
    <tr>
      <td>Aman untuk data sensitif?</td>
      <td>Ya, tidak mengirim ulang apa pun</td>
      <td>PUT/POST berulang perlu hati-hati (double submit)</td>
    </tr>
  </table>

  <div class="note">
    <strong>Verifikasi cepat:</strong> buka DevTools tab <em>Network</em>, isi nama lalu klik
    <strong>Reset</strong> &mdash; tidak ada request baru, kolom hanya terosongkan di browser.
    Sedangkan klik <strong>Kirim</strong> menimbulkan request POST yang diproses PHP
    (hasilnya terlihat pada pesan di atas).
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
