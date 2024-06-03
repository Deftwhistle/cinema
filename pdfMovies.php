<?php

require __DIR__ . "/vendor/autoload.php";
use Dompdf\Dompdf;


    $dompdf = new Dompdf    ;

    $id_cine = $_GET['id'];
    $pdfContent = "";

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

    $pdfContent = $pdfContent .  "<h2>" . $titulo . "</h2>";
  ?>


  <?php
    if (count($result['datos']) > 0) {
      foreach ($result['datos'] as $fila) {
        $pdfContent = $pdfContent . "<hr class='solid'>";
        $pdfContent = $pdfContent . "<div class='col-md-3'>";
        $pdfContent = $pdfContent . "<div class='pelicula'>";
        $pdfContent = $pdfContent .  "<p><b>" . $fila["titulo"] . "</b></p>";
        $pdfContent = $pdfContent .  "<p><b>Director: </b>" . $fila["director"] . "</p>";
        $pdfContent = $pdfContent .  "<p><b>Genero: </b>" . $fila["genero"] . "</p>";
        $pdfContent = $pdfContent .  "<p><b>Clasificacion: </b>" . $fila["clasificacion"] . "</p>";
        $pdfContent = $pdfContent .  "<p><b>Protagonista(s): </b>" . $fila["protagonista1"];
        $pdfContent = $pdfContent .  ", " . $fila["protagonista2"];
        $pdfContent = $pdfContent .  ", " . $fila["protagonista3"] . "</p>";
        $pdfContent = $pdfContent .  "<p><b>Hora: </b>" . $fila["hora"] . "</p>";
        $pdfContent = $pdfContent . "</div>";
        $pdfContent = $pdfContent . "</div>";
      }
    }

    $dompdf->loadHtml($pdfContent);

    $dompdf->render();

    $dompdf->setPaper('A4');

    $dompdf->stream('peliculas.pdf',array('Attachment'=>0));

?>