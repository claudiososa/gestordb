<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/rtixescuela.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/rti.php");

$referenteId=$_SESSION['referenteId'];

//Crear objeto escuela y buscar las escuelas que tiene a cargo el Referente
$escuela= new Escuela(null,$referenteId);
$escuela_acargo=$escuela->buscar();



echo "<div class='container'>";
echo '<div class="panel panel-primary">';
echo '<div class="panel-heading"><h4>Mis RTI</h4></div>';
  echo '<div class="panel-body">';
echo "<div class='table-responsive'>";
echo "<table id='tableRTI' class='table table-hover table-striped table-condensed tablesorter'>";

echo "<thead>";
  echo "<tr>";
    echo "<th>CUE</th>";
    echo "<th>Nº</th>";
    echo "<th>Nombre Institución</th>";
    echo "<th>Apellido y Nombre</th>";
    echo "<th>DNI</th>";
    echo "<th>Correo Electrónico</th>";
    echo "<th>Teléfono 1</th>";
    echo "<th>Teléfono 2</th>";
    echo "<th>Turno</th>";
  echo "</tr>";
echo "</thead>";
echo "<tbody>";
//recorrido por las escuelas acargo del referente
while($fila=mysqli_fetch_object($escuela_acargo)){
  //echo $fila->escuelaId.$fila->nombre."<br><br>";
  //echo "_______________________<br>";
  $rtix= new rtixescuela($fila->escuelaId);

  $buscar_rti=$rtix->buscar();
  //var_dump($rtix);
  while($filarti=mysqli_fetch_object($buscar_rti)){


    $rti=new Rti($filarti->rtiId);
    $buscar_dato=$rti->buscar();


    while($filadato=mysqli_fetch_object($buscar_dato)){
      $persona= new Persona($filadato->personaId);
      $buscar_persona=$persona->buscar();
      $dato=mysqli_fetch_object($buscar_persona);

      echo "<tr>";
      echo "<td>".$fila->cue."</td>";
      echo "<td>".$fila->numero."</td>";
      echo "<td>".substr($fila->nombre,0,35)."</td>";
      echo "<td>".$dato->apellido.", ".$dato->nombre."</td>";
      echo "<td>".$dato->dni."</td>";
      echo "<td>".$dato->email."</td>";
      echo "<td>".$dato->telefonoM."</td>";
      echo "<td>".$dato->telefonoC."</td>";
      echo "<td>".$filarti->turno."</td>";



      //echo "<td>"."<a href='index.php?men=rtis&id=2&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Ver</a>"."</td>";
      //echo "<td>"."<a href='index.php?men=rtis&id=3&personaId=".$dato->personaId."&rtiId=".$dato->rtiId."'>Editar</a>"."</td>";
      echo "</tr>";
      echo "\n";



      //echo $filarti->escuelaId."-> ".$filarti->rtiId."<br>";
      //echo $dato->apellido."<br><br>";
    }

  }

}
echo "</tbody>";
echo "</table>";
echo '</div>';
echo '</div>';
echo "</div>";
echo "</div>";
?>

<script type="text/javascript">
$(document).ready(function()
		{
				//$("#myTable").tablesorter();
				$("#tableRTI").tablesorter( {sortList: [[1,0]]} );
				//$("#myTable1").tablesorter();
				//$("#myTable1").tablesorter( {sortList: [[0,1]]} );
		}
);
</script>
<script type="text/javascript">
  new TableExport(document.getElementsByTagName("table"), {
                               // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
    formats: ['xls'],             // (String[]), filetype(s) for the export, (default: ['xls', 'csv', 'txt'])

	});


</script>
