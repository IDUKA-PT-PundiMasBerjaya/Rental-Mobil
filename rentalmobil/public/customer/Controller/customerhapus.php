<?php  
	include_once("../../../config/koneksi.php");

	class CustomerController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteCustomer($id_customer) {
			$deletedata = mysqli_query($this->kon, "DELETE FROM customer WHERE id_customer = '$id_customer'");

			if ($deletedata) {
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new CustomerController($kon);
	if (isset($_GET['id_customer'])) {
		$id_customer = $_GET['id_customer'];
		$message = $kelasController->deleteCustomer($id_customer);
		echo $message;
		header("Location: ../../dashboard/data/dashboardcustomer.php");
	}
?>