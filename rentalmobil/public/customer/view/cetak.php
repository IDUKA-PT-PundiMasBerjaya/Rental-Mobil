<?php 
    include_once("../../../config/koneksi.php");
    require("../../../library/fpdf.php");

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Customer', 0, 0, 'C');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(20, 7, 'ID Customer', 1, 0, 'C');
	$pdf->Cell(60, 7, 'Nama Customer', 1, 0, 'C');
	$pdf->Cell(80, 7, 'Alamat', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Email', 1, 0, 'C');
	$pdf->Cell(30, 7, 'No. HP', 1, 0, 'C');

    $pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT * FROM customer ORDER BY idcustomer ASC");

    while ($d = mysqli_fetch_array($data)) {
		$pdf->Cell(20, 6, $d['idcustomer'], 1, 0, 'C');
		$pdf->Cell(60, 6, $d['nama'], 1, 0, 'C');
		$pdf->Cell(80, 6, $d['alamat'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['email'], 1, 0, 'C');
		$pdf->Cell(30, 6, $d['no_hp'], 1, 0, 'C');
		$pdf->Ln();
	}
	$pdf->Output();
?>