<?php 
    include_once("../../../config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Penyewaan</title>
    <style>
        /* Style untuk judul tabel */
        h1 {
            text-align: center;
            color: #020617;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 30px;
        }

        /* Style untuk navbar */
        nav {
            display: flex;
            justify-content: space-between; /* Menempatkan item ke ujung kiri dan kanan */
            align-items: center; /* Pusatkan item secara vertikal */
            margin-bottom: 10px; /* Jarak antara navbar dan judul */
        }

        nav a {
            padding: 10px 20px;
            margin-right: 15px;
            color: #fff; /* Warna biru tua */
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            background-color: #e2e8f0; /* Warna latar belakang */
            border: 2px solid #4299e1; /* Warna border */
            border-radius: 4px; /* Bentuk sudut */
        }

        /* Hover effect */
        nav a:hover {
            background-color: #4299e1; /* Warna latar belakang saat hover */
            color: #fff; /* Warna teks saat hover */
        }

        /* Style untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px; /* Jarak antara tabel dan bagian atas halaman */
        }

        th, td {
            border: 3px solid #020617;
            padding: 12px;
            text-align: left;
            color: #020617; /* Warna teks hitam */
            background-color: #fff; /* Warna latar belakang putih */
        }

        th:first-child,
        th:nth-child(2),
        th:nth-child(3),
        th:nth-child(4),
        th:nth-child(5) {
            color: #fff; /* Warna teks putih */
        }

        th {
            font-weight: bold;
            background-color: #4299e1; /* Warna latar belakang biru muda */
        }

        td {
            font-size: 16px;
        }

        /* Warna teks untuk tautan aksi */
        .btn-view {
            color: #38c172; /* Warna hijau muda */
        }

        /* Style untuk kotak pencarian */
        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type=text] {
            width: 200px;
            margin-top: 10px;
            padding: 5px;
            font-size: 16px;
            border: 2px solid #020617;
            border-radius: 4px;
            background-color: #e2e8f0; /* Warna latar belakang abu-abu */
        }

        .search-container input[type=submit] {
            background-color: #4299e1; /* Warna latar belakang biru muda */
            color: #fff; /* Warna teks putih */
            border: none;
            padding: 8px 16px; /* Padding lebih besar */
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px; /* Jarak antara kotak pencarian dan tombol */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="dashboardpenyewaan.php" method="get">
        <label>Cari :</label>
        <input type="text" name="cari">
        <input type="submit" name="Cari">
    </form>
    <?php 
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
        }
    ?>
    <table border="1">
        <h1>Data Penyewa</h1>
        <nav>
            <div>
                <a href="../../penyewaan/view/tambah.php" class="btn">Tambah Data</a>
                <a href="../../penyewaan/view/cetak.php" target="_blank" class="btn">Cetak</a>
            </div>
            <a href="../dashboard.php" class="btn">Home</a>
        </nav>
            <?php 
                if (isset($_GET['cari'])) {
                    $cari = $_GET['cari'];
                    $sql = "SELECT p.id_penyewaan, p.tanggal_sewa, p.tanggal_kembali,
                                CASE
                                    WHEN p.customer_idcustomer IS NOT NULL THEN c.nama
                                END AS namapengguna
                            FROM penyewaan p
                            LEFT JOIN customer c ON p.customer_idcustomer = c.idcustomer
                            WHERE p.id_penyewaan LIKE '%".$cari."%' OR p.customer_idcustomer LIKE '%".$cari."%'";
                } else {
                    $sql = "SELECT p.id_penyewaan, p.tanggal_sewa, p.tanggal_kembali,
                                CASE
                                WHEN p.customer_idcustomer IS NOT NULL THEN c.nama
                                END AS namapengguna
                            FROM penyewaan p
                            LEFT JOIN customer c ON p.customer_idcustomer = c.idcustomer
                            ORDER BY p.id_penyewaan ASC";
                }

                $ambildata = mysqli_query($kon, $sql);
                $num = mysqli_num_rows($ambildata);
            ?>

        <tr>
            <th> ID Penyewaan </th>
            <th> Nama Customer </th>
            <th> Tanggal Sewa </th>
            <th> Tanggal Kembali </th>
            <th> Aksi </th>
        </tr>
        <tr>
            <?php 
                while ($userAmbilData = mysqli_fetch_array($ambildata)) {
                    echo "<tr>";
                        echo "<td>" . $id = $userAmbilData['id_penyewaan'] . "</td>";
                        echo "<td>" . $namapengguna = $userAmbilData['namapengguna'] . "</td>";
                        echo "<td>" . $tglsewa = $userAmbilData['tanggal_sewa'] . "</td>";
                        echo "<td>" . $tglkembali = $userAmbilData['tanggal_kembali'] . "</td>";
                        echo "<td>
                                | <a href='../../penyewaan/view/view.php?id_penyewaan=$id'>View</a> |
                            </td>";
                    echo "</tr>";
                }
            ?>
        </tr>
    </table>
</body>
</html>