<?php  
	include_once("../../../config/koneksi.php");

	class HargaController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getHargaData($id_harga) {
			$result =  mysqli_query($this->kon, "SELECT * FROM harga WHERE id_harga = '$id_harga'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new HargaController($kon);
	$id_harga = $_GET['id_harga'];
	$mapelData = $kelasController->getHargaData($id_harga);

	if ($mapelData) {
		$id_harga = $mapelData['id_harga'];
		$harga_per_hari = $mapelData['harga_per_hari'];
	}
?>