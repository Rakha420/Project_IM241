<?php
include '../config/koneksi.php';

/* VALIDASI */

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    header('location:data_ruangan.php');
    exit;
}

/* AMBIL DATA */

$id_ruangan   = $_POST['id_ruangan'];
$nama_ruangan = $_POST['nama_ruangan'];

/* CEK APAKAH RUANGAN MASIH DIPAKAI */

$cek = mysqli_query($koneksi, "

SELECT *
FROM t_booking

WHERE id_ruang='$id_ruangan'

");

if (mysqli_num_rows($cek) > 0) {

    echo "
    <script>

    alert('Ruangan $nama_ruangan Masih Digunakan Pada Data Booking!');

    window.location='data_ruangan.php';

    </script>
    ";

    exit;
}

/* HAPUS DATA */

$hapus = mysqli_query($koneksi, "

DELETE FROM m_ruangan

WHERE id_ruangan='$id_ruangan'

");

/* JIKA BERHASIL */

if ($hapus) {

    /* SIMPAN LOG */

    $keterangan = "

Menghapus Data Ruangan

Nama Ruangan : $nama_ruangan

";

    mysqli_query($koneksi, "

    INSERT INTO t_log_aktivitas
    (
    keterangan
    )

    VALUES
    (
    '$keterangan'
    )

    ");

    /* REDIRECT */

    echo "
    <script>

    alert('Data Ruangan Berhasil Dihapus!');

    window.location='data_ruangan.php';

    </script>
    ";
} else {

    echo "
    <script>

    alert('Data Gagal Dihapus!');

    window.location='data_ruangan.php';

    </script>
    ";
}