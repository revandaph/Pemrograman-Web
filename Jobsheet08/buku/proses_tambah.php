<?php
session_start();
include '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun = (int)($_POST['tahun'] ?? 0);
    $isbn = trim($_POST['isbn'] ?? '');
    $stok = (int)($_POST['stok'] ?? 0);
    $kategori = trim($_POST['kategori'] ?? 'Fiksi');

    if (empty($judul) || empty($pengarang) || $tahun < 1900 || $tahun > 2026 || $stok < 0) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Gagal! Mohon periksa kembali inputan form Anda.'
        ];
        header("Location: tambah.php");
        exit;
    }

    if (!empty($isbn) && !preg_match('/^[0-9-]+$/', $isbn)) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Gagal! ISBN hanya boleh berisi angka dan tanda hubung (-).'
        ];
        header("Location: tambah.php");
        exit;
    }

    try {
        $sql = "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) 
                VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori) RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':judul' => $judul,
            ':pengarang' => $pengarang,
            ':tahun' => $tahun,
            ':isbn' => $isbn,
            ':stok' => $stok,
            ':kategori' => $kategori
        ]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Buku berhasil disimpan ke database!'
        ];
    } catch (PDOException $e) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Gagal menyimpan ke database: ' . $e->getMessage()
        ];
        header("Location: tambah.php");
        exit;
    }

    header("Location: list.php");
    exit;
} else {
    header("Location: list.php");
    exit;
}