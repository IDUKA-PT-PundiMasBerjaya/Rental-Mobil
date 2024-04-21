<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengembalian Mobil</title>
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
        th:nth-child(9),
        th:nth-child(10) {
            color: #fff;
        }

        /* Style untuk tombol Cetak */
        .btn-cetak {
            color: #4299e1;
        }
        .btn-cetak-pegembal{
            color: #4299e1;
        }
        
        /* Style untuk tombol Home */
        .home-link {
            margin-left: auto; /* Posisikan ke pojok kanan */
        }
    </style>
</head>
    <h1>Data Pengembalian Mobil</h1>
        <nav>
            <div>
                <a href="../../pengembalianmobil/view/tambah.php"  class="btn bg-blue-500 text-white"> Kembalikan Mobil </a>
                <a href="../../pengembalianmobil/view/cetak.php" target="_blank" class="btn bg-blue-500 text-white"> Cetak </a>
            </div>
            <a href="../../../public/dashboard/dashboard.php" class="btn bg-blue-500 text-white home-link"> Home </a>
        </nav>
<form action="../../dashboard/data/dspengembalianmobil.php" method="get">
<label>Tampilkan :</label>
    <select name="perPage" onchange="this.form.submit()">
        <option value="15" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 5 ? 'selected' : ''; ?>>15</option>
        <option value="25" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 10 ? 'selected' : ''; ?>>25</option>
        <option value="35" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 20 ? 'selected' : ''; ?>>35</option>
        <option value="50" <?php echo isset($_GET['perPage']) && $_GET['perPage'] == 30 ? 'selected' : ''; ?>>50</option>
    </select>
</form>
<table border="1">
    <tr>
        <th> No </th>
        <th> ID Pengembalian </th>
        <th> Nama Penyewa </th>
        <th> Tanggal Pengembalian </th>
        <th> Nama Mobil </th>
        <th> Jumlah </th>
        <th> Gambar </th>
        <th> Denda </th>
        <th> Total Denda </th>
        <th> Aksi </th>
    </tr>
    <?php 
        $prevPengembalianID = null;
        $rowSpanCounts = [];

        if ($num > 0) {
            $totalDendaByID = [];
            
            while ($row = mysqli_fetch_array($ambildata)) {
                $pengembalianID = $row['id_pengembalian'];
                $rowSpanCounts[$pengembalianID][] = $row;

                if (!isset($totalDendaByID[$pengembalianID])) {
                    $totalDendaByID[$pengembalianID] = 0;
                }
                $totalDendaByID[$pengembalianID] += $row['denda'];
            }

            mysqli_data_seek($ambildata, 0);
            $no = $start + 1;
            foreach ($rowSpanCounts as $pengembalianID => $rows) {
                $rowSpanCount = count($rows);
                $firstRow = true;
                foreach ($rows as $key => $userAmbilData) {
                    echo "<tr>";
                    if ($firstRow) {
                        echo "<td rowspan='{$rowSpanCount}'>" . $no++ . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['id_pengembalian'] . "</td>";
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['namapenyewa'] . "</td>";      
                        echo "<td rowspan='{$rowSpanCount}'>" . $userAmbilData['tanggal_pengembalian'] . "</td>";
                        $firstRow = false;
                    }
                    echo "<td>" . $userAmbilData['nama_kendaraan'] . "</td>";
                    echo "<td>" . $userAmbilData['stok_mobil'] . "</td>";
                    echo "<td><img src='../../kendaraan/aset/{$userAmbilData['gambar_kendaraan']}' alt='Gambar Mobil' style='width: 150px; height: 100px;'></td>";
                    echo "<td>" . $userAmbilData['telat_hari'] . " Hari - Rp. " . $userAmbilData['denda'] . "</td>";

                    if ($key === 0) {
                        echo "<td rowspan='{$rowSpanCount}'>Rp. " . $totalDendaByID[$pengembalianID] . "</td>";
                    }

                    if ($key === 0) {
                        echo "<td rowspan='{$rowSpanCount}'>";
                        if (isset($userAmbilData['id_pengembalian'])) {
                            echo "<a href='../../pengembalianmobil/view/cetakpengembali.php?id_pengembalian={$userAmbilData['id_pengembalian']}' target='_blank' class=>Cetak</a>";
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='10'>Data tidak ditemukan.</td></tr>";
        }
    ?>
</table>