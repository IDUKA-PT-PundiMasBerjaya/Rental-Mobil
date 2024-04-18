<?php  
	include_once("../../../config/koneksi.php");

	class GarasiController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getGarasiData($idgarasi) {
			$result = mysqli_query($this->kon, "SELECT garasi.idgarasi, kendaraan.nama_mobil, kendaraan.merek, kendaraan.warna,  kendaraan.tahun, kendaraan.gambar_mobil AS gambar, garasi.stok
                                                FROM kendaraan
                                                INNER JOIN garasi
                                                ON kendaraan.idmobil = garasi.kendaraan_idmobil
                                                WHERE idgarasi = '$idgarasi'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new GarasiController($kon);
	$idgarasi = $_GET['idgarasi'];
	$garasiData = $kelasController->getGarasiData($idgarasi);

	if ($garasiData) {
		$idgarasi = $garasiData['idgarasi'];
		$nama_mobil = $garasiData['nama_mobil'];
		$merek = $garasiData['merek'];
		$warna = $garasiData['warna'];
		$tahun = $garasiData['tahun'];
		$gambar = $garasiData['gambar'];
		$stok = $garasiData['stok'];
	}
?>