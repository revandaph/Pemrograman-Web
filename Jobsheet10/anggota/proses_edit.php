<?php
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id      = (int)$_POST['id'];
    $nama    = trim($_POST['nama']);
    $email   = trim($_POST['email']);
    $telepon = trim($_POST['telepon']);
    $alamat  = trim($_POST['alamat']);

    $sql = "UPDATE anggota SET 
                nama = :nama, 
                email = :email, 
                telepon = :telepon, 
                alamat = :alamat 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id'      => $id,
        ':nama'    => $nama,
        ':email'   => $email,
        ':telepon' => $telepon,
        ':alamat'  => $alamat
    ]);

    header('Location: list.php');
    exit;
}