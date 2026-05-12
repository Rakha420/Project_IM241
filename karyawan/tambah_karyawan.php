<?php
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #e5e5e5;
        }

        .container {
            width: 500px;
            margin: 50px auto;
        }

        .card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 25px;
            font-size: 32px;
            color: #000;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #000;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .button-group {
            margin-top: 25px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            font-size: 15px;
            cursor: pointer;
            border-radius: 4px;
            color: white;
        }

        .btn-save {
            background: #3498db;
        }

        .btn-cancel {
            background: #888;
            text-decoration: none;
            display: inline-block;
            margin-left: 5px;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="card">

            <h2>Tambah Karyawan</h2>

            <form action="proses_tambah_karyawan.php" method="POST">

                <div class="form-group">
                    <label>NIK</label>

                    <input
                        type="text"
                        name="nik"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Nama Karyawan</label>

                    <input
                        type="text"
                        name="nama_karyawan"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Divisi</label>

                    <input
                        type="text"
                        name="divisi"
                        class="form-control"
                        required>
                </div>

                <div class="button-group">

                    <button
                        type="submit"
                        name="simpan"
                        class="btn btn-save">
                        Simpan
                    </button>

                    <a href="data_karyawan.php" class="btn btn-cancel">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>