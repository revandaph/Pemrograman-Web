// ===== Render Dinamis Data Anggota =====
async function loadAnggota() {
    const tbody = document.querySelector("#tabel-anggota tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        // Simulasi delay 600ms
        await new Promise(resolve => setTimeout(resolve, 600));

        const response = await fetch("../data/anggota.json");
        if (!response.ok) {
            throw new Error("Gagal mengambil data dari server (" + response.status + ")");
        }

        const data = await response.json();

        data.forEach(anggota => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${anggota.no_anggota}</td>
                <td>${anggota.nama}</td>
                <td>${anggota.alamat}</td>
                <td>${anggota.no_hp}</td>
                <td>${anggota.tgl_bergabung}</td>
                <td>${anggota.email}</td>
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
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; color:#b91c1c;">Error: ${error.message}</td></tr>`;
    } finally {
        if (loading) loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", loadAnggota);