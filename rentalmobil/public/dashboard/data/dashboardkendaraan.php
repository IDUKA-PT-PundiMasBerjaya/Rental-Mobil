<?php  
	include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Kendaraan</title>
	<link rel="stylesheet" href="../../css/output.css">
	<style>
        /* Style untuk judul tabel */
        h1 {
            text-align: center;
            color: #020617;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 30px;
        }

        /* Style untuk navbar */
        nav {
            display: flex;
            justify-content: space-between; /* Menempatkan item ke ujung kiri dan kanan */
            align-items: center; /* Pusatkan item secara vertikal */
            margin-bottom: 10px; /* Jarak antara navbar dan judul */
        }

        nav a {
            padding: 10px 20px;
            margin-right: 15px;
            color: #1a365d; /* Warna biru tua */
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            background-color: #e2e8f0; /* Warna latar belakang */
            border: 2px solid #4299e1; /* Warna border */
            border-radius: 4px; /* Bentuk sudut */
        }

        /* Hover effect */
        nav a:hover {
            background-color: #4299e1; /* Warna latar belakang saat hover */
            color: #fff; /* Warna teks saat hover */
        }

        /* Style untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px; /* Jarak antara tabel dan bagian atas halaman */
        }

        th, td {
            border: 3px solid #020617;
            padding: 12px;
            text-align: left;
            color: #020617; /* Warna teks hitam */
            background-color: #fff; /* Warna latar belakang putih */
        }

        th:first-child {
            color: #fff; /* Warna teks putih */
        }

        th {
            font-weight: bold;
            background-color: #4299e1; /* Warna latar belakang biru muda */
        }

        td {
            font-size: 16px;
        }
		/* Style untuk sel yang sejajar dengan ID Mobil */
        th:first-child,
        th:nth-child(2),
        th:nth-child(3),
        th:nth-child(4),
        th:nth-child(5),
        th:nth-child(6),
        th:nth-child(7) {
            color: #fff; /* Warna teks putih */
        }

        .btn-pinjam {
            color: #4338ca; /* Warna hijau muda */
        }
        .btn-view {
            color: #38c172; /* Warna hijau muda */
        }

        .btn-edit {
            color: #4299e1; /* Warna biru muda */
        }

        .btn-hapus {
            color: #e53e3e; /* Warna merah */
        }

		/* Style untuk kotak pencarian */
        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type=text] {
            width: 200px;
            margin-top: 10px;
            padding: 5px;
            font-size: 5px;
            border: 2px solid #020617;
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.5); /* Transparansi */
        }

        .search-container input[type=submit] {
            background-color: #4299e1;
            color: white;
            border: none;
            padding: 4px 8px; /* Padding diperkecil */
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px; /* Ukuran font yang lebih kecil */
            margin-left: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body class="bg-gray-100">
	<div class="container mx-auto py-8">
		<form action="dashboardkendaraan.php" method="GET" class="mb-4">
           <div class="search-container">
                <input type="text" name="cari" placeholder="Search..." class="border border-gray-400 rounded-md px-2 py-1" style="font-size: 20px;">
                <input type="submit" value="Cari" class="btn bg-blue-500 text-white px-4 py-1 rounded-md" style="font-size: 25px;">
            </div>
        </form>
	<?php  
		if (isset($_GET['cari'])) {
			$cari = $_GET['cari'];
		}
	?>
	<h1> Mobil Yang Tersedia </h1>
		<nav>
			<div>
				<a href="../../kendaraan/View/tambah.php" class="btn bg-blue-500 text-white">Tambah Data Kendaraan</a>
				<a href="../../kendaraan/View/cetak.php" target="_blank" class="btn bg-blue-500 text-white">Cetak</a>
			</div>
            <div>
                <a href="../dashboard.php" class="btn bg-blue-500 text-white">Home</a>
            </div>
        </nav>
	<!-- Tabel Kendaraan -->
	<table border="1" >
			<?php  
				if (isset($_GET['cari'])) {
					$cari = $_GET['cari'];
					$ambildata = mysqli_query($kon, "SELECT kendaraan.*, harga.harga_per_hari FROM kendaraan 
                                                    INNER JOIN harga ON kendaraan.harga_id_harga = harga.id_harga 
                                                    WHERE kendaraan.id_mobil LIKE '%".$cari."%' OR kendaraan.nama LIKE '%".$cari."%' OR kendaraan.merek LIKE '%".$cari."%'");

				} else {
					$ambildata = mysqli_query($kon, "SELECT kendaraan.*, harga.harga_per_hari FROM kendaraan 
                                                    INNER JOIN harga ON kendaraan.harga_id_harga = harga.id_harga 
                                                    ORDER BY kendaraan.id_mobil ASC");

					$num = mysqli_num_rows($ambildata);
				}
			?>
		<tr>
        	<th class="border border-gray-400 px-4 py-2 text-center">ID Mobil</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Nama</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Merek</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Tahun</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Gambar</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Harga</th>
            <th class="border border-gray-400 px-4 py-2 text-center">Aksi</th>
        </tr>
		<tbody>
		<?php  
			while ($userAmbilData = mysqli_fetch_array($ambildata)) {
				echo "<tr>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $id_mobil = $userAmbilData['id_mobil'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $nama = $userAmbilData['nama'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $merek =$userAmbilData['merek'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>" . $tahun = $userAmbilData['tahun'] . "</td>";
                    echo "<td class='border border-gray-400 px-4 py-2'>";
                        $data = mysqli_query($kon, "SELECT * FROM kendaraan WHERE id_mobil = '{$userAmbilData['id_mobil']}'");
                        while ($row = mysqli_fetch_array($data)) {
                            echo "<a href='javascript:void(0);' onclick=\"window.open(../../kendaraan/aset/{$row['gambar']}', '_blank');\">
                                    <img src='../../kendaraan/aset/{$row['gambar']}' alt='Gambar Mobil' width='110' height='150'></a>";
                        }
                        "</td>";
                    echo "<td>" . $harga = $userAmbilData['harga_per_hari'] . "</td>";
					echo "<td>
							<a href='../../kendaraan/View/view.php?id_mobil=" . $userAmbilData['id_mobil'] . "' class='btn btn-view'> View </a> | 
							<a href='../../kendaraan/View/update.php?id_mobil=" . $userAmbilData['id_mobil'] . "' class='btn btn-edit'> Edit </a> | 
							<a href='../../kendaraan/Controller/mobilhapus.php?id_mobil=" . $userAmbilData['id_mobil'] ."' class='btn btn-hapus'> Hapus </a> 
						</td>";
				echo "</tr>";
			}
		?>
		</tbody>
	</table>
	</div>
</body>
</html>