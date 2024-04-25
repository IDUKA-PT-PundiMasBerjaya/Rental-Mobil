<?php  
	include_once("../../../config/koneksi.php");

	class CustomerController {
		private $kon;

		public function __construct($connection) {
			$this->kon = $connection;
		}

		public function deleteCustomer($idcustomer) {
			$deletedata = mysqli_query($this->kon, "DELETE FROM customer WHERE idcustomer = '$idcustomer'");

			if ($deletedata) {
				return "Data sukses terhapus.";
			} else {
				return "Data gagal terhapus.";
			}
		}
	}

	$kelasController = new CustomerController($kon);
	if (isset($_GET['idcustomer'])) {
		$idcustomer = $_GET['idcustomer'];
		$message = $kelasController->deleteCustomer($idcustomer);
		echo $message;
		header("Location: ../../dashboard/data/dashboardcustomer.php");
	}
?>