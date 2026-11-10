<?php
/**
 * latihan4.php — Latihan 4: Membuat function
 * Function utama (hitungDiskon) sesuai modul, ditambah dua function:
 * hitungLuasPersegiPanjang() dan tentukanKelulusan().
 */
$title = 'Latihan 4 — Membuat Function';
require 'partials/top.php';

// ---------- Function sesuai modul ----------
function hitungDiskon($harga, $persen)
{
    $potongan = $harga * ($persen / 100);
    return $harga - $potongan;
}

// ---------- Function tambahan 1: luas persegi panjang ----------
function hitungLuasPersegiPanjang($panjang, $lebar)
{
    return $panjang * $lebar;
}

// ---------- Function tambahan 2: kelulusan berdasarkan nilai ----------
function tentukanKelulusan($nilai)
{
    if ($nilai >= 75) {
        return "Lulus";
    } elseif ($nilai >= 60) {
        return "Lulus Bersyarat";
    } else {
        return "Tidak Lulus";
    }
}

// ---------- Function tambahan 3: format Rupiah (dipakai eksperimen 3 juga) ----------
function formatRupiah($angka)
{
    return "Rp" . number_format((float) $angka, 0, ",", ".");
}

// Nilai default sesuai modul
$hargaDemo  = 150000;
$persenDemo = 10;
$hargaAkhir = hitungDiskon($hargaDemo, $persenDemo);

// Uji kombinasi lain melalui form GET
if (isset($_GET['harga'], $_GET['persen'])) {
    if (is_numeric($_GET['harga']) && (float) $_GET['harga'] >= 0 && is_numeric($_GET['persen'])) {
        $persenInput = (float) $_GET['persen'];
        if ($persenInput >= 0 && $persenInput <= 100) {
            $hargaDemo  = (float) $_GET['harga'];
            $persenDemo = $persenInput;
            $hargaAkhir = hitungDiskon($hargaDemo, $persenDemo);
        }
    }
}
?>

<section class="card">
  <span class="tag">Latihan 4</span>
  <h1>Membuat Function</h1>

  <div class="success-box">
<?php
echo "Harga setelah diskon: " . formatRupiah($hargaAkhir);
?>
  </div>

  <h3>Uji hitungDiskon()</h3>
  <form method="GET" action="">
    <label for="harga">Harga (Rp)</label>
    <input type="number" id="harga" name="harga" min="0" step="0.01"
           value="<?= htmlspecialchars($hargaDemo, ENT_QUOTES, 'UTF-8') ?>" required>

    <label for="persen">Diskon (%)</label>
    <input type="number" id="persen" name="persen" min="0" max="100" step="1"
           value="<?= htmlspecialchars($persenDemo, ENT_QUOTES, 'UTF-8') ?>" required>

    <button type="submit">Hitung Diskon</button>
  </form>

  <h3>Hasil function tambahan</h3>
  <table>
    <tr>
      <th>Function</th>
      <th>Input</th>
      <th>Hasil</th>
    </tr>
    <tr>
      <td><code>hitungLuasPersegiPanjang(8, 4)</code></td>
      <td>panjang = 8, lebar = 4</td>
      <td><?= hitungLuasPersegiPanjang(8, 4) ?></td>
    </tr>
    <tr>
      <td><code>tentukanKelulusan(78)</code></td>
      <td>nilai = 78</td>
      <td><?= tentukanKelulusan(78) ?></td>
    </tr>
    <tr>
      <td><code>tentukanKelulusan(63)</code></td>
      <td>nilai = 63</td>
      <td><?= tentukanKelulusan(63) ?></td>
    </tr>
    <tr>
      <td><code>tentukanKelulusan(40)</code></td>
      <td>nilai = 40</td>
      <td><?= tentukanKelulusan(40) ?></td>
    </tr>
    <tr>
      <td><code>hitungDiskon(150000, 10)</code></td>
      <td>harga = 150000, diskon = 10%</td>
      <td><?= formatRupiah(hitungDiskon(150000, 10)) ?></td>
    </tr>
  </table>

  <h3>Kode function</h3>
  <pre>function hitungDiskon($harga, $persen) {
    $potongan = $harga * ($persen / 100);
    return $harga - $potongan;
}

function hitungLuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

function tentukanKelulusan($nilai) {
    if ($nilai >= 75) return "Lulus";
    elseif ($nilai >= 60) return "Lulus Bersyarat";
    else return "Tidak Lulus";
}</pre>
</section>

<?php require 'partials/bottom.php'; ?>
