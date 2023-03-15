<?php
require "conex.php";
$con=conectar();
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
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
    <title>Agregar/Modificar</title>
</head>
<body>

<header>
    <div class="menu">
    <div class="logoblanco">
        <img src="img/logoblanco.png" alt="logoblanco">
    </div>


        <ul>
            <li><a  href="index.php">Inicio</a></li>
            <li><a  style="color: #ec1414" href=#>Agregar/Modificar</a></li>
            <li><a href="eliminar.php">Eliminar</a></li>
            <li><a href="reportes.php">Generar Reportes</a></li>
            <li><a href="logout.php">Cerrar Sesion</a></li>
            <li><h3 style="margin-left: 25px ">Bienvenido <?php echo $_SESSION['usuario'];?> </h3></li>
        </ul>
    </div>
</header>


<div class="container">
    <div class="formulario">
        <form action="" method="POST">
            <h2 class="agregotitl" >Agregar Becado</h2>
            <div class="form1">
                <label for="apellido">Datos Personales</label>
                <input id="apellido" name="apellido" type="text" placeholder="Apellido">
            </div>
            <div class="form2">

                <input id="nombre" name="nombre" type="text" placeholder="Nombre">
            </div>
            <div class="form3">

                <input id="cuil" name="cuil" type="number" placeholder="Cuil">
            </div>
            <div class="form4">

                <select name="lugar" id="lugar">
                    <option value="">Lugar de Trabajo</option>
                    <option value="1">Acción Social Directa</option>
                    <option value="2">Sectorial Personal</option>
                    <option value="3">Tesoreria</option>
                    <option value="4">Unidad de Auditoria Interna</option>
                    <option value="5">Mesa de Entrada</option>
                </select>
            </div>
            <div class="btn">
                <input class="btn1" type="submit" name="enviar" value="Agregar">
            </div>
        </form>
         <?php
                if (isset($_POST['enviar'])){
                    $apellido=trim($_POST['apellido']);
                    $nombre=trim($_POST['nombre']);
                    $cuil=trim($_POST['cuil']);
                    $lugar=trim($_POST['lugar']);

                    $verifica=mysqli_query($con,"SELECT * FROM becados WHERE cuil = $cuil");
                     if (mysqli_num_rows($verifica) > 0 ){
                echo '
                <script>
                    alert("Usuario DUPLICADO intente nuevamente");
                    window.location = "agregar.php";
                </script>

                ';
                exit();
            }


                    $sql= "INSERT INTO becados (apellido, nombre, cuil, id_lugar,estado) VALUES ('$apellido','$nombre','$cuil','$lugar','1')";
                    $agregar= mysqli_query($con,$sql);



         }
            ?>


    </div>
</div>

<footer>
    <div class="logoabajo">
        <img src="img/minislogo.png" alt="Minislogo"> <br>
    </div>
</footer>


</body>
</html>