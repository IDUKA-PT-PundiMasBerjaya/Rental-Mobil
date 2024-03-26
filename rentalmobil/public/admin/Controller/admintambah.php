<?php 
    include_once("../../../config/koneksi.php");
    
    class AdminController {
        private $kon;

        public function __construct($connection){
            $this->kon = $connection;
        }

        public function tambahAdmin() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_admin) AS max_id FROM admin");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        } 

        public function tambahDataAdmin($data) {
            $id_admin = $data['id_admin'];
            $username = $data['username'];
            $password = $data['password'];

            $insertData = mysqli_query($this->kon, "INSERT INTO Admin (id_admin, username, password) VALUES('$id_admin', '$username', '$password')");
            
            if ($insertData) {
                return "Data berhasil disimpan ";
            } else {
                return "gagal menyimpan data ";
            }
        }
    }
?>