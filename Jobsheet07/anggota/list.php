<?php
$page_title = "SIMPUS-Mini | Daftar Anggota";
include '../includes/header.php';

if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [
        ["no_anggota" => "A001", "nama" => "Revalinda Putri Hadinata", "alamat" => "Malang", "no_hp" => "0812xxxx", "tgl_bergabung" => "12-08-2024", "email" => "revalinda@gmail.com"],
        ["no_anggota" => "A002", "nama" => "Kazzama Haqi Al-Fatih", "alamat" => "Batu", "no_hp" => "0813xxxx", "tgl_bergabung" => "22-11-2025", "email" => "kazzama@gmail.com"]
    ];
}

$anggota_list = $_SESSION['anggota'];
?>

        <section>
            <h2>Daftar Anggota</h2>
            <div class="table-responsive">
                <div style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 0.5rem;">
                    <input type="search" id="search-input" placeholder="Cari berdasarkan Nama..." style="margin-bottom: 0;">
                    <button type="button" id="btn-reload-anggota" style="padding: 0.55rem 1rem; background-color: #5c3d2e; color: white; border: none; border-radius: 4px; cursor: pointer; white-space: nowrap;">Muat Ulang</button>
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
                                    <td><?= htmlspecialchars($row['tgl_bergabung'] ?? '-') ?></td>
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