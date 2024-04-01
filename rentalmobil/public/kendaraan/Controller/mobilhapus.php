<?php  
	include_once("../../../config/koneksi.php");

	class MobilController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteMobil($idmobil) {
			$result = mysqli_query($this->kon, "SELECT gambar_mobil FROM kendaraan WHERE idmobil = '$idmobil'");
			$row = mysqli_fetch_assoc($result);
			$gambar_mobil = $row['gambar_mobil'];

			$deletedata = mysqli_query($this->kon, "DELETE FROM kendaraan WHERE idmobil = '$idmobil'");

			if ($deletedata) {
				$gambar_dir = "../aset/";
				if ($gambar_mobil && file_exists($gambar_dir . $gambar_mobil)) {
					unlink ($gambar_dir . $gambar_mobil);
				}
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new MobilController($kon);
	if (isset($_GET['idmobil'])) {
		$idmobil = $_GET['idmobil'];
		$message = $kelasController->deleteMobil($idmobil);
		echo $message;
		header("Location: ../../dashboard/data/dashboardkendaraan.php");
	}
?>