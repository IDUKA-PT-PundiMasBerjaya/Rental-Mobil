<?php 
    include_once("../../../config/koneksi.php");

    if (isset($_GET['cari'])) {
        $cari = $_GET['cari'];
    }

    $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    $query = "SELECT pengembalian_mobil.id_pengembalian, kendaraan.nama_mobil AS nama_kendaraan,
                CASE
                    WHEN customer.nama IS NOT NULL THEN customer.nama
                END AS namapenyewa,
                pengembalian_mobil.stok_mobil,
                garasi.stok AS stok_garasi,
                kendaraan.gambar_mobil AS gambar_kendaraan,
                pengembalian_mobil.tanggal_pengembalian,
                penyewaan.id_penyewaan AS penyewaan_id_penyewaan,
                pengembalian_mobil.denda,
                DATEDIFF(pengembalian_mobil.tanggal_pengembalian, penyewaan.tanggal_kembali) AS telat_hari
                FROM 
                pengembalian_mobil
                JOIN 
                penyewaan ON pengembalian_mobil.id_pengembalian = penyewaan.id_penyewaan                
                LEFT JOIN
                customer ON penyewaan.customer_idcustomer = customer.idcustomer
                JOIN 
                garasi ON pengembalian_mobil.garasi_idgarasi = garasi.idgarasi
                JOIN
                kendaraan ON garasi.kendaraan_idmobil = kendaraan.idmobil";
    
    if (!empty($cari)) {
        $query .= " WHERE penyewaan_mobil.id_penyewaan LIKE '%".$cari."%' 
                    OR kendaraan.nama_mobil LIKE '%".$cari."%' 
                    OR customer.nama LIKE '%".$cari."%' 
                    OR kendaraan.merek LIKE '%".$cari."%'";
    }

    $query .= " ORDER BY pengembalian_mobil.id_pengembalian DESC LIMIT $start, $perPage";
    $ambildata = mysqli_query($kon, $query) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Halaman Data Pengembalian Mobil </title>
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
        <form action="dspengembalianmobil.php" method="get">
            <label>Cari: </label>
            <input type="text" name="cari" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
            <input type="submit" value="Cari">
        </form>
    </div>
    <?php include("../../pengembalianmobil/Controller/tabel_template.php") ?>
    <?php 
        $totalPage = mysqli_num_rows(mysqli_query($kon, "SELECT * FROM pengembalian_mobil")); 
        $totalPage = ceil($totalPage / $perPage);
        include("../../pengembalianmobil/Controller/pagination_template.php")
    ?>
</body>
</html>