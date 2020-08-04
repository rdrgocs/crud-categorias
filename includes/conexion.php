<?php 

    $conexion = new mysqli ('localhost','root','','test_ajax');

    if ($conexion->connect_errno){
        die('No se pudo conectar');
    }

?>