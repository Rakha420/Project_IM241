<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "

SELECT * FROM m_ruangan

WHERE id_ruangan='$id'

");

$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Hapus Ruangan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #e5e5e5;
            font-family: Arial;
        }

        .container {
            width: 420px;
            margin: 80px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 30px;
        }

        .info {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            line-height: 28px;
        }

        label {
            font-size: 15px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 25px;
            border: 1px solid #bbb;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .btn-hapus {
            background: #e74c3c;
            color: white;
        }

        .btn-batal {
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

        <h2>Konfirmasi Hapus</h2>

        <div class="info">

            <b>Nama Ruangan :</b><br>
            <?= $data['nama_ruangan']; ?>

            <br><br>

            <b>Kapasitas :</b><br>
            <?= $data['kapasitas']; ?>

        </div>

        <p>

            Ketik Kode:

            <b>HAPUS</b>

            Untuk Menghapus Data Ruangan.

        </p>

        <form
            action="proses_hapus_ruangan.php"
            method="POST">

            <input
                type="hidden"
                name="id_ruangan"
                value="<?= $data['id_ruangan']; ?>">

            <input
                type="hidden"
                name="nama_ruangan"
                value="<?= $data['nama_ruangan']; ?>">

            <input
                type="text"
                name="kode"
                placeholder="Ketik HAPUS"
                required>

            <div class="button-group">

                <button
                    type="submit"
                    class="btn btn-hapus">

                    Hapus Data

                </button>

                <a
                    href="data_ruangan.php"
                    class="btn btn-batal">

                    Batal

                </a>

            </div>

        </form>

    </div>

</body>

</html>