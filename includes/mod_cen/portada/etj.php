<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script>

<style type="text/css">

.btn-default {
		color: #333;
		background-color: #E9ECEC;
		border-color: #ccc;
}
</style>

<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");


//create object referenteId and filter of status active
$referenteId=$_SESSION['referenteId'];

$referente= new Referente($referenteId);
$resultado_ett_acargo = $referente->Cargo("Activo");
$informes= new informe();
////////////////////////////////////////////////
// todos los informes creados por referente Conectar Igualdad
$arrayReferenteConectar = array ('ETT','ETJ','Coordinador');
$informeEquipoConectar = $informes->buscar(20,null,$arrayReferenteConectar);

//busqueda de informes de proiridad alta
$informe_alta= new Informe(null,null,null,"Alta");
$buscar_alta =$informe_alta->buscar(20,null,$arrayReferenteConectar);
$total = mysqli_num_rows($buscar_alta);

// creación y busqueda de todos los informes


$b_informe = $informes->buscar(20);

////////////////////////////////////////////////


$mis_informes= new informe(null,null,$_SESSION["referenteId"]);

$b_mis_informe = $mis_informes->buscar(10);

echo '<div class="container">';
?>
<!--
<div class="alert alert-info" role="alert">
	<h4> <span class="badge">1 </span>&nbsp;<a href="index.php?mod=slat&men=referentes&id=10">Atención!! Nuevo -> Buscador de RTI, por nombre, apellido, etc.</a>  </h4>
</div>
-->



<div class="row hidden-xs  wow zoomIn">
	<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=escuelas&id=18" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

	<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=user&id=3" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/escuela (4).png"><h3 align="center">Mis escuelas</h3></a>
	</div>

	<div class="col-lg-2 col-md-4 col-sm-4">
		<a href="index.php?mod=slat&men=user&id=2" style="text-decoration:none"><img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/equipo (3).png"><h3 align="center">Mis ETT</h3></a>
	</div>

<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=user&id=4" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/seo (2).png"><h3 align="center">Mis RTI</h3></a>
</div>

<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=doc&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda (4).png"><h3 align="center">Documentación</h3></a>
</div>

<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=videoTutorial&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/laptop.png"><h3 align="center">Video Tutoriales DBMS</h3></a>
</div>

</div>
<!--vista mobile-->

<div class="row visible-xs wow zoomIn">
	<div class="col-xs-6"><a href="index.php?mod=slat&men=escuelas&id=18" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

	<div class="col-xs-6"><a href="index.php?mod=slat&men=user&id=3" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/escuela (4).png"><h3 align="center">Mis escuelas</h3></a>
	</div>
</div>



<div class="row visible-xs wow zoomIn">
	<div class="col-xs-6">
		<a href="index.php?mod=slat&men=user&id=2" style="text-decoration:none"><img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/equipo (3).png"><h3 align="center">Mis ETT</h3></a>
	</div>
<div class="col-xs-6"><a href="index.php?mod=slat&men=user&id=4" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/seo (2).png"><h3 align="center">Mis RTI</h3></a>
</div>

</div>


<div class="row visible-xs wow zoomIn">

	<div class="col-xs-6"><a href="index.php?mod=slat&men=doc&id=1" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda (4).png"><h3 align="center">Documentación</h3></a>
	</div>

	<div class="col-xs-6"><a href="index.php?mod=slat&men=escuelas&id=18" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/laptop.png"><h3 align="center">Video Tutoriales DBMS</h3></a>
	</div>

</div>


<br><br><br>
<?php
	echo '<div class="row">';
	?>
	<!--
	<div class="col-md-12 hidden-xs">
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
		//informes de prioridad alta ///
	  if(mysqli_num_rows($buscar_alta)>0){
	 	?>


	 	<div class="panel panel-primary">
			<div class="panel-heading" id="panel1"><span class="panel-title clickable">
				<h4>Informes Prioridad Alta<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
			</div>
	 		<div class="panel-body">
	 			<?php

	 	echo "<table id='myTableAlta' class='table table-hover table-striped table-condensed tablesorter'>";
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
	 	while ($fila=mysqli_fetch_object($buscar_alta)){

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

	  ///////////////////////////////


		if(mysqli_num_rows($resultado_ett_acargo)>0){
			?>
			<div class="panel panel-primary">
				<div class="panel-heading" id="panel2"><span class="panel-title clickable">
					<h4>Informes de ETT a cargo<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
				</div>
				<div class="panel-body">
					<?php

					echo "<table id='informe_ett' class='table table-hover table-striped table-condensed tablesorter'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>Apellido y Nombre</th>";

					echo "<th>Normal</th>";
					echo "<th>Media</th>";
					echo "<th>Alta</th>";
					echo "<th>Total</th>";
					echo "</tr>";
					echo "</thead>";

					echo "<tbody>";

					while ($fila=mysqli_fetch_object($resultado_ett_acargo)){
				 		echo "<tr>";
					 	echo "<td><a href='index.php?mod=slat&men=referentes&id=2&personaId=".$fila->personaId."&referenteId=".$fila->referenteId."'>".$fila->apellido.", ".$fila->nombre."</a></td>";

						$informe_ett= new informe(null,null,$fila->referenteId);
						$buscar_informe=$informe_ett->buscar();
						$cantidad=mysqli_num_rows($buscar_informe);

						//busqueda de informes de proiridad alta
						$informe_alta= new Informe(null,null,$fila->referenteId,"Alta");
						$buscar_alta =$informe_alta->buscar();
						$totalAlta = mysqli_num_rows($buscar_alta);

						//busqueda de informes de proiridad media
						$informe_media= new Informe(null,null,$fila->referenteId,"Media");
						$buscar_media =$informe_media->buscar();
						$totalMedia = mysqli_num_rows($buscar_media);

						//busqueda de informes de proiridad normal
						$informe_normal= new Informe(null,null,$fila->referenteId,"Normal");
						$buscar_normal =$informe_normal->buscar();
						$totalNormal = mysqli_num_rows($buscar_normal);

						//echo $cantidad;


						echo '<td><a href="?mod=slat&men=informe&id=6&referenteId='.$fila->referenteId.'&prioridad=Normal">'.$totalNormal.'</a></td>';
						echo '<td><a href="?mod=slat&men=informe&id=6&referenteId='.$fila->referenteId.'&prioridad=Media">'.$totalMedia.'</a></td>';
						echo '<td><a href="?mod=slat&men=informe&id=6&referenteId='.$fila->referenteId.'&prioridad=Alta">'.$totalAlta.'</a></td>';

  echo '<td><a href="?mod=slat&men=informe&id=6&referenteId='.$fila->referenteId.'">'.$cantidad.'</a></td>';

						echo "</tr>";
					}

					echo "</tbody>";
					echo "</table>";
				}

					 ?>
				</div>
			</div>
<?php


if(mysqli_num_rows($b_mis_informe)>0){
	?>



<?php
}
echo "</div>";
echo "<div class='col-md-6'>";


if(mysqli_num_rows($b_informe)>0){
	?>
	<div class="panel panel-primary">
		<div class="panel-heading" id="panel3"><span class="panel-title clickable">
			<h4>Ultimos informes creados<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
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
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	while ($fila=mysqli_fetch_object($informeEquipoConectar)){

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
		echo "</td>";
	}
	echo "</tbody>";
	echo "</table>";
	?>
</div>
</div>
<div class="panel panel-primary">
	<div class="panel-heading" id="panel4"><span class="panel-title clickable">
		<h4>Mis Informes (últimos 10)<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
	</div>
	<div class="panel-body">
		<?php

echo "<table id='myTable' class='table table-hover table-striped table-condensed tablesorter'>";
echo "<thead>";
echo "<tr>";
echo "<th>Id</th>";
echo "<th>Título</th>";
echo "<th>Número</th>";
echo "<th>Creado por...</th>";
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
	echo "<td>".$dato_escuela->numero."</td>";
	echo "<td>".$dato_persona->apellido."  ".$dato_persona->nombre."</td>";
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
			$("#informe_ett").tablesorter( {sortList: [[1,1]]} );
		}
);
</script>
<div class="row">

<div class="panel panel-primary">
	<div class="panel-heading" id="panel5"><span class="panel-title clickable">
		<h4>Documentación<span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span></h4></span>
	</div>
	<div class="panel-body">

<?php
require_once("includes/mod_cen/documentos/documentoPortadas.php");
?>
</div>
</div>
</div>
<script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script>
