<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tag = $_POST['tag'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    $tag_hasil = mysqli_query($koneksi, "SELECT tag FROM siswa WHERE nama='$nama'");
    $tag_row = mysqli_fetch_array($tag_hasil);
    $old_tag = $tag_row['tag'];

    // Update tag di tabel siswa
    $update_siswa = mysqli_query($koneksi, "UPDATE siswa SET tag='$tag', kelas='$kelas' WHERE nama='$nama'");

    // Update tag di tabel masuk dan keluar
    $update_masuk = mysqli_query($koneksi, "UPDATE masuk SET tag='$tag' WHERE tag='$old_tag'");
    $update_keluar = mysqli_query($koneksi, "UPDATE keluar SET tag='$tag' WHERE tag='$old_tag'");
    $sql="DELETE from tambah where tag='$tag'";
    mysqli_query($koneksi, $sql);

    if ($update_siswa && $update_masuk && $update_keluar) {
        header("location:datasiswa.php");
    } else {
        echo "Gagal mengupdate data.";
    }
} else {
    echo "Akses tidak diizinkan.";
}
?>
