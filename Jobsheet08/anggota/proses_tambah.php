<?php
session_start();
include '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $no_anggota = trim($_POST['no_anggota'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $no_hp = trim($_POST['no_hp'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($nama) || empty($no_anggota)) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Gagal! Nama dan No. Anggota wajib diisi.'
        ];
        header("Location: tambah.php");
        exit;
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Gagal! Format alamat email tidak valid.'
        ];
        header("Location: tambah.php");
        exit;
    }

    try {
        $sql = "INSERT INTO anggota (no_anggota, nama, alamat, no_hp, tgl_bergabung, email) 
                VALUES (:no_anggota, :nama, :alamat, :no_hp, CURRENT_DATE, :email) RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':no_anggota' => $no_anggota,
            ':nama' => $nama,
            ':alamat' => $alamat,
            ':no_hp' => $no_hp,
            ':email' => $email
        ]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Anggota baru berhasil disimpan ke database!'
        ];
    } catch (PDOException $e) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Gagal menyimpan data (mungkin No. Anggota sudah terdaftar): ' . $e->getMessage()
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