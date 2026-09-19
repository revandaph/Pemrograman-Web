=CREATE TABLE IF NOT EXISTS buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(255) NOT NULL,
    tahun INT NOT NULL,
    isbn VARCHAR(50),
    stok INT NOT NULL DEFAULT 0,
    kategori VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS anggota (
    id SERIAL PRIMARY KEY,
    no_anggota VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(20),
    tgl_bergabung DATE NOT NULL DEFAULT CURRENT_DATE,
    email VARCHAR(100)
);

INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) VALUES
('Laskar Pelangi', 'Andrea Hirata', 2005, '978-979-3062-79-2', 4, 'Fiksi'),
('Bumi Manusia', 'Pramoedya Ananta Toer', 1980, '978-979-97312-3-4', 2, 'Fiksi'),
('Filosofi Teras', 'Henry Manampiring', 2018, '978-602-424-694-5', 5, 'Non-Fiksi');

INSERT INTO anggota (no_anggota, nama, alamat, no_hp, tgl_bergabung, email) VALUES
('A001', 'Revalinda Putri Hadinata', 'Malang', '0812xxxx', '2024-08-12', 'revalinda@gmail.com'),
('A002', 'Kazzama Haqi Al-Fatih', 'Batu', '0813xxxx', '2025-11-22', 'kazzama@gmail.com');