<?php  
	include_once("../../../config/koneksi.php");
	require("../../../library/fpdf.php");

	$pdf = new FPDF('L', 'mm', 'A4');
	$pdf->AddPage();

	$pdf->SetFont('Times', 'B', 13);
	$pdf->Cell(0, 15, '', 0, 1);
	$pdf->Cell(250, 10, 'Data Penyewa', 0, 0, 'C');

	$pdf->Cell(10, 17, '', 0, 1);	
	$pdf->SetFont('Times', 'B', 9);
	$pdf->Cell(30, 7, 'ID Penyewa', 1, 0, 'C');
	$pdf->Cell(60, 7, 'Nama Penyewa', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Tanggal Sewa', 1, 0, 'C');
	$pdf->Cell(40, 7, 'Tanggal Kembali', 1, 0, 'C');

	$pdf->Cell(10, 7, '', 0, 1);
	$pdf->SetFont('Times', '', 10);

	$no = 1;
	$data = mysqli_query($kon, "SELECT p.id_penyewaan, p.tanggal_sewa, p.tanggal_kembali,
                                    CASE
                                        WHEN p.customer_idcustomer IS NOT NULL THEN c.nama
                                    END AS namapenyewa
                                FROM penyewaan p
                                LEFT JOIN customer c ON p.customer_idcustomer = c.idcustomer
                                ORDER BY p.id_penyewaan ASC");

	while ($d = mysqli_fetch_array($data)) {
        $pdf->Cell(30, 6, $d['id_penyewaan'], 1, 0, 'C');
		$pdf->Cell(60, 6, $d['namapenyewa'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['tanggal_sewa'], 1, 0, 'C');
		$pdf->Cell(40, 6, $d['tanggal_kembali'], 1, 0, 'C');
        $pdf->Ln();
	}

	$pdf->Output();
?>