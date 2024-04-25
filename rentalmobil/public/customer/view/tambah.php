<?php  
	include_once("../../../config/koneksi.php");
	include_once("../Controller/customertambah.php");
 
	$customerController = new CustomerController($kon);

	if (isset($_POST['submit'])) {
		$idcustomer = $customerController->tambahCustomer();

		$data = [
			'idcustomer' => $idcustomer,
      		'nama' => $_POST['nama'],
      		'alamat' => $_POST['alamat'],
      		'email' => $_POST['email'],
      		'no_hp' => $_POST['no_hp'],
		];

		$message = $customerController->tambahDataCustomer($data);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4 text-center">Tambah Data Customer</h1>
    
    <form action="tambah.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label for="idcustomer" class="block font-bold">NO ID</label>
            <input type="text" name="idcustomer" value="<?php echo($customerController->tambahCustomer())?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="nama" class="block font-bold">Nama</label>
            <input type="text" name="nama" required 
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="alamat" class="block font-bold"> Alamat </label>
            <input type="text" name="alamat" required
            class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="email" class="block font-bold"> Email </label>
            <input type="text" name="email" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="no_hp" class="block font-bold"> No. HP </label>
            <input type="text" name="no_hp" required
            class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <a href="../../dashboard/data/dashboardcustomer.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
        <button type="submit" name="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Tambah Data </button>
        <?php if (isset($message)) : ?>
            <div class="success-message">
                <?php echo($message) ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>