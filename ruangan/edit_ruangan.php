<?php
include '../config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM m_ruangan WHERE id_ruangan='$id'"
);

$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Ruangan</title>

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

        .form-group {
            margin-bottom: 18px;
        }

        .top-button {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
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
            color: white;
        }

        .btn-save {
            background: #3498db;
        }

        .btn-cancel {
            background: #95a5a6;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>

</head>

<body>

    <div class="container">

        <h1>Edit Ruangan</h1>

        <form method="POST" action="proses_edit_ruangan.php">

            <input
                type="hidden"
                name="id_ruangan"
                value="<?= $data['id_ruangan']; ?>">

            <input type="hidden" name="old_nama_ruangan" value="<?= $data['nama_ruangan']; ?>">

            <input type="hidden" name="old_kapasitas" value="<?= $data['kapasitas']; ?>">

            <input type="hidden" name="old_fasilitas" value="<?= $data['fasilitas']; ?>">

            <div class="form-group">

                <label>Nama Ruangan</label>

                <input
                    type="text"
                    name="nama_ruangan"
                    value="<?= $data['nama_ruangan']; ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Kapasitas</label>

                <input
                    type="number"
                    name="kapasitas"
                    value="<?= $data['kapasitas']; ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Fasilitas</label>

                <textarea
                    name="fasilitas"
                    required><?= $data['fasilitas']; ?></textarea>

            </div>

            <div class="button-group">

                <button type="submit" class="btn btn-save">
                    Simpan
                </button>

                <a href="data_ruangan.php" class="btn btn-cancel">
                    Batal
                </a>

            </div>

        </form>

    </div>

</body>

</html>