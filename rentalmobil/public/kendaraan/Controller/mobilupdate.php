<?php  
	include_once("../../../config/koneksi.php");
 
	class MobilController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updateMobil($id_mobil, $nama, $merek, $tahun, $gambar, $harga_per_hari) {
			$result = mysqli_query($this->kon, "UPDATE kendaraan SET nama = '$nama', merek = '$merek', tahun = '$tahun', gambar = '$gambar', harga_per_hari = '$harga_per_hari' WHERE id_mobil = '$id_mobil'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataMobil($id_mobil) {
			$sql = "SELECT * FROM kendaraan WHERE id_mobil = '$id_mobil'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>