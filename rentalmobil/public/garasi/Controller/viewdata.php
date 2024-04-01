<?php  
	include_once("../../../config/koneksi.php");

	class GarasiController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getGarasiData($idgarasi) {
			$result =  mysqli_query($this->kon, "SELECT * FROM garasi WHERE idgarasi = '$idgarasi'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new GarasiController($kon);
	$idgarasi = $_GET['idgarasi'];
	$garasiData = $kelasController->getGarasiData($idgarasi);

	if ($garasiData) {
		$idgarasi = $garasiData['idgarasi'];
		$tersedia = $garasiData['tersedia'];
	}
?>