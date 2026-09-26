<?php
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $tahun     = (int)$_POST['tahun'];
    $isbn      = trim($_POST['isbn']);
    $stok       = (int)$_POST['stok'];
    $kategori  = trim($_POST['kategori']);

    $sql = "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) 
            VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori) 
            RETURNING id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':judul'     => $judul,
        ':pengarang' => $pengarang,
        ':tahun'     => $tahun,
        ':isbn'      => $isbn,
        ':stok'      => $stok,
        ':kategori'  => $kategori
    ]);

    header('Location: list.php');
    exit;
}