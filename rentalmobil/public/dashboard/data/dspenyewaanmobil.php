<?php 
    include_once("../../../config/koneksi.php");

    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT penyewaan_mobil.id_penyewaan, kendaraan.nama_mobil AS nama,
                CASE
                    WHEN customer.nama IS NOT NULL THEN customer.nama
                END AS namapenyewa,
                penyewaan_mobil.jumlah_mobil,
                kendaraan.tersedia,
                kendaraan.gambar_mobil AS gambar,
                penyewaan.tanggal_sewa
                FROM 
                penyewaan_mobil
                JOIN 
                penyewaan ON penyewaan_mobil.id_penyewaan = penyewaan.id_penyewaan                
                LEFT JOIN
                customer ON penyewaan.customer_idcustomer = customer.idcustomer
                JOIN 
                kendaraan ON penyewaan_mobil.kendaraan_idmobil = kendaraan.idmobil";

    if (!empty($cari)) {
        $query .= " WHERE penyewaan_mobil.id_penyewaan LIKE '%".$cari."%' 
                    OR customer.idcustomer LIKE '%".$cari."%' 
                    OR kendaraan.nama_mobil LIKE '%".$cari."%'";
    }

    $query .= " ORDER BY penyewaan_mobil.id_penyewaan DESC LIMIT $start, $perPage";
    $ambildata = mysqli_query($kon, $query);
    if (!$ambildata) {
        die('Error: ' . mysqli_error($kon));
    }
    $num = mysqli_num_rows($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Halaman Data Penyewaan Barang </title>
    <style>
        /* Style untuk tombol pencarian (search) */
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start; /* Mengatur tata letak ke kiri */
            align-items: center;
        }

        .search-container input[type=text] {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #4299e1;
            border-radius: 4px;
        }

        .search-container input[type=submit] {
            background-color: #4299e1;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-container input[type=submit]:hover {
            background-color: #2c5282;
        }
    </style>
</head>
<body>
    <div class="search-container">
        <form action="dspenyewaanmobil.php" method="get">
            <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>" placeholder="Cari...">
            <input type="submit" value="Cari">
        </form>
    </div>
    <?php include("../../penyewaanmobil/Controller/tabel_template.php") ?> <!-- tabel_template.php -->
    <?php 
        $totalData = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM penyewaan_mobil"));
        $totalPage = ceil($totalData / $perPage);
        include("../../penyewaanmobil/Controller/pagination_template.php"); // pagination_template.php
    ?>
</body>
</html>