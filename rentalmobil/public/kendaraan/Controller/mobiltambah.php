<?php  
	include_once("../../../config/koneksi.php");

	class MobilController {
		private $kon; 

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function tambahMobil() {
			$setAuto = mysqli_query($this->kon, "SELECT MAX(idmobil) AS max_id FROM kendaraan");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
		}

		public function tambahDataMobil($data) {
			$idmobil = $data['idmobil'];
            $nama_mobil = $data['nama_mobil'];
            $merek = $data['merek'];
			$warna = $data['warna'];
            $tahun = $data['tahun'];
            $harga_perhari = $data['harga_perhari']; // Kolom baru untuk harga per hari

			//Menambahkan Gambar
			$ekstensi_diperbolehkan = array('jpeg', 'jpg', 'png');
			$namagambar = $_FILES['gambar_mobil']['name'];
			$x = explode('.', $namagambar);
			$ekstensi = strtolower(end($x));
			$ukuran = $_FILES['gambar_mobil']['size'];
			$file_temp = $_FILES['gambar_mobil']['tmp_name'];

			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
				if ($ukuran <= 20000000) {
					move_uploaded_file($file_temp, '../aset/' . $namagambar);
					$insertData = mysqli_query($this->kon, "INSERT INTO kendaraan (idmobil, nama_mobil, merek, warna, tahun,gambar_mobil,  harga_perhari) VALUES ('$idmobil', '$nama_mobil', '$merek', '$warna', '$tahun','$namagambar',  '$harga_perhari')");

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