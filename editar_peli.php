<!DOCTYPE html>
<html>


<head>
    <title>Crear pelicula</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
$id_peli = $_GET["id"];


$conexion = mysqli_connect('localhost', 'root', '', 'cinema');

$query = "SELECT cine.id, pelicula.id AS id_pelicula, cine.nombre AS cine, pelicula.titulo,
       pelicula.director,genero.nombre AS genero,clasificacion.nombre AS clasificacion,
        protagonista.id AS id_protagonista,protagonista.nombre AS protagonista,
        protagonista.nombre2 AS protagonista2,protagonista.nombre3 AS protagonista3,proyectar.hora
       FROM cine
       INNER JOIN proyectar ON cine.id=proyectar.id_cine
       INNER JOIN pelicula ON proyectar.id_pelicula = pelicula.id
       INNER JOIN genero ON pelicula.genero = genero.id
       INNER JOIN clasificacion ON pelicula.clasificacion = clasificacion.id
       INNER JOIN protagonista ON pelicula.protagonista = protagonista.id
       WHERE pelicula.id = '$id_peli'";



$response = mysqli_query($conexion, $query);

while ($row = mysqli_fetch_array($response)) {
    $id = $row['0'];
    $id_pelicula = $row['1'];
    $cine = $row['2'];
    $titulo = $row['3'];
    $director = $row['4'];
    $genero = $row['5'];
    $clasificacion = $row['6'];
    $id_protagonista = $row['7'];
    $protagonista1 = $row['8'];
    if (empty($row['9'])) {
        $protagonista2 = "-";
    } else {
        $protagonista2 = $row['9'];
    }
    if (empty($row['10'])) {
        $protagonista3 = "-";
    } else {
        $protagonista3 = $row['10'];
    }
    $hora = $row['11'];
}
mysqli_close($conexion);

?>



<body>
    <div class="main">
        <h3>Ingresa tu informacion</h3>
        <form action="" method="post">
            <label for="titulo">
                Titulo:
            </label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $titulo; ?>" placeholder="Ingresa el titulo de la pelicula" required>

            <label for="director">
                Director:
            </label>
            <input type="text" id="director" name="director" value="<?php echo $director; ?>" placeholder="Ingresa la director de la pelicula" required>

            <div class="custom-select">
                <select name="genero" required>
                    <option selected disabled>Selecciona la tarifa</option>
                    <option value="1">Dibujos</option>
                    <option value="2">Comedia</option>
                    <option value="3">Drama</option>
                </select>
            </div>

            <div class="custom-select">
                <select name="clasificacion" required>
                    <option selected disabled>Selecciona la tarifa</option>
                    <option value="1">T. menores</option>
                    <option value="2">No rec. menores 13 años</option>
                </select>
            </div>

            <label for="protagonista1">
                Protagonista:
            </label>
            <input type="text" id="protagonista1" name="protagonista1" value="<?php echo $protagonista1; ?>" placeholder="Ingresa el primer protagosnista" required>

            <label for="protagonista2">
                Protagonista:
            </label>
            <input type="text" id="protagonista2" name="protagonista2" value="<?php echo $protagonista2; ?>" placeholder="Ingresa  el segundo protagosnista">

            <label for="protagonista3">
                Protagonista:
            </label>
            <input type="text" id="protagonista3" name="protagonista3" value="<?php echo $protagonista3; ?>" placeholder="Ingresa  el tercer protagosnista">

            <label for="hora">
                Hora:
            </label>
            <input type="time" id="hora" name="hora" value="<?php echo $hora; ?>" required>



            <div class="wrap">
                <input type="submit" name="actualizar" value="Actualizar">
                </input>
            </div>
        </form>
    </div>





    <?php

    if (isset($_POST['actualizar'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'cinema');
        if (!$conexion) {
            echo "Error en conexion";
        }


        $id_cine = $id;
        $titulo = $_POST['titulo'];
        $director = $_POST['director'];
        $genero = $_POST['genero'];
        $clasificacion = $_POST['clasificacion'];
        $protagonista1 = $_POST['protagonista1'];
        $protagonista2 = $_POST['protagonista2'];
        $protagonista3 = $_POST['protagonista3'];
        $hora = $_POST['hora'];

        $query1 = "UPDATE pelicula SET titulo = '$titulo', director = '$director', genero = '$genero', 
                    clasificacion = '$clasificacion' WHERE id = '$id_pelicula'";
        $resultado1 = mysqli_query($conexion, $query1);

        if ($resultado1) {

            $query2 = "UPDATE proyectar SET hora = '$hora' WHERE id_cine = '$id_cine' AND id_pelicula = '$id_pelicula'";
            $resultado2 = mysqli_query($conexion, $query2);

            if ($resultado2) {

                $query3 = "UPDATE protagonista SET nombre = '$protagonista1' , nombre2 = '$protagonista2',
                        nombre3 = '$protagonista3' WHERE id = '$id_protagonista'";
                $resultado3 = mysqli_query($conexion, $query3);

                if ($resultado3) {
                    echo "Datos actualizados";
                    header("Location: http://localhost:8000/cine_admin.php", true, 301);
                    exit();
                } else {
                    echo "Error";
                }
            }
        }





        mysqli_close($conexion);
    }

    ?>



</body>

</html>