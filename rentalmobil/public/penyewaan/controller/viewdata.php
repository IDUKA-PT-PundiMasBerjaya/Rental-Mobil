<?php 
    include_once("../../../config/koneksi.php");

    class PenyewaanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getPenyewaanData($id) {
            $result = mysqli_query($this->kon, "SELECT p.id_penyewaan, p.tanggal_sewa, p.tanggal_kembali,
                                                    CASE
                                                        WHEN p.customer_idcustomer IS NOT NULL THEN c.nama
                                                    END AS namapengguna
                                                FROM penyewaan p
                                                LEFT JOIN customer c ON p.customer_idcustomer = c.idcustomer
                                                WHERE p.id_penyewaan = '$id'");
            return mysqli_fetch_array($result);
        }
    }

    $penyewaanController = new PenyewaanController($kon);
    $id = $_GET['id_penyewaan'];
    $penyewaanData = $penyewaanController->getPenyewaanData($id);

    if ($penyewaanData) {
        $id = $penyewaanData['id_penyewaan'];
        $namapengguna = $penyewaanData['namapengguna'];
        $tglsewa = $penyewaanData['tanggal_sewa'];
        $tglkembali = $penyewaanData['tanggal_kembali'];
    }
?>