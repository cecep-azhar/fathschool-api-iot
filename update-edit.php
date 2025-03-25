<?php
include 'koneksi.php';
// menyimpan data kedalam variabel
$No  = $_POST['No'];
$tag           = $_POST['tag'];
$nama           = $_POST['nama'];
$kelas     = $_POST['kelas'];
// query SQL untuk insert data
$query="UPDATE siswa SET tag='$tag',nama='$nama',kelas='$kelas' where No='$No'";
mysqli_query($koneksi, $query);
// mengalihkan ke halaman index.php
header("location:datasiswa.php");
?>