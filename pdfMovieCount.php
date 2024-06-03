<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;


$dompdf = new Dompdf;

$pdfContent = '<style>
table {
    font-size: 35px;
    text-align: center;
    border:2px solid #000;
}

td, th {
    font-size: 30px;
    text-align: center;
    border:2px solid #000;
}

</style>';

$conexion = mysqli_connect('localhost', 'root', '', 'cinema');

$result = array();
$result['datos'] = array();
$query = "SELECT cine.id, cine.nombre AS cine, pelicula.titulo, sum(pelicula.ticket) as tickets
    FROM cine
    INNER JOIN proyectar ON cine.id=proyectar.id_cine
    INNER JOIN pelicula ON proyectar.id_pelicula = pelicula.id
    INNER JOIN genero ON pelicula.genero = genero.id
    INNER JOIN clasificacion ON pelicula.clasificacion = clasificacion.id
    INNER JOIN protagonista ON pelicula.protagonista = protagonista.id
    GROUP BY pelicula.id
    ORDER BY tickets DESC";



$response = mysqli_query($conexion, $query);


while ($row = mysqli_fetch_array($response)) {
    $index['id'] = $row['0'];
    $index['nombre'] = $row['1'];
    $index['titulo'] = $row['2'];
    $index['ticket'] = $row['3'];

    array_push($result['datos'], $index);
}

$result["exito"] = "1";
mysqli_close($conexion);

$titulo = "Total de ticketes vendidos por cinema";
$pdfContent = $pdfContent .  "<h2>" . $titulo . "</h2>";
?>


  <?php
    if (count($result['datos']) > 0) {

        $pdfContent = $pdfContent . '<table id="table_cines" class="table table-striped table-sm">';
        $pdfContent = $pdfContent . '<thead>';
        $pdfContent = $pdfContent . '<tr>';
        $pdfContent = $pdfContent . '<th>Id</th>';
        $pdfContent = $pdfContent . '<th>Cinema</th>';
        $pdfContent = $pdfContent . '<th>Pelicula</th>';
        $pdfContent = $pdfContent . '<th>Ticketes vendidos</th>';
        $pdfContent = $pdfContent . '</tr>';
        $pdfContent = $pdfContent . '</thead>';
        $pdfContent = $pdfContent . '<tbody>';


        if (count($result['datos']) > 0) {
            foreach ($result['datos'] as $fila) {

                $pdfContent = $pdfContent . '<tr>';
                $pdfContent = $pdfContent . '<td>' . $fila["id"] . '</td>';
                $pdfContent = $pdfContent . '<td>' . $fila["nombre"] . '</td>';
                $pdfContent = $pdfContent . '<td>' . $fila["titulo"] . '</td>';
                $pdfContent = $pdfContent . '<td>' . $fila["ticket"] . '</td>';
                $pdfContent = $pdfContent . '</tr>';
            }


            $pdfContent = $pdfContent . '<tbody>';
            $pdfContent = $pdfContent . '</table>';
        }
    }

    $dompdf->loadHtml($pdfContent);

    $dompdf->setPaper('A4');

    $dompdf->render();

    $dompdf->stream('CinemaTicket.pdf', array('Attachment' => 0));

    ?>