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
    <title>Penyewaan Mobil</title>
    <link rel="stylesheet" href="../../src/output.css">
</head>
<body class="bg-gray-100 p-8">
    <h1 class="flex justify-center text-2xl font-bold mb-4">Dashboard Penyewaan Motor</h1><br>
    <div class="flex justify-center mb-8 space-x-4">
        <a href="data/dashboardgarasi.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Garasi </a>
        <a href="data/dashboardkendaraan.php"
            <!-- class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> List Mobil </a>
        <a href="data/dashboardcustomer.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Customer </a>
    </div>
    <div class="flex justify-center mb-8 space-x-4">
        <a href="data/dashboardpenyewaan.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Daftar Penyewa </a>
        <a href="data/dspenyewaanmobil.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Penyewaan Mobil</a>
        <a href="data/dspengembalianmobil.php"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"> Pengembalian </a>
    </div>
    <div class="flex justify-center">
        <a href="../../logout.php"
            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"> Logout </a>
    </div>
</body>
</html>
