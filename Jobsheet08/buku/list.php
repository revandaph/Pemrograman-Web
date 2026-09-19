<?php
$page_title = "SIMPUS-Mini | Daftar Buku";
include '../includes/header.php';
include '../includes/koneksi.php';

try {
    $stmt = $pdo->query("SELECT * FROM buku ORDER BY id DESC");
    $buku_list = $stmt->fetchAll();
} catch (PDOException $e) {
    $buku_list = [];
}
?>

<section>
    <h2>Daftar Buku</h2>
    <div class="table-responsive">
        <div style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 0.5rem;">
            <input type="search" id="search-input" placeholder="Cari buku berdasarkan judul..." style="margin-bottom: 0;">
        </div>
        <p id="table-counter">Menampilkan <?= count($buku_list) ?> data</p>
        <table id="tabel-buku">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($buku_list)): ?>
                    <tr><td colspan="6" style="text-align:center;">Belum ada data buku.</td></tr>
                <?php else: ?>
                    <?php foreach ($buku_list as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['judul']) ?></td>
                            <td><?= htmlspecialchars($row['pengarang']) ?></td>
                            <td><?= htmlspecialchars($row['tahun']) ?></td>
                            <td><?= htmlspecialchars($row['stok']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td>
                                <button type="button" class="btn-edit">Edit</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include '../includes/footer.php'; ?>