<!DOCTYPE html>
<html>


<head>
    <title>Crear pelicula</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <h3>Ingresa tu informacion</h3>
        <form action="" method="post">
            <label for="titulo">
                Titulo:
            </label>
            <input type="text" id="titulo" name="titulo" placeholder="Ingresa el titulo de la pelicula" required>

            <label for="director">
                Director:
            </label>
            <input type="text" id="director" name="director" placeholder="Ingresa la director de la pelicula" required>

            <div class="custom-select">
                <select name="genero" required>
                    <option selected disabled>Selecciona el genero</option>
                    <option value="1">Dibujos</option>
                    <option value="2">Comedia</option>
                    <option value="3">Drama</option>
                </select>
            </div>

            <div class="custom-select">
                <select name="clasificacion" required>
                    <option selected disabled>Selecciona la clasificacion</option>
                    <option value="1">T. menores</option>
                    <option value="2">No rec. menores 13 años</option>
                </select>
            </div>

            <label for="protagonista1">
                Protagonista:
            </label>
            <input type="text" id="protagonista1" name="protagonista1" placeholder="Ingresa el primer protagosnista" required>

            <label for="protagonista2">
                Protagonista:
            </label>
            <input type="text" id="protagonista2" name="protagonista2" placeholder="Ingresa  el segundo protagosnista">

            <label for="protagonista3">
                Protagonista:
            </label>
            <input type="text" id="protagonista3" name="protagonista3" placeholder="Ingresa  el tercer protagosnista">

            <label for="hora">
                Hora:
            </label>
            <input type="time" id="hora" name="hora" required>



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

        $result = array();
        $result['datos'] = array();
        $query = "SHOW TABLE STATUS LIKE 'protagonista';";
        $response = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($response);

        $id_next_prota = $row[10];

        $query = "SHOW TABLE STATUS LIKE 'pelicula';";
        $response = mysqli_query($conexion, $query);
        $row = mysqli_fetch_array($response);

        $id_next_peli = $row[10];

        $id_cine = $_GET['id'];
        $titulo = $_POST['titulo'];
        $director = $_POST['director'];
        $genero = $_POST['genero'];
        $clasificacion = $_POST['clasificacion'];
        $protagonista1 = $_POST['protagonista1'];
        $protagonista2 = $_POST['protagonista2'];
        $protagonista3 = $_POST['protagonista3'];
        $hora = $_POST['hora'];


        $query1 = "INSERT INTO proyectar(`id_cine`, `id_pelicula`, `hora`) 
VALUES ('$id_cine','$id_next_peli','$hora')";
        $resultado1 = mysqli_query($conexion, $query1);

        if ($resultado1) {

            $query2 = "INSERT INTO `pelicula`(`id`, `titulo`, `director`, `clasificacion`, `protagonista`, `genero`) 
                VALUES ('$id_next_peli','$titulo','$director','$clasificacion','$id_next_prota','$genero')";
            $resultado2 = mysqli_query($conexion, $query2);

            if ($resultado2) {
                $query3 = "INSERT INTO `protagonista`(`id`, `nombre`, `nombre2`, `nombre3`) 
                    VALUES ('$id_next_prota','$protagonista1','$protagonista2','$protagonista3')";
                $resultado3 = mysqli_query($conexion, $query3);

                mysqli_close($conexion);


                if ($resultado3) {
                    echo "Datos ingresados";
                    header("Location: http://localhost:8000/cine_admin.php", true, 301);
                    exit();
                } else {
                    echo "Error";
                }
            }
        }
    }

    ?>



</body>

</html>