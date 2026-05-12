<?php
include '../config/koneksi.php';

$id     = $_POST['id_ruangan'];
$nama   = $_POST['nama_ruangan'];
$kap    = $_POST['kapasitas'];
$fas    = $_POST['fasilitas'];

/* DATA LAMA */

$old_nama = $_POST['old_nama_ruangan'];
$old_kap  = $_POST['old_kapasitas'];
$old_fas  = $_POST['old_fasilitas'];

/* 1. VALIDASI DOUBLE DATA */

$cek_ruangan = mysqli_query($koneksi, "

SELECT *
FROM m_ruangan
WHERE nama_ruangan = '$nama'
AND id_ruangan != '$id'

");

if (mysqli_num_rows($cek_ruangan) > 0) {

    echo "

    <script>

    alert('Gagal Update! Nama Ruangan $nama Sudah Ada.');

    window.history.back();

    </script>

    ";

    exit;
}

/* 2. UPDATE DATA */

$update = mysqli_query($koneksi, "

UPDATE m_ruangan SET

nama_ruangan = '$nama',
kapasitas    = '$kap',
fasilitas    = '$fas'

WHERE id_ruangan='$id'

");

if ($update) {

    /* LOG AKTIVITAS */

    $log = "

Mengubah Data Ruangan

ID Ruangan : $id

";

    /* CEK PERUBAHAN */

    if ($old_nama != $nama) {

        $log .= "

Nama Ruangan :
$old_nama -> $nama

";
    }

    if ($old_kap != $kap) {

        $log .= "

Kapasitas :
$old_kap -> $kap

";
    }

    if ($old_fas != $fas) {

        $log .= "

Fasilitas :
$old_fas -> $fas

";
    }

    /* SIMPAN LOG */

    mysqli_query($koneksi, "

    INSERT INTO t_log_aktivitas
    (
    keterangan
    )

    VALUES
    (
    '$log'
    )

    ");

    echo "

    <script>

    alert('Data Ruangan Berhasil Diperbarui!');

    window.location='data_ruangan.php';

    </script>

    ";
} else {

    echo mysqli_error($koneksi);
}