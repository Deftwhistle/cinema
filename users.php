<?php


function login($email, $password){

$conexion =mysqli_connect('localhost','root','','cinema');
if(!$conexion){
    echo "Error en conexion";
}



$query = "SELECT admin FROM usuarios WHERE email = '$email' AND contrasena = '$password'";
$resultado = mysqli_query($conexion,$query);



if($resultado->num_rows > 0) {

    $row = mysqli_fetch_array($resultado);
    mysqli_close($conexion);
    if($row["0"] == 1){

        return "admin";
    }else{
        return "user";
    }
}else{
    return "error";
}


}



function register($email, $password, $hint){

    $conexion =mysqli_connect('localhost','root','','cinema');
    if(!$conexion){
        return "error";
    }
    
    
    $query = "INSERT INTO usuarios (email,contrasena,admin,hint) VALUES ('$email','$password','0','$hint')";
    $resultado = mysqli_query($conexion,$query);
    mysqli_close($conexion);
    
    if($resultado){
        return "success";
    }else{
        return "error";
    }
    
    
    }

