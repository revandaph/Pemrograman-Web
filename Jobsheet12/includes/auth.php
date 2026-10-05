<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

function require_role($allowed_roles = []) {
    if (!is_array($allowed_roles)) {
        $allowed_roles = [$allowed_roles];
    }
    
    $user_role = $_SESSION['role'] ?? 'petugas';
    
    if (!in_array($user_role, $allowed_roles)) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Akses ditolak: Anda tidak memiliki izin (peran) untuk melakukan aksi ini.'
        ];
        header('Location: list.php');
        exit;
    }
}