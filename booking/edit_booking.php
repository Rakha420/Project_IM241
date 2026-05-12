<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "

SELECT
t.*,
k.divisi,
k.nama_karyawan

FROM t_booking t

JOIN m_karyawan k
ON t.id_karyawan = k.id_karyawan

WHERE t.id_booking='$id'

");

$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Booking</title>

    <style>
        body {
            background: #e5e5e5;
            font-family: Arial;
        }

        .container {
            width: 500px;
            margin: 25px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #ccc;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea {
            height: 90px;
            resize: none;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .readonly {
            background: #f1f1f1;
        }

        .button-group {
            text-align: right;
            margin-top: 15px;
        }

        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-save {
            background: #3498db;
            color: white;
        }

        .btn-cancel {
            background: #95a5a6;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>

</head>

<body>

    <div class="container">

        <h1>Edit Peminjaman</h1>

        <form action="proses_edit_booking.php" method="POST">

            <input type="hidden" name="id_booking" value="<?= $data['id_booking']; ?>">
            <input type="hidden" name="old_tanggal" value="<?= $data['tanggal_rapat']; ?>">
            <input type="hidden" name="old_jam_mulai" value="<?= $data['jam_mulai']; ?>">
            <input type="hidden" name="old_jam_selesai" value="<?= $data['jam_selesai']; ?>">
            <input type="hidden" name="old_id_ruang" value="<?= $data['id_ruang']; ?>">
            <input type="hidden" name="old_agenda" value="<?= $data['agenda']; ?>">

            <div class="form-group">
                <label>Tanggal Rapat</label>

                <input
                    type="date"
                    name="tanggal_rapat"
                    value="<?= $data['tanggal_rapat']; ?>"
                    required>
            </div>

            <div class="row">

                <div class="form-group">
                    <label>Jam Mulai</label>

                    <input
                        type="time"
                        name="jam_mulai"
                        value="<?= $data['jam_mulai']; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label>Jam Selesai</label>

                    <input
                        type="time"
                        name="jam_selesai"
                        value="<?= $data['jam_selesai']; ?>"
                        required>
                </div>

            </div>

            <div class="row">

                <div class="form-group">

                    <label>Nama Ruangan</label>

                    <select name="id_ruang" required>

                        <?php

                        $ruang = mysqli_query($koneksi, "

                    SELECT *
                    FROM m_ruangan

                    ");

                        while ($r = mysqli_fetch_array($ruang)) {

                            $selected = '';

                            if ($r['id_ruangan'] == $data['id_ruang']) {

                                $selected = 'selected';
                            }

                        ?>

                            <option
                                value="<?= $r['id_ruangan']; ?>"
                                <?= $selected; ?>>
                                <?= $r['nama_ruangan']; ?>
                            </option>

                        <?php
                        }

                        ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Nama Peminjam</label>

                    <input
                        type="text"
                        value="<?= $data['nama_karyawan']; ?>"
                        class="readonly"
                        readonly>

                    <input
                        type="hidden"
                        name="id_karyawan"
                        value="<?= $data['id_karyawan']; ?>">

                </div>

            </div>

            <div class="form-group">

                <label>Divisi</label>

                <input
                    type="text"
                    value="<?= $data['divisi']; ?>"
                    class="readonly"
                    readonly>

            </div>

            <div class="form-group">

                <label>Agenda</label>

                <textarea
                    name="agenda"
                    required><?= $data['agenda']; ?></textarea>

            </div>

            <div class="button-group">

                <button type="submit" class="btn btn-save">
                    Simpan
                </button>

                <a
                    href="javascript:history.back()"
                    class="btn btn-cancel">
                    Batal
                </a>

            </div>

        </form>

    </div>

</body>

</html>