<!DOCTYPE html>
<html>


<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <h3>Ingresa tu informacion</h3>
        <form action="" method="post">
            <label for="nombre">
                Nombre:
            </label>
            <input type="text" id="nombre" name="nombre" placeholder="Ingresa el nombre del cinema" required>

            <label for="calle">
                Calle:
            </label>
            <input type="text" id="calle" name="calle" placeholder="Ingresa la calle del cinema" required>

            <label for="telefono">
                Telefono:
            </label>
            <input type="number" id="telefono" name="telefono" placeholder="Ingresa el telefono del cinema" required>

            <div class="custom-select">
                <select name="dia" required>
                    <option selected disabled>Selecciona la tarifa</option>
                    <option value="1">Dia del espectador</option>
                    <option value="2">Dia del jubilado</option>
                    <option value="3">Festividades y visperas</option>
                    <option value="4">Carnet de estudiante</option>
                </select>

            </div>
            <div class="wrap">
                <input type="submit" name="crear" value="crear">
                </input>
            </div>
        </form>
    </div>





    <?php

    if (isset($_POST['crear'])) {
        $conexion = mysqli_connect('localhost', 'root', '', 'cinema');
        if (!$conexion) {
            echo "Error en conexion";
        }

        $nombre = $_POST['nombre'];
        $calle = $_POST['calle'];
        $telefono = $_POST['telefono'];
        $dia = $_POST['dia'];


        $query = "INSERT INTO cine(nombre,calle,telefono,tarifa) VALUES ('$nombre','$calle','$telefono','$dia')";
        $resultado = mysqli_query($conexion, $query);

        mysqli_close($conexion);

        if ($resultado) {
            echo "Datos ingresados";
            header("Location: http://localhost:8000/cine_admin.php", true, 301);
            exit();
        }
    }

    ?>



</body>

</html>