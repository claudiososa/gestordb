<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/director.php");


$referenteId=$_GET['referenteId'];
$referente= new Referente($referenteId);
$consulta= $referente->DatoPersona();
$datoref=mysqli_fetch_object($consulta);


if($_SESSION['tipo']=='ETJ' || $_SESSION['tipo']=='Coordinador' ){
	$escuela= new Escuela(null,$referenteId);
	$resultado = $escuela->Cargo();
}elseif($_SESSION['tipo']=='CoordinadorPmi'){
	$escuela= new Escuela(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$referenteId);
	$resultado = $escuela->Cargo('ATT');
}elseif($_SESSION['tipo']=='DirectorNivelSecundario'){
	$escuela= new Escuela(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,$referenteId);
  //$escuela= new Escuela();
  //$escuela->referenteIdSuperSec=$referenteId;
	$resultado = $escuela->Cargo('Supervisor-Secundaria');
}



	echo '<div class="table-responsive">';
	echo '<div class="container">';

	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<?php echo "<h4>DIRECTIVOS  Agrupamiento : ".$datoref->nombre.", ".$datoref->apellido."</h4>" ?>
		</div>
		<div class="panel-body">
			<?php

	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Accion</th>";
	echo "<th> Escuela  N°  </th>";
	echo "<th>Cargo</th>";
	echo "<th>Apellido y Nombre</th>";
	echo "<th>Dni</th>";
	echo "<th>Cuil</th>";
	echo "<th>Telefono</th>";
	echo "<th>e-mail</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
while ($fila = mysqli_fetch_object($resultado))
{

	// busca director

    $director= director::existeAutoridad($fila->escuelaId);
	$director2 = mysqli_fetch_object($director);


	echo "<tr>";


	if(isset($director2->directorId)>0)//Si existe director
	{
		$dire=new Persona($director2->personaId);
		$buscarDire=$dire->buscar();
		$resultadoDire=mysqli_fetch_object($buscarDire);

		// en el siguiente boton enviamos la variable  "dirUpdate" el proposito es indicar que los cambios se estan realizando desde el menu de un etj o coordinador y que cuando el script termine liste nuevamente el menu de mis ett y no mis escuelas

		echo "<td><a class='btn btn-primary' role='button' href='index.php?mod=slat&men=escuelas&id=13&personaId=".$director2->personaId."&directorId=".$director2->directorId."&escuelaId=".$fila->escuelaId."&dirUpdate=1'>"."Editar"."</a></td>";
		echo "<td>".$fila->numero."</td>";
		echo "<td>".$director2->tipoautoridad."</td>";
		echo "<td>".$resultadoDire->apellido.", ".$resultadoDire->nombre."</td>";
		echo "<td>".$resultadoDire->dni."</td>";
		echo "<td>".$resultadoDire->cuil."</td>";
		echo "<td>".$resultadoDire->telefonoC." ".$resultadoDire->telefonoM."</td>";
		echo "<td>".$resultadoDire->email." ".$resultadoDire->email2."</td>";


		}
	else
	{
		// en el siguiente boton enviamos la variable  "dirUpdate" el proposito es indicar que los cambios se estan realizando desde el menu de un etj o coordinador y que cuando el script termine liste nuevamente el menu de mis ett y no mis escuelas
		echo "<td><a class='btn btn-danger' role='button' href='index.php?mod=slat&men=escuelas&id=13&escuelaId=".$fila->escuelaId."&dirUpdate=1' font-weight:bold' >Cargar</a></td>";
		echo "<td>".$fila->numero."</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";
		echo "<td>N/A</td>";


	}

	echo "</tr>";
	echo "\n";
}
echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
?>
<script type="text/javascript">
$(document).ready(function()
		{
				//$("#myTable").tablesorter();
				$("#myTable").tablesorter( {sortList: [[0,1]]} );
				//$("#myTable1").tablesorter();
				$("#myTable1").tablesorter( {sortList: [[0,1]]} );
		}
);
</script>
<script type="text/javascript">
$("table").tableExport( {

    formats: ['xlsx'],

	});





</script>
