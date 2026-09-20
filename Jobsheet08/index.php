<?php
require_once 'includes/koneksi.php';

try {
    $total_buku    = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
    $total_anggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
} catch (PDOException $e) {
    die("Gagal mengambil data statistik: " . $e->getMessage());
}

include 'includes/header.php';
?>

<h2>Beranda SIMPUS-Mini</h2>
<p>Selamat datang di Sistem Informasi Perpustakaan Mini berbasis PHP PDO dan PostgreSQL.</p>

<div class="card-container">
    <div class="card">
        <h3>Total Buku</h3>
        <p><?= htmlspecialchars($total_buku) ?></p>
    </div>
    <div class="card">
        <h3>Total Anggota</h3>
        <p><?= htmlspecialchars($total_anggota) ?></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>