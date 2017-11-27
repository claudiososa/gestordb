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
	<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=escuelas&id=1" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

	<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=user&id=3" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/escuela (4).png"><h3 align="center">Mis escuelas</h3></a>
	</div>
	<!--<div class="col-lg-3 col-md-6 col-sm-6">
		<a href="index.php?mod=slat&men=user&id=2"><img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/equipo (3).png"><h4 align="center">Mis ETT</h4></a>
	</div>-->
<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=user&id=4" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/seo (2).png"><h3 align="center">Mis RTI</h3></a>
</div>

<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=referentes&id=10" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/la-busqueda-de-empleo.png"><h3 align="center">Buscar RTI</h3></a>
</div>

<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=doc&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda (4).png"><h3 align="center">Documentación</h3></a>
</div>

<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=videoTutorial&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/laptop.png"><h3 align="center">Video Tutoriales DBMS</h3></a>
</div>

</div>


<div class="row visible-xs">
	<div class="col-xs-6"><a href="index.php?mod=slat&men=escuelas&id=1" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

	<div class="col-xs-6"><a href="index.php?mod=slat&men=user&id=3" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/escuela (4).png"><h3 align="center">Mis escuelas</h3></a>
	</div>
</div>

<div class="row visible-xs">

<div class="col-xs-6"><a href="index.php?mod=slat&men=user&id=4" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/seo (2).png"><h3 align="center">Mis RTI</h3></a>
</div>

<div class="col-xs-6"><a href="index.php?mod=slat&men=referentes&id=10" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/la-busqueda-de-empleo.png"><h3 align="center">Buscar RTI</h3></a>
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
<!-- <div class="alert alert-info" role="alert">
	<h4> <span class="badge">1 </span>&nbsp;<a href="index.php?mod=slat&men=referentes&id=10">Atención!! Nuevo -> Buscador de RTI, por nombre, apellido, etc.</a>  </h4>
</div>-->
<?php
	echo '<div class="row">';
	?>
<!--	<div class="col-md-12 hidden-xs">
		<p class="alert alert-success">Tutorial administración Horario Facilitadores</p>
		<iframe src="https://player.vimeo.com/video/239149998" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		 <p><a href="https://vimeo.com/user72995653">Tutoriales DBMS</a></p>
	</div>
	<div class="col-md-12 visible-xs">
	 <p class="alert alert-success">Tutorial administración Horario Facilitadores</p>
		<iframe src="https://player.vimeo.com/video/239149998" width="320" height="240" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		 <p><a href="https://vimeo.com/user72995653">Tutoriales DBMS</a></p>
	</div> -->
	<?php
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
	echo "<th>ETJ</th>";
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
		//$leyo=0;
		$leyo=false;
		//echo $fila->informeId."-- ".$dato_referente->etjcargo."<br>";
		$leido= new Leido(null,$fila->informeId,$dato_referente->etjcargo);
		$dato_leido=$leido->buscar();

		$leyo = mysqli_num_rows($dato_leido);
		//echo $leyo;
		if($leyo){
			echo "<td><button id= 'leido.$fila->informeId' class='btn btn-success'>L&nbsp;</button></td>";
		}else {
			echo  "<td><a href='#' class='btn btn-danger'>N L</a></td>";
		}
		//echo "<td>vio</td>";
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

$listadeReferentes= array("Coordinador","ETJ","ETT");

//$informes= new informe(NULL,NULL,'0075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
$informes= new informe();
$b_informe = $informes->buscar(20,"",$listadeReferentes);


if(mysqli_num_rows($b_informe)>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel2"><span class="panel-title clickable">
			<h4>Ultimos informes  Conectar Igualdad<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php

	echo "<table id='myTable1' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>Nº</th>";
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
echo "</div>"; // cierra el row n° 1

?>


<div class="row">
  <div class="col-md-6">

     <div class="panel panel-primary">
		<div class="panel-heading" id="panel3"><span class="panel-title clickable">
			<h4>Ultimos informes  Creados P.M.I.<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
	 <div class="panel-body">


			<?php

			$listadeReferentes= array("ATT","CoordinadorPmi");
			$informes= new informe();
			//$informes= new informe(NULL,NULL,'0075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);


            $b_informe = $informes->buscar( 20,"",$listadeReferentes,"exclusiva");



	echo "<table id='myTable1' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>Nº</th>";
	echo "<th>Creado por...</th>";
	echo "<th>Prioridad</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	while ($fila=mysqli_fetch_object($b_informe)) {

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
</div>

<div class='col-md-6'>

	<div class="panel panel-primary">

		<div class="panel-heading" id="panel4"><span class="panel-title clickable">
			<h4>Ultimos informes  Creados Supervisores<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
		</div>
		<div class="panel-body">
			<?php

			$listadeReferentes= array("DirectorNivelSecundario","Supervisor-General-Secundaria"," Supervisor-Secundaria","DirectorNivelSuperior","SupervisorGeneralSuperior","Supervisor-Nivel-Superior");
			$informes= new informe();
			//$informes= new informe(NULL,NULL,'0075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

            $b_informe = $informes->buscar(20,"",$listadeReferentes,"exclusiva");

	echo "<table id='myTable1' class='table table-hover table-striped table-condensed tablesorter'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Título</th>";
	echo "<th>Nº</th>";
	echo "<th>Creado por...</th>";
	echo "<th>Prioridad</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	while ($fila=mysqli_fetch_object($b_informe)) {

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


</div>
</div> <!-- cierra el row -->


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
require_once("includes/mod_cen/documentos/documento.php")
?>
</div>
</div>
</div>
