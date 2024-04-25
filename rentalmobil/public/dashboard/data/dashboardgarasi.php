<?php  
	include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Garasi</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../src/output.css">
</head>

<body class="bg-gray-100 p-8">
    <form action="dashboard.php" method="get" class="mb-4">
        <label class="mr-2">Cari:</label>
        <input type="text" name="cari" class="border border-gray-300 px-3 py-1 rounded-md">
        <button type="submit" name="Cari"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded-md">Cari</button>
    </form>

    <?php 
    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }
    ?>
    <h1 class="text-2xl font-bold mb-4">Data Garasi</h1>
        <div class="mb-4">
            <a href="../../garasi/view/tambah.php"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Tambah Garasi</a>
            <a href="../../garasi/view/cetak.php" target="_blank"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-4">Cetak</a>
            <a href="../dashboard.php" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Home</a>
        </div>
    <table class="border-collapse border border-gray-400 w-full">
        <tr>
			<th class="border border-gray-400 px-4 py-2 text-center"> ID Garasi </th>
            <th class="border border-gray-400 px-4 py-2 text-center"> Nama Mobil</th>
            <th class="border border-gray-400 px-4 py-2 text-center"> Merek </th>
            <th class="border border-gray-400 px-4 py-2 text-center"> Warna </th>
            <th class="border border-gray-400 px-4 py-2 text-center"> Tahun </th>
            <th class="border border-gray-400 px-4 py-2 text-center"> Gambar </th>
			<th class="border border-gray-400 px-4 py-2 text-center"> Stok  </th>
            <th class="border border-gray-400 px-4 py-2 text-center"> Status Mobil  </th>
			<th class="border border-gray-400 px-4 py-2 text-center"> Aksi </th>
		</tr>
			<?php  
				if (isset($_GET['cari'])) {
					$cari = $_GET['cari'];
					$ambildata = mysqli_query($kon, "SELECT garasi.idgarasi, kendaraan.nama_mobil, kendaraan.merek, kendaraan.warna,  kendaraan.tahun, kendaraan.gambar_mobil AS gambar, garasi.stok
                                                    FROM kendaraan
                                                    INNER JOIN garasi
                                                    ON kendaraan.idmobil = garasi.kendaraan_idmobil
                                                    WHERE garasi.idgarasi LIKE '%" . $cari . "%' OR kendaraan.nama_mobil LIKE '%" . $cari . "%' OR kendaraan.merek LIKE '%" . $cari . "%' OR kendaraan.warna LIKE '%" . $cari . "%' OR garasi.stok LIKE '%" . $cari . "%'");
				} else {
					$ambildata = mysqli_query($kon, "SELECT garasi.idgarasi, kendaraan.nama_mobil, kendaraan.merek, kendaraan.warna,  kendaraan.tahun, kendaraan.gambar_mobil AS gambar, garasi.stok
                                                    FROM kendaraan
                                                    INNER JOIN garasi
                                                    ON kendaraan.idmobil = garasi.kendaraan_idmobil
                                                    ORDER BY garasi.idgarasi ASC");
					$num = mysqli_num_rows($ambildata);
				}

            if ($ambildata) {
			    while ($userAmbilData = mysqli_fetch_array($ambildata)) {
				    echo "<tr>";
					echo "<td class='border border-gray-400 px-4 py-2'>" . $idgarasi = $userAmbilData['idgarasi'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $nama_mobil = $userAmbilData['nama_mobil'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $merek = $userAmbilData['merek'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $warna = $userAmbilData['warna'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $tahun = $userAmbilData['tahun'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'><img src='../../kendaraan/aset/" . $userAmbilData['gambar'] . "' width='100'></td>";
					$stok = $userAmbilData['stok'];
					echo "<td class='border border-gray-400 px-4 py-2'>" . $stok . "</td>";
					$statusMobil = $stok > 0 ? "Tersedia" : "Kosong";
					echo "<td class='border border-gray-400 px-4 py-2'>" . $statusMobil . "</td>";
					echo "<td class='border border-gray-400 px-4 py-2'> 
							<a href='../../garasi/View/view.php?idgarasi=" . $userAmbilData['idgarasi'] . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded'> View </a>  
							<a href='../../garasi/Controller/garasihapus.php?idgarasi=" . $userAmbilData['idgarasi'] ."' class='bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-2 rounded ml-2'> Hapus </a>  
						</td>";
				echo "</tr>";
			}
        } else {
            echo "<tr><td class='border border-gray-400 px-4 py-2' colspan='8'>Data tidak ditemukan.</td></tr>";
        }
        ?>
    </table>
</body>
</html>