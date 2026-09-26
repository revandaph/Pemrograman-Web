<?php
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($_POST['nama']);
    $email   = trim($_POST['email']);
    $telepon = trim($_POST['telepon']);
    $alamat  = trim($_POST['alamat']);

    $sql = "INSERT INTO anggota (nama, email, telepon, alamat) 
            VALUES (:nama, :email, :telepon, :alamat) 
            RETURNING id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nama'    => $nama,
            ':email'   => $email,
            ':telepon' => $telepon,
            ':alamat'  => $alamat
        ]);

        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        die("Gagal menambah anggota: " . $e->getMessage());
    }
}