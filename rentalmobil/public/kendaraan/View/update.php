<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/mobilupdate.php");

	$mobilController = new MobilController($kon);

	if (isset($_POST['update'])) {
	$idmobil = $_POST['idmobil'];
	$nama_mobil = $_POST['nama_mobil'];
    $merek = $_POST['merek'];
    $warna = $_POST['warna'];
    $tahun = $_POST['tahun'];
    $harga_perhari = $_POST['harga_perhari']; // Menambahkan harga per hari

		$message = $mobilController->updateMobil($idmobil, $nama_mobil, $merek, $warna, $tahun, $harga_perhari); // Menambahkan harga per hari sebagai argumen
		echo $message;

		header("Location: ../../dashboard/data/dashboardkendaraan.php");
	}

	$idmobil = null;
    $nama_mobil = null;
    $merek = null;
    $warna = null;
    $tahun = null;
    $harga_perhari = null; // Inisialisasi harga per hari

	if (isset($_GET['idmobil']) && is_numeric($_GET['idmobil'])) {
		$idmobil = $_GET['idmobil'];
		$result = $mobilController->getDataMobil($idmobil);

		if ($result) {
			$idmobil = $result['idmobil'];
			$nama_mobil = $result['nama_mobil'];
			$merek = $result['merek'];
            $warna = $result['warna'];
			$tahun = $result['tahun'];
			$harga_perhari = $result['harga_perhari']; // Menambahkan harga per hari
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
    <title>Update Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4 text-center">Update Data Kendaraan</h1>
    <form action="update.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label class="block font-bold">ID Mobil</label>
            <input type="text" name="idmobil" value="<?php echo $idmobil; ?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Nama Mobil</label>
            <input type="text" name="nama_mobil" value="<?php echo $nama_mobil; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Merek</label>
            <input type="text" name="merek" value="<?php echo $merek; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Warna</label>
            <input type="text" name="warna" value="<?php echo $warna; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Tahun</label>
            <input type="number" name="tahun" value="<?php echo $tahun; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold">Harga Per Hari</label>
            <input type="text" name="harga_perhari" value="<?php echo $harga_perhari; ?>"
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <a href="../../dashboard/data/dashboardkendaraan.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
        <button type="submit" name="update"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Update Data</button>
    </form>
</body>
</html>
