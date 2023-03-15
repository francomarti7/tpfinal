<?php
require_once ("conex.php");
$con=conectar();
session_start();

mysqli_set_charset($con, "utf8");

header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte.xls");

echo chr(239) . chr(187) . chr(191);

$buscanombre=$_GET['buscanombre'];
$buscacuil=$_GET['buscacuil'];
$buscalugar=$_GET['buscalugar'];


if ($buscanombre > 1) {
    $filtro = mysqli_query($con, "SELECT becados.id_becado,becados.apellido,becados.nombre,becados.cuil,lugar.dir_ofi 
                                        FROM becados 
                                        JOIN lugar ON becados.id_lugar = lugar.id_lugar                                       
                                        WHERE  becados.apellido 
                                        LIKE '%$buscanombre%'  or becados.nombre LIKE '%$buscanombre%'
                                        AND estado ='1'
                                        ORDER BY id_becado");


 } else if ($buscacuil > 1) {
    $filtro = mysqli_query($con, "SELECT becados.id_becado,becados.apellido,becados.nombre,becados.cuil,lugar.dir_ofi 
                                        FROM becados 
                                        JOIN lugar ON becados.id_lugar = lugar.id_lugar 
                                        WHERE  becados.cuil = '$buscacuil'   
                                        AND estado ='1'
                                        ORDER BY id_becado");


 } else if ($buscalugar > 0 ) {
$filtro = mysqli_query($con, "SELECT becados.id_becado,becados.apellido,becados.nombre,becados.cuil,lugar.dir_ofi 
                                        FROM becados 
                                        JOIN lugar ON becados.id_lugar = lugar.id_lugar 
                                        WHERE  becados.id_lugar = '$buscalugar'   
                                        AND estado ='1'
                                        ORDER BY id_becado");


} else if ($buscalugar ==0 ) {
$filtro = mysqli_query($con, "SELECT  becados.id_becado,becados.apellido,becados.nombre,becados.cuil,becados.estado,lugar.dir_ofi 
         FROM becados  
         JOIN lugar 
         ON becados.id_lugar = lugar.id_lugar
         AND estado='1'
         ORDER BY id_becado  ");


}else {
    ?>
        <script>
            alert("Datos vacios por favor intente nuevamente.")
                        window.location = "index.php";
        </script>
    <?php

}


?>




<table class="tabla">
        <thead>
        <tr>
            <th>N°</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Cuil</th>
            <th>Lugar de Trabajo</th>

        </tr>

        </thead>
        <tbody>
        <tr>

            <?php

            while($row = mysqli_fetch_array($filtro))
            {
                echo "<tr>";
                echo "<td>" . $row['id_becado']  ."</td>";
                echo "<td>" . $row['apellido'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['cuil'] . "</td>";
                echo "<td>" . $row['dir_ofi'] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";


            ?>

        </tr>
        </tbody>
    </table>