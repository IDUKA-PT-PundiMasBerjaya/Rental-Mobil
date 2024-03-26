<?php  
	include_once("../../../config/koneksi.php");

	class MobilController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteMobil($id_mobil) {
			$result = mysqli_query($this->kon, "SELECT gambar FROM kendaraan WHERE id_mobil = '$id_mobil'");
			$row = mysqli_fetch_assoc($result);
			$gambar = $row['gambar'];

			$deletedata = mysqli_query($this->kon, "DELETE FROM kendaraan WHERE id_mobil = '$id_mobil'");

			if ($deletedata) {
				$gambar_dir = "../aset/";
				if ($gambar && file_exists($gambar_dir . $gambar)) {
					unlink ($gambar_dir . $gambar);
				}
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new MobilController($kon);
	if (isset($_GET['id_mobil'])) {
		$id_mobil = $_GET['id_mobil'];
		$message = $kelasController->deleteMobil($id_mobil);
		echo $message;
		header("Location: ../../dashboard/data/dashboardkendaraan.php");
	}
?>