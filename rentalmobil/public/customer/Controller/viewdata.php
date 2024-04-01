<?php  
	include_once("../../../config/koneksi.php");

	class CustomerController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getCustomerData($idcustomer) {
			$result =  mysqli_query($this->kon, "SELECT * FROM customer WHERE idcustomer = '$idcustomer'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new CustomerController($kon);
	$idcustomer = $_GET['id_customer'];
	$customerData = $kelasController->getCustomerData($idcustomer);

	if ($customerData) {
		$idcustomer = $customerData['idcustomer'];
		$nama = $customerData['nama'];
		$alamat = $customerData['alamat'];
		$email = $customerData['email'];
		$no_hp = $customerData['no_hp'];
	}
?>