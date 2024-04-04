<?php 
    include_once("../../../config/koneksi.php");

    class PenyewaanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function tambahPenyewaan() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(id_penyewaan) AS max_id FROM penyewaan");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;
            } return $nounik;
        }

        public function tambahDataPenyewaan($data) {
            $id_penyewaan = $data['id_penyewaan'];
            $tanggalsewa = $data['tanggal_sewa'];
            $tanggalkembali = $data['tanggal_kembali'];
            $customer_idcustomer = $data['customer_idcustomer'];
            
                $insertData = mysqli_query($this->kon, "INSERT INTO penyewaan(id_penyewaan, tanggal_sewa, tanggal_kembali, customer_idcustomer) 
                                                        VALUES ('$id_penyewaan', '$tanggalsewa', '$tanggalkembali', '$customer_idcustomer')");
                if ($insertData) {
                    return "Data berhasil disimpan";
                } else {
                    return "Gagal menyimpan data";
            }
        }
    }
?>