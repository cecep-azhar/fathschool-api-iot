<?php 
	include 'koneksi.php';
?>
<html>
<head>
	<title>Absensi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1, h2 {
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty {
			background-color: #ffcccc;
		}

		/* Form container */
		.form-container {
			display: flex;
			justify-content: center; /* Center the boxes horizontally */
			gap: 20px; /* Add space between the boxes */
			margin: 20px auto;
			width: fit-content;
		}

		/* Form boxes */
		.form-box {
			border: 1px solid #ccc;
			padding: 15px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			width: 300px; /* Set a fixed width for the box */
			display: flex;
			flex-direction: column;
			align-items: center; /* Center the form elements horizontally */
			justify-content: center; /* Center the form elements vertically */
		}
		.form-title {
			margin-bottom: 15px;
			font-size: 18px;
			font-weight: bold;
			text-align: center;
			width: 100%;
		}
		form {
			width: 100%; /* Ensure the form takes the full width of the form-box */
		}
		label, input {
			width: 100%; /* Ensure the label and input fields take the full width */
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="form-container">
		<!-- <div class="form-box">
			<div class="form-title">Filter Data</div>
		    <form method="post" action="">
		        <label for="start_date">Tanggal Awal:</label>
		        <input type="date" name="start_date" id="start_date" required>
		        <label for="end_date">Tanggal Akhir:</label>
		        <input type="date" name="end_date" id="end_date" required>
		        <input type="submit" name="filter" class="w3-button w3-blue" value="Filter Data">
		    </form>
		</div> -->
		<div class="form-box">
			<div class="form-title">Download Data</div>
		    <form method="post" action="download.php">
		        <label for="start_date_download">Tanggal Awal:</label>
		        <input type="date" name="start_date" id="start_date_download" required>
		        <label for="end_date_download">Tanggal Akhir:</label>
		        <input type="date" name="end_date" id="end_date_download" required>
		        <input type="submit" name="download" class="w3-button w3-blue" value="Download Data">
		    </form>
		</div>
	</div>
	<table class="data-table">
		<caption class="title">Data Absensi Siswa</caption>
		<center></center>
		<thead>
			<tr>
				<th>No</th>
				<th>Tag</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Tanggal</th>
				<th>Masuk</th>
				<th>Keluar</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
		$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

		if ($start_date && $end_date) {
			$sql = "SELECT masuk.tag, masuk.masuk, keluar.keluar, masuk.tanggal as tanggal_masuk, siswa.nama, siswa.kelas
			        FROM masuk 
			        LEFT JOIN keluar ON masuk.tag = keluar.tag AND masuk.tanggal = keluar.tanggal
			        INNER JOIN siswa ON masuk.tag = siswa.tag
			        WHERE masuk.tanggal BETWEEN '$start_date' AND '$end_date'
			        ORDER BY masuk.tanggal DESC, masuk.masuk DESC";
		} else {
			$sql = "SELECT masuk.tag, masuk.masuk, keluar.keluar, masuk.tanggal as tanggal_masuk, siswa.nama, siswa.kelas
			        FROM masuk 
			        LEFT JOIN keluar ON masuk.tag = keluar.tag AND masuk.tanggal = keluar.tanggal
			        INNER JOIN siswa ON masuk.tag = siswa.tag
			        ORDER BY masuk.tanggal DESC, masuk.masuk DESC";
		}

		$result = mysqli_query($koneksi, $sql);
		if (mysqli_num_rows($result) > 0) {
			$currentDate = null;
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<tr>
						<td>'.$no.'</td>
						<td>'.$row['tag'].'</td>
						<td>'.$row['nama'].'</td>
						<td>'.$row['kelas'].'</td>
						<td>'.$row['tanggal_masuk'].'</td>
						<td>'.$row['masuk'].'</td>
						<td>'.$row['keluar'].'</td>
					</tr>';
				$no++;
			}
		}?>
		</tbody>
	</table>
</body>
</html>
