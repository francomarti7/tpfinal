<?php
require "conex.php";
$conect = conectar();
session_start();
if (!isset($_SESSION['usuario'])){
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
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Eliminar</title>
</head>
<body>

<header>

    <div class="menu">
    <div class="logoblanco">
        <img src="img/logoblanco.png" alt="logoblanco">
    </div>

    <div class="menu">
        <ul>
            <li><a  href="index.php">Inicio</a></li>
            <li><a  href="agregar.php">Agregar/Modificar</a></li>
            <li><a style="color: #ec1414" href=#>Eliminar</a></li>
            <li><a href="reportes.php">Generar Reportes</a></li>
            <li><a href="logout.php">Cerrar Sesion</a></li>
            <li><h3 style="margin-left: 25px ">Bienvenido <?php echo $_SESSION['usuario'];?> </h3></li>
        </ul>
    </div>

</header>


<div class="container">
    <div class="formulario">
        <form action=eliminar.php method="POST">
            <h2 class="eliminatitl" >Eliminar Becado por Cuil</h2>
            <div class="form1">
                <label for="cuil">Cuil</label>
                <input id="cuil" name="cuil" type="number" placeholder="Ingrese el Cuil">
            </div>
            <div class="btnelim">
                <input class="btn1" type="submit" name="eliminar" value="Eliminar">
            </div>
    </div>

        </form>

        <?php
        if (isset($_POST['eliminar'])){

            $borracuil = trim($_POST['cuil']);
            $existe= mysqli_query($conect,"SELECT * FROM becados WHERE cuil ='$borracuil'");

            if(mysqli_num_rows($existe) > 0 ){
                $sql= "UPDATE becados SET estado=0 where cuil = '$borracuil'";
                $eliminar= mysqli_query($conect,$sql);
            } else {  echo '
                <script>
                    alert("Usuario INEXISTENTE intente nuevamente");
                    window.location = "eliminar.php";
                </script>

                ';
                exit();

            }

        }

        ?>


    </div>


<footer>
    <div class="logoabajo">
        <img src="img/minislogo.png" alt="Minislogo"> <br>
    </div>
</footer>


</body>
</html>