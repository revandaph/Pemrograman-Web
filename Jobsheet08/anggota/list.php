<?php
$page_title = "SIMPUS-Mini | Daftar Anggota";
include '../includes/header.php';
include '../includes/koneksi.php';

try {
    $stmt = $pdo->query("SELECT * FROM anggota ORDER BY id DESC");
    $anggota_list = $stmt->fetchAll();
} catch (PDOException $e) {
    $anggota_list = [];
}
?>

<section>
    <h2>Daftar Anggota</h2>
    <div class="table-responsive">
        <div style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 0.5rem;">
            <input type="search" id="search-input" placeholder="Cari berdasarkan Nama..." style="margin-bottom: 0;">
        </div>
        <p id="table-counter">Menampilkan <?= count($anggota_list) ?> data</p>
        <table id="tabel-anggota">
            <thead>
                <tr>
                    <th>No. Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Tanggal Bergabung</th>
                    <th>E-mail</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($anggota_list)): ?>
                    <tr><td colspan="7" style="text-align:center;">Belum ada data anggota.</td></tr>
                <?php else: ?>
                    <?php foreach ($anggota_list as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['no_anggota']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['alamat'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($row['no_hp'] ?? '-') ?></td>
                            <td><?= htmlspecialchars(date('d-m-Y', strtotime($row['tgl_bergabung']))) ?></td>
                            <td><?= htmlspecialchars($row['email'] ?? '-') ?></td>
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