<?php
include 'koneksi.php';

// Check if the download button is clicked
if (isset($_POST['download'])) {
    // Validate and sanitize the start and end dates
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    $startDate = mysqli_real_escape_string($koneksi, $startDate);
    $endDate = mysqli_real_escape_string($koneksi, $endDate);


    $sql = "SELECT masuk.tag, masuk.masuk, keluar.keluar, masuk.tanggal as tanggal_masuk, keluar.tanggal as tanggal_keluar, siswa.nama, siswa.kelas
            FROM masuk 
            LEFT JOIN keluar ON masuk.tag = keluar.tag
            INNER JOIN siswa ON masuk.tag = siswa.tag
            WHERE masuk.tanggal = keluar.tanggal AND masuk.tanggal BETWEEN '$startDate' AND '$endDate'
            ORDER BY masuk.tanggal DESC, masuk.masuk DESC";

    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        $filename = "absensi_data_" . $startDate . "_to_" . $endDate . ".xls"; // Set the filename based on the selected date range

        // Output Excel headers
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo "<table border='1'>";
        echo "<tr><th colspan='7'>Data Absensi</th></tr>";
        echo "<tr><th colspan='7'>Tanggal: " . $startDate . " to " . $endDate . "</th></tr>";
        echo "<tr>";
        echo "<th>No</th>";
        echo "<th>Tag</th>";
        echo "<th>Nama</th>";
        echo "<th>Kelas</th>";
        echo "<th>Tanggal</th>";
        echo "<th>Masuk</th>";
        echo "<th>Keluar</th>";
        echo "</tr>";

        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['tag'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['kelas'] . "</td>";
            echo "<td>" . $row['tanggal_masuk'] . "</td>";
            echo "<td>" . $row['masuk'] . "</td>";
            echo "<td>" . $row['keluar'] . "</td>";
            echo "</tr>";
            $no++;
        }

        echo "</table>";

        mysqli_free_result($result);
        mysqli_close($koneksi);
        exit();
    }
}
?>
