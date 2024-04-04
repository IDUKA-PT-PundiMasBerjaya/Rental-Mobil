<?php  
	include_once("../../../config/koneksi.php");
	include_once("../Controller/viewdata.php");

	$customerController = new CustomerController($kon);
?>

<!DOCTYPE html>
<html>
<head>
	<title>View Customer Data</title>
</head>
<body>
	<a href="../../dashboard/data/dashboardcustomer.php">Home</a>
	<br><br>
	<form name="update_data" method="post" action="view.php">
		<table border="0">
			<tr>
				<td>ID Customer </td>
				<td>: </td>
				<td><?php echo $idcustomer; ?></td>
			</tr>
			<tr>
				<td>Nama Customer </td>
				<td>: </td>
				<td><?php echo $nama; ?></td>
			</tr>
			<tr>
				<td>Alamat Guru </td>
				<td>: </td>
				<td><?php echo $alamat; ?></td>
			</tr>
			<tr>
				<td>Email </td>
				<td>: </td>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td>No HP </td>
				<td>: </td>
				<td><?php echo $no_hp; ?></td>
			</tr>
		</table>
	</form>
</body>
</html>