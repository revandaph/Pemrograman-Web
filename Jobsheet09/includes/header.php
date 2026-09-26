<?php
$base_url = sprintf(
    "%s://%s%s/",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['HTTP_HOST'],
    rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\')
);

if (basename(dirname($_SERVER['SCRIPT_NAME'])) === 'buku' || basename(dirname($_SERVER['SCRIPT_NAME'])) === 'anggota') {
    $base_url = dirname($base_url) . '/';
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
        nav { display: flex; gap: 15px; }
        nav a { color: #f8f9fa; text-decoration: none; font-weight: bold; font-size: 14px; }
        nav a:hover { color: #ffca28; }

        .burger-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 26px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
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

        @media (max-width: 768px) {
            .burger-btn { display: block; }
            nav {
                display: none;
                flex-direction: column;
                width: 100%;
                position: absolute;
                top: 100%;
                left: 0;
                background-color: #4a3525;
                padding: 15px 30px;
                box-sizing: border-box;
                gap: 12px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.2);
                z-index: 999;
            }
            nav.active { display: flex; }
        }
    </style>
</head>
<body>
<header>
    <h1>SIMPUS-Mini</h1>
    <button class="burger-btn" onclick="toggleMenu()">&#9776;</button>
    <nav id="navMenu">
        <a href="<?= $base_url ?>index.php">Beranda</a>
        <a href="<?= $base_url ?>buku/list.php">Daftar Buku</a>
        <a href="<?= $base_url ?>buku/tambah.php">Tambah Buku</a>
        <a href="<?= $base_url ?>anggota/list.php">Daftar Anggota</a>
        <a href="<?= $base_url ?>anggota/tambah.php">Tambah Anggota</a>
    </nav>
</header>

<script>
function toggleMenu() {
    var menu = document.getElementById("navMenu");
    menu.classList.toggle("active");
}
</script>

<div class="container">