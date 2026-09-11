// ===== Hamburger Menu Toggle =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== Counter Jumlah Baris Tabel =====
function updateTableCounter() {
    const counterElem = document.getElementById("table-counter");
    const table = document.querySelector(".table-responsive table");
    if (!counterElem || !table) return;

    const totalRows = table.querySelectorAll("tbody tr").length;
    const visibleRows = Array.from(table.querySelectorAll("tbody tr")).filter(function (row) {
        return row.style.display !== "none";
    }).length;

    counterElem.textContent = "Menampilkan " + visibleRows + " dari " + totalRows + " data";
}

// ===== Konfirmasi Hapus Data =====
function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const nama = row ? row.querySelector("td")?.textContent : "data ini";
            const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
            if (yakin && row) {
                row.remove();
                updateTableCounter();
            }
        });
    });
}

// ===== Filter / Pencarian Tabel Real-Time =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    updateTableCounter();

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            const targetCell = row.querySelector("td:nth-child(2)") || row.querySelector("td");
            const teks = targetCell ? targetCell.textContent.toLowerCase() : "";

            row.style.display = teks.includes(keyword) ? "" : "none";
        });

        updateTableCounter();
    });
}

// ===== Helper Pesan Error =====
function tampilkanError(input, pesan) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

// ===== Validasi Form =====
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        const requiredFields = ["judul", "nama", "pengarang", "no_anggota"];

        requiredFields.forEach(function (fieldName) {
            const field = form.querySelector("[name='" + fieldName + "']");
            if (field) {
                if (field.value.trim() === "") {
                    tampilkanError(field, "Field ini wajib diisi.");
                    valid = false;
                } else {
                    hapusError(field);
                }
            }
        });

        const tahun = form.querySelector("[name='tahun']");
        if (tahun && tahun.value.trim() !== "") {
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
                valid = false;
            } else {
                hapusError(tahun);
            }
        }

        const stok = form.querySelector("[name='stok']");
        if (stok && stok.value.trim() !== "") {
            const nilai = parseInt(stok.value, 10);
            if (isNaN(nilai) || nilai < 0) {
                tampilkanError(stok, "Stok tidak boleh negatif.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }

        const isbn = form.querySelector("[name='isbn']");
        if (isbn && isbn.value.trim() !== "") {
            const isbnRegex = /^[0-9-]+$/;
            if (!isbnRegex.test(isbn.value.trim())) {
                tampilkanError(isbn, "ISBN hanya boleh berisi angka dan tanda hubung (-).");
                valid = false;
            } else {
                hapusError(isbn);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

// ===== Event Listener Init =====
document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});