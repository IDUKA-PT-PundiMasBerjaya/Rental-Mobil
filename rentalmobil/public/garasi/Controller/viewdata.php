<?php  
	include_once("../../../config/koneksi.php");

	class GarasiController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getGarasiData($id_garasi) {
			$result =  mysqli_query($this->kon, "SELECT * FROM garasi WHERE id_garasi = '$id_garasi'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new GarasiController($kon);
	$id_garasi = $_GET['id_garasi'];
	$mapelData = $kelasController->getGarasiData($id_garasi);

	if ($mapelData) {
		$id_garasi = $mapelData['id_garasi'];
		$tersedia = $mapelData['tersedia'];
	}
?>