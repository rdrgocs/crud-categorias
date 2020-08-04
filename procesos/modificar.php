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
    $id = $_POST['id_marca'];
    $nombre = $_POST['nombre'];

    if ($nombre != '') {
        $sql_rubro = "UPDATE marca SET nombre_marca = '" . $nombre . "' WHERE id_marca = " . $id;
        $consulta_rubro = $conexion->query($sql_rubro);
    }

    $data['success'] = true;
    $data['message'] = 'Marca agregado con éxito!';
}

echo json_encode($data);
