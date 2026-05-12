<?php include 'config/koneksi.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Smart Office</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <div class="dashboard-container">

        <div class="dashboard-box">

            <h1>Smart Office</h1>

            <p class="subtitle">
                Sistem Booking Ruangan Meeting
            </p>

            <div class="menu-grid">

                <a href="booking/data_booking.php" class="menu-card">

                    <div class="icon">📅</div>

                    <h3>Data Booking</h3>

                    <p>
                        Kelola Jadwal Peminjaman Ruangan Meeting
                    </p>

                </a>

                <a href="ruangan/data_ruangan.php" class="menu-card">

                    <div class="icon">🏢</div>

                    <h3>Data Ruangan</h3>

                    <p>
                        Kelola Data Ruangan Meeting Kantor
                    </p>

                </a>

                <a href="karyawan/data_karyawan.php" class="menu-card">

                    <div class="icon">👨‍💼</div>

                    <h3>Data Karyawan</h3>

                    <p>
                        Kelola Data Karyawan Perusahaan
                    </p>

                </a>

            </div>

        </div>

    </div>

</body>

</html>