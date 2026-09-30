<?php
require_once __DIR__ . '/../includes/auth.php';
require_role('admin');

require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);

    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
        $stmt->execute([':id' => $id]);
        
        $_SESSION['flash'] = [
            'type' => 'success',
            'pesan' => 'Data anggota berhasil dihapus.'
        ];
    }
}

header('Location: list.php');
exit;