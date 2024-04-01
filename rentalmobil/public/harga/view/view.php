<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/viewdata.php");

	$hargaController = new HargaController($kon);
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Data Harga </title>
</head>
<body>
	<a href="../../dashboard/data/dashboardharga.php">Home</a>
	<br><br>
	<form name="update_data" method="post" action="view.php">
		<table border="0">
			<tr>
				<td>ID Harga </td>
				<td>: </td>
				<td><?php echo $idharga; ?></td>
			</tr>
			<tr>
				<td>Harga </td>
				<td>: </td>
				<td><?php echo $harga_perhari; ?></td>
			</tr>
		</table>
	</form>
</body>
</html>