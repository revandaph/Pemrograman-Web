<?php
require_once '../includes/koneksi.php';

$stmt = $pdo->query("SELECT * FROM buku ORDER BY id DESC");
$daftar_buku = $stmt->fetchAll();

include '../includes/header.php';
?>

<h2>Daftar Buku</h2>
<a href="tambah.php" class="btn">+ Tambah Buku Baru</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>ISBN</th>
            <th>Stok</th>
            <th>Kategori</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_buku) > 0): ?>
            <?php foreach ($daftar_buku as $buku): ?>
                <tr>
                    <td><?= htmlspecialchars($buku['id']) ?></td>
                    <td><?= htmlspecialchars($buku['judul']) ?></td>
                    <td><?= htmlspecialchars($buku['pengarang']) ?></td>
                    <td><?= htmlspecialchars($buku['tahun']) ?></td>
                    <td><?= htmlspecialchars($buku['isbn']) ?></td>
                    <td><?= htmlspecialchars($buku['stok']) ?></td>
                    <td><?= htmlspecialchars($buku['kategori']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;">Belum ada data buku.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>