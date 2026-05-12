<?php
$host = "db"; // Sesuaikan dengan nama service di docker-compose
$user = "root";
$pass = "secret_password";
$db   = "db_office_smart";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal : " . mysqli_connect_error());
}