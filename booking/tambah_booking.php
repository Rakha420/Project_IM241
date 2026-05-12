<?php
include '../config/koneksi.php';

$karyawan = mysqli_query(
    $koneksi,
    "SELECT * FROM m_karyawan"
);

$ruangan = mysqli_query(
    $koneksi,
    "SELECT * FROM m_ruangan"
);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Tambah Booking</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial;
            background: #e5e5e5;
        }

        .container {
            width: 500px;
            margin: 20px auto;
            background: #fff;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-top: 5px;
            margin-bottom: 20px;
            font-size: 28px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 9px;
            border: 1px solid #cfcfcf;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        textarea {
            height: 80px;
            resize: none;
        }

        .row {
            display: flex;
            gap: 12px;
        }

        .button-group-top {
            margin-bottom: 10px;
        }

        .button-group-bottom {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            display: inline-block;
        }

        .btn-home {
            background: #2ecc71;
        }

        .btn-back {
            background: #7f8c8d;
        }

        .btn-save {
            background: #3498db;
        }

        .btn-cancel {
            background: #8e8e8e;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="button-group-top">

            <a
                href="javascript:history.back()"
                class="btn btn-back">

                Kembali

            </a>

            <a
                href="../index.php"
                class="btn btn-home">

                Home

            </a>

        </div>

        <h1>Tambah Booking</h1>

        <form
            action="proses_tambah_booking.php"
            method="POST">

            <label>Tanggal Rapat</label>

            <input
                type="date"
                name="tanggal_rapat"
                required>

            <div class="row">

                <div class="col">

                    <label>Jam Mulai</label>

                    <input
                        type="time"
                        name="jam_mulai"
                        required>

                </div>

                <div class="col">

                    <label>Jam Selesai</label>

                    <input
                        type="time"
                        name="jam_selesai"
                        required>

                </div>

            </div>

            <div class="row">

                <div class="col">

                    <label>Nama Ruangan</label>

                    <select
                        name="id_ruang"
                        required>

                        <option value="">
                            -- Pilih Ruangan --
                        </option>

                        <?php
                        while ($r = mysqli_fetch_array($ruangan)) {
                        ?>

                            <option value="<?= $r['id_ruangan']; ?>">

                                <?= $r['nama_ruangan']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <div class="col">

                    <label>Nama Peminjam</label>

                    <select
                        name="id_karyawan"
                        id="id_karyawan"
                        onchange="ambilDivisi()"
                        required>

                        <option value="">
                            -- Pilih Karyawan --
                        </option>

                        <?php
                        mysqli_data_seek($karyawan, 0);

                        while ($k = mysqli_fetch_array($karyawan)) {
                        ?>

                            <option
                                value="<?= $k['id_karyawan']; ?>"
                                data-divisi="<?= $k['divisi']; ?>">

                                <?= $k['nama_karyawan']; ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

            </div>

            <label>Divisi</label>

            <input
                type="text"
                id="divisi"
                readonly>

            <label>Agenda</label>

            <textarea
                name="agenda"
                required></textarea>

            <div class="button-group-bottom">

                <button
                    type="submit"
                    class="btn btn-save">

                    Simpan

                </button>

                <a
                    href="data_booking.php"
                    class="btn btn-cancel">

                    Batal

                </a>

            </div>

        </form>

    </div>

    <script>
        function ambilDivisi() {

            let select =
                document.getElementById('id_karyawan');

            let divisi =
                select.options[
                    select.selectedIndex
                ].getAttribute('data-divisi');

            document.getElementById('divisi').value =
                divisi;

        }
    </script>

</body>

</html>