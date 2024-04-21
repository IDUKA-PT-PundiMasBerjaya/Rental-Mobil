<?php
include_once("../../../config/koneksi.php");
require("../../../library/fpdf.php");

$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Times', 'B', 13);
$pdf->Cell(0, 15, '', 0, 1);
$id_pengembalian = $_GET['id_pengembalian'];
$data = "SELECT CASE
                    WHEN customer.nama IS NOT NULL THEN customer.nama
                END AS namapenyewa
                FROM
                pengembalian_mobil
                JOIN
                penyewaan ON pengembalian_mobil.id_pengembalian = penyewaan.id_penyewaan
                LEFT JOIN
                customer ON penyewaan.customer_idcustomer = customer.idcustomer
                WHERE pengembalian_mobil.id_pengembalian = '$id_pengembalian'";

$ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
$nama_penyewa = "";
if ($row = mysqli_fetch_assoc($ambildata)) {
    $nama_penyewa = $row['namapenyewa'];
}

$pdf->Cell(250, 10, "Data Pengembalian Mobil - Penyewa: $nama_penyewa", 0, 0, 'C');

$pdf->Cell(10, 17, '', 0, 1);    
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'No', 1, 0, 'C');
$pdf->Cell(30, 7, 'ID Pengembalian', 1, 0, 'C');
$pdf->Cell(40, 7, 'Nama Penyewa', 1, 0, 'C');
$pdf->Cell(20, 7, 'ID Garasi', 1, 0, 'C');
$pdf->Cell(27, 7, 'Jumlah', 1, 0, 'C');
$pdf->Cell(30, 7, 'Tanggal Kembali', 1, 0, 'C');

$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);

$no = 1;
$data = "SELECT pengembalian_mobil.id_pengembalian,
                pengembalian_mobil.stok_mobil,
                garasi.idgarasi AS id_garasi,
                garasi.stok AS stok_garasi,
                pengembalian_mobil.tanggal_pengembalian,
                penyewaan.id_penyewaan AS penyewaan_id_penyewaan
                FROM
                pengembalian_mobil
                JOIN
                penyewaan ON pengembalian_mobil.id_pengembalian = penyewaan.id_penyewaan
                JOIN
                garasi ON pengembalian_mobil.garasi_idgarasi = garasi.idgarasi
                WHERE pengembalian_mobil.id_pengembalian = '$id_pengembalian'";

$ambildata = mysqli_query($kon, $data) or die(mysqli_error($kon));
$num = mysqli_num_rows($ambildata);

$prevPengembalianID = null;
$rowSpanCounts = [];

if ($num > 0) {
    while ($row = mysqli_fetch_array($ambildata)) {
        $pengembalianID = $row['id_pengembalian'];
        $rowSpanCounts[$pengembalianID][] = $row;
    }

    mysqli_data_seek($ambildata, 0);
    $no = 1;
    foreach ($rowSpanCounts as $pengembalianID => $rows) {
        $rowSpanCount = count($rows);
        $firstRow = true;
        foreach ($rows as $key => $userAmbilData) {
            if ($firstRow) {
                $pdf->Cell(10, 6 * $rowSpanCount, $no++, 1, 0, 'C');
                $pdf->Cell(30, 6 * $rowSpanCount, $userAmbilData['id_pengembalian'], 1, 0, 'C');
                $pdf->Cell(40, 6 * $rowSpanCount, $nama_penyewa, 1, 0, 'C');
                $firstRow = false;
            } else {
                $pdf->Cell(10, 6, '', 0, 0, 'C');
                $pdf->Cell(30, 6, '', 0, 0, 'C');
                $pdf->Cell(40, 6, '', 0, 0, 'C');
            }

            $pdf->Cell(20, 6, $userAmbilData['id_garasi'], 1, 0, 'C');
            $pdf->Cell(27, 6, $userAmbilData['stok_mobil'], 1, 0, 'C');
            $pdf->Cell(30, 6, $userAmbilData['tanggal_pengembalian'], 1, 0, 'C');
        }
    }
}

$pdf->Output();
?>`