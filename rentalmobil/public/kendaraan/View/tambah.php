<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/mobiltambah.php");
 
	$mobilController = new MobilController($kon);

	if (isset($_POST['submit'])) {
		$idmobil = $mobilController->tambahMobil();
       
		$data = [
			'idmobil' => $idmobil,
            'nama_mobil' => $_POST['nama_mobil'],
            'merek' => $_POST['merek'],
            'warna' => $_POST['warna'],
            'tahun' => $_POST['tahun'],
            'harga_perhari' => $_POST['harga_perhari'], // Menambahkan harga per hari
		];

		$message = $mobilController->tambahDataMobil($data);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4 text-center">Tambah Data Mobil</h1>
    <form action="tambah.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label class="block font-bold"> ID Mobil </label>
            <input type="text" name="idmobil" value="<?php echo($mobilController->tambahMobil())?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Nama Mobil </label>
            <input type="text" name="nama_mobil" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Merek </label>
            <input type="text" name="merek" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Warna </label>
            <input type="text" name="warna" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Tahun </label>
            <input type="text" name="tahun" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Harga Per Hari </label>
            <input type="number" name="harga_perhari" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label class="block font-bold"> Gambar Mobil </label>
            <input type="file" name="gambar_mobil" class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <a href="../../dashboard/data/dashboardkendaraan.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4"> Home </a>
        <button type="submit" name="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">Tambah Data</button>
        
        <?php if (isset($message)) : ?>
            <div class="success-message mt-4">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>
