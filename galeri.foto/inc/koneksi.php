<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "galeri2"; // Updated to avoid using a dot

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
