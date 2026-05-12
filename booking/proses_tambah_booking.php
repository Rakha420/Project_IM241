<?php

include '../config/koneksi.php';

/* AMBIL DATA */

$id_ruang      = $_POST['id_ruang'];
$id_karyawan   = $_POST['id_karyawan'];
$tanggal       = $_POST['tanggal_rapat'];
$jam_mulai     = $_POST['jam_mulai'];
$jam_selesai   = $_POST['jam_selesai'];
$agenda        = $_POST['agenda'];

/* VALIDASI JAM */

if ($jam_mulai >= $jam_selesai) {

    echo "
    <script>
        alert('Jam tidak valid!');
        window.location='tambah_booking.php';
    </script>
    ";

    exit;
}

/* CEK BENTROK RUANGAN */

$cek_ruangan = mysqli_query($koneksi, "

SELECT
t_booking.*,
m_karyawan.divisi

FROM t_booking

JOIN m_karyawan
ON t_booking.id_karyawan =
m_karyawan.id_karyawan

WHERE id_ruang='$id_ruang'
AND tanggal_rapat='$tanggal'

AND (

('$jam_mulai' BETWEEN jam_mulai AND jam_selesai)

OR

('$jam_selesai' BETWEEN jam_mulai AND jam_selesai)

OR

(jam_mulai BETWEEN '$jam_mulai' AND '$jam_selesai')

)

");

if (mysqli_num_rows($cek_ruangan) > 0) {

    $data = mysqli_fetch_array($cek_ruangan);

    echo "
    <script>

    alert('Maaf, Ruangan Sudah Digunakan Oleh Divisi " . $data['divisi'] . " Untuk Agenda " . $data['agenda'] . "!');

    window.location='tambah_booking.php';

    </script>
    ";

    exit;
}

/* CEK BENTROK KARYAWAN */

$cek_karyawan = mysqli_query($koneksi, "

SELECT *

FROM t_booking

WHERE id_karyawan='$id_karyawan'
AND tanggal_rapat='$tanggal'

AND (

('$jam_mulai' BETWEEN jam_mulai AND jam_selesai)

OR

('$jam_selesai' BETWEEN jam_mulai AND jam_selesai)

OR

(jam_mulai BETWEEN '$jam_mulai' AND '$jam_selesai')

)

");

if (mysqli_num_rows($cek_karyawan) > 0) {

    echo "
    <script>

    alert('Karyawan Masih Memiliki Booking Di Jam Tersebut!');

    window.location='tambah_booking.php';

    </script>
    ";

    exit;
}

/* INSERT BOOKING */

$insert = mysqli_query($koneksi, "

INSERT INTO t_booking
(
id_karyawan,
id_ruang,
tanggal_rapat,
jam_mulai,
jam_selesai,
agenda,
status
)

VALUES
(
'$id_karyawan',
'$id_ruang',
'$tanggal',
'$jam_mulai',
'$jam_selesai',
'$agenda',
'Pinjam'
)

");

if ($insert) {

    /* AMBIL NAMA KARYAWAN */

    $q_karyawan = mysqli_query($koneksi, "

    SELECT nama_karyawan

    FROM m_karyawan

    WHERE id_karyawan='$id_karyawan'

    ");

    $d_karyawan = mysqli_fetch_array($q_karyawan);

    $nama_karyawan = $d_karyawan['nama_karyawan'];

    /* SIMPAN LOG */

    $log = "

Booking Baru

Nama Karyawan : $nama_karyawan

Tanggal : $tanggal

Jam : $jam_mulai - $jam_selesai

Agenda : $agenda

";

    simpanLog($koneksi, $log);

    echo "
    <script>

    alert('Data Booking Berhasil Dibuat!');

    window.location='data_booking.php';

    </script>
    ";
} else {

    die("Gagal Menyimpan Booking : " . mysqli_error($koneksi));
}