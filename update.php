	<?php 
		include 'koneksi.php';
		?>
<html>
<head>
<meta http-equiv="refresh" content="3">
	<title>Tambah Data</title>
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

		h1 {
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
		}
				h2 {
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
			padding: 7px 17px;text-align: center;
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
			text-align: center;
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
			text-align: center;
		}
		.data-table tfoot th:first-child {
			text-align: center;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
		a {
    font-family: sans-serif;
    font-size: 15px;
    background: #22a4cf;
    color: white;
    border: white 3px solid;
    border-radius: 5px;
    padding: 6px 10px;
    margin-top: 5px;
}
a {
    text-decoration: none;
}
a:hover {
    opacity:0.9;
}
	</style>
</head>
<body>
	<table class="data-table">
		<caption class="title">Tambah Data Siswa</caption>
		<?php include 'navbar.php'; ?>
		<thead>
			<tr>
				<th>No</th>
				<th>Tag</th>
				<th>Data</th>
			</tr>
			
		</thead>
		<tbody>
		<?php
		$no 	= 1;
				$sql = mysqli_query($koneksi,"select * from tambah");
			
		while ($row= mysqli_fetch_array($sql))
{
			echo "<tr>
					<td>".$no."</td>
					<td>".$row['tag']."</td>
					<td> <a href='tambahdata.php?tag=$row[tag]'>Tambahkan Data</a>
					<a href='edittag.php?tag=$row[tag]'>Edit Tag</a>  </td>
				</tr>";
			$no++;
			 
}?>
 
		</tbody>
	</table>
</body>
</html>