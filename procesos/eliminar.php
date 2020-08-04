<?php 
include "../includes/conexion.php";

//Se recibe el id por POST
$id_marca = $_POST['id_marca'];

//Se hace el delete en la BD
$sql = "DELETE FROM marca WHERE id_marca = $id_marca";
echo $resultado = $conexion->query($sql);

?>