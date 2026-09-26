<?php include '../includes/header.php'; ?>

<h2>Tambah Anggota Baru</h2>

<form action="proses_tambah.php" method="POST">
    <label for="nama">Nama Lengkap:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="telepon">Nomor Telepon:</label>
    <input type="text" id="telepon" name="telepon" required>

    <label for="alamat">Alamat:</label>
    <textarea id="alamat" name="alamat" rows="4" required></textarea>

    <br><br>
    <button type="submit" class="btn">Simpan Anggota</button>
    <a href="list.php" style="margin-left: 15px; color: #666; text-decoration: none;">Batal</a>
</form>

<?php include '../includes/footer.php'; ?>