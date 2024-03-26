<?php  
	include_once("../../../config/koneksi.php");

	class GarasiController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteGarasi($id_garasi) {
			$deletedata = mysqli_query($this->kon, "DELETE FROM garasi WHERE id_garasi = '$id_garasi'");

			if ($deletedata) {
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new GarasiController($kon);
	if (isset($_GET['id_garasi'])) {
		$id_garasi = $_GET['id_garasi'];
		$message = $kelasController->deleteGarasi($id_garasi);
		echo $message;
		header("Location: ../../dashboard/data/dashboardgarasi.php");
	}
?>