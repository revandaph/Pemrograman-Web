<?php
$host = 'localhost';
$port = '5432';
$db   = 'simpus_mini';
$user = 'postgres'; // Sesuaikan dengan username PostgreSQL lokalmu
$pass = '12345678'; // Sesuaikan dengan password PostgreSQL lokalmu

$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}