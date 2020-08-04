<?php

include "../includes/conexion.php";

$errors         = array(); 
$data           = array(); 

if (empty($_POST['nombre']))
    $errors['nombre'] = 'Debe ingresar el nombre de la marca.';

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $nombre = $_POST['nombre'];

    if ($nombre != '') {
        $sql_rubro = "INSERT INTO marca(nombre_marca) VALUES ('$nombre')";
        $consulta_rubro = $conexion->query($sql_rubro);
    }

    $data['success'] = true;
    $data['message'] = 'Marca agregada con éxito!';
}

echo json_encode($data);




