<?php  
	include_once("../../../config/koneksi.php");

	class CustomerController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function getCustomerData($id_customer) {
			$result =  mysqli_query($this->kon, "SELECT * FROM customer WHERE id_customer = '$id_customer'");
			return mysqli_fetch_array($result);
		}
	}

	$kelasController = new CustomerController($kon);
	$id_customer = $_GET['id_customer'];
	$customerData = $kelasController->getCustomerData($id_customer);

	if ($customerData) {
		$id_customer = $customerData['id_customer'];
		$nama = $customerData['nama'];
		$alamat = $customerData['alamat'];
		$email = $customerData['email'];
		$no_hp = $customerData['no_hp'];
	}
?>