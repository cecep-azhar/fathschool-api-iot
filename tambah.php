<?php
require "koneksi.php";

//Menangkap data dari mikrokontroller
$tag        = $_GET["tag"];

$query = "INSERT INTO tambah (tag) VALUES ('$tag')";
mysqli_query($koneksi, $query);


?>