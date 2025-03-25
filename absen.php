<?php
require "koneksi.php";

// Menangkap data dari mikrokontroller
$tag = $_GET["tag"];

// Mendapatkan tanggal hari ini
$tanggal_hari_ini = date('Y-m-d');

// Memeriksa apakah sudah ada data dengan tag yang sama pada hari ini
$query_cek = "SELECT * FROM masuk WHERE tag = '$tag' AND DATE(tanggal) = '$tanggal_hari_ini'";
$result = mysqli_query($koneksi, $query_cek);

if (mysqli_num_rows($result) > 0) {
    // Jika sudah ada data dengan tag yang sama pada hari ini
    echo "gagal";
} else {
    // Jika belum ada data, maka tambahkan data ke database
    $query = "INSERT INTO masuk (tag, tanggal) VALUES ('$tag', NOW())";
    if (mysqli_query($koneksi, $query)) {
        echo "berhasil";
    } else {
        echo "gagal menyimpan data";
    }
}

?>
