<?php
$page_title = "SIMPUS-Mini | Daftar Buku";
include '../includes/header.php';

if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [
        ["id" => 1, "judul" => "Laskar Pelangi", "pengarang" => "Andrea Hirata", "tahun" => 2005, "stok" => 4, "kategori" => "Fiksi"],
        ["id" => 2, "judul" => "Bumi Manusia", "pengarang" => "Pramoedya Ananta Toer", "tahun" => 1980, "stok" => 2, "kategori" => "Fiksi"],
        ["id" => 3, "judul" => "Filosofi Teras", "pengarang" => "Henry Manampiring", "tahun" => 2018, "stok" => 5, "kategori" => "Non-Fiksi"]
    ];
}

$buku_list = $_SESSION['buku'];
?>

        <section>
            <h2>Daftar Buku</h2>
            <div class="table-responsive">
                <div style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 0.5rem;">
                    <input type="search" id="search-input" placeholder="Cari buku berdasarkan judul..." style="margin-bottom: 0;">
                    <button type="button" id="btn-reload" style="padding: 0.55rem 1rem; background-color: #5c3d2e; color: white; border: none; border-radius: 4px; cursor: pointer; white-space: nowrap;">Muat Ulang</button>
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