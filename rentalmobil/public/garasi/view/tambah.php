<?php  
	include_once("../../../config/koneksi.php");
	include_once("../controller/garasitambah.php");
 
	$garasiController = new GarasiController($kon);

	if (isset($_POST['submit'])) {
		$idgarasi = $garasiController->tambahGarasi();

		$data = [
			'idgarasi' => $idgarasi,
      		'tersedia' => $_POST['tersedia'],
		];

		$message = $garasiController->tambahDataGarasi($data);
        
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Tambah Garasi</title>
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
        td:nth-child(2) {
            color: #020617; /* Warna teks Hitam */
        }
    </style>
	</head>
	<body class="bg-gray-100">
    <div class="container mx-auto py-4"> <!-- Padding atas dan bawah sedikit diperkecil -->
		<h1>Tambah Data Garasi</h1>
		<nav>
            <a href="../../dashboard/data/dashboardgarasi.php">Home</a>
        </nav>
		<form action="tambah.php" method="POST", name="tambah", enctype="multipart/form-data">
			<table border="1">
			<tr>
					<td>ID Garasi</td>
					<td><input class="input_data_1" type="text" name="idgarasi" value="<?php echo($garasiController->tambahGarasi()) ?>" readonly></td>
				</tr>
			<tr>
				<td>Tersedia</td>
				<td><input class="input" type="text" name="tersedia" required></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Tambah Data">
		<?php  if (isset($message)): ?>
			<div class="success-message">
				<?php echo $message; ?>
			</div>
		<?php endif; ?>
	</form>
</body>
</html>