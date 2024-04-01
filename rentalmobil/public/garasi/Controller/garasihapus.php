<?php  
	include_once("../../../config/koneksi.php");

	class GarasiController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteGarasi($idgarasi) {
			$deletedata = mysqli_query($this->kon, "DELETE FROM garasi WHERE idgarasi = '$idgarasi'");

			if ($deletedata) {
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new GarasiController($kon);
	if (isset($_GET['idgarasi'])) {
		$idgarasi = $_GET['idgarasi'];
		$message = $kelasController->deleteGarasi($idgarasi);
		echo $message;
		header("Location: ../../dashboard/data/dashboardgarasi.php");
	}
?>