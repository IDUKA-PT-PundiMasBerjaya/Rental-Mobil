<?php  
	include_once("../../../config/koneksi.php");

	class HargaController {
		private $kon; 

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function tambahHarga() {
			$setAuto = mysqli_query($this->kon, "SELECT MAX(id_harga) AS max_id FROM harga");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
		}

		public function tambahDataHarga($data) {
			$id_harga = $data['id_harga'];
			$harga_per_hari = $data['harga_per_hari'];

					$insertData = mysqli_query($this->kon, "INSERT INTO harga (id_harga, harga_per_hari) VALUES ('$id_harga', '$harga_per_hari')");

					if ($insertData) {
						return "Data berhasil disimpan.";
					} else {
						return "Gagal menyimpan data.";
					}

		}
	}
?>