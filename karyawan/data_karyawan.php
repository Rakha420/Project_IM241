<?php
include '../config/koneksi.php';
$karyawan = mysqli_query($koneksi, "SELECT * FROM m_karyawan");
?>

<div style="font-family: sans-serif; padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="margin: 0;">Smart-Meeting System</h1>
            <p style="margin: 5px 0 20px 0;">Data Karyawan</p>
        </div>
        <a href="tambah_karyawan.php" style="background-color: #3498db; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Tambah Karyawan</a>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Cari Karyawan: </label>
        <input type="text" id="filterKaryawan" onkeyup="filterTabel()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <table id="tabelKaryawan" width="100%" style="border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background-color: #3498db; color: white;">
                <th style="padding: 12px; border: 1px solid #ddd;">No</th>
                <th style="padding: 12px; border: 1px solid #ddd;">NIK</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Nama Karyawan</th>
                <th style="padding: 12px; border: 1px solid #ddd;">Divisi</th>
                <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            while ($k = mysqli_fetch_array($karyawan)): ?>
                <tr>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?= $no++; ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?= $k['nik']; ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?= $k['nama_karyawan']; ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd;"><?= $k['divisi']; ?></td>
                    <td style="padding: 12px; border: 1px solid #ddd; text-align: center;">
                        <a href="edit_karyawan.php?id=<?= $k['id_karyawan']; ?>" style="background-color: #f39c12; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none; margin-right: 5px;">Edit</a>
                        <a href="proses_hapus_karyawan.php?id=<?= $k['id_karyawan']; ?>" style="background-color: #e74c3c; color: white; padding: 5px 10px; border-radius: 3px; text-decoration: none;">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    function filterTabel() {
        var input = document.getElementById("filterKaryawan").value.toUpperCase();
        var rows = document.getElementById("tabelKaryawan").getElementsByTagName("tr");
        for (var i = 1; i < rows.length; i++) {
            var td = rows[i].getElementsByTagName("td")[2]; // Cari berdasarkan Nama
            if (td) {
                var text = td.textContent || td.innerText;
                rows[i].style.display = text.toUpperCase().indexOf(input) > -1 ? "" : "none";
            }
        }
    }
</script>