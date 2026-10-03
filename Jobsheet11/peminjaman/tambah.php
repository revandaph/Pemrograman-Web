<?php
require_once __DIR__ . '/../includes/auth.php';
require_once '../includes/koneksi.php';

$buku_list = $pdo->query("SELECT id, judul FROM buku ORDER BY judul ASC")->fetchAll();
$anggota_list = $pdo->query("SELECT id, nama FROM anggota ORDER BY nama ASC")->fetchAll();

include '../includes/header.php';
?>

<h2>Form Peminjaman Buku</h2>

<form action="proses_tambah.php" method="POST">
    <label for="buku_id">Pilih Buku:</label>
    <select name="buku_id" id="buku_id" required>
        <option value="">-- Pilih Buku --</option>
        <?php foreach ($buku_list as $b): ?>
            <option value="<?= $b['id'] ?>"><?= htmlspecialchars($b['judul']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="anggota_id">Pilih Anggota:</label>
    <select name="anggota_id" id="anggota_id" required>
        <option value="">-- Pilih Anggota --</option>
        <?php foreach ($anggota_list as $a): ?>
            <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nama']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="tanggal_pinjam">Tanggal Pinjam:</label>
    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="<?= date('Y-m-d') ?>" required>

    <br><br>
    <button type="submit" class="btn">Simpan Transaksi</button>
    <a href="list.php" style="margin-left: 10px; color: #666;">Batal</a>
</form>

<?php include '../includes/footer.php'; ?>