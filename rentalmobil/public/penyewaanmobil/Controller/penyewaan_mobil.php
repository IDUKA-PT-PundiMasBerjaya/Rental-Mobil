<?php 
    include_once("../../../config/koneksi.php");
class TambahMobilController {
        private $kon;
        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahDataPenyewaanMobil($data) {
            $id_penyewaan = $data['id_penyewaan'];
            $jumlah_array = $data['jumlah_mobil'];
            $idmobil_array = $data['kendaraan_idmobil'];

            if (empty($id_penyewaan) || !is_numeric($id_penyewaan)) {
                return "Gagal menyimpan data, Penyewaan ID tidak valid.";
            }
            foreach ($idmobil_array as $key => $kendaraan_idmobil) {
                $jumlah = $jumlah_array[$key];

                if (!is_numeric($jumlah)) {
                    return "Gagal menyimpan data, Jumlah bukan bilangan.";
                }

                $stokMobil = $this->cekStokMobil($kendaraan_idmobil, $jumlah);
                if ($stokMobil === false) {
                    return "Stok barang tidak mencukupi";
                }

                $insertData = mysqli_query($this->kon, "INSERT INTO penyewaan_mobil (id_penyewaan, jumlah_mobil, kendaraan_idmobil)
                                                        VALUES ('$id_penyewaan', '$jumlah', '$kendaraan_idmobil)')");
                
                if (!$insertData) {
                    return "Gagal menyimpan data. Error : " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan.";
        }

        private function cekStokMobil($kendaraan_idmobil, $jumlah) {
            $query = mysqli_query ($this->kon, "SELECT tersedia FROM kendaraan WHERE idmobil = '$kendaraan_idmobil'");
            $data = mysqli_fetch_assoc($query);

            if ($data['tersedia'] >= $jumlah) {
                return true;
            } else {
                return false;
            }
        }
    }
?>