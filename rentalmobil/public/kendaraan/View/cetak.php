<?php 
    include_once("../../../config/koneksi.php");
    require("../../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

	$pdf->SetFont('Arial', 'B', 14);
	$pdf->Cell(0, 10, '', 0, 1);
	$pdf->Cell(270, 10, 'Data Kendaraan', 0, 0, 'C');

	$pdf->Cell(10, 10, '', 0, 1);	
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(30, 7, 'ID Kendaraan', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Nama Kendaraan', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Merek', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Warna', 1, 0, 'C');
	$pdf->Cell(30, 7, 'Tahun', 1, 0, 'C');
	$pdf->Cell(60, 7, 'Harga Per Hari', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Arial', '', 11);

	$data = mysqli_query($kon, "SELECT * FROM kendaraan ORDER BY idmobil ASC");

    while ($d = mysqli_fetch_array($data)) {
		$pdf->Cell(30, 6, $d['idmobil'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['nama_mobil'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['merek'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['warna'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['tahun'], 1, 0, 'C');
		$pdf->Cell(60, 6, $d['harga_perhari'], 1, 0, 'C');
		$pdf->Ln();
	}
	$pdf->Output();
?>