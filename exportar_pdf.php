<?php
header('Content-Type: text/html; charset=utf8mb4');
require('conex.php');
require('mipdf.php');

$con = conectar();




mysqli_set_charset($con, "utf8mb4");
$pdf = new MyPDF();
$pdf->AliasNbPages();
$pdf->AddPage();



$query= "SELECT becados.id_becado, becados.apellido, becados.nombre, becados.cuil, becados.estado, lugar.dir_ofi 
         FROM becados  
         JOIN lugar 
         ON becados.id_lugar = lugar.id_lugar
         AND estado='1'
         ORDER BY id_becado";
$sql = mysqli_query($con,$query);


while($row = mysqli_fetch_array($sql)) {
    $pdf->Cell(8,8,$row['id_becado'],1,0,'C');
    $pdf->Cell(40,8,$row['apellido'],1,0,'C');
    $pdf->Cell(40,8,$row['nombre'],1,0,'C');
    $pdf->Cell(40,8,$row['cuil'],1,0,'C');
    $pdf->Cell(50,8,$row['dir_ofi'],1,1,'C');
}

$pdf->Output();
?>