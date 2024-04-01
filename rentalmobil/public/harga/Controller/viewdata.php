<?php  
	include_once("../../../config/koneksi.php");

	class HargaController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getHargaData($idharga) {
			$result =  mysqli_query($this->kon, "SELECT * FROM harga WHERE idharga = '$idharga'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new HargaController($kon);
	$idharga = $_GET['idharga'];
	$mapelData = $kelasController->getHargaData($id_harga);

	if ($mapelData) {
		$idharga = $mapelData['idharga'];
		$harga_perhari = $mapelData['harga_perhari'];
	}
?>