<?php
include '../config/koneksi.php';

/* AMBIL DATA */

$id_booking = $_POST['id_booking'];
$kode       = $_POST['kode'];

/* VALIDASI KODE */

if ($kode != "HAPUS") {

    echo "
    <script>

    alert('Kode HAPUS Salah!');

    window.location='data_booking.php';

    </script>
    ";

    exit;
}

/* AMBIL DATA BOOKING */

$query = mysqli_query($koneksi, "

SELECT
t_booking.*,
m_karyawan.nama_karyawan,
m_ruangan.nama_ruangan

FROM t_booking

JOIN m_karyawan
ON t_booking.id_karyawan =
m_karyawan.id_karyawan

JOIN m_ruangan
ON t_booking.id_ruang =
m_ruangan.id_ruangan

WHERE id_booking='$id_booking'

");

$data = mysqli_fetch_array($query);

/* HAPUS BOOKING */

mysqli_query($koneksi, "

DELETE FROM t_booking

WHERE id_booking='$id_booking'

");

/* SIMPAN LOG */

$keterangan = "

Menghapus Booking

Nama Karyawan : " . $data['nama_karyawan'] . "

Ruangan : " . $data['nama_ruangan'] . "

Tanggal : " . $data['tanggal_rapat'] . "

";

simpanLog($koneksi, $keterangan);

/* REDIRECT */

echo "
<script>

alert('Data Booking Berhasil Dihapus!');

window.location='data_booking.php';

</script>
";