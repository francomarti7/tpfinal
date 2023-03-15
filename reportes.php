<?php
require "conex.php";
$con=conectar();
session_start();


if (!isset($_SESSION['usuario'])){
    header("Location: login.php");
}


$query= "SELECT  becados.id_becado,becados.apellido,becados.nombre,becados.cuil,becados.estado,lugar.dir_ofi 
         FROM becados  
         JOIN lugar 
         ON becados.id_lugar = lugar.id_lugar
         AND estado='1'
         ORDER BY id_becado  ";
$sql= mysqli_query($con,$query);

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
    <script src="jquery-3.6.4.min.js"></script>
    <title>Ver Listado</title>
</head>

<header>
    <div class="menu">

        <div class="logoblanco">
            <img src="img/logoblanco.png" alt="logoblanco">
        </div>

        <ul>




                <li><a style="color: #ec1414" href="index.php">Inicio</a></li>
                <li><a href="agregar.php">Agregar/Modificar</a></li>
                <li><a href="eliminar.php">Eliminar</a></li>
                <li><a href="#">Generar Reportes</a></li>
            <li><a href="logout.php">Cerrar Sesion</a></li>
            <li><h3 style="margin-left: 25px ">Bienvenido <?php echo $_SESSION['usuario'];?> </h3></li>
        </ul>



    </div>
</header>
<body>



<div class="centro">

<div class="filtro">
    <div class="formulariofiltro">
    <form id="filtro-form" action="reporte.php" method="get">
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
        <div class="boton-flt">
          <input class="botonfiltro" style="margin-top: 35px" type="submit" name="Filtrar" value="Generar Reporte">
        </div>
    </form>
    </div>




</div>
    <div class="verprint">
    <table id="tabla-resultados" class="tabla">
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

            while($row = mysqli_fetch_array($sql))
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


</div>

<footer>
<div class="logoabajo">
    <img src="img/minislogo.png" alt="Minislogo"> <br>
</div>
</footer>


<script>
$(document).ready(function() {
  $('#filtro-form input, #filtro-form select').on('change', function() {
    $.ajax({
      url: $('#filtro-form').attr('action'),
      data: $('#filtro-form').serialize(),
      type: 'GET',
      success: function(response) {
        $('#tabla-resultados tbody').html(response);
      }
    });
  });
});
</script>


</body>




</html>