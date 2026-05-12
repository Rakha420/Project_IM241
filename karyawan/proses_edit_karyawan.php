<?php
include '../config/koneksi.php';

$id     = $_POST['id_karyawan'];
$nik    = $_POST['nik'];
$nama   = $_POST['nama_karyawan'];
$divisi = $_POST['divisi'];

/* 1. VALIDASI DOUBLE DATA (NIK UNIK) */
// Mengecek apakah NIK baru sudah dipakai oleh orang lain (selain ID yang sedang diedit)
$cek_nik = mysqli_query($koneksi, "SELECT * FROM m_karyawan WHERE nik = '$nik' AND id_karyawan != '$id'");

if (mysqli_num_rows($cek_nik) > 0) {
    echo "
    <script>
        alert('Gagal Update! NIK $nik sudah digunakan oleh karyawan lain.');
        window.history.back();
    </script>
    ";
    exit;
}

/* 2. UPDATE DATA KARYAWAN */
$update = mysqli_query($koneksi, "UPDATE m_karyawan SET 
    nik = '$nik', 
    nama_karyawan = '$nama', 
    divisi = '$divisi' 
    WHERE id_karyawan = '$id'");

if ($update) {
    /* 3. LOGGING AKTIVITAS (Sesuai Spesifikasi Audit Trail) */
    // Mencatat detail perubahan ke tabel log
    $keterangan = "Update Karyawan: Mengubah data NIK $nik atas nama $nama (Divisi: $divisi)";
    mysqli_query($koneksi, "INSERT INTO t_log_aktivitas (keterangan) VALUES ('$keterangan')");

    echo "
    <script>
        alert('Data berhasil diupdate'); 
        window.location='data_karyawan.php';
    </script>
    ";
} else {
    echo "Error: " . mysqli_error($koneksi);
}