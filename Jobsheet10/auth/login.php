<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Login";
include __DIR__ . '/../includes/header.php';
?>

<h2>Login Petugas</h2>

<form action="proses_login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <br><br>
    <button type="submit" class="btn">Masuk</button>
    <a href="register.php" style="margin-left: 15px; text-decoration: none;">Belum punya akun? Registrasi</a>
</form>

<?php include __DIR__ . '/../includes/footer.php'; ?>