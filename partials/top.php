<?php
/**
 * partials/top.php
 * Bagian atas halaman: <head>, navigasi, dan pembuka <main>.
 * Halaman lain cukup men-set $title lalu require file ini.
 */
$title = $title ?? 'Praktikum 7 PHP';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🐘</text></svg>">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="topbar">
  <div class="brand">Praktikum 7 &mdash; PHP Server-Side</div>
  <nav>
    <a href="index.php">Beranda</a>
    <a href="latihan1.php">Latihan 1</a>
    <a href="latihan2.php">Latihan 2</a>
    <a href="latihan3.php">Latihan 3</a>
    <a href="latihan4.php">Latihan 4</a>
    <a href="cari.php">Latihan 5</a>
    <a href="latihan6.php">Latihan 6</a>
    <a href="latihan7.php">Latihan 7</a>
    <a href="miniproject.php">Mini Project</a>
    <a href="eksperimen1.php">Eksperimen 1</a>
    <a href="eksperimen2.php">Eksperimen 2</a>
    <a href="eksperimen3.php">Eksperimen 3</a>
    <a href="eksperimen4.php">Eksperimen 4</a>
    <a href="eksperimen5.php">Eksperimen 5</a>
  </nav>
</header>
<main class="container">
