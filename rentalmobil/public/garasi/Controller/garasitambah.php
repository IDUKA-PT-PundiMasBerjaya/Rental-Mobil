<?php 
    include_once("../../../config/koneksi.php");

    class GarasiController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahGarasi() {
            $setAuto = mysqli_query($this->kon, "SELECT MAX(idgarasi) AS max_id FROM garasi");
            $result = mysqli_fetch_assoc($setAuto);
            $max_id = $result['max_id'];

            if (is_numeric($max_id)) {
                $nounik = $max_id + 1;
            } else {
                $nounik = 1;;
            } return $nounik;
        }

        public function tambahDataGarasi($data) {
            $idgarasi = $data['idgarasi'];
            $kendaraan_idmobil = $data['kendaraan_idmobil'];
            $stok = $data['stok'];

            $insertData = mysqli_query($this->kon, "INSERT INTO garasi(idgarasi, kendaraan_idmobil, stok) VALUES ('$idgarasi', '$kendaraan_idmobil', '$stok')");
            
            if ($insertData) {
                return "Data berhasil disimpan.";
            } else {
                return "gagal menyimpan data.";
            }
        }
    }
?>