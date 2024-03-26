<?php  
	include_once("../../../config/koneksi.php");
 
	class HargaController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updateHarga($id_harga, $harga_per_hari) {
			$result = mysqli_query($this->kon, "UPDATE harga SET harga_per_hari = '$harga_per_hari' WHERE id_harga = '$id_harga'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataHarga($id_harga) {
			$sql = "SELECT * FROM harga WHERE id_harga = '$id_harga'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>