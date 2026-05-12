<?php
include '../config/koneksi.php';
simpanLog($koneksi, "TEST LOG MASUK");

// Ambil data ruangan untuk Card View (Bagian Atas)
$ruangan = mysqli_query($koneksi, "SELECT * FROM m_ruangan");

// Ambil data booking untuk Tabel (Bagian Bawah)
$booking = mysqli_query($koneksi, "
    SELECT t_booking.*, m_ruangan.nama_ruangan, m_karyawan.nama_karyawan, m_karyawan.divisi 
    FROM t_booking 
    JOIN m_ruangan ON t_booking.id_ruang = m_ruangan.id_ruangan 
    JOIN m_karyawan ON t_booking.id_karyawan = m_karyawan.id_karyawan 
    ORDER BY tanggal_rapat DESC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Booking</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 20px;
        }

        h2 {
            margin-bottom: 5px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Grid Card View */
        .grid-ruangan {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0 0 10px 0;
            color: #2c3e50;
        }

        .card p {
            margin: 5px 0;
            font-size: 14px;
            color: #7f8c8d;
        }

        .filter-box {
            margin-bottom: 20px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        input[type=date] {
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
            border-radius: 10px;
            overflow: hidden;
        }

        table th,
        table td {
            border: 1px solid #eee;
            padding: 12px;
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
            font-size: 13px;
        }

        .hapus {
            background: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 13px;
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
            <p>Data Peminjaman Ruangan</p>
        </div>
        <a href="tambah_booking.php" class="btn btn-save">Tambah Booking</a>
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
        <label>Filter Tanggal Rapat:</label><br><br>
        <input type="date" id="filterTanggal">
    </div>

    <table id="tabelPeminjaman">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Nama Ruangan</th>
                <th>Nama Peminjam</th>
                <th>Divisi</th>
                <th>Agenda</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($booking) > 0) {
                while ($data = mysqli_fetch_array($booking)) {
            ?>
                    <tr data-tanggal="<?= $data['tanggal_rapat']; ?>">
                        <td><?= $no++; ?></td>
                        <td><?= $data['tanggal_rapat']; ?></td>
                        <td><?= $data['jam_mulai']; ?> - <?= $data['jam_selesai']; ?></td>
                        <td><?= $data['nama_ruangan']; ?></td>
                        <td><?= $data['nama_karyawan']; ?></td>
                        <td><?= $data['divisi']; ?></td>
                        <td><?= $data['agenda']; ?></td>
                        <td>
                            <a href="edit_booking.php?id=<?= $data['id_booking']; ?>" class="edit">Edit</a>
                            <a href="hapus_booking.php?id=<?= $data['id_booking']; ?>" class="hapus">Hapus</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='8'>Belum ada data booking.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script src="../assets/js/script.js"></script>
</body>

</html>