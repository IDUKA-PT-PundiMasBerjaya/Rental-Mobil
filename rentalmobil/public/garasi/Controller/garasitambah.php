<?php  
	include_once("../../../config/koneksi.php");

	class GarasiController {
		private $kon; 

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function tambahGarasi() {
			$setAuto = mysqli_query($this->kon, "SELECT MAX(id_garasi) AS max_id FROM garasi");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
		}

		public function tambahDataGarasi($data) {
			$id_garasi = $data['id_garasi'];
			$tersedia = $data['tersedia'];

					$insertData = mysqli_query($this->kon, "INSERT INTO garasi (id_garasi, tersedia) VALUES ('$id_garasi', '$tersedia')");

					if ($insertData) {
						return "Data berhasil disimpan.";
					} else {
						return "Gagal menyimpan data.";
					}

		}
	}
?>