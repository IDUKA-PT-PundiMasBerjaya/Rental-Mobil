<?php  
	include_once("../../../config/koneksi.php");
	include_once("../Controller/customerupdate.php");

	$customerController = new CustomerController($kon);

	if (isset($_POST['update'])) {
		$idcustomer = $_POST['idcustomer'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
		$no_hp = $_POST['no_hp'];

		$message = $customerController->updateCustomer($idcustomer, $nama, $alamat, $email, $no_hp);
		echo $message;

		header("Location: ../../dashboard/data/dashboardcustomer.php");
	}

	$idcustomer = null;
	$nama = null;
	$alamat = null;
	$email = null;
	$no_hp = null;

	if (isset($_GET['idcustomer']) && is_numeric($_GET['idcustomer'])) {
		$idcustomer = $_GET['idcustomer'];
		$result = $customerController->getDataCustomer($idcustomer);

		if ($result) {
			$idcustomer = $result['idcustomer'];
			$nama = $result['nama'];
			$alamat = $result['alamat'];
			$email = $result['email'];
			$no_hp = $result['no_hp'];
		} else{
			echo "ID Tidak Valid.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1  class="text-2xl font-bold mb-4 text-center">Update Data Customer</h1>
    <form action="update.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label class="block font-bold">ID Customer</label>
            <input type="text" name="idcustomer" value="<?php echo $idcustomer; ?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Nama</label>
            <input type="text" name="nama" value="<?php echo $nama; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Alamat</label>
            <input type="text" name="alamat" value="<?php echo $alamat; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">No. HP</label>
            <input type="number" name="no_hp" value="<?php echo $no_hp; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
            <a href="../../dashboard/data/dashboardcustomer.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
            <button type="submit" name="update"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Update Data</button>
    </form>
</body>
</html>