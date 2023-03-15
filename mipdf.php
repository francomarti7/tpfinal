<?php
header('Content-Type: text/html; charset=utf8mb4');
require('fpdf/fpdf.php');



class MyPDF extends FPDF {
    function Header() {
        $this->SetFont('Arial','B',10);
        $this->Cell(30);
        $this->Cell(120,10,'Becados Ministerio de Desarrollo Social',1,0,'C');
        $this->Ln(20);
        $this->SetFont('Arial','B',8);
        $this->Cell(8,8,'N°',1,0,'C');
        $this->Cell(40,8,'Apellido',1,0,'C');
        $this->Cell(40,8,'Nombre',1,0,'C');
        $this->Cell(40,8,'Cuil',1,0,'C');
        $this->Cell(50,8,'Lugar de Trabajo',1,1,'C');
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
?>