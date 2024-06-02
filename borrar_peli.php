<?php


$conexion = mysqli_connect('localhost', 'root', '', 'cinema');
if (!$conexion) {
    echo "Error en conexion";
}


$id_pelicula = $_GET["id"];

$conexion = mysqli_connect('localhost', 'root', '', 'cinema');

       $query = "SELECT cine.id AS id_cine, pelicula.id AS id_pelicula,
        protagonista.id AS id_protagonista
       FROM cine
       INNER JOIN proyectar ON cine.id=proyectar.id_cine
       INNER JOIN pelicula ON proyectar.id_pelicula = pelicula.id
       INNER JOIN genero ON pelicula.genero = genero.id
       INNER JOIN clasificacion ON pelicula.clasificacion = clasificacion.id
       INNER JOIN protagonista ON pelicula.protagonista = protagonista.id
       WHERE pelicula.id = '$id_pelicula'";
       
       
       
       $response = mysqli_query($conexion, $query);

       while($row = mysqli_fetch_array($response))
       {
           $id_cine = $row['0'];
           $id_pelicula = $row['1']; 
           $id_protagonista = $row['2'];
       
       
       }
       mysqli_close($conexion);


$conexion = mysqli_connect('localhost', 'root', '', 'cinema');
$query1 = "DELETE from proyectar WHERE id_cine= '$id_cine' AND id_pelicula = '$id_pelicula'";
$result1 = mysqli_query($conexion, $query1);

if ($result1) {
    $query2 = "DELETE FROM pelicula WHERE id = '$id_pelicula'";
    $result2 = mysqli_query($conexion, $query2);

    if ($result2) {
        $query3 = "DELETE FROM protagonista WHERE id = '$id_protagonista'";
        $result3 = mysqli_query($conexion, $query3);

        if ($result3) {
            echo "Borrado exitosamente";
            header("Location: http://localhost:8000/cine_admin.php", true, 301);
            exit();
        } else {
            echo "Error";
        }
    }
}

mysqli_close($conexion);
