<?php
function conectar(){
    $user    = 'root';
    $pass    = '';
    $base    = 'ministerio';
    $host    = 'localhost';
    $con     = mysqli_connect($host,$user,$pass,$base);

    if($con == false) {
        die("Error de Conexion");
    }
    return $con;
}
