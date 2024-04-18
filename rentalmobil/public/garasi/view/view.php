<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/viewdata.php");

	$garasiController = new GarasiController($kon);
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Data Garasi </title>
</head>
<body>
	<a href="../../dashboard/data/dashboardgarasi.php">Home</a>
	<br><br>
	<form name="update_data" method="post" action="view.php">
		<table border="0">
			<tr>
				<td>ID Garasi </td>
				<td>: </td>
				<td><?php echo $idgarasi; ?></td>
			</tr>
			<tr>
				<td>Nama Mobil</td>
				<td>: </td>
				<td><?php echo $nama_mobil; ?></td>
			</tr>
			<tr>
				<td>Merek</td>
				<td>: </td>
				<td><?php echo $merek; ?></td>
			</tr>
			<tr>
				<td>Warna</td>
				<td>: </td>
				<td><?php echo $warna; ?></td>
			</tr>
			<tr>
				<td>Tahun</td>
				<td>: </td>
				<td><?php echo $tahun; ?></td>
			</tr>
			<tr>
				<td>Gambar Mobil</td>
				<td>: </td>
				<td><?php echo $gambar; ?></td>
			</tr>
			<tr>
				<td>Tersedia </td>
				<td>: </td>
				<td><?php echo $stok; ?></td>
			</tr>
		</table>
	</form>
</body>
</html>