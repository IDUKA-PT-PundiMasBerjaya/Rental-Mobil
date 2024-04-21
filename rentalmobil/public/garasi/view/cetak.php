<?php 
    include_once("../../../config/koneksi.php");
    require("../../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

	$pdf->SetFont('Arial', 'B', 14);
	$pdf->Cell(0, 10, '', 0, 1);
	$pdf->Cell(270, 10, 'Data Garasi', 0, 0, 'C');

	$pdf->Cell(10, 10, '', 0, 1);	
	$pdf->SetFont('Arial', 'B', 10);
	$pdf->Cell(30, 7, 'ID Garasi', 1, 0, 'C');
	$pdf->Cell(50, 7, 'Id Mobil', 1, 0, 'C');
	$pdf->Cell(50, 7, 'stok', 1, 0, 'C');


    $pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Arial', '', 11);

	$data = mysqli_query($kon, "SELECT * FROM garasi ORDER BY idgarasi ASC");

    while ($d = mysqli_fetch_array($data)) {
		$pdf->Cell(30, 6, $d['idgarasi'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['kendaraan_idmobil'], 1, 0, 'C');
		$pdf->Cell(50, 6, $d['stok'], 1, 0, 'C');
		$pdf->Ln();
	}
	$pdf->Output();
?>