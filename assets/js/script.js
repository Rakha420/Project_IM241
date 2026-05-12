// Tunggu sampai seluruh dokumen dimuat
document.addEventListener("DOMContentLoaded", function () {

    // --- 1. FILTER TABEL (Berdasarkan Nama) ---
    const filterInput = document.getElementById("filterInput");
    if (filterInput) {
        filterInput.addEventListener("keyup", function () {
            let keyword = this.value.toUpperCase();
            let table = document.getElementById("myTable") || document.getElementById("tabelKaryawan");
            let tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                // Indeks [1] untuk Nama Ruangan, Indeks [2] untuk Nama Karyawan
                // Kita cek kedua kolom tersebut mana yang tersedia
                let tdNama = tr[i].getElementsByTagName("td")[1];
                let tdKaryawan = tr[i].getElementsByTagName("td")[2];
                let targetTd = tdKaryawan || tdNama;

                if (targetTd) {
                    let textValue = targetTd.textContent || targetTd.innerText;
                    tr[i].style.display = textValue.toUpperCase().indexOf(keyword) > -1 ? "" : "none";
                }
            }
        });
    }

    // --- 2. FILTER CARD VIEW (CSS GRID) ---
    // Fitur ini otomatis menyembunyikan kartu saat user mengetik di search bar
    if (filterInput) {
        filterInput.addEventListener("keyup", function () {
            let keyword = this.value.toUpperCase();
            let cards = document.querySelectorAll(".card, .card-item");

            cards.forEach(card => {
                let title = card.querySelector("h3").innerText.toUpperCase();
                card.style.display = title.indexOf(keyword) > -1 ? "" : "none";
            });
        });
    }

    // --- 3. FILTER TANGGAL (Khusus Halaman Peminjaman) ---
    const filterTanggal = document.getElementById("filterTanggal");
    if (filterTanggal) {
        filterTanggal.addEventListener("change", function () {
            let tglFilter = this.value; // Format YYYY-MM-DD dari input date
            let table = document.getElementById("tabelPeminjaman");
            let tr = table.getElementsByTagName("tr");

            for (let i = 1; i < tr.length; i++) {
                let tdTgl = tr[i].getElementsByTagName("td")[1]; // Asumsi kolom tanggal di indeks 1
                if (tdTgl) {
                    let tglText = tdTgl.textContent || tdTgl.innerText;
                    tr[i].style.display = (tglFilter === "" || tglText === tglFilter) ? "" : "none";
                }
            }
        });
    }

});