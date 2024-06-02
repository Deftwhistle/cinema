<!DOCTYPE html>
<html>


<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php



$conexion = mysqli_connect('localhost', 'root', '', 'cinema');
if (!$conexion) {
    $result["exito"] = "0";
} else {

    $result = array();
    $query = "SELECT cine.nombre, cine.calle, cine.telefono
 FROM cine where cine.id =" . $_GET["id"];
    $response = mysqli_query($conexion, $query);

    while ($row = mysqli_fetch_array($response)) {
        $nombre = $row['0'];
        $calle = $row['1'];
        $telefono = $row['2'];
    }

    mysqli_close($conexion);
}

?>








<body>
    <div class="main">
        <h3>Ingresa tu informacion</h3>
        <form action="" method="post">
            <label for="nombre">
                Nombre:
            </label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" placeholder="Ingresa el nombre del cinema" required>

            <label for="calle">
                Calle:
            </label>
            <input type="text" id="calle" name="calle" value="<?php echo $calle; ?>" placeholder="Ingresa la calle del cinema" required>

            <label for="telefono">
                Telefono:
            </label>
            <input type="number" id="telefono" name="telefono" value="<?php echo $telefono; ?>" placeholder="Ingresa el telefono del cinema" required>

            <div class="custom-select">
            <select name="dia" id="dia" required>
                <option selected disabled>Selecciona la tarifa</option>
                <option value="1">Dia del espectador</option>
                <option value="2">Dia del jubilado</option>
                <option value="3">Festividades y visperas</option>
                <option value="4">Carnet de estudiante</option>
            </select>
            </div>


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

        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $calle = $_POST['calle'];
        $telefono = $_POST['telefono'];
        $dia = $_POST['dia'];

        $query = "UPDATE cine SET nombre = '$nombre' , calle = '$calle' , telefono = '$telefono' , tarifa = '$dia' WHERE id = '$id'";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
    ?>
            <div class="notice">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                Cine actualizado exitosamente.
            </div>

    <?php

            header("Location: http://localhost:8000/cine_admin.php", true, 301);
            exit();
        } else {
            echo "Error";
        }

        mysqli_close($conexion);
    }

    ?>



</body>

</html>