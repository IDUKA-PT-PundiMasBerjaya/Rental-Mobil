<?php  
	include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../src/output.css">
</head>
<body class="bg-gray-100 p-8">

<form action="dashboardkendaraan.php" method="get" class="mb-4">
    <label class="mr-2">Cari:</label>
    <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" class="border border-gray-300 px-3 py-1 rounded-md">
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-md">Cari</button>
</form>

<?php 
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
}
?>

<h1 class="text-2xl font-bold mb-4">List Mobil </h1>

<div class="mb-4">
    <a href="../../kendaraan/view/tambah.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Tambah Data</a>
    <a href="../../kendaraan/view/cetak.php" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Cetak</a>
    <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Home</a>
</div>
<table class="border-collapse border border-gray-400 w-full">
    <thead>
        <tr>
        	<th class="border border-gray-400 px-4 py-2 text-center">ID Mobil</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Nama</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Merek</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Warna</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Tahun</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Gambar</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Harga Perhari</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
        <tbody>
			<?php  
				if (isset($_GET['cari'])) {
					$cari = $_GET['cari'];
					$ambildata = mysqli_query($kon, "SELECT * FROM kendaraan
                                        WHERE kendaraan.idmobil LIKE '%".$cari."%' OR kendaraan.nama_mobil LIKE '%".$cari."%'");
				} else {
					$ambildata = mysqli_query($kon, "SELECT * FROM kendaraan
                                          ORDER BY kendaraan.idmobil ASC ");
					$num = mysqli_num_rows($ambildata);
				}

            if ($ambildata) {
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                    echo "<td class='border border-blue-400 px-4 py-2'>" . $idmobil = $userAmbilData['idmobil'] . "</td>";
                    echo "<td class='border border-blue-400 px-4 py-2'>" . $nama_mobil = $userAmbilData['nama_mobil'] . "</td>";
                    echo "<td class='border border-blue-400 px-4 py-2'>" . $merek =$userAmbilData['merek'] . "</td>";
                    echo "<td class='border border-blue-400 px-4 py-2'>" . $warna = $userAmbilData['warna'] . "</td>";
                    echo "<td class='border border-blue-400 px-4 py-2'>" . $tahun = $userAmbilData['tahun'] . "</td>";
                    echo "<td class='border border-blue-400 px-4 py-2'>";
                        $data = mysqli_query($kon, "SELECT * FROM kendaraan WHERE idmobil = '{$userAmbilData['idmobil']}'");
                        while ($row = mysqli_fetch_array($data)) {
                            echo "<a href='javascript:void(0);' onclick=\"window.open(../../kendaraan/aset/{$row['gambar_mobil']}', '_blank');\">
                                    <img src='../../kendaraan/aset/{$row['gambar_mobil']}' alt='Gambar Mobil' width='240' height='300'></a>";
                        }
                        "</td>";
                    echo "<td class='border border-blue-400 px-4 py-2'>Rp. " . number_format($userAmbilData['harga_perhari'], 0, ',', '.') . "</td>";
                    echo "<td>
                            <a href='../../kendaraan/view/view.php?idmobil=" . $userAmbilData['idmobil'] . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded ml-2'> View </a>  
                            <a href='../../kendaraan/view/update.php?idmobil=" . $userAmbilData['idmobil'] . "' class='bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded ml-2'> Edit </a>  
                            <a href='../../kendaraan/controller/mobilhapus.php?idmobil=" . $userAmbilData['idmobil'] . "' class='bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded ml-2'> Hapus </a> 
                        </td>";
                echo "</tr>";
                }
            } else {
                echo "<tr><td class='border border-gray-400 px-4 py-2' colspan='8'>Data tidak ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>