<?php
require_once '../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute([':id' => $id]);
$buku = $stmt->fetch();

if (!$buku) {
    header('Location: list.php');
    exit;
}

include '../includes/header.php';
?>

<h2>Edit Buku</h2>

<form action="proses_edit.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($buku['id']) ?>">

    <label for="judul">Judul Buku:</label>
    <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required>

    <label for="pengarang">Pengarang:</label>
    <input type="text" id="pengarang" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']) ?>" required>

    <label for="tahun">Tahun Terbit:</label>
    <input type="number" id="tahun" name="tahun" min="1900" max="<?= date('Y') ?>" value="<?= htmlspecialchars($buku['tahun']) ?>" required>

    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($buku['isbn']) ?>" required>

    <label for="stok">Jumlah Stok:</label>
    <input type="number" id="stok" name="stok" min="0" value="<?= htmlspecialchars($buku['stok']) ?>" required>

    <label for="kategori">Kategori:</label>
    <input type="text" id="kategori" name="kategori" value="<?= htmlspecialchars($buku['kategori']) ?>" required>

    <br><br>
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a href="list.php" style="margin-left: 15px; color: #666; text-decoration: none;">Batal</a>
</form>

<?php include '../includes/footer.php'; ?>