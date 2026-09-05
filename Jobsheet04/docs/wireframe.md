# Wireframe & User Flow — SIMPUS-Mini

Halaman yang sudah ada (Beranda, Daftar/Tambah Buku, Daftar/Tambah Anggota) belum
mencakup fitur Login, Dashboard Petugas, dan Peminjaman/Pengembalian. Dokumen ini
merancang wireframe untuk halaman-halaman tersebut sebelum diimplementasikan.

## Aktor
- **Tamu**: hanya bisa melihat katalog buku (Beranda, Daftar Buku) tanpa login.
- **Petugas**: login untuk mengakses seluruh fitur CRUD dan transaksi peminjaman.

# Gambar User Flow - Peminjaman Buku
[Petugas Login] -> [Dashboard] -> [Pilih "Peminjaman Baru"]
   -> [Pilih Anggota dari Daftar Anggota] -> [Pilih Buku, hanya yg Stok > 0]
   -> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]

# Gambar User Flow - Pengembalian Buku
[Dashboard] -> [Menu "Pengembalian"] -> [Cari transaksi aktif (nama anggota/judul buku)]
   -> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1] -> [Kembali ke Dashboard]

# Wireframe teks Halaman Login
+--------------------------------------+
|              SIMPUS-Mini             |
|--------------------------------------|
|          [ Login Petugas ]           |
|   Username : [______________]        |
|   Password : [______________]        |
|            [   Masuk   ]             |
+--------------------------------------+

# Wireframe Dashboard Petugas
+-------------------------------------------------------------------------------------------+
| SIMPUS-Mini   Beranda | Daftar Buku | Daftar Anggota | Peminjaman | (Nama Petugas) Logout |
|-------------------------------------------------------------------------------------------|
|  [Total Buku]   [Total Anggota]   [Sedang Dipinjam]                                       |
|  Aksi Cepat: [ + Peminjaman Baru ]   [ + Pengembalian ]                                   |
|  Transaksi Terbaru: Anggota | Buku | Tgl Pinjam | Status                                  |
+-------------------------------------------------------------------------------------------+

# Wireframe Form Peminjaman & Form Pengembalian
+--------------------------------------+
|  Form Peminjaman Buku                 |
|  Anggota : [ dropdown pilih anggota ] |
|  Buku    : [ dropdown, hanya stok>0 ] |
|  Tanggal Pinjam : [ auto: hari ini ]  |
|         [  Simpan Peminjaman  ]       |
+--------------------------------------+
+---------------------------------------------+
|  Pengembalian Buku                          |
|  Cari transaksi: [nama anggota/judul]       |
|  Anggota | Buku | Tgl Pinjam | [Kembalikan] |
+---------------------------------------------+

# Wireframe Riwayat Peminjaman
+--------------------------------------------------+
|  Riwayat Peminjaman — Kazzama Haqi Al-Fatih       |
|  Buku            | Pinjam | Kembali | Status      |
|  Laskar Pelangi  | 01/07  | 10/07   | Selesai     |
|  Filosofi Teras   | 15/07  | -       | Dipinjam   |
+--------------------------------------------------+

# Konsistensi dengan Desain yang Sudah Berjalan
- warna, tipografi, dan gaya tabel/kartu di wireframe ini sudah mengikuti assets/css/style.css yang sudah saya bangun yaitu (warna coklat header #5c3d2e, background krem #f8f5f2, kartu statistik di section kedua index.html, style tombol .btn-edit/.btn-detail/.btn-delete di tabel).
- Navbar akan ditambah menu **Peminjaman** dan indikator status login (nama petugas / tombol Logout) mulai implementasi di Jobsheet 10.
- Edge case yang perlu ditangani saat implementasi: buku stok habis tidak boleh dipilih di form peminjaman; anggota dengan tunggakan terlambat divalidasi di Jobsheet 12 (tugas mandiri).