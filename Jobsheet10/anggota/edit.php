<?php
require_once '../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute([':id' => $id]);
$anggota = $stmt->fetch();

if (!$anggota) {
    header('Location: list.php');
    exit;
}

include '../includes/header.php';
?>

<h2>Edit Anggota</h2>

<form action="proses_edit.php" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($anggota['id']) ?>">

    <label for="nama">Nama Lengkap:</label>
    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($anggota['nama']) ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($anggota['email']) ?>" required>

    <label for="telepon">Nomor Telepon:</label>
    <input type="text" id="telepon" name="telepon" value="<?= htmlspecialchars($anggota['telepon']) ?>" required>

    <label for="alamat">Alamat:</label>
    <textarea id="alamat" name="alamat" rows="4" required><?= htmlspecialchars($anggota['alamat']) ?></textarea>

    <br><br>
    <button type="submit" class="btn">Simpan Perubahan</button>
    <a href="list.php" style="margin-left: 15px; color: #666; text-decoration: none;">Batal</a>
</form>

<?php include '../includes/footer.php'; ?>