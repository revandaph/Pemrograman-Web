// ===== Fungsi Generik Muat Data JSON ke Tabel =====
async function muatDataTabel(urlJson, idTabel, keys, delayMs = 3000) {
    const table = document.getElementById(idTabel);
    if (!table) return;

    const tbody = table.querySelector("tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = ""; // Kosongkan tbody terlebih dahulu

    try {
        // Simulasi delay jaringan (3000ms / 3 detik)
        await new Promise(resolve => setTimeout(resolve, delayMs));

        const response = await fetch(urlJson);
        if (!response.ok) {
            throw new Error("Gagal mengambil data dari server (" + response.status + ")");
        }

        const data = await response.json();

        data.forEach(item => {
            const tr = document.createElement("tr");

            // Generasi td dinamis berdasarkan array keys
            let cellsHtml = keys.map(key => `<td>${item[key] ?? "-"}</td>`).join("");

            // Tambah kolom aksi
            cellsHtml += `
                <td>
                    <button type="button" class="btn-edit">Edit</button>
                    <button type="button" class="btn-detail">Detail</button>
                    <button type="button" class="btn-hapus">Hapus</button>
                </td>
            `;

            tr.innerHTML = cellsHtml;
            tbody.appendChild(tr);
        });

        if (typeof updateTableCounter === "function") {
            updateTableCounter();
        }
    } catch (error) {
        const colCount = keys.length + 1;
        tbody.innerHTML = `<tr><td colspan="${colCount}" style="text-align:center; color:#b91c1c;">Error: ${error.message}</td></tr>`;
    } finally {
        if (loading) loading.style.display = "none";
    }
}

// Fungsi pembungkus khusus Buku
function muatDaftarBuku() {
    muatDataTabel("../data/buku.json", "tabel-buku", ["judul", "pengarang", "tahun", "stok", "kategori"]);
}

// Fungsi pembungkus khusus Anggota
function muatDaftarAnggota() {
    muatDataTabel("../data/anggota.json", "tabel-anggota", ["no_anggota", "nama", "alamat", "no_hp", "tgl_bergabung", "email"]);
}

// Event listener saat DOM siap
document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("tabel-buku")) {
        muatDaftarBuku();

        // Event handler tombol Muat Ulang
        const btnReload = document.getElementById("btn-reload");
        if (btnReload) {
            btnReload.addEventListener("click", muatDaftarBuku);
        }
    }

    if (document.getElementById("tabel-anggota")) {
        muatDaftarAnggota();
    }
});