<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/garasitambah.php");
 
	$garasiController = new GarasiController($kon);

	if (isset($_POST['submit'])) {
		$idgarasi = $garasiController->tambahGarasi();

		$data = [
			'idgarasi' => $idgarasi,
            'kendaraan_idmobil' => $_POST['kendaraan_idmobil'],
      		'stok' => $_POST['stok'],
		];

		$message = $garasiController->tambahDataGarasi($data);
    
	}
    $dataMobil= "SELECT idmobil, nama_mobil, merek, warna, tahun FROM kendaraan WHERE idmobil NOT IN (SELECT kendaraan_idmobil FROM garasi)";
    $hasilMobil= mysqli_query($kon, $dataMobil);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
    <style>
        .success-message {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #d1f5e9;
            border: 1px solid #4caf50;
            color: #4caf50;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="bg-gray-100 p-8">
    <h1 class="text-2xl font-bold mb-4 text-center">Tambah Data Kendaraan</h1>

    <form action="tambah.php" method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <div class="mb-4">
            <label for="id" class="block font-bold">NO ID</label>
            <input type="text" name="id" id="id" value="<?php echo $garasiController->TambahGarasi() ?>" readonly
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
        </div>
        <div class="mb-4">
            <label for="kendaraan_idmobil" class="block font-bold">Mobil</label>
            <select name="kendaraan_idmobil" id="kendaraan_idmobil" required
                class="w-full border border-gray-300 px-3 py-2 rounded-md">
                <?php if (mysqli_num_rows($hasilMobil) == 0) : ?>
                    <option disabled>Tidak ada data di Kendaraan.</option>
                <?php else : ?>
                    <?php while ($row = mysqli_fetch_assoc($hasilMobil)) : ?>
                        <option value="<?php echo $row['idmobil']; ?>">
                            <?php echo $row['idmobil'] . ' - ' . $row['nama_mobil'] . ' ' . $row['merek'] . ' ' . $row['warna'] . ' - ' . $row['tahun'] ?>
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="stok" class="block font-bold">Stok</label>
            <input type="number" name="stok" id="stok" class="w-full border border-gray-300 px-3 py-2 rounded-md"
                required>
        </div>
        <a href="../../dashboard/data/dashboardgarasi.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
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
