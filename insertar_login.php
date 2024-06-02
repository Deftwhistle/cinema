<?php

$conexion =mysqli_connect('localhost','root','','cinema');
if(!$conexion){
    echo "Error en conexion";
}

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];


$query = "INSERT INTO usuarios (email,contrasena,admin) VALUES ('$email','$contrasena','0')";
$resultado = mysqli_query($conexion,$query);

if($resultado){
    echo "Datos ingresados";
}else{
    echo "Error";
}

mysqli_close($conexion);

?>