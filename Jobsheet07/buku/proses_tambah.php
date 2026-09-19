<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun = (int)($_POST['tahun'] ?? 0);
    $stok = (int)($_POST['stok'] ?? 0);
    $kategori = trim($_POST['kategori'] ?? 'fiksi');

    if (empty($judul) || empty($pengarang) || $tahun < 1900 || $tahun > 2026 || $stok < 0) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Gagal! Mohon periksa kembali inputan form Anda.'
        ];
        header("Location: tambah.php");
        exit;
    }

    if (!isset($_SESSION['buku'])) {
        $_SESSION['buku'] = [];
    }

    $_SESSION['buku'][] = [
        'id' => time(),
        'judul' => $judul,
        'pengarang' => $pengarang,
        'tahun' => $tahun,
        'stok' => $stok,
        'kategori' => $kategori
    ];

    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Buku berhasil ditambahkan!'
    ];

    header("Location: list.php");
    exit;
} else {
    header("Location: list.php");
    exit;
}