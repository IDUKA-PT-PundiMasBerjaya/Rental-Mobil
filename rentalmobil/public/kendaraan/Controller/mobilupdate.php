<?php  
	include_once("../../../config/koneksi.php");
 
	class MobilController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updateMobil($idmobil, $nama_mobil, $merek, $warna, $tahun, $harga_perhari) {
			$result = mysqli_query($this->kon, "UPDATE kendaraan SET nama_mobil = '$nama_mobil', merek = '$merek', warna = '$warna', tahun = '$tahun', harga_perhari = '$harga_perhari' WHERE idmobil = '$idmobil'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataMobil($idmobil) {
			$sql = "SELECT * FROM kendaraan WHERE idmobil = '$idmobil'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>