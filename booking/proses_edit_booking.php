<?php
include '../config/koneksi.php';

$id_booking    = $_POST['id_booking'];
$id_ruang      = $_POST['id_ruang'];
$id_karyawan   = $_POST['id_karyawan'];
$tanggal_rapat = $_POST['tanggal_rapat'];
$jam_mulai     = $_POST['jam_mulai'];
$jam_selesai   = $_POST['jam_selesai'];
$agenda        = $_POST['agenda'];

// 1. Cek jam tidak terbalik
if ($jam_mulai >= $jam_selesai) {
    echo "<script>alert('Format Jam Salah! Jam Mulai Harus Lebih Awal.'); window.history.back();</script>";
    exit;
}

// 2. Cek Bentrok (Double Booking Prevention)
// Mengecek apakah ada jadwal lain di RUANGAN yang sama, TANGGAL yang sama, dan JAM yang beririsan
$cek_bentrok = mysqli_query($koneksi, "
    SELECT b.*, k.divisi 
    FROM t_booking b
    JOIN m_karyawan k ON b.id_karyawan = k.id_karyawan
    WHERE b.id_ruang = '$id_ruang' 
    AND b.tanggal_rapat = '$tanggal_rapat' 
    AND b.id_booking != '$id_booking'
    AND (
        ('$jam_mulai' < b.jam_selesai AND '$jam_selesai' > b.jam_mulai)
    )
");

if (mysqli_num_rows($cek_bentrok) > 0) {
    $row = mysqli_fetch_array($cek_bentrok);
    // Notifikasi sesuai instruksi soal [cite: 192]
    echo "<script>
        alert('Maaf, Ruangan Sudah Digunakan Oleh Divisi " . $row['divisi'] . " Untuk Agenda " . $row['agenda'] . "!');
        window.history.back();
    </script>";
    exit;
}

// 3. Eksekusi Update
$update = mysqli_query($koneksi, "
    UPDATE t_booking SET 
    id_ruang = '$id_ruang',
    tanggal_rapat = '$tanggal_rapat',
    jam_mulai = '$jam_mulai',
    jam_selesai = '$jam_selesai',
    agenda = '$agenda'
    WHERE id_booking = '$id_booking'
");

if ($update) {

    /* AMBIL DATA LAMA */

    $old_tanggal     = $_POST['old_tanggal'];
    $old_jam_mulai   = $_POST['old_jam_mulai'];
    $old_jam_selesai = $_POST['old_jam_selesai'];
    $old_id_ruang    = $_POST['old_id_ruang'];
    $old_agenda      = $_POST['old_agenda'];

    /* AMBIL NAMA RUANGAN */

    $q_ruang = mysqli_query($koneksi, "
    
    SELECT nama_ruangan
    FROM m_ruangan
    WHERE id_ruangan='$id_ruang'
    
    ");

    $d_ruang = mysqli_fetch_array($q_ruang);

    $nama_ruangan = $d_ruang['nama_ruangan'];

    /* LOG AKTIVITAS */

    $log = "

Mengubah Booking

ID Booking : $id_booking

Tanggal : $tanggal_rapat

Jam : $jam_mulai - $jam_selesai

Agenda : $agenda

";

    simpanLog($koneksi, $log);

    echo "

    <script>

    alert('Data Booking Berhasil Diperbarui!');

    window.location='data_booking.php';

    </script>

    ";
}