<?php  
	include_once("../../../config/koneksi.php");
 
	class GarasiController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updateGarasi($id_garasi, $tersedia) {
			$result = mysqli_query($this->kon, "UPDATE garasi SET tersedia = '$tersedia' WHERE id_garasi = '$id_garasi'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataGarasi($id_garasi) {
			$sql = "SELECT * FROM garasi WHERE id_garasi = '$id_garasi'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>