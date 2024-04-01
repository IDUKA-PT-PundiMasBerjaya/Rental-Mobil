<?php 
    include_once("../../../config/koneksi.php");

    class PeminjamanController {
        private $kon;

        public function __construct($connection) {
            $this->kon = $connection;
        }

        public function getPeminjamanData($id_peminjaman) {
            $result = mysqli_query($this->kon, "SELECT p.id_peminjaman, p.tanggal_pinjam, p.tanggal_kembali,
                                                    CASE
                                                        WHEN p.guru_idguru IS NOT NULL THEN g.nama
                                                        WHEN p.siswa_idsiswa IS NOT NULL THEN s.nama
                                                    END AS namapengguna
                                                FROM peminjaman p
                                                LEFT JOIN guru g ON p.guru_idguru = g.idguru
                                                LEFT JOIN siswa s ON p.siswa_idsiswa = s.idsiswa
                                                WHERE p.id_peminjaman = '$id_peminjaman'");
            return mysqli_fetch_array($result);
        }
    }

    $peminjamanController = new PeminjamanController($kon);
    $id_peminjaman = $_GET['id_peminjaman'];
    $peminjamanData = $peminjamanController->getPeminjamanData($id_peminjaman);

    if ($peminjamanData) {
        $id_peminjaman = $peminjamanData['id_peminjaman'];
        $namapengguna = $peminjamanData['namapengguna'];
        $tanggal_pinjam = $peminjamanData['tanggal_pinjam'];
        $tanggal_kembali = $peminjamanData['tanggal_kembali'];
    }
?>