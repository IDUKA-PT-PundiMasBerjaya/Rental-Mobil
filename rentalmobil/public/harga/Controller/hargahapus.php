<?php  
	include_once("../../../config/koneksi.php");

	class HargaController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteHarga($id_harga) {
			$deletedata = mysqli_query($this->kon, "DELETE FROM harga WHERE id_harga = '$id_harga'");

			if ($deletedata) {
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new HargaController($kon);
	if (isset($_GET['id_harga'])) {
		$id_harga = $_GET['id_harga'];
		$message = $kelasController->deleteHarga($id_harga);
		echo $message;
		header("Location: ../../dashboard/data/dashboardharga.php");
	}
?>