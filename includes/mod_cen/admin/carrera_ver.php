<?php
include_once ('includes/mod_cen/clases/EscuelaCarrera.class.php' );

$carreras = new EscuelaCarrera();

$buscar_carreras = $carreras->buscarEscuelaCarrera();
echo "<table class='table'>";
while ($row = mysqli_fetch_object($buscar_carreras)) {
    echo "<tr>";
         echo "<td>$row->numero</td>";
         echo '<td>'.$row->nombre.'</td>';
         echo '<td>'.$row->nombreCarrera.'</td>';
         echo '<td>'.$row->fecha_inicio.'</td>';         
         echo "<td>$row->fecha_final</td>";
         echo "<td>$row->estado</td>";
         //var_dump($row);
    echo "</tr>";
}

echo '</table>';