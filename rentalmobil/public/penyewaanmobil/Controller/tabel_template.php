<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan Mobil</title>
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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        nav a {
            padding: 10px 20px;
            margin-right: 15px;
            color: #f8fafc;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            background-color: #e2e8f0;
            border: 2px solid #4299e1;
            border-radius: 4px;
        }

        /* Hover effect */
        nav a:hover {
            background-color: #4299e1;
            color: #fff;
        }

        /* Style untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 3px solid #020617;
            padding: 12px;
            text-align: left;
            color: #020617;
            background-color: #fff;
        }

        th:first-child {
            color: #fff;
        }

        th {
            font-weight: bold;
            background-color: #4299e1;
        }

        td {
            font-size: 16px;
        }

        /* Style untuk sel yang sejajar dengan ID Buku */
        th:first-child,
        th:nth-child(2),
        th:nth-child(3),
        th:nth-child(4),
        th:nth-child(5),
        th:nth-child(6),
        th:nth-child(7),
        th:nth-child(8),
        th:nth-child(9) {
            color: #fff;
        }

        /* Style untuk tombol Cetak */
        .btn-cetak {
            color: #4299e1;
        }
        
        /* Style untuk tombol Home */
        .home-link {
            margin-left: auto; /* Posisikan ke pojok kanan */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1>Data Penyewaan Mobil</h1>
        <nav>
            <div>
                <a href="../../penyewaanmobil/view/tambah.php" class="btn bg-blue-500 text-white">Meminjam Buku</a>
                <a href="../penyewaanmobil/view/cetak.php" target="_blank" class="btn bg-blue-500 text-white">Cetak</a>
            </div>
            <a href="../../../public/dashboard/dashboard.php" class="btn bg-blue-500 text-white home-link">Home</a>
        </nav>
        <form action="../../dashboard/data/dspenyewaanmobil.php" method="get">
            <label>Tampilkan :</label>
            <select name="perPage" onchange="this.form.submit()">
                <option value="15" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 5 ? 'selected' : ''; ?>>15</option>
                <option value="25" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 10 ? 'selected' : ''; ?>>25</option>
                <option value="35" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 15 ? 'selected' : ''; ?>>35</option>
                <option value="50" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 20 ? 'selected' : ''; ?>>50</option">
            </select>
        </form>
        <table border="1">
            <tr>
                <th> No </th>
                <th> Penyewaan ID Mobil </th>
                <th> Nama Penyewa </th>
                <th> Nama Mobil </th>
                <th> Gambar </th>
                <th> Jumlah </th>
                <th> Sisa </th>
                <th> Tanggal Sewa </th>
                <th> Aksi </th>
            </tr>
        <?php 
            $prevPenyewaanID = null;
            $rowspanCounts = [];
            if ($num > 0) {
                //Menghitung rowspanCounts untuk setiap penyewaan ID
                while ($row = mysqli_fetch_assoc($ambildata)) {
                    $penyewaanID = $row['id_penyewaan'];
                    $rowspanCounts[$penyewaanID][] = $row;
                }
                //Kembali ke awal result set
                mysqli_data_seek($ambildata, 0);
                $no = $start + 1;
                foreach ($rowspanCounts as $penyewaanID => $rows) {
                    $rowspanCounts = count($rows);
                    $firstRow = true;
                    foreach ($rows as $key => $userAmbilData) {
                        echo "<tr>";
                        if ($firstRow) {
                            echo "<td rowspan='{$rowspanCounts}'>" . $no++ . "</td>";
                            echo "<td rowspan='{$rowspanCounts}'>" . $userAmbilData['id_penyewaan'] . "</td>";
                            echo "<td rowspan='{$rowspanCounts}'>" . $userAmbilData['namapenyewa'] . "</td>";
                            $firstRow = false;
                        }
                        echo "<td>" . $userAmbilData['nama'] . "</td>";
                        echo "<td><img src='../../kendaraan/aset/{$userAmbilData['gambar']}' alt='Gambar Mobil' style='max-width: 100px; max-height: 100px;'></td>";
                        echo "<td>" . $userAmbilData['jumlah_mobil'] . "</td>";
                        echo "<td>" . $userAmbilData['tersedia'] . "</td>";
                        echo "<td>" . $userAmbilData['tanggal_sewa'] . "</td>";
                        
                        if ($key === 0) {
                            echo "<td rowspan='{$rowspanCounts}'>";
                            if (isset($userAmbilData['id_penyewaan'])) {
                                echo "<a href='../../penyewaanmobil/view/cetakpeminjam.php?id_penyewaan={$userAmbilData['id_penyewaan']}'> Cetak </a>";
                            }
                            echo "</td>";
                        }
                    }
                }
            } else {
                echo "<tr><td colspan='10'>Tidak ada data</td></tr>";
            }
        ?>
    </table>