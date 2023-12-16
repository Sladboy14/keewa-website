<?php
// Inisialisasi koneksi ke database
$con = mysqli_connect("localhost", "root","", "keewa_shoes");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

?>