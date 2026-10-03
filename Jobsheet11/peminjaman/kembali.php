<?php
require_once __DIR__ . '/../includes/auth.php';
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0) {
        $stmt = $pdo->prepare("UPDATE peminjaman SET status = 'dikembalikan', tanggal_kembali = CURRENT_DATE WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'pesan' => 'Buku berhasil dikembalikan!'
        ];
    }
}

header('Location: list.php');
exit;