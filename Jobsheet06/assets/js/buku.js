// ===== Render Dinamis Data Buku =====
async function loadBuku() {
    const tbody = document.querySelector("#tabel-buku tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        // Simulasi delay 600ms
        await new Promise(resolve => setTimeout(resolve, 600));

        const response = await fetch("../data/buku.json");
        if (!response.ok) {
            throw new Error("Gagal mengambil data dari server (" + response.status + ")");
        }

        const data = await response.json();

        data.forEach(buku => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${buku.judul}</td>
                <td>${buku.pengarang}</td>
                <td>${buku.tahun}</td>
                <td>${buku.stok}</td>
                <td>
                    <button type="button" class="btn-edit">Edit</button>
                    <button type="button" class="btn-detail">Detail</button>
                    <button type="button" class="btn-hapus">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        if (typeof updateTableCounter === "function") {
            updateTableCounter();
        }
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="5" style="text-align:center; color:#b91c1c;">Error: ${error.message}</td></tr>`;
    } finally {
        if (loading) loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", loadBuku);