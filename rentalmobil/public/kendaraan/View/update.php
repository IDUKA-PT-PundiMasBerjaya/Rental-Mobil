<?php  
	include_once("../../../config/koneksi.php");
	include_once("../Controller/mobilupdate.php");

	$mobilController = new MobilController($kon);

	if (isset($_POST['update'])) {
	$id_mobil = $_POST['id_mobil'];
	$nama = $_POST['nama'];
    $merek = $_POST['merek'];
    $tahun = $_POST['tahun'];
    $gambar = $_POST['gambar'];
    $harga_id_harga = $_POST['harga_id_harga'];

		$message = $mobilController->updateMobil($id_mobil, $nama, $merek, $tahun, $stok, $gambar, $harga_id_harga);
		echo $message;

		header("Location: ../../dashboard/data/dashboardkendaraan.php");
	}

	  $id_mobil = null;
    $nama = null;
    $merek = null;
    $tahun = null;
	$gambar = null;
    $harga_id_harga = null;

	if (isset($_GET['id_mobil']) && is_numeric($_GET['id_mobil'])) {
		$id_mobil = $_GET['id_mobil'];
		$result = $mobilController->getDataMobil($id_mobil);

		if ($result) {
			$id_mobil = $result['id_mobil'];
			$nama = $result['nama'];
			$merek = $result['merek'];
			$tahun = $result['tahun'];
			$gambar = $result['gambar'];
			$harga_id_harga = $result['harga_id_harga'];
		} else{
			echo "ID Tidak Valid.";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Update Kendaraan</title>
    <link rel="stylesheet" href="../../css/output.css">
    <style>
        /* Style untuk judul tabel */
        h1 {
            text-align: center;
            color: #020617;
            font-weight: bold;
            margin-bottom: 20px; /* Margin bawah sedikit diperkecil */
            font-size: 30px; /* Ukuran judul lebih kecil */
        }

        nav {
            display: flex;
            justify-content: left; /* Pusatkan item ke tengah */
            align-items: left; /* Pusatkan item secara vertikal */
            margin-bottom: 10px; /* Jarak antara navbar dan judul */
            width: 100%; /* Lebar nav mengisi keseluruhan */
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

        /* Style untuk form */
        form {
            margin-top: 10px; /* Margin atas sedikit diperkecil */
            text-align: center; /* Pusatkan teks */
            flex-wrap: wrap; /* Mengatur wrap agar tombol submit turun ke bawah pada layar kecil */
        }

        table {
            width: 25%; /* Lebar tabel lebih diperkecil */
            margin: 0 auto; /* Menengahkan tabel */
            border-collapse: collapse;
            margin-bottom: 10px; /* Margin bawah sedikit diperkecil */
        }

        table, th, td {
            border: 1px solid #020617;
            padding: 4px; /* Padding sedikit diperkecil */
        }

        input[type=text] {
            width: 100%;
            padding: 4px; /* Padding sedikit diperkecil */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 2px; /* Margin atas dan bawah sedikit diperkecil */
            margin-bottom: 8px; /* Margin atas dan bawah sedikit diperkecil */
            font-size: 14px; /* Ukuran teks sedikit diperkecil */
        }

        input[type=submit] {
            background-color: #4299e1;
            color: white;
            padding: 6px 12px; /* Padding sedikit diperkecil */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px; /* Ukuran teks sedikit diperkecil */
        }

        input[type=submit]:hover {
            background-color: #3182ce;
        }

        .success-message {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 4px;
            margin-top: 6px; /* Margin atas sedikit diperkecil */
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 14px; /* Ukuran teks sedikit diperkecil */
        }
        th:first-child {
            color: #020617; /* Warna teks putih */
        }

        td {
            font-weight: bold;
            background-color: #4299e1; /* Warna latar belakang biru muda */
        }

        td {
            font-size: 16px;
        }
        /* Style untuk sel yang sejajar dengan ID Buku */
        td:first-child,
        td:nth-child(2),
        td:nth-child(3),
        td:nth-child(4),
        td:nth-child(5),
        td:nth-child(6) {
            color: #020617; /* Warna teks Hitam */
        }
        /* Style untuk tombol update */
        .update-button {
            text-align: center;
            margin-top: 20px;
        }

        .update-button input[type=submit] {
            width: auto; /* Mengembalikan lebar tombol ke ukuran default */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-4"> 
        <h1>Update Data Mobil</h1>
        <nav>
            <a href="../../dashboard/data/dashboardkendaraan.php">Home</a>
        </nav>
        <form action="update.php" method="POST" name="update" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>ID Mobil</td>
                    <td><input class="input_data_1" type="text" name="id_mobil" value="<?php echo $id_mobil ?>" readonly></td>
                </tr>
                <tr>
                    <td>Nama Mobil</td>
                    <td><input type="text" name="judul" value="<?php echo $nama ?>" required></td>
                </tr>
                <tr>
                    <td>Merek</td>
                    <td><input type="text" name="merek" value="<?php echo $merek ?>" required></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td><input type="text" name="tahun" value="<?php echo $tahun ?>" required></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td><input type="text" name="gambar" value="<?php echo $gambar ?>" required></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="text" name="harga_id_harga" value="<?php echo $harg_id_harga ?>" required></td>
                </tr>
            </table>
              <div class="update-button">
                  <input type="hidden" name="id_mobil" value="<?php echo $id_mobil; ?>">
                  <input type="submit" name="update" value="Update">
              </div>
        </form>
    </div>
</body>
</html>