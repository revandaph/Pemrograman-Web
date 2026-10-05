<?php
require_once __DIR__ . '/../includes/auth.php';
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buku_id        = (int)($_POST['buku_id'] ?? 0);
    $anggota_id     = (int)($_POST['anggota_id'] ?? 0);
    $tanggal_pinjam = $_POST['tanggal_pinjam'] ?? date('Y-m-d');

    if ($buku_id > 0 && $anggota_id > 0) {
        $stmt = $pdo->prepare("INSERT INTO peminjaman (buku_id, anggota_id, tanggal_pinjam) VALUES (:buku_id, :anggota_id, :tanggal_pinjam)");
        $stmt->execute([
            ':buku_id'        => $buku_id,
            ':anggota_id'     => $anggota_id,
            ':tanggal_pinjam' => $tanggal_pinjam,
        ]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'pesan' => 'Peminjaman buku berhasil dicatat.'
        ];
    } else {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Pilih buku dan anggota dengan benar.'
        ];
    }
}

header('Location: list.php');
exit;