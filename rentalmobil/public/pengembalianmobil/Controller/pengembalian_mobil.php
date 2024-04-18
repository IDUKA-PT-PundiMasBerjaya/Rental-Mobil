<?php

    include_once("../../../config/koneksi.php");

    class TambahDataController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function TambahDataPengembalianMobil($data) {
            $jumlah_array = $data['stok_mobil'];
            $tanggal_pengembalian = $data['tanggal_pengembalian'];
            $idgarasi_array = $data['garasi_idgarasi'];
            $id_penyewaan = $data['penyewaan_id_penyewaan'];

            foreach ($idgarasi_array as $key => $garasi_idgarasi) {
                $jumlah = $jumlah_array[$key];

                if (!is_numeric($jumlah)) {
                    return "Gagal menyimpan data, Jumlah bukan bilangan.";
                }

                $result = mysqli_query($this->kon, "SELECT tanggal_kembali FROM penyewaan WHERE id_penyewaan = '$id_penyewaan'");
                $row = mysqli_fetch_assoc($result);
                $tanggal_kembali_penyewaan = $row['tanggal_kembali'];

                $perbedaan_hari = floor(strtotime($tanggal_pengembalian) - strtotime($tanggal_kembali_penyewaan)) / (60 * 60 * 24);

                $denda = 0;
                if ($perbedaan_hari > 0) {
                    $denda = $perbedaan_hari * 50000; // Asumsi denda per hari adalah 50.000
                }

                $insertData = mysqli_query($this->kon, "INSERT INTO pengembalian_mobil(id_pengembalian, stok_mobil, tanggal_pengembalian, garasi_idgarasi, penyewaan_id_penyewaan, denda)
                                                        VALUES ('$id_penyewaan', '$jumlah', '$tanggal_pengembalian', '$garasi_idgarasi', '$id_penyewaan', '$denda')");

                if (!$insertData) {
                    return "Gagal menyimpan data. Error : " . mysqli_error($this->kon);
                }
            }
            return "Data berhasil disimpan.";
        }
    }
?>