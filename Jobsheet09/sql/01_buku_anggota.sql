CREATE DATABASE simpus_mini;

DROP TABLE IF EXISTS buku CASCADE;
DROP TABLE IF EXISTS anggota CASCADE;

CREATE TABLE buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(150) NOT NULL,
    tahun INT NOT NULL,
    isbn VARCHAR(20) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    kategori VARCHAR(100) NOT NULL
);

CREATE TABLE anggota (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telepon VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL
);

INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) VALUES
('Kami (Bukan) Sarjana Kertas', 'J.S. Khairen', 2019, '978-602-052-101', 10, 'Fiksi / Drama'),
('Kami (Bukan) Jongos Berdasi', 'J.S. Khairen', 2020, '978-602-052-102', 8, 'Fiksi / Comedy'),
('Harry Potter dan Rahasia Kucing Garong', 'J.K. Rowling', 2023, '978-602-000-101', 12, 'Fiksi / Fantasi'),
('Petualangan Detektif Conan di Pasar Senen', 'Gosho Aoyama', 2022, '978-602-000-102', 7, 'Fiksi / Detektif'),
('Laskar Pelangi 2: Menembus Batas Kesabaran', 'Andrea Hirata', 2024, '978-602-000-103', 15, 'Fiksi / Drama');

INSERT INTO anggota (nama, email, telepon, alamat) VALUES
('Revalinda Putri Hadinata', 'revalindaph@gmail.com', '089504172030', 'Kota Semarang'),
('Khazzama Haqi', 'khazzama.haqi@gmail.com', '081234567891', 'Kota Malang');