<?php
require_once __DIR__ . '/../includes/koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nama === '' || $username === '' || strlen($password) < 6) {
        header('Location: register.php');
        exit;
    }

    $cek = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $cek->execute([':username' => $username]);
    
    if ($cek->fetch()) {
        header('Location: register.php');
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')");
    $stmt->execute([
        ':nama'     => $nama,
        ':username' => $username,
        ':password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    header('Location: login.php');
    exit;
}