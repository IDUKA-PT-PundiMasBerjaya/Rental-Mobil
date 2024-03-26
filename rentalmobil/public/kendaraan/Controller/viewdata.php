<?php  
	include_once("../../../config/koneksi.php");

	class MobilController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getMobilData($id_mobil) {
			$result =  mysqli_query($this->kon, "SELECT * FROM kendaraan WHERE id_mobil = '$id_mobil'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new MobilController($kon);
	$id_mobil = $_GET['id_mobil'];
	$mobilData = $kelasController->getMobilData($id_mobil);

	if ($mobilData) {
		$id_mobil = $mobilData['id_mobil'];
		$merek = $mobilData['merk'];
		$tahun = $mobilData['tahun'];
		$gambar = $mobilData['gambar'];
		$garasi_id_garasi = $mobilData['garasi_id_garasi'];
		$harga_id_harga = $mobilData['harga_id_harga'];
	}
?>