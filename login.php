<?php
require "conex.php";
$conect = conectar();
session_start();
if (isset($_POST['enviar'])){
    $usuario=trim($_POST['usuario']);
    $contra=trim($_POST['contraseña']);
    $select =mysqli_query($conect,"SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña =md5('$contra')");
    $row= mysqli_fetch_array($select);


    if(is_array($row)){

    $_SESSION["usuario"] = $row ['usuario'];
    $_SESSION["contraseña"] = $row ['contraseña'];


} else {
        ?>
            <script>
                alert("Usuario o Contraseña no existente por favor verifique sus datos.")
                window.location = "login.php";
            </script>
        <?php

    }
}

if (isset($_SESSION["usuario"])){
    header("Location: index.php");
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
    <link rel="stylesheet" href="login_Style.css">
    <title>Login</title>
</head>


<body>

<div class="container">
    <div class="formulario">
        <form action="" method="POST">
            <h2>Login</h2>
            <div class="form1">
                <label for="usuario">Usuario</label>
                <input id="usuario" name="usuario" type="text">
            </div>
            <div class="form2">
                <label for="contraseña">Contraseña</label>
                <input id="contraseña" name="contraseña" type="password">
            </div>
            <div class="btn">
              <input class="btn1" type="submit" name="enviar">
            </div>
        </form>
    </div>
</div>
</body>
</html>
