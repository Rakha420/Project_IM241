<?php

include 'config/koneksi.php';

echo "KONEKSI BERHASIL <br>";

$query = mysqli_query($koneksi, "

INSERT INTO t_log_aktivitas
(
    keterangan
)

VALUES
(
    'TEST LOG DARI PHP'
)

");

if ($query) {

    echo "LOG BERHASIL DISIMPAN";

} else {

    echo mysqli_error($koneksi);

}