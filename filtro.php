<?php
require "conex.php";
$con=conectar();

session_start();
if (!isset($_SESSION['usuario'])){
    header("Location: login.php");
}

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




<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Ver Listado</title>
</head>

<header>
    <div class="menu">

        <div class="logoblanco">
            <img src="img/logoblanco.png" alt="logoblanco">
        </div>

        <ul>
                <li><a style="color: #ec1414" href=index.php>Inicio</a></li>
                <li><a href="agregar.php">Agregar/Modificar</a></li>
                <li><a href="eliminar.php">Eliminar</a></li>
                <li><a href="reportes.php">Generar Reportes</a></li>
            <li><a href="logout.php">Cerrar Sesion</a></li>
            <li><h3 style="margin-left: 25px ">Bienvenido <?php echo $_SESSION['usuario'];?> </h3></li>
        </ul>
    </div>
</header>
<body>



<div class="centro">

    <div class="filtro">
        <div class="formulariofiltro">
            <form action="filtro.php" method="get">
                <label for="buscanombre">Nombre</label>
                <input type="text" name="buscanombre" id="buscanombre" placeholder="Buscar por Nombre">
                <label for="buscacuil">Cuil</label>
                <input type="number" name="buscacuil" id="buscacuil" placeholder="Buscar por Cuil">
                <label for="buscalugarlugar">Lugar de Trabajo</label>
                <select name="buscalugar" id="buscalugar">
                    <option value="0">Todos</option>
                    <option value="1">Acción Social Directa</option>
                    <option value="2">Sectorial Personal</option>
                    <option value="3">Tesoreria</option>
                    <option value="4">Unidad de Auditoria Interna</option>
                    <option value="5">Mesa de Entrada</option>
                </select>
                <div class="botoness">
                <input class="botonimpr" id="filtra" style="margin-top: 35px" type="submit" name="Filtrar" value="Filtrar">
                <a class="botonimpr" href="" onclick="window.print()" >Imprimir</a>
                
               </div>
            </form>
        </div>

        


    </div>

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
</div>
    <footer>
        <div class="logoabajo">
            <img src="img/minislogo.png" alt="Minislogo"> <br>
        </div>
    </footer>

</body>
</html>