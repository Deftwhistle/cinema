<?php


$conexion = mysqli_connect('localhost', 'root', '', 'cinema');
if (!$conexion) {
    echo "Error en conexion";
}


$id = $_GET["id"];

$query = "DELETE from cine WHERE id= '$id'";
$result = mysqli_query($conexion, $query);
if ($result) {
?>
    <div class="notice">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Cine eliminado exitosamente.
    </div>

<?php

    header("Location: http://localhost:8000/cine_admin.php", true, 301);
    exit();
} else {
?>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Error al eliminar datos.
    </div>

<?php
}

mysqli_close($conexion);
