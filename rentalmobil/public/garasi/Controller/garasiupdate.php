<?php  
	include_once("../../../config/koneksi.php");
 
	class GarasiController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updateGarasi($idgarasi, $tersedia) {
			$result = mysqli_query($this->kon, "UPDATE garasi SET tersedia = '$tersedia' WHERE idgarasi = '$idgarasi'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataGarasi($idgarasi) {
			$sql = "SELECT * FROM garasi WHERE idgarasi = '$idgarasi'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>