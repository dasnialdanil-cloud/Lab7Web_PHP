<?php
/**
 * cari.php — Latihan 5: Memproses form dengan GET
 * Data dikirim melalui parameter URL; sesuai modul tidak untuk data sensitif.
 */
$title = 'Latihan 5 — Form dengan GET';
require 'partials/top.php';
?>

<section class="card">
  <span class="tag">Latihan 5</span>
  <h1>Memproses Form dengan GET</h1>

  <!-- cari.php -->
  <form method="GET" action="">
    <label for="kata">Kata kunci:</label>
    <input id="kata" name="kata" type="text">
    <button type="submit">Cari</button>
  </form>

<?php
if (isset($_GET["kata"])) {
    $kata = trim($_GET["kata"]);
    echo "Kata kunci: " . htmlspecialchars($kata, ENT_QUOTES, "UTF-8");
}
?>

<?php if (isset($_GET["kata"])): ?>
  <div class="success-box">
    <p>Form sudah dikirim dengan metode <strong>GET</strong>.</p>
    <p>Perhatikan URL di address bar — data muncul sebagai parameter:
       <code>?kata=<?= htmlspecialchars(trim($_GET["kata"]), ENT_QUOTES, 'UTF-8') ?></code></p>
  </div>
<?php endif; ?>

  <h3>Dokumentasi uji</h3>
  <table>
    <tr>
      <th>Input</th>
      <th>URL yang terbentuk</th>
      <th>Output</th>
    </tr>
    <tr>
      <td><code>php</code></td>
      <td><code>cari.php?kata=php</code></td>
      <td>Kata kunci: php</td>
    </tr>
    <tr>
      <td><code>&lt;b&gt;hai&lt;/b&gt;</code></td>
      <td><code>cari.php?kata=%3Cb%3Ehai%3C%2Fb%3E</code></td>
      <td>Kata kunci: <b>hai</b> (tidak dieksekusi — aman karena <code>htmlspecialchars()</code>)</td>
    </tr>
    <tr>
      <td><code>&nbsp;</code> (kosong/spasi)</td>
      <td><code>cari.php?kata=</code></td>
      <td>Kata kunci: (string kosong, trim() memotong spasi)</td>
    </tr>
  </table>

  <div class="note">
    <strong>Catatan keamanan:</strong> GET mengirim data melalui URL sehingga terekam pada
    history browser, log server, dan bisa dibagikan sebagai link. Jangan gunakan GET untuk
    mengirim kata sandi atau data sensitif — gunakan POST (Latihan 6).
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
