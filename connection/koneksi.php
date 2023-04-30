<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "erapor";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("connection lost");
}
mysqli_select_db($koneksi,$db);


?>