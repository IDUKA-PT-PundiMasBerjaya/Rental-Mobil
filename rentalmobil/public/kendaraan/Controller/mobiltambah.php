<?php  
	include_once("../../../config/koneksi.php");

	class MobilController {
		private $kon; 

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function tambahMobil() {
			$setAuto = mysqli_query($this->kon, "SELECT MAX(id_mobil) AS max_id FROM kendaraan");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
		}

		public function tambahDataMobil($data) {
			$id_mobil = $data['id_mobil'];
            $nama = $data['nama'];
            $merek = $data['merek'];
            $tahun = $data['tahun'];
            $harga_id_harga = $data['harga_id_harga'];

			//Menambahkan Gambar
			$ekstensi_diperbolehkan = array('jpeg', 'jpg', 'png');
			$namagambar = $_FILES['gambar']['name'];
			$x = explode('.', $namagambar);
			$ekstensi = strtolower(end($x));
			$ukuran = $_FILES['gambar']['size'];
			$file_temp = $_FILES['gambar']['tmp_name'];

			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				if ($ukuran <= 2000000) {
					move_uploaded_file($file_temp, '../aset/' . $namagambar);
					$insertData = mysqli_query($this->kon, "INSERT INTO kendaraan (id_mobil, nama, merek, tahun, gambar, harga_id_harga) VALUES ('$id_mobil', '$nama', '$merek', '$tahun', '$namagambar', '$harga_id_harga')");

					if ($insertData) {
						return "Data berhasil disimpan.";
					} else {
						return "Gagal menyimpan data.";
					}
				} else {
					echo "<div style:'color: red;'>
							Ukuran file terlalu besar! Silahkan pilih file yang lebih kecil. 
						</div>";
				}
			} else {
				echo "<div style:'color: red;'>
						Ekstensi file yang diupload tidak diizinkan!
					</div>";
			}

		}
	}
?>