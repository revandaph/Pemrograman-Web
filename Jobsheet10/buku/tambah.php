<?php include '../includes/header.php'; ?>

<h2>Tambah Buku Baru</h2>

<form action="proses_tambah.php" method="POST">
    <label for="judul">Judul Buku:</label>
    <input type="text" id="judul" name="judul" required>

    <label for="pengarang">Pengarang:</label>
    <input type="text" id="pengarang" name="pengarang" required>

    <label for="tahun">Tahun Terbit:</label>
    <input type="number" id="tahun" name="tahun" min="1900" max="<?= date('Y') ?>" value="<?= date('Y') ?>" required>

    <label for="isbn">ISBN:</label>
    <input type="text" id="isbn" name="isbn" required>

    <label for="stok">Jumlah Stok:</label>
    <input type="number" id="stok" name="stok" min="0" value="1" required>

    <label for="kategori">Kategori:</label>
    <input type="text" id="kategori" name="kategori" required>

    <br><br>
    <button type="submit" class="btn">Simpan Buku</button>
    <a href="list.php" style="margin-left: 15px; color: #666; text-decoration: none;">Batal</a>
</form>

<?php include '../includes/footer.php'; ?>