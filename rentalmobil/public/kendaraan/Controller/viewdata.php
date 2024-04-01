<?php  
	include_once("../../../config/koneksi.php");

	class MobilController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getMobilData($idmobil) {
			$result =  mysqli_query($this->kon, "SELECT * FROM kendaraan WHERE idmobil = '$idmobil'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new MobilController($kon);
	$idmobil = $_GET['idmobil'];
	$mobilData = $kelasController->getMobilData($id_mobil);

	if ($mobilData) {
		$idmobil = $mobilData['idmobil'];
		$nama_mobil = $mobilData['nama_mobil'];
		$merek = $mobilData['merek'];
		$tahun = $mobilData['tahun'];
		$gambar_mobil = $mobilData['gambar_mobil'];
		$garasi_idgarasi = $mobilData['garasi_idgarasi'];
		$harga_idharga = $mobilData['harga_idharga'];
	}
?>