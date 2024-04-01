<?php  
	include_once("../../../config/koneksi.php");
 
	class HargaController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updateHarga($idharga, $harga_perhari) {
			$result = mysqli_query($this->kon, "UPDATE harga SET harga_per_hari = '$harga_perhari' WHERE idharga = '$idharga'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataHarga($idharga) {
			$sql = "SELECT * FROM harga WHERE idharga = '$idharga'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>