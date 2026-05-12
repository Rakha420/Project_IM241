<?php
include '../config/koneksi.php';

$nik    = $_POST['nik'];
$nama   = $_POST['nama_karyawan'];
$divisi = $_POST['divisi'];

// Validasi: Cek apakah NIK sudah ada (Double Data Prevention) 
$cek = mysqli_query($koneksi, "SELECT * FROM m_karyawan WHERE nik = '$nik'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Error: NIK sudah terdaftar!'); window.history.back();</script>";
    exit;
}

// Simpan Data
$query = "INSERT INTO m_karyawan (nik, nama_karyawan, divisi) VALUES ('$nik', '$nama', '$divisi')";
if (mysqli_query($koneksi, $query)) {
    // Mencatat Log Aktivitas sesuai soal [cite: 82]
    $log_ket = "Tambah Karyawan: Menambahkan $nama (NIK: $nik) ke divisi $divisi";
    mysqli_query($koneksi, "INSERT INTO t_log_aktivitas (keterangan) VALUES ('$log_ket')");

    echo "<script>alert('Data Karyawan Berhasil Ditambahkan'); window.location='data_karyawan.php';</script>";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}