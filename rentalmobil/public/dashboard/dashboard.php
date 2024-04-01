<?php  
	include_once("../../config/koneksi.php");

	session_start();

	if (!isset($_SESSION["id"])) {
		header("Location: ../../login.php");
		exit();
	}

	$id = $_SESSION["id"];
	$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link href="../css/output.css" rel="stylesheet">
    <link href="output.css" rel="stylesheet">
    <style>
        /* Gaya untuk judul Selamat Datang */
        .welcome-title {
            text-align: center; /* Memusatkan teks */
            font-weight: bold; /* Membuat teks menjadi tebal */
        }
        /* Gaya untuk setiap kotak di dalam navbar */
        .horizontal-navbar {
            background-color: #fff; /* Warna latar belakang */
            padding: 20px;
            border-radius: 8px;
            display: flex; /* Menjadikan navbar horizontal */
            justify-content: space-between; /* Menyeimbangkan item di dalam navbar */
            align-items: center; /* Memusatkan item di tengah vertikal */
            border: 1px solid black; /* Garis hitam di sekitar navbar */
        }

        /* Gaya untuk setiap kotak di dalam navbar */
        .nav-box {
            background-color: #fca5a5; /* Warna latar belakang Pink */
            padding: 10px 20px; /* Ruang dalam kotak */
            border-radius: 8px; /* Sudut melengkung pada kotak */
            margin-right: 10px; /* Jarak antar kotak */
        }

        /* Gaya untuk tombol logout */
        .btn-logout {
            background-color: #ff0000; /* Warna latar belakang merah */
            color: #fff; /* Warna teks putih */
            padding: 10px 20px; /* Ukuran padding */
            border: none; /* Tanpa border */
            border-radius: 5px; /* Sudut melengkung */
            text-decoration: none; /* Tanpa garis bawah */
            margin: 10px auto 0; /* Memusatkan tombol logout dan menurunkannya sedikit */
            display: block; /* Membuat tombol logout menjadi block */
            width: fit-content; /* Menyesuaikan lebar dengan kontennya */
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8">
    <h2 class="welcome-title text-2xl font-semibold mb-4">Selamat datang <?php echo $username; ?>, Ini Halaman Rental Mobil</h2>

    <!-- Navbar vertikal -->
    <nav class="horizontal-navbar">
        <div class="nav-box"><a href="data/dashboardkendaraan.php">Data Kendaraan</a></div>
        <div class="nav-box"><a href="data/dashboardgarasi.php">Data Garasi</a></div>
        <div class="nav-box"><a href="data/dashboardharga.php">Data Harga</a></div>
        <div class="nav-box"><a href="data/dashboardcustomer.php">Data Customer</a></div>
        <div class="nav-box"><a href="data/dashboardpenyewaanmobil.php">Data Sewa Mobil</a></div>
    </nav>

    </div>
        <a href="../../logout.php" class="btn-logout">Logout</a>
    </div>

</body>
</html>
