<?php
require_once '../includes/koneksi.php';

$stmt = $pdo->query("SELECT * FROM anggota ORDER BY id DESC");
$daftar_anggota = $stmt->fetchAll();

include '../includes/header.php';
?>

<h2>Daftar Anggota</h2>
<a href="tambah.php" class="btn">+ Tambah Anggota Baru</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_anggota) > 0): ?>
            <?php foreach ($daftar_anggota as $anggota): ?>
                <tr>
                    <td><?= htmlspecialchars($anggota['id']) ?></td>
                    <td><?= htmlspecialchars($anggota['nama']) ?></td>
                    <td><?= htmlspecialchars($anggota['email']) ?></td>
                    <td><?= htmlspecialchars($anggota['telepon']) ?></td>
                    <td><?= htmlspecialchars($anggota['alamat']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align:center;">Belum ada data anggota.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>