<?php
    include_once("../../../config/koneksi.php");
    require("../../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(0, 15, '', 0, 1);
    $pdf->Cell(250, 10, 'Data Penyewaan Mobil', 0, 0, 'C');

    $pdf->Cell(10, 17, '', 0, 1);	
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    $pdf->Cell(30, 7, 'ID Penyewaan', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Nama Penyewaan', 1, 0, 'C');
    $pdf->Cell(80, 7, 'Nama Mobil', 1, 0, 'C');
    $pdf->Cell(22, 7, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(22, 7, 'Sisa', 1, 0, 'C');
    $pdf->Cell(30, 7, 'Tgl. Penyewaan', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);

    $no = 1;
    $data = "SELECT penyewaan_mobil.id_penyewaan, kendaraan.nama_mobil AS nama_kendaraan,
                CASE
                    WHEN customer.nama IS NOT NULL THEN customer.nama
                END AS namapenyewa,
                penyewaan_mobil.stok_mobil,
                garasi.stok,
                kendaraan.gambar_mobil AS gambar_kendaraan,
                penyewaan.tanggal_sewa
                FROM 
                penyewaan_mobil
                JOIN 
                penyewaan ON penyewaan_mobil.id_penyewaan = penyewaan.id_penyewaan                
                LEFT JOIN
                customer ON penyewaan.customer_idcustomer = customer.idcustomer
                JOIN 
                garasi ON penyewaan_mobil.garasi_idgarasi = garasi.idgarasi
                JOIN
                kendaraan ON garasi.kendaraan_idmobil = kendaraan.idmobil";

    $ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
    $num = mysqli_num_rows($ambildata);

    $prevpenyewaanID = null;
    $rowSpanCounts = [];

    if ($num > 0) {
        while ($row = mysqli_fetch_array($ambildata)) {
            $penyewaanID = $row['id_penyewaan'];
            $rowSpanCounts[$penyewaanID][] = $row;
        }

        mysqli_data_seek($ambildata, 0);
        $no = 1;
        foreach ($rowSpanCounts as $penyewaanID => $rows) {
            $rowSpanCount = count($rows);
            $firstRow = true;
            foreach ($rows as $key => $userAmbilData) {
                if ($firstRow) {
                    $pdf->Cell(10, 6 * $rowSpanCount, $no++, 1, 0, 'C');
                $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['id_penyewaan'], 1, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['namapenyewa'], 1, 0, 'C');
                    $firstRow = false;
                } else {
                    $pdf->Cell(10, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                    $pdf->Cell(30, 6 * $rowSpanCount, '', 0, 0, 'C');
                }

                $pdf->Cell(80, 6, $userAmbilData['nama_kendaraan'], 1, 0, 'C');
                $pdf->Cell(22, 6, $userAmbilData['stok_mobil'], 1, 0, 'C');
                $pdf->Cell(22, 6, $userAmbilData['stok'], 1, 0, 'C');
                $pdf->Cell(30, 6, $userAmbilData['tanggal_sewa'], 1, 1, 'C');
            }
        }
    }

    $pdf->Output();
?>