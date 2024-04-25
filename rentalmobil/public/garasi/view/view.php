<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/viewdata.php");

	$garasiController = new GarasiController($kon);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../src/output.css">
</head>

<body class="bg-gray-100 p-8">

    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Detail Kendaraan</h1>
        <form action="view.php" name="update_data" method="post">
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-3">
                    <label class="font-bold">ID Garasi :</label>
                    <span><?php echo $idgarasi; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Nama Mobil :</label>
                    <span><?php echo $nama_mobil; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Merek :</label>
                    <span><?php echo $merek; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Warna :</label>
                    <span><?php echo $warna; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Tahun :</label>
                    <span><?php echo $tahun; ?></span>
                </div>
				<div class="col-span-3">
                    <label class="font-bold">Tersedia :</label>
                    <span><?php echo $stok; ?></span>
                </div>
                <div class="col-span-3">
                    <label class="font-bold">Gambar Mobil :</label>
                    <img src="../../kendaraan/aset/<?php echo $gambar; ?>" alt="<?php echo $gambar; ?>"
                        class="mt-2 w-full h-auto">
                </div>
            </div>
        </form>
		<br><br>
		<a href="../../dashboard/data/dashboardgarasi.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Home</a>
    </div>
</body>

</html>
