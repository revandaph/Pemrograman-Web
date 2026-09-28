<?php
require_once '../includes/koneksi.php';

$q = trim($_GET['q'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

if ($q !== '') {
    $countStmt = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :kw OR pengarang ILIKE :kw");
    $countStmt->execute([':kw' => "%$q%"]);
    $totalData = $countStmt->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :kw OR pengarang ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':kw', "%$q%", PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $totalData = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM buku ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
}

$totalPages = ceil($totalData / $limit);
$daftar_buku = $stmt->fetchAll();

include '../includes/header.php';
?>

<h2>Daftar Buku</h2>
<a href="tambah.php" class="btn">+ Tambah Buku Baru</a>

<form method="GET" action="list.php" style="margin-bottom: 20px; padding: 10px; background: none; box-shadow: none;">
    <input type="text" id="search-input" name="q" value="<?= $q ?>" placeholder="Cari judul / pengarang..." style="width: 250px; display: inline-block;">
    <button type="submit" class="btn" style="padding: 10px 15px;">Cari</button>
    <?php if ($q !== ''): ?>
        <a href="list.php" style="margin-left: 10px; text-decoration: none; color: #666;">Reset</a>
    <?php endif; ?>
</form>

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
            <th>Aksi</th>
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
                    <td>
                        <a href="edit.php?id=<?= $buku['id'] ?>" style="color: #007bff; text-decoration: none; font-weight: bold; margin-right: 10px;">Edit</a>
                        <form action="hapus.php" method="POST" class="form-hapus" style="display: inline; padding: 0; background: none; box-shadow: none;">
                            <input type="hidden" name="id" value="<?= $buku['id'] ?>">
                            <button type="submit" style="color: #dc3545; background: none; border: none; cursor: pointer; font-weight: bold; padding: 0;">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align:center;">Data tidak ditemukan.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if ($totalPages > 1): ?>
    <div style="margin-top: 20px; text-align: center;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="list.php?page=<?= $i ?>&q=<?= urlencode($q) ?>" style="padding: 8px 12px; margin: 2px; border: 1px solid #4a3525; text-decoration: none; border-radius: 4px; <?= $i === $page ? 'background: #4a3525; color: white;' : 'color: #333;' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>