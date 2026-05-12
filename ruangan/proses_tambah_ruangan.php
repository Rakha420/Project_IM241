<?php
include '../config/koneksi.php';

$nama = $_POST['nama_ruangan'];
$kap  = $_POST['kapasitas'];
$fas  = $_POST['fasilitas'];

// VALIDASI NAMA RUANGAN
$cek = mysqli_query($koneksi, "

SELECT *
FROM m_ruangan

WHERE nama_ruangan='$nama'

");

if (mysqli_num_rows($cek) > 0) {

    echo "
    <script>
        alert('Nama ruangan sudah ada!');
        window.location='tambah_ruangan.php';
    </script>
    ";

    exit;
}

// INSERT DATA RUANGAN
$insert = mysqli_query($koneksi, "

INSERT INTO m_ruangan
(
    nama_ruangan,
    kapasitas,
    fasilitas
)

VALUES
(
    '$nama',
    '$kap',
    '$fas'
)

");

// JIKA BERHASIL
if ($insert) {

    /* ===== LOG AKTIVITAS ===== */

    $keterangan_log = "Tambah Ruangan Baru: $nama";

    mysqli_query($koneksi, "

    INSERT INTO t_log_aktivitas
    (
        keterangan
    )

    VALUES
    (
        '$keterangan_log'
    )

    ");

    /* ========================= */

    echo "
    <script>
        alert('Data Ruangan Berhasil Ditambahkan!');
        window.location='data_ruangan.php';
    </script>
    ";
} else {

    echo "

    Gagal Menyimpan Data:

    " . mysqli_error($koneksi);
}