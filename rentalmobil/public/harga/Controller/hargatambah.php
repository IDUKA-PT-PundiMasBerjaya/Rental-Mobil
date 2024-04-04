<?php  
	include_once("../../../config/koneksi.php");

	class HargaController {
		private $kon; 

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function tambahHarga() {
			$setAuto = mysqli_query($this->kon, "SELECT MAX(idharga) AS max_id FROM harga");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
		}

		public function tambahDataHarga($data) {
			$idharga = $data['idharga'];
			$harga_perhari = $data['harga_perhari'];

					$insertData = mysqli_query($this->kon, "INSERT INTO harga (idharga, harga_perhari) VALUES ('$idharga', '$harga_perhari')");

					if ($insertData) {
						return "Data berhasil disimpan.";
					} else {
						return "Gagal menyimpan data.";
					}

		}
	}
?>