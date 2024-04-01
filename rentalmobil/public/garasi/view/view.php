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
				<td>Tersedia </td>
				<td>: </td>
				<td><?php echo $tersedia; ?></td>
			</tr>
		</table>
	</form>
</body>
</html>