<?php  
	include_once("../../../config/koneksi.php");

	class HargaController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteHarga($idharga) {
			$deletedata = mysqli_query($this->kon, "DELETE FROM harga WHERE idharga = '$idharga'");

			if ($deletedata) {
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new HargaController($kon);
	if (isset($_GET['idharga'])) {
		$idharga = $_GET['idharga'];
		$message = $kelasController->deleteHarga($idharga);
		echo $message;
		header("Location: ../../dashboard/data/dashboardharga.php");
	}
?>