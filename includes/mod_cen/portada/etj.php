<script type="text/javascript" src="includes/mod_cen/documentos/panelportada.js"></script>
<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
    let tipoR = '<?php echo $_SESSION['tipo'];?>'
</script>
<style type="text/css">

.btn-default {
		color: #333;
		background-color: #E9ECEC;
		border-color: #ccc;
}
</style>
<script>
  $( function() {

		 $( "#accordion1,#accordion2,#accordion3,#accordion4,#accordion5,#accordion6,#accordion7" ).accordion({
			 active: false,
			 collapsible: true
     });

		 $( "#tabs" ).tabs({
       collapsible: true
     });

  } );

  </script>
<script type="text/javascript" src="includes/mod_cen/portada/js/etjInforme.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.date.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/legacy.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>

<?php
require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");
require_once("includes/mod_cen/clases/leido.php");




//create object referenteId and filter of status active
$referenteId=$_SESSION['referenteId'];

$referente= new Referente($referenteId);
$ett1 = $referente->Cargo("Activo");
$ett2 = $referente->Cargo("Activo");
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
<div class="" id="padreIr">
</div>

<div class="row hidden-xs  wow zoomIn">
	<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=escuelas&id=18" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda.png"><h3 align="center">Búsqueda escuelas</h3></a>
	</div>

	<!-- <div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=user&id=3" style="text-decoration:none">
		<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/escuela (4).png"><h3 align="center">Mis escuelas</h3></a>
	</div>

	<div class="col-lg-2 col-md-4 col-sm-4">
		<a href="index.php?mod=slat&men=user&id=2" style="text-decoration:none"><img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/equipo (3).png"><h3 align="center">Mis ETT</h3></a>
	</div>

<div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=user&id=4" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/seo (2).png"><h3 align="center">Mis RTI</h3></a>
</div> -->

<!-- <div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=doc&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/busqueda (4).png"><h3 align="center">Documentación</h3></a>
</div> -->

<!-- <div class="col-lg-2 col-md-4 col-sm-4"><a href="index.php?mod=slat&men=videoTutorial&id=1" style="text-decoration:none">
	<img class="img-responsive"src="includes/mod_cen/portada/imgPortadas/laptop.png"><h3 align="center">Video Tutoriales DBMS</h3></a>
</div> -->

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
<?php

		if(mysqli_num_rows($resultado_ett_acargo)>0){

				echo "<div id='tabs'>";
				 echo "<ul>";

							while ($fila=mysqli_fetch_object($ett1))
							{
								$informe_ett= new informe(null,null,$fila->referenteId);

								$informesNoLeidos = $informe_ett->summary('noLeido',null,null,null,null,'2018',null,$fila->referenteId,null,$_SESSION['referenteId']);
								$totalNoLeidos= mysqli_num_rows($informesNoLeidos);
								$buscar   = ' ';
								$pos = strpos($fila->apellido, $buscar);

								if ($pos===false) {
									echo "<li><a  href='#tabs-".$fila->referenteId."'>".strtoupper($fila->apellido)." <span id='badge-".ltrim($fila->referenteId,'0')."' class='badge'>".$totalNoLeidos."</span></a></li>";
								}else{
									echo "<li><a  href='#tabs-".$fila->referenteId."'>".substr(strtoupper($fila->apellido),0,strpos($fila->apellido,' '))."  <span id='badge-".ltrim($fila->referenteId,'0')."' class='badge'>".$totalNoLeidos."</span></a></li>";	# code...
								}

							}

				  echo '</ul>';
					$contador=0;
					/**
					 * Creado de tabs por ett, con contenido de sus informes, datos de contacto y calendario de visitas.
					 */
					while ($fila=mysqli_fetch_object($ett2))
					{
						$informe_ett= new informe(null,null,$fila->referenteId);
						$informesNoLeidos = $informe_ett->summary('noLeido',null,null,null,null,'2018',null,$fila->referenteId,null,$_SESSION['referenteId']);
						echo "<div id='tabs-$fila->referenteId'>";
						$leido = new Leido(null,null,$_SESSION['referenteId']);
						$buscar_alta =$informe_ett->summary('año',null,null,null,null,'2018','Alta',$fila->referenteId);
						$totalAlta = mysqli_num_rows($buscar_alta);
						$buscar_media =$informe_ett->summary('año',null,null,null,null,'2018','Media',$fila->referenteId);
						$totalMedia = mysqli_num_rows($buscar_media);
						$buscar_normal = $informe_ett->summary('año',null,null,null,null,'2018','Normal',$fila->referenteId);
						$totalNormal = mysqli_num_rows($buscar_normal);
						$actual = $informe_ett->summary('año',null,null,null,null,'2018',null,$fila->referenteId);
						$cantidadActual=mysqli_num_rows($actual);
						$cantidadNoLeidos=mysqli_num_rows($informesNoLeidos);

						echo "<p>".strtoupper($fila->apellido).", ".strtoupper($fila->nombre)."</p>";
						//echo "<p class='alert alert-success'>Total Informes - $cantidadActual</p>";
						$contador++;
						echo "<div id='accordion$contador'>";
            echo '<h3>Informes No Leidos <span id="badgeNoLeidos-'.ltrim($fila->referenteId,'0').'" class="badge">'.$cantidadNoLeidos.'</span></h3>';
            //<h3>Informes No Leidos <span id='badgeNoLeidos-".$fila->referenteId."' class="badge"> <?php echo $cantidadNoLeidos;</span></h3>

						?>
							<div>
								<?php
								while ($row = mysqli_fetch_object($informesNoLeidos))
								{
									switch ($row->prioridad) {
										case 'Normal':
											$class="alert alert-success";
											break;
										case 'Media':
											$class="alert alert-info";
											break;
										case 'Alta':
											$class="alert alert-warning";
											break;
										default:
											# code...
											break;
									}
									echo "<p id='informeId".$row->informeId."' class='".$class."'>Id:$row->informeId Asunto: <b>$row->titulo</b><br>
												Fecha:".$row->fechaVisita."</p>";
								}
								 ?>

							</div>
							<h3>Informes prioridad Alta <span class="badge"> <?php echo $totalAlta;?></span></h3>

						  <div>

								<?php
								while ($row = mysqli_fetch_object($buscar_alta)) {
									echo "<p id='inforalta".$row->informeId."' class='alert alert-warning'>$row->informeId---$row->titulo</p>";

								}
								?>
						  </div>
							<h3>Informes prioridad Media <span class="badge"> <?php echo $totalMedia;?></span></h3>
						  <div>
							<?php
								while ($row = mysqli_fetch_object($buscar_media)) {
										echo "<p id='informedi".$row->informeId."' class='alert alert-info'>$row->informeId---$row->titulo></p>";
								}
							?>
						 </div>
							<h3>Informes prioridad Normal <span class="badge"> <?php echo $totalNormal;?></span></h3>
						  <div>
								<?php
	 							 while ($row = mysqli_fetch_object($buscar_normal)) {
	 									 echo "<p id='infornorm".$row->informeId."' class='alert alert-success'>$row->informeId---$row->titulo></p>";
	 							 }
	 						 ?>
						  </div>
							<h3>Calendario de Visitas realizadas</h3>
						  <div>
	 							<p>Normal</p>
						  </div>
						</div>


						<?php


					  echo "</div>";
					}
				  echo "</div>";



				}
?>

<!--
<div class="alert alert-info" role="alert">
	<h4> <span class="badge">1 </span>&nbsp;<a href="index.php?mod=slat&men=referentes&id=10">Atención!! Nuevo -> Buscador de RTI, por nombre, apellido, etc.</a>  </h4>
</div>
-->




<br><br><br>
<?php
	echo '<div class="row">';
	?>
	<!-- <div class="col-md-12 hidden-xs">
			<p class="alert alert-success">Presentación Proyecto trabajo 2018</p>
			<iframe allowFullScreen frameborder="0" height="564" mozallowfullscreen src="https://player.vimeo.com/video/258948009" webkitAllowFullScreen width="640"></iframe>
			 <p><a href="https://vimeo.com/user72995653">Mensaje para el equipo</a></p>
		</div>
		<div class="col-md-12 visible-xs">
		 <p class="alert alert-success">Presentación Proyecto trabajo 2018</p>
		 <iframe allowFullScreen frameborder="0" height="240" mozallowfullscreen src="https://player.vimeo.com/video/258948009" webkitAllowFullScreen width="320"></iframe>
			<p><a href="https://vimeo.com/user72995653">Mensaje para el equipo</a></p>
	</div> -->

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
