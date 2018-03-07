<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script>
<script type="text/javascript" src="includes/mod_cen/portada/botonLeido.js"></script>

<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");
require_once("includes/mod_cen/clases/leido.php");

// create object informe and search of last 20 informe
//$informes= new informe();

//$b_informe = $informes->buscar(20);

////////////////////////////////////////////////

// create object mis_informes and filter of my report, last 10
$mis_informes= new informe(null,null,$_SESSION["referenteId"]);

$b_mis_informe = $mis_informes->buscar(10);

echo '<div class="container">';


?>


<div class="row hidden-xs">
	<div class="col-lg-3 col-md-3 col-sm-3"><a href="index.php?mod=slat&men=escuelas&id=1" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-3"><a href="" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/escuela (4).png"><h3 align="center">Mis escuelas</h3></a>
	</div>
	<!--<div class="col-lg-3 col-md-6 col-sm-6">
		<a href="index.php?mod=slat&men=user&id=2"><img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/equipo (3).png"><h4 align="center">Mis ETT</h4></a>
	</div>-->


<div class="col-lg-3 col-md-3 col-sm-3"><a href="index.php?mod=slat&men=doc&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda (4).png"><h3 align="center">Documentación</h3></a>
</div>

<div class="col-lg-3 col-md-3 col-sm-3"><a href="index.php?mod=slat&men=videoTutorial&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/laptop.png"><h3 align="center">Video Tutoriales DBMS</h3></a>
</div>

</div>


<div class="row visible-xs">
	<div class="col-xs-6"><a href="index.php?mod=slat&men=escuelas&id=1" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

	<div class="col-xs-6"><a href="" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/escuela (4).png"><h3 align="center">Mis escuelas</h3></a>
	</div>
</div>



<div class="row visible-xs">

<div class="col-xs-6"><a href="index.php?mod=slat&men=doc&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda (4).png"><h3 align="center">Documentación</h3></a>
</div>

<div class="col-xs-6"><a href="index.php?mod=slat&men=videoTutorial&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/laptop.png"><h3 align="center">Video Tutoriales DBMS</h3></a>
</div>

</div>


<br><br><br>

<?php
	echo '<div class="row">';

		echo '<div class="col-md-6">';



if(mysqli_num_rows($b_mis_informe)>0){
	?>

	<div class="panel panel-primary">
		<div class="panel-heading" id="panel1">
          <span class="panel-title clickable">
			<h4>Mis Informes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <a href="index.php?mod=slat&men=informe&id=6&referenteId=<?php echo $_SESSION["referenteId"] ?>" class="pull-center"><font color="SkyBlue">Ver Todos</font></a><span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php


	echo "<table id='tablaPrincipal' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>Nº</th>";
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





echo "<tr id= 'encabezado.$fila->informeId'>";



		?>


		<td> <?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->informeId.'</a>';?></td>
		<td><?php echo '<a href="index.php?mod=slat&men=informe&id=3&escuelaId='.$fila->escuelaId.'&informeId='.$fila->informeId.'">'.$fila->titulo.'</a>';?></td>
		<?php

		echo "<td>".$dato_escuela->numero."</td>";
		echo "<td>".$fila->prioridad."</td>";



	echo "</tr>";
  echo "<tr></tr>";
	echo "<tr id= 'fila$fila->informeId' >";
	echo '<td colspan=5>';
	echo "<table>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Usuario</th>";
	echo "</tr>";
	echo "</thead>";
  echo "<tbody>";
	$leido= new Leido(null,$fila->informeId);
	$todosLosLeidos=$leido->buscar(null,'distinto');
	while ($dato = mysqli_fetch_object($todosLosLeidos)) {
		# code...
		echo '<tr>';
		echo '<td>'.$dato->nombre.' '.$dato->apellido.'</td>';
		echo '</tr>';
	}

  echo "</tbody>";
	echo "</table>";
	echo '</td>';
	echo "</tr>";


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


echo "</div>";
echo "</div>"; // cierra el row n° 1

?>



<div class='col-md-12'>
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
	<div class="panel-heading" id="panel5"><span class="panel-title clickable">
		<h4>Documentación<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4>
	</span>
	</div>
	<div class="panel-body">

				<?php
require_once("includes/mod_cen/documentos/documentoPortadas.php")
?>
</div>
</div>
</div>
