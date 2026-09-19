<?php
$page_title = "SIMPUS-Mini | Beranda";
include 'includes/header.php';
include 'includes/koneksi.php';

try {
    $stmt_buku = $pdo->query("SELECT COUNT(*) AS total FROM buku");
    $total_buku = $stmt_buku->fetch()['total'];

    $stmt_anggota = $pdo->query("SELECT COUNT(*) AS total FROM anggota");
    $total_anggota = $stmt_anggota->fetch()['total'];
} catch (PDOException $e) {
    $total_buku = 0;
    $total_anggota = 0;
}
?>

<section>
    <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
    <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
</section>

<section>
    <h2>Ringkasan</h2>
    <article>
        <h3>Total Buku</h3>
        <p><?= $total_buku ?></p>
    </article>
    <article>
        <h3>Total Anggota</h3>
        <p><?= $total_anggota ?></p>
    </article>
    <article>
        <h3>Sedang Dipinjam</h3>
        <p>3</p>
    </article>
    <article>
        <h3>Buku Rusak</h3>
        <p>5</p>
    </article>
</section>

<?php include 'includes/footer.php'; ?>