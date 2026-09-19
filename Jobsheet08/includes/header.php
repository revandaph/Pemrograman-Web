<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_dir = basename(dirname($_SERVER['SCRIPT_NAME']));
if (in_array($current_dir, ['buku', 'anggota'])) {
    $base = "../";
} else {
    $base = "";
}

$page_title = $page_title ?? 'SIMPUS-Mini';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
    <script src="<?= $base ?>assets/js/app.js"></script>
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <nav>
            <ul>
                <li><a href="<?= $base ?>index.php">Beranda</a></li>
                <li><a href="<?= $base ?>buku/list.php">Daftar Buku</a></li>
                <li><a href="<?= $base ?>buku/tambah.php">Tambah Buku</a></li>
                <li><a href="<?= $base ?>anggota/list.php">Daftar Anggota</a></li>
                <li><a href="<?= $base ?>anggota/tambah.php">Tambah Anggota</a></li>
                <li><a href="<?= $base ?>reset_session.php" onclick="return confirm('Yakin ingin mereset seluruh data session?');" style="color: #ffcccc;">Reset Data</a></li>
            </ul>
        </nav>
        <button type="button" id="nav-toggle-btn" aria-label="Buka menu">&#9776;</button>
    </header>

    <main>
<?php if (isset($_SESSION['flash'])): ?>
    <div style="padding: 0.75rem 1rem; margin-bottom: 1rem; border-radius: 4px; background-color: <?= $_SESSION['flash']['type'] === 'success' ? '#d1e7dd' : '#f8d7da' ?>; color: <?= $_SESSION['flash']['type'] === 'success' ? '#0f5132' : '#842029' ?>;">
        <?= htmlspecialchars($_SESSION['flash']['message']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>