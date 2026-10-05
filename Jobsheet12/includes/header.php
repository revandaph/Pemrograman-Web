<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';

$sudahLogin = isset($_SESSION['user_id']);

$base = sprintf(
    "%s://%s%s/",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['HTTP_HOST'],
    rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\')
);

if (in_array(basename(dirname($_SERVER['SCRIPT_NAME'])), ['buku', 'anggota', 'auth', 'peminjaman'])) {
    $base = dirname($base) . '/';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Mini | Sistem Informasi Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f8f9fa; color: #333; }
        header { 
            background-color: #4a3525; 
            color: white; 
            padding: 15px 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: relative;
        }
        header h1 { margin: 0; font-size: 22px; white-space: nowrap; }
        nav { display: flex; gap: 15px; align-items: center; }
        nav a { color: #f8f9fa; text-decoration: none; font-weight: bold; font-size: 14px; }
        nav a:hover { color: #ffca28; }
        .auth-status { display: flex; align-items: center; gap: 15px; }
        .auth-status a { color: #ffca28; text-decoration: underline; font-weight: bold; }
        .role-badge { 
            background: #ffca28; 
            color: #4a3525; 
            padding: 2px 8px; 
            border-radius: 4px; 
            font-size: 11px; 
            font-weight: bold; 
            text-transform: uppercase; 
            margin-left: 5px;
        }
        .container { padding: 30px; max-width: 1000px; margin: auto; }
        .card-container { display: flex; gap: 20px; margin-top: 20px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex: 1; text-align: center; }
        .card h3 { margin-top: 0; color: #4a3525; }
        .card p { font-size: 36px; font-weight: bold; margin: 10px 0 0; color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { background-color: #4a3525; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .btn { display: inline-block; padding: 10px 18px; background: #4a3525; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; border: none; cursor: pointer; font-weight: bold; }
        .btn:hover { background: #332419; }
        form { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        form label { display: block; margin-top: 12px; font-weight: bold; }
        form input, form select, form textarea { width: 100%; padding: 10px; margin-top: 5px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
    </style>
</head>
<body>
<header>
    <h1>SIMPUS-Mini</h1>
    <nav>
        <a href="<?= $base ?>index.php">Beranda</a>
        <a href="<?= $base ?>buku/list.php">Daftar Buku</a>
        <?php if ($sudahLogin): ?>
            <a href="<?= $base ?>buku/tambah.php">Tambah Buku</a>
            <a href="<?= $base ?>anggota/list.php">Daftar Anggota</a>
            <a href="<?= $base ?>anggota/tambah.php">Tambah Anggota</a>
            <a href="<?= $base ?>peminjaman/list.php">Peminjaman</a>
        <?php endif; ?>
    </nav>
    <div class="auth-status">
        <?php if ($sudahLogin): ?>
            <span>
                Halo, <strong><?= e($_SESSION['nama']) ?></strong>
                <span class="role-badge"><?= e($_SESSION['role'] ?? 'petugas') ?></span>
            </span>
            <a href="<?= $base ?>auth/logout.php">Logout</a>
        <?php else: ?>
            <a href="<?= $base ?>auth/login.php">Login</a>
        <?php endif; ?>
    </div>
</header>
<div class="container">

<?php
if (isset($_SESSION['flash'])) {
    $type   = $_SESSION['flash']['type'] === 'error' ? '#f8d7da' : '#d4edda';
    $color  = $_SESSION['flash']['type'] === 'error' ? '#721c24' : '#155724';
    $border = $_SESSION['flash']['type'] === 'error' ? '#f5c6cb' : '#c3e6cb';
    
    echo '<div style="background-color: ' . $type . '; color: ' . $color . '; border: 1px solid ' . $border . '; padding: 12px; border-radius: 5px; margin-bottom: 20px;">';
    echo e($_SESSION['flash']['pesan']);
    echo '</div>';

    unset($_SESSION['flash']);
}
?>