<?php
include '../config/koneksi.php';

$ruangan = mysqli_query($koneksi, "SELECT * FROM m_ruangan");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Ruangan</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* CSS Grid sesuai Soal Hal 10 */
        .grid-ruangan {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0;
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
        }

        .filter-box {
            margin-bottom: 20px;
            background: white;
            padding: 15px;
            border-radius: 10px;
        }

        input[type=text] {
            padding: 10px;
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background: #3498db;
            color: white;
        }

        .edit {
            background: orange;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .hapus {
            background: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-group {
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            font-size: 15px;
            cursor: pointer;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back {
            background: #7f8c8d;
        }

        .btn-home {
            background: #2ecc71;
        }

        .btn-save {
            background: #3498db;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

    <div class="button-group">
        <a href="javascript:history.back()" class="btn btn-back">Kembali</a>
        <a href="../index.php" class="btn btn-home">Home</a>
    </div>

    <div class="top">
        <div>
            <h2>Smart Office System</h2>
            <p>Data Ruangan</p>
        </div>
        <div>
            <a href="tambah_ruangan.php" class="btn btn-save">Tambah Ruangan</a>
        </div>
    </div>

    <div class="grid-ruangan">
        <?php while ($r = mysqli_fetch_array($ruangan)) { ?>
            <div class="card">
                <h3><?= $r['nama_ruangan']; ?></h3>
                <p>Kapasitas: <?= $r['kapasitas']; ?></p>
                <p>Fasilitas: <?= $r['fasilitas']; ?></p>
            </div>
        <?php } ?>
    </div>

    <div class="filter-box">
        <label>Cari Ruangan:</label>
        <input type="text" id="filterInput" placeholder="Cari ruangan...">
    </div>

    <table id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Fasilitas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            mysqli_data_seek($ruangan, 0); // Reset pointer data
            while ($row = mysqli_fetch_array($ruangan)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_ruangan']; ?></td>
                    <td><?= $row['kapasitas']; ?></td>
                    <td><?= $row['fasilitas']; ?></td>
                    <td>
                        <a href="edit_ruangan.php?id=<?= $row['id_ruangan']; ?>" class="edit">Edit</a>
                        <a href="hapus_ruangan.php?id=<?= $row['id_ruangan']; ?>" class="hapus">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="../assets/js/script.js"></script>
</body>

</html>