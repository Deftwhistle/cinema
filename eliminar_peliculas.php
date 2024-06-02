<?php

$conexion = mysqli_connect('localhost', 'root', '', 'cinema');
if (!$conexion) {
    echo "Error en conexion";
}

$id = $_POST['id'];
$id_pelicula = $_POST["id_pelicula"];
$id_protagonista = $_POST["id_protagonista"];

$query1 = "DELETE from proyectar WHERE id_cine= '$id' AND id_pelicula = '$id_pelicula'";
$result1 = mysqli_query($conexion, $query1);

if ($result1) {
    $query2 = "DELETE FROM pelicula WHERE id = '$id_pelicula'";
    $result2 = mysqli_query($conexion, $query2);

    if ($result2) {
        $query3 = "DELETE FROM protagonista WHERE id = '$id_protagonista'";
        $result3 = mysqli_query($conexion, $query3);

        if ($result3) {
            echo "Borrado exitosamente";
        } else {
            echo "Error";
        }
    }
}

mysqli_close($conexion);
