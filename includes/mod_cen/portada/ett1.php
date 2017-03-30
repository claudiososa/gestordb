<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");
require_once("includes/mod_cen/clases/leido.php");

// create object informe and search of last 20 informe
$informes= new informe();

$b_informe = $informes->buscar(20);

////////////////////////////////////////////////

// create object mis_informes and filter of my report, last 10
$mis_informes= new informe(null,null,$_SESSION["referenteId"]);

$b_mis_informe = $mis_informes->buscar(10);

echo '<div class="container">';
	echo '<div class="row">';
		echo '<div class="col-md-6">';



if(mysqli_num_rows($b_mis_informe)>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Mis Informes (últimos 10) &nbsp;&nbsp;&nbsp;&nbsp;  <a href="index.php?mod=slat&men=informe&id=6&referenteId=<?php echo $_SESSION["referenteId"] ?>" class="btn btn-warning">Ver Todos mis informes</a></h4>
		</div>
		<div class="panel-body">
			<?php


	echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>ETJ</th>";
	echo "<th>Número</th>";
	echo "<th>Prioridad</th>";
	echo "</tr>";
	echo "</thead>";
  echo "<tbody>";
	while ($fila=mysqli_fetch_object($b_mis_informe)){

		$escuela= new Escuela($fila->escuelaId);
		$buscar_escuela= $escuela->buscar();
		$dato_escuela= mysqli_fetch_object($buscar_escuela);


		$referente = new Referente($_SESSION["referenteId"]);
		$b_referente = $referente->buscar();

		$dato_referente= mysqli_fetch_object($b_referente);

		$persona = new Persona($dato_referente->personaId);

		$b_persona = $persona->buscar();

		$dato_persona=mysqli_fetch_object($b_persona);



		echo "<tr>";
		?>

		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
		<?php
		$leyo=0;
		//$leido= new Leido(null,$fila->informeId,$dato_referente->etjcargo);
		//$dato_leido=$leido->buscar();
		//$leyo = mysqli_num_rows($result)
		//$leyo = mysqli_num_rows($dato_leido);
		//echo $leyo;
		if($leyo>0){
			echo "<td><a href='#' class='btn btn-success'>&nbsp;&nbsp;Leido&nbsp;&nbsp;&nbsp;</a></td>";
		}else {
			echo  "<td><a href='#' class='btn btn-danger'>No Leido</a></td>";
		}
		//echo "<td>vio</td>";
		echo "<td>".$dato_escuela->numero."</td>";
		echo "<td>".$fila->prioridad."</td>";
		echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>
<?php

}
echo "</div>";
echo "<div class='col-md-6'>";


if(mysqli_num_rows($b_informe)>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4>Ultimos informes creados</h4>
		</div>
		<div class="panel-body">
			<?php

	echo "<table id='myTable1' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>Número</th>";
	echo "<th>Creado por...</th>";
	echo "<th>Prioridad</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	while ($fila=mysqli_fetch_object($b_informe)){

		$escuela= new Escuela($fila->escuelaId);
		$buscar_escuela= $escuela->buscar();
		$dato_escuela= mysqli_fetch_object($buscar_escuela);

		$referente = new Referente($fila->referenteId);
		$b_referente = $referente->buscar();

		$dato_referente= mysqli_fetch_object($b_referente);

		$persona = new Persona($dato_referente->personaId);

		$b_persona = $persona->buscar();

		$dato_persona=mysqli_fetch_object($b_persona);
		echo "<tr>";
		?>
		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
		<?php
		echo "<td>".$dato_escuela->numero."</td>";
		echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
		echo "<td>".$fila->prioridad."</td>";
		echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>
<?php

}
echo "</div>";
echo "</div>";
echo "<div class='col-md-12'>";



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
<div class="row">

<div class="panel panel-primary">
	<div class="panel-heading">
		<h4>Tutoriales DBMS</h4>
	</div>
	<div class="panel-body">

				<div class="listap">
				<p><img alt="documentos" src="img/iconos/carpetap.png"> Documentos</p>

				<ul class="lista">
						<li>Datos Colegio 2015 > Formato: Microsoft Excel > <a href="descarga/documentos/DatoColegio2015.xlsx" target="_blank">Descargar</a></li>
				</ul>
				</div>
				<div class="listap">
				<p><img alt="tutoriales" src="img/iconos/videotutorialp.png"> Video Tutoriales</p>

				<ul class="lista">
						<li>Carga de Datos de Colegio (nombre,telefono, etc. > Formato: MP4 > <a href="descarga/videotutorial-dbms/dbm-dato-colegio.mp4" download="dbm-dato-colegio.mp4" target="_blank" >Descargar</a></li><br>
						<li>Carga de Datos de RTI  > Formato: MP4 > <a href="descarga/videotutorial-dbms/dbm-alta-rti.mp4" download="dbm-alta-rti.mp4" target="_blank" >Descargar</a></li><br>
						<li>Carga de Dato de Autoridad (director, vicedirector, etc). > Formato: MP4 > <a href="descarga/videotutorial-dbms/dbm-director-dbms.mp4" download="dbm-director-dbms.mp4" target="_blank">Descargar</a></li><br>
						<li>Asignación de Escuelas > Formato: MP4 > <a href="descarga/videotutorial-dbms/tutorial-asignar-escuelas.mp4" download="tutorial-asignar-escuelas.mp4" target="_blank">Descargar</a></li><br>
				</ul>
				</div>
				<?php
?>
</div>
</div>
</div>
