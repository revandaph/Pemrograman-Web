<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Registrasi Petugas";
include __DIR__ . '/../includes/header.php';
?>

<h2>Registrasi Petugas Baru</h2>

<form action="proses_register.php" method="POST">
    <label for="nama">Nama Lengkap:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password (min. 6 karakter):</label>
    <input type="password" id="password" name="password" minlength="6" required>

    <br><br>
    <button type="submit" class="btn">Daftar Akun</button>
    <a href="login.php" style="margin-left: 15px; text-decoration: none;">Sudah punya akun? Login</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>