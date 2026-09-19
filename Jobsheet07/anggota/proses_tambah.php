<?php
session_start();

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

    if (!isset($_SESSION['anggota'])) {
        $_SESSION['anggota'] = [];
    }

    $_SESSION['anggota'][] = [
        'no_anggota' => $no_anggota,
        'nama' => $nama,
        'alamat' => $alamat,
        'no_hp' => $no_hp,
        'tgl_bergabung' => date('d-m-Y'),
        'email' => $email
    ];

    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => 'Anggota baru berhasil ditambahkan!'
    ];

    header("Location: list.php");
    exit;
} else {
    header("Location: list.php");
    exit;
}