<!DOCTYPE html>
<?php

$error = false;



$conexion = mysqli_connect('localhost', 'root', '', 'cinema');
if (!$conexion) {
  $result["exito"] = "0";
} else {

  $result = array();
  $result['datos'] = array();
  $query = "SELECT cine.id as id, cine.nombre, cine.calle, cine.telefono, tarifa.dia, tarifa.precio
 FROM cine INNER JOIN tarifa ON cine.tarifa = tarifa.id";
  $response = mysqli_query($conexion, $query);

  while ($row = mysqli_fetch_array($response)) {
    $index['id'] = $row['0'];
    $index['nombre'] = $row['1'];
    $index['calle'] = $row['2'];
    $index['telefono'] = $row['3'];
    $index['dia'] = $row['4'];
    $index['tarifa'] = $row['5'];

    array_push($result['datos'], $index);
  }

  $result["exito"] = "1";

  mysqli_close($conexion);
}



$titulo = 'Lista de cinemas';
?>


<?php
if ($error) {
?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>


<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="sw/package/dist/sweetalert2.min.css">
</head>

<body>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="crear_cine.php" class="btn btn-primary mt-4">Crear cine</a>
      </div>
    </div>
  </div>



  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mt-3"><?= $titulo ?></h2>
        <table id="table_cines" class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Calle</th>
              <th>Telefono</th>
              <th>Tarifa</th>
              <th>Precio</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (count($result['datos']) > 0) {
              foreach ($result['datos'] as $fila) {
            ?>
                <tr>
                  <td><?php echo $fila["nombre"]; ?></td>
                  <td><?php echo $fila["calle"]; ?></td>
                  <td><?php echo $fila["telefono"]; ?></td>
                  <td><?php echo $fila["dia"]; ?></td>
                  <td><?php echo $fila["tarifa"]; ?></td>
                  <td>
                    <a href="<?= 'borrar_cine.php?id=' . $fila["id"] ?>">🗑️Borrar</a>
                    <a href="<?= 'editar_cine.php?id=' . $fila["id"] ?>">✏️Editar</a>
                  </td>
                </tr>
            <?php
              }
            }
            ?>
          <tbody>
        </table>
      </div>
    </div>
  </div>

  <hr />

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <label>Mostrar peliculas de cine:</label>
        <form method="POST" action="">
          <div class="custom-select">
            <select name="cine_dropdown" onchange="this.form.submit()">
              <option selected disabled>Selecciona cinema</option>
              <?php
              foreach ($result['datos'] as $fila) {
                echo '<option value="' . $fila['id'] . '"> ' . $fila['nombre'] . '</option>';
              }
              ?>
            </select>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST["cine_dropdown"])) {
    $id_cine = $_POST["cine_dropdown"];


    $conexion = mysqli_connect('localhost', 'root', '', 'cinema');

    $result = array();
    $result['datos'] = array();
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
       WHERE cine.id = '$id_cine'";



    $response = mysqli_query($conexion, $query);

    $titulo = "El cine no esta presentando peliculas";

    while ($row = mysqli_fetch_array($response)) {
      $index['id'] = $row['0'];
      $index['id_pelicula'] = $row['1'];
      $index['cine'] = $row['2'];
      $index['titulo'] = $row['3'];
      $index['director'] = $row['4'];
      $index['genero'] = $row['5'];
      $index['clasificacion'] = $row['6'];
      $index['id_protagonista'] = $row['7'];
      $index['protagonista1'] = $row['8'];
      if (empty($row['9'])) {
        $index['protagonista2'] = "-";
      } else {
        $index['protagonista2'] = $row['9'];
      }
      if (empty($row['10'])) {
        $index['protagonista3'] = "-";
      } else {
        $index['protagonista3'] = $row['10'];
      }
      $index['hora'] = $row['11'];

      array_push($result['datos'], $index);

      $titulo = 'Peliculas del cinema: ' . $index['cine'];
    }

    $result["exito"] = "1";
    mysqli_close($conexion);
  ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mt-3"><?= $titulo ?></h2>
          <a href="<?= 'crear_peli.php?id=' . $id_cine ?>" class="btn btn-primary mt-4">Crear pelicula</a>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a href="<?= 'generatePdf.php?id=' . $id_cine ?>" class="btn btn-primary mt-4">Generar PDF</a>
        </div>
      </div>
    </div>



  <?php
    if (count($result['datos']) > 0) {
      foreach ($result['datos'] as $fila) {
        echo "<div class='pelicula'>";
        echo  "<p><b>" . $fila["titulo"] . "</b></p>";
        echo  "<p><b>Director: </b>" . $fila["director"] . "</p>";
        echo  "<p><b>Genero: </b>" . $fila["genero"] . "</p>";
        echo  "<p><b>Clasificacion: </b>" . $fila["clasificacion"] . "</p>";
        echo  "<p><b>Protagonista(s): </b>" . $fila["protagonista1"];
        echo  ", " . $fila["protagonista2"];
        echo  ", " . $fila["protagonista3"] . "</p>";
        echo  "<p><b>Hora: </b>" . $fila["hora"] . "</p>";
        echo '<a href="editar_peli.php?id=' . $fila["id_pelicula"] . '" class="btn btn-warning">Editar pelicula</a>';
        echo '<a href="borrar_peli.php?id=' . $fila["id_pelicula"] . '" class="btn btn-info">Borrar pelicula</a>';
        echo "</div>";
      }
    }
  }
  ?>



</body>