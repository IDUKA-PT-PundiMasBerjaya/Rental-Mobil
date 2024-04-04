<?php  
	include_once("../../../config/koneksi.php");
	include_once("../Controller/viewdata.php");

	$mobilController = new MobilController($kon);
?>

<!DOCTYPE html>
<html>
<head>
	<title>View User Data</title>
</head>
<body>
	<a href="../../dashboard/data/dashboardkendaraan.php">Home</a>
	<br><br>
	<form name="update_data" method="post" action="view.php">
		<table border="0">
			<tr>
				<td>ID Mobil </td>
				<td>: </td>
				<td><?php echo $idmobil; ?></td>
			</tr>
			<tr>
				<td>Nama Mobil </td>
				<td>: </td>
				<td><?php echo $nama_mobil; ?></td>
			</tr>
			<tr>
				<td>Merek </td>
				<td>: </td>
				<td><?php echo $merek; ?></td>
			</tr>
			<tr>
				<td>Tahun </td>
				<td>: </td>
				<td><?php echo $tahun; ?></td>
			</tr>
			<tr>
				<td>gambar </td>
				<td>: </td>
				<td><?php echo $gambar_mobil; ?></td>
			</tr>
			<tr>
				<td>Tersedia </td>
				<td>: </td>
				<td><?php echo $tersedia; ?></td>
			</tr>
			<tr>
				<td>Harga Mobil</td>
				<td>: </td>
				<td><?php echo $idharga; ?></td>
			</tr>
		</table>
	</form>
</body>
</html>