<?php
session_start();

// Menghapus semua data session
session_unset();
session_destroy();

// Mulai session baru khusus untuk mengirim flash message
session_start();
$_SESSION['flash'] = [
    'type' => 'success',
    'message' => 'Seluruh data session berhasil di-reset!'
];

header("Location: index.php");
exit;