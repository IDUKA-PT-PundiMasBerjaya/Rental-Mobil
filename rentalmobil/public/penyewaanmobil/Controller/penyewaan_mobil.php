<?php 
    include_once("../../../config/koneksi.php");
class TambahMobilController {
        private $kon;
        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahDataPenyewaanMobil($data) {
            $id_penyewaan = $data['id_penyewaan'];
            $jumlah_array = $data['stok_mobil'];
            $idgarasi_array = $data['garasi_idgarasi'];

            if (empty($id_penyewaan) || !is_numeric($id_penyewaan)) {
                return "Gagal menyimpan data, ID Penyewaan tidak valid.";
            }
            foreach ($idgarasi_array as $key => $garasi_idgarasi) {
                $jumlah = $jumlah_array[$key];

                if (!is_numeric($jumlah)) {
                    return "Gagal menyimpan data, Jumlah harus berupa angka.";
                }

                $stokMobil = $this->cekStokMobil($garasi_idgarasi, $jumlah);
                if ($stokMobil === false) {
                    return "Stok mobil tidak mencukupi.";
                }

                $insertData = mysqli_query($this->kon, "INSERT INTO penyewaan_mobil (id_penyewaan, stok_mobil, garasi_idgarasi)
                                                        VALUES ('$id_penyewaan', '$jumlah', '$garasi_idgarasi')");
                
                if (!$insertData) {
                    return "Gagal menyimpan data. Kesalahan: " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan.";
        }

        private function cekStokMobil($garasi_idgarasi, $jumlah) {
            $query = mysqli_query ($this->kon, "SELECT stok FROM garasi WHERE idgarasi = '$garasi_idgarasi'");
            $data = mysqli_fetch_assoc($query);

            if ($data['stok'] >= $jumlah) {
                return true;
            } else {
                return false;
            }
        }
    }
?>