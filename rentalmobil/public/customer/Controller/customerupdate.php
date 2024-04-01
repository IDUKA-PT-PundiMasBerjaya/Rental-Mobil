<?php  
	include_once("../../../config/koneksi.php");
 
	class CustomerController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function updatecustomer($idcustomer, $nama, $alamat, $email, $no_hp) {
			$result = mysqli_query($this->kon, "UPDATE customer SET nama = '$nama', alamat = '$alamat',email = '$email', no_hp = '$no_hp' WHERE idcustomer = '$idcustomer'");

			if ($result) {
				return "Sukses meng-update data.";
			} else {
				return "Gagal meng-update data.";
			}
		}

		public function getDataCustomer($idcustomer) {
			$sql = "SELECT * FROM customer WHERE idcustomer = '$idcustomer'";
			$ambildata = $this->kon->query($sql);

			if ($result = mysqli_fetch_array($ambildata)) {
				return $result;
			} else {
				return null;
			}
		}
	}
	
?>