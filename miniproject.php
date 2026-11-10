<?php
/**
 * miniproject.php — Mini Project: Aplikasi Formulir Data Mahasiswa
 *
 * - Form POST: nama, NIM, program studi, semester, email.
 * - Validasi server-side: wajib diisi, NIM hanya angka (9-10 digit),
 *   semester bilangan bulat 1-14, email format valid.
 * - Data ditampilkan kembali dengan htmlspecialchars().
 * - Pemrosesan data dipisahkan dari tampilan HTML.
 */
$title = 'Mini Project — Formulir Data Mahasiswa';
require 'partials/top.php';

// ==================== PENGOLAHAN DATA (SEBELUM TAMPILAN) ====================
$data  = null;
$error = [];

// Ketentuan NIM (Eksperimen 4): hanya angka, panjang 9-10 digit
define('NIM_MIN', 9);
define('NIM_MAX', 10);
define('SEMESTER_MIN', 1);
define('SEMESTER_MAX', 14);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama          = trim($_POST["nama"] ?? "");
    $nimRaw        = trim($_POST["nim"] ?? "");
    $prodi         = trim($_POST["prodi"] ?? "");
    $semesterInput = $_POST["semester"] ?? "";
    $email         = trim($_POST["email"] ?? "");

    // Validasi nama: wajib diisi
    if ($nama === "") {
        $error[] = "Nama wajib diisi.";
    }

    // Validasi NIM: wajib diisi, hanya angka, panjang sesuai ketentuan (Eksperimen 4)
    if ($nimRaw === "") {
        $error[] = "NIM wajib diisi.";
    } elseif (!ctype_digit($nimRaw)) {
        $error[] = "NIM hanya boleh berisi angka.";
    } elseif (strlen($nimRaw) < NIM_MIN || strlen($nimRaw) > NIM_MAX) {
        $error[] = "Panjang NIM harus " . NIM_MIN . "-" . NIM_MAX . " digit.";
    }

    // Validasi program studi: wajib diisi
    if ($prodi === "") {
        $error[] = "Program studi wajib diisi.";
    }

    // Validasi semester: bilangan bulat 1-14 (sesuai modul)
    if (!ctype_digit((string) $semesterInput) ||
        (int) $semesterInput < SEMESTER_MIN || (int) $semesterInput > SEMESTER_MAX) {
        $error[] = "Semester harus berupa angka " . SEMESTER_MIN . "-" . SEMESTER_MAX . ".";
    }

    // Validasi email: format valid (sesuai modul)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[] = "Format email tidak valid.";
    }

    if (!$error) {
        $data = compact("nama", "nimRaw", "prodi", "email");
        $data["nim"]      = $nimRaw;
        $data["semester"] = (int) $semesterInput;
        unset($data["nimRaw"]);
    }
}

// Pakai data preset (nilai form saat pertama dibuka)
$presetNama  = "Daniel Dasnial";
$presetNim   = "312510492";
$presetProdi = "Teknik Informatika";
$presetEmail = "daniel.dasnial@example.com";
$presetSem   = "3";

// Setelah submit, form tetap terisi dengan input terakhir (sticky form)
$vNama  = $_POST["nama"] ?? $presetNama;
$vNim   = $_POST["nim"]    ?? $presetNim;
$vProdi = $_POST["prodi"]  ?? $presetProdi;
$vSem   = $_POST["semester"] ?? $presetSem;
$vEmail = $_POST["email"]  ?? $presetEmail;

$semesterOptions = range(SEMESTER_MIN, SEMESTER_MAX);
?>

<!-- ==================== TAMPILAN HTML ==================== -->
<section class="card">
  <span class="tag">Mini Project</span>
  <h1>Formulir Data Mahasiswa</h1>
  <p>
    Aplikasi menerima data mahasiswa, memvalidasi di sisi <strong>server</strong>,
    lalu menampilkan ringkasan data. Semua kolom wajib diisi.
  </p>

  <form method="POST" action="" novalidate>
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" required
           value="<?= htmlspecialchars($vNama, ENT_QUOTES, 'UTF-8') ?>">

    <label for="nim">NIM (<?= NIM_MIN ?>&ndash;<?= NIM_MAX ?> digit angka)</label>
    <input type="text" id="nim" name="nim" inputmode="numeric" required
           value="<?= htmlspecialchars($vNim, ENT_QUOTES, 'UTF-8') ?>">

    <label for="prodi">Program Studi</label>
    <input type="text" id="prodi" name="prodi" required
           value="<?= htmlspecialchars($vProdi, ENT_QUOTES, 'UTF-8') ?>">

    <label for="semester">Semester</label>
    <select id="semester" name="semester" required>
<?php foreach ($semesterOptions as $opt): ?>
      <option value="<?= $opt ?>" <?= ((int) $vSem === $opt) ? 'selected' : '' ?>>Semester <?= $opt ?></option>
<?php endforeach; ?>
    </select>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required
           value="<?= htmlspecialchars($vEmail, ENT_QUOTES, 'UTF-8') ?>">

    <button type="submit">Kirim Data</button>
    <button type="reset">Reset</button>
  </form>

<?php if ($_SERVER["REQUEST_METHOD"] === "POST" && $error): ?>
  <div class="error-box">
    <strong>Terdapat kesalahan pada input:</strong>
    <ul>
<?php foreach ($error as $pesan): ?>
      <li><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></li>
<?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php if ($data !== null): ?>
  <div class="success-box">
    <p style="margin:0 0 8px"><strong>Ringkasan Data Mahasiswa (valid, diterima server)</strong></p>
    <table>
      <tr>
        <th style="width:180px">Nama</th>
        <td style="color:#1f2937"><?= htmlspecialchars($data["nama"], ENT_QUOTES, 'UTF-8') ?></td>
      </tr>
      <tr>
        <th style="width:180px">NIM</th>
        <td style="color:#1f2937"><?= htmlspecialchars($data["nim"], ENT_QUOTES, 'UTF-8') ?></td>
      </tr>
      <tr>
        <th style="width:180px">Program Studi</th>
        <td style="color:#1f2937"><?= htmlspecialchars($data["prodi"], ENT_QUOTES, 'UTF-8') ?></td>
      </tr>
      <tr>
        <th style="width:180px">Semester</th>
        <td style="color:#1f2937"><?= (int) $data["semester"] ?></td>
      </tr>
      <tr>
        <th style="width:180px">Email</th>
        <td style="color:#1f2937"><?= htmlspecialchars($data["email"], ENT_QUOTES, 'UTF-8') ?></td>
      </tr>
    </table>
  </div>
<?php endif; ?>

  <h3>Dokumentasi uji</h3>
  <table>
    <tr>
      <th>Kasus</th>
      <th>Input</th>
      <th>Hasil</th>
    </tr>
    <tr>
      <td><span style="color:#059669;font-weight:700">VALID</span></td>
      <td>Data lengkap: Daniel Dasnial, 312510492, Teknik Informatika, semester 3, email valid</td>
      <td>Ringkasan data mahasiswa ditampilkan</td>
    </tr>
    <tr>
      <td><span style="color:#059669;font-weight:700">VALID</span></td>
      <td>NIM lain 10 digit: <code>3125000001</code>, semester 14</td>
      <td>Diterima (sesuai batas atas ketentuan)</td>
    </tr>
    <tr>
      <td><span style="color:#dc2626;font-weight:700">INVALID</span></td>
      <td>Email <code>daniel@salah</code>; semester kosong</td>
      <td>Error: format email tidak valid + semester harus 1-14 (semua pesan muncul sekaligus)</td>
    </tr>
    <tr>
      <td><span style="color:#dc2626;font-weight:700">INVALID</span></td>
      <td>NIM <code>31-25-0492</code>; NIM pendek <code>12345</code></td>
      <td>Error: NIM hanya boleh angka + panjang NIM harus 9-10 digit</td>
    </tr>
  </table>

  <div class="note">
    <strong>Pengamanan output:</strong> seluruh data pengguna ditampilkan kembali lewat
    <code>htmlspecialchars()</code> agar tag HTML/script menjadi teks biasa (mencegah
    injeksi). Atribut <code>required</code> HTML hanya membantu; validasi PHP di atas
    adalah pemeriksaan utama.
  </div>
</section>

<?php require 'partials/bottom.php'; ?>
