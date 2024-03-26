<?php  
	include_once("../../../config/koneksi.php");

	class CustomerController {
		private $kon; 

		public function __construct($connection) {
			$this->kon = $connection;
		}
		public function tambahCustomer() {
			$setAuto = mysqli_query($this->kon, "SELECT MAX(id_customer) AS max_id FROM customer");
			$result = mysqli_fetch_assoc($setAuto);
			$max_id = $result['max_id'];

			if (is_numeric($max_id)) {
				$nounik = $max_id + 1;
			} else {
				$nounik = 1;
			} return $nounik;
		}

		public function tambahDataCustomer($data) {
			$id_customer = $data['id_customer'];
			$nama = $data['nama'];
			$alamat = $data['alamat'];
			$email = $data['email'];
			$no_hp = $data['no_hp'];

					$insertData = mysqli_query($this->kon, "INSERT INTO customer(id_customer, nama, alamat, email, no_hp) VALUES ('$id_customer', '$nama', '$alamat', '$email', '$no_hp')");

					if ($insertData) {
						return "Data berhasil disimpan.";
					} else {
						return "Gagal menyimpan data.";
					}

		}
	}
?>