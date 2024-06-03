<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="sw/package/dist/sweetalert2.min.css">
</head>
<?php

$conexion = mysqli_connect('localhost', 'root', '', 'cinema');
if (!$conexion) {
    echo "Error en conexion";
}

$id = $_GET['id'];


$query = "UPDATE pelicula SET ticket = ticket + 1 WHERE id  = '$id'";
$result = mysqli_query($conexion, $query);

mysqli_close($conexion);

if ($result) {
?>
    <div class="notice">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Ticket comprado.
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="cine_admin.php" class="btn btn-primary mt-4">Regresar</a>
            </div>
        </div>
    </div>
<?php

} else {
?>
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Error.
    </div>
<?php
}
