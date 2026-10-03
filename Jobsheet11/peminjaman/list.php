<?php
require_once __DIR__ . '/../includes/auth.php';
require_once '../includes/koneksi.php';

$query = "
    SELECT p.*, b.judul AS judul_buku, a.nama AS nama_anggota 
    FROM peminjaman p
    JOIN buku b ON p.buku_id = b.id
    JOIN anggota a ON p.anggota_id = a.id
    ORDER BY p.id DESC
";
$daftar_peminjaman = $pdo->query($query)->fetchAll();

include '../includes/header.php';
?>

<h2>Daftar Transaksi Peminjaman</h2>
<a href="tambah.php" class="btn">+ Catat Peminjaman Baru</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul Buku</th>
            <th>Nama Anggota</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_peminjaman) > 0): ?>
            <?php foreach ($daftar_peminjaman as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['judul_buku']) ?></td>
                    <td><?= htmlspecialchars($p['nama_anggota']) ?></td>
                    <td><?= $p['tanggal_pinjam'] ?></td>
                    <td><?= $p['tanggal_kembali'] ?? '-' ?></td>
                    <td>
                        <strong style="color: <?= $p['status'] === 'dipinjam' ? '#d9534f' : '#5cb85c' ?>;">
                            <?= strtoupper($p['status']) ?>
                        </strong>
                    </td>
                    <td>
                        <?php if ($p['status'] === 'dipinjam'): ?>
                            <form action="kembali.php" method="POST" style="display:inline; padding:0; background:none; box-shadow:none;">
                                <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                <button type="submit" style="color: green; background:none; border:none; cursor:pointer; font-weight:bold; padding:0;">Proses Kembali</button>
                            </form>
                        <?php else: ?>
                            <span style="color: #888;">Selesai</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;">Belum ada transaksi peminjaman.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>