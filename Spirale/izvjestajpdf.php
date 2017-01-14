<?php
require("fpdf181/fpdf.php");

class PDF extends FPDF
{}

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times', '', 12);
    $header = array('Naziv', 'Cijena');
    //$xml = simplexml_load_file('usluge.xml');
    //$pdf->BasicTable($header, $xml);

	$dbh= new PDO("mysql:dbname=wt_spirala4;host=localhost;charset=utf8", "wtuser", "wtpassword");
	$sql = 'SELECT naziv, cijena FROM usluga ORDER BY id';
    foreach ($dbh->query($sql) as $row) {
		$pdf->Cell(0,10,'Usluga '.$row['naziv'].' Cijena: '.$row['cijena'],0,1);
	}
	
    $pdf->SetX(15);
    $pdf->SetY(40);
    $pdf->Output();
?>