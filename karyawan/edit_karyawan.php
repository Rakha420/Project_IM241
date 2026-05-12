<?php
include '../config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM m_karyawan WHERE id_karyawan='$id'"));
?>

<div style="font-family: sans-serif; width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <h2 style="margin-top: 0;">Tambah/Edit Karyawan</h2>
    <form action="proses_edit_karyawan.php" method="POST">
        <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']; ?>">

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">NIK</label>
            <input type="text" name="nik" value="<?= $data['nik']; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Nama Karyawan</label>
            <input type="text" name="nama_karyawan" value="<?= $data['nama_karyawan']; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px;">Divisi</label>
            <input type="text" name="divisi" value="<?= $data['divisi']; ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
        </div>

        <div style="text-align: right; margin-top: 20px;">
            <button type="submit" style="background-color: #eee; border: 1px solid #ccc; padding: 10px 20px; border-radius: 4px; cursor: pointer; margin-right: 10px;">Simpan</button>
            <a href="data_karyawan.php" style="background-color: #eee; border: 1px solid #ccc; padding: 10px 20px; border-radius: 4px; text-decoration: none; color: black; display: inline-block;">Batal</a>
        </div>
    </form>
</div>