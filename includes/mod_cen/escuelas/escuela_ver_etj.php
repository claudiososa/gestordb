<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="gmap/gmaps.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/rti.php");
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/director.php");

$c_referente= new Referente(null,null,null,null,null,null,null,'Activo');
$b_referente= $c_referente->buscar();

?>
<div class="container">
	<form class='form-horizontal' action='' method='POST'>
	<div class="form-group">
			<label class="control-label col-md-3 col-md-offset-2"><h3>Busqueda de Escuelas</h3></label>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Número</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <input class="form-control" size="30" type="text" name="numero" placeholder="sin puntos" autofocus>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">CUE</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <input size="30" class="form-control"  type="text" name="cue" placeholder="sin guiones" >
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Nombre</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <input size="30" class="form-control"  type="text" name="nombre">
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Departamento</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					<?php
				$departamento= new Departamentos();
				$total=$departamento->getTotal();
				echo "<select class='form-control' name='localidadId'>";
					echo	"<option value='0'>Todos</option>";
					echo	"<option value='1'>Sin registrar</option>";
				for($val=2;$val<=$total;$val++) {
					$departamento= new Departamentos($val);
					$dato=$departamento->getDepartamento();
					echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
					}
				echo "</select>";?>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Nivel</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
				 <select class="form-control" name="nivel">
		 					<option value="0" label="todos">Todos</option>
		 					<option value="Sin registrar" label="Sin registrar">Sin registrar</option>
								<option value="Primaria Común" label="Primaria Común">Primaria Común</option>
								<option value="Primaria Especial" label="Primaria Especial">Primaria Especial</option>
								<option value="Secundaria Común" label="Secundaria Común">Secundaria Común</option>
								<option value="Secundaria Técnica" label="Secundaria Técnica"  >Secundaria Técnica</option>
								<option value="Secundaria Rural" label="Secundaria Rural">Secundaria Rural</option>
								<option value="ISFD" label="ISFD">ISFD</option>
								<option value="IEM" label="IEM">IEM</option>
								<option value="Capacitación" label="Capacitación">Capacitación</option>

					</select>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Referente</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					<select class="form-control" name="referenteId" >
					echo	"<option value='0'>Todos</option>";
					<?php
					while($fila = mysqli_fetch_object($b_referente)) {
						$c_persona= new Persona($fila->personaId);
						$b_persona=$c_persona->buscar();
						$d_persona=mysqli_fetch_object($b_persona);
						if($fila->referenteId>1) {
							echo "<option value=".$fila->referenteId.">".$fila->tipo." -".$d_persona->apellido." ,".$d_persona->nombre."</option>";
						}
					}
					?>
					</select>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Recurso Tecnológico</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <select class="form-control" name="recursotec">
		 					<option value="0" label="todos">Todos</option>
		 					<option value="PISOTEC" label="PISOTEC">PISO TEC.</option>
							<option value="ADM" label="ADM">ADM</option>

					</select>
				 </div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-2 col-md-offset-2">
			<input class="btn btn-primary" type='submit' value='Buscar'>
		</div>
	</div>

	</form>
</div>

<?php

if(($_POST))
	{
				//var_dump($_POST);
				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				$localidadId=$_POST["localidadId"];
				$nivel=$_POST["nivel"];
				$recursotec=$_POST["recursotec"];

				$referenteId=$_POST["referenteId"];

				if($localidadId=="0"){
					$locadlidadId=NULL;
				}

				if($localidadId=="1"){
					$locadlidadId=1;
				}

				if($nivel=="0"){
				$nivel=NULL;
				}

				if($recursotec=="0"){
					$recursotec=NULL;
				}

				if($referenteId=="0"){
					$referenteId=NULL;
				}

				$escuela=new Escuela(NULL,$referenteId,$cue,$numero,$nombre,null,$nivel,$localidadId,null,null,null,null,null,null,null,null,$recursotec);



				$resultado = $escuela->buscar();
				$resultado2= $escuela->buscar();

				$cantidad=mysqli_num_rows($resultado);

				?>

				<script type="text/javascript">
				var map;
				$(document).ready(function(){
					map = new GMaps({

					<?php while ($fila = mysqli_fetch_object($resultado))
							{
							$cantidad++;
							if($fila->ubicacion<>""){
								if($primero==0){
									$lat= substr($fila->ubicacion,0,10);
									$lng= substr($fila->ubicacion,12,10);
										 ?>
									el: '#map',
									lat: <?php echo $lat;?>,
									lng:  <?php echo $lng;?>,
									zoomControl : true,
									zoomControlOpt: {
										style : 'SMALL',
										position: 'TOP_LEFT'
									},
									panControl : false,
									streetViewControl : false,
									mapTypeControl: true,
									overviewMapControl: false
									});

									map.drawOverlay({
									lat: <?php echo $lat;?>,
										lng:  <?php echo $lng;?>,
										content: '<div class="overlay"><?php echo $fila->numero;?></div>'
									});
									map.addMarker({
											lat: <?php echo $lat;?>,
											lng:  <?php echo $lng;?>,
											title: '<?php echo $fila->nombre."- Nº ".$fila->numero;?>',
											infoWindow: {
												content: '<p><?php echo "<b>Nº</b> ".$fila->numero;?></p>'
													}
										});
										<?php
								$primero++;
								}else{
											$lat= substr($fila->ubicacion,0,10);
											$lng= substr($fila->ubicacion,12,10);
									?>
											map.drawOverlay({
										lat: <?php echo $lat;?>,
											lng:  <?php echo $lng;?>,
													content: '<div class="overlay"><?php echo $fila->numero;?></div>'
										});
										map.addMarker({
													lat: <?php echo $lat;?>,
														lng:  <?php echo $lng;?>,
														title: '<?php echo $fila->nombre."- Nº ".$fila->numero;?>',
															infoWindow: {
															content: '<p><?php echo "<b>Nº</b> ".$fila->numero;?></p>'
																	}
									});

								 <?php }
							}
						}
								 ?>

						});

						</script>
				<?php
				echo '<div class="table-responsive">';
				echo "<div class='container'>";
				echo "Resultado Cantidad: <b>".$cantidad."</b>";
				echo "<table id='example' class='table table-hover table-striped table-condensed'>";

				//echo "<table class='table table-hover table-striped table-condensed '>";
				echo "<thead>";
				  echo "<tr>";
					echo "<th>Nº</th>";
			  	echo "<th>CUE</th>";
			  	echo "<th>Nombre de Escuela</th>";
			  	echo "<th>Localidad</th>";
			  	echo "<th>Referente a Cargo</th>";
			  	echo "<th>ETJ a Cargo</th>";
					echo "<th>Autoridad</th>";
			  	echo "<th>RTI</th>";
			  	echo "<th>Informes</th>";
					echo "</tr>";
				echo "</thead>";
				echo "<tfoot>";
				echo "<tr>";
					echo "<th>Nº</th>";
					echo "<th>CUE</th>";
					echo "<th>Nombre de Escuela</th>";
					echo "<th>Localidad</th>";
					echo "<th>Referente a Cargo</th>";
					echo "<th>ETJ a Cargo</th>";
					echo "<th>Autoridad</th>";
					echo "<th>RTI</th>";
					echo "<th>Informes</th>";
				echo "</tr>";
				echo "</tfoot>";
				$arreglo[]=array();
				$arreglo["0"]="0";
				$i=0;
				echo "<tbody>";

				while ($fila = mysqli_fetch_object($resultado2))
				{

					$dato_rti=Rti::existeRtixinstitucion($fila->escuelaId);
					$rti=mysqli_num_rows($dato_rti);
					$repite=0;
					$encontrado=0;
					if($i==0)
						$arreglo[$i]=$fila->referenteId;
					else
						foreach ($arreglo as $clave => $valor)
						{
							if($arreglo[$clave]==$fila->referenteId)
								$repite++;
						}
						if($repite>0)
							$encontrado=$repite;
							$arreglo[count($arreglo)]=$fila->referenteId;
					$i++;



					//referente a cargo
					  $crearreferente=new Referente($fila->referenteId);
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();
			  		$etjCargo=$traerreferente->getEtj();



						$referente_etj= new Referente($etjCargo);
						$buscar_etj = $referente_etj->buscar();
						$dato_etj=mysqli_fetch_object($buscar_etj);

						$crearPersona=new Persona($r_personaId);
						$traerPersona=$crearPersona->getContacto();
					//	var_dump($dato_etj);
					//	$nuevoETJ = new Persona($dato_etj->personaId);
					//$ETJ = $nuevoETJ->getContacto();


			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();

						$crearreferenteetj=new Referente($dato_etj->referenteId);
						$traerreferenteetj= $crearreferenteetj->getContacto();
						$r_personaIdetj=$traerreferenteetj->getPersonaId();

			  		$crearEtj= new Persona($r_personaIdetj);
			  		$traerEtj=$crearEtj->getContacto();
			  		$nombreEtj= $traerEtj->getNombre();
			  		$apellidoEtj= $traerEtj->getApellido();
			  		$idEtj=$traerEtj->getPersonaId();
echo "<tr>";
			  		echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
			  		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>".$fila->nombre."</a></td>";

			  		//echo "<td>".substr($fila->nombre,0, 40)."</td>";

			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1=mysqli_fetch_object($busca_loc);
			  		echo "<td>".$fila1->nombre."</td>";
			  		echo "<td>";

			  				if($encontrado==0){
			  					echo "<div class='divSimple' id='ref_".$fila->referenteId."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$apellidoPersona.", ".$nombrePersona.
					  			"</a></div>";
					  		}else{
					  			echo "<div class='divSimple' id='ref_".$fila->referenteId.$encontrado."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$apellidoPersona.", ".$nombrePersona.
					  			"</a></div>";
								}
					  		//echo "<div class='divSimple1'>&nbsp;&nbsp;&nbsp;";


					echo "</td>";
					echo "<td>";
					echo "<div class='divSimple' id='ref_".$fila->referenteId.$encontrado."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$etjCargo."&referenteId=".$idEtj."'>".$apellidoEtj.", ".$nombreEtj.
					"</a></div>";
					echo "</td>";

					//revisar escuela para buscar director.
					$director = new Director(null,$fila->escuelaId);
					$buscar_director= $director->buscar();
					$dato_director= mysqli_fetch_object($buscar_director);
					echo "<td>";
					if($dato_director<>NULL){
					?>
							<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal<?php echo $fila->escuelaId; ?>">
			  					Director
							</button>

							<div class="modal fade" id="myModal<?php echo $fila->escuelaId; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Autoridad</h4>
										<h4 class="modal-title" id="myModalLabel">Nombre <?php echo $fila->nombre?></h4>
										<h4 class="modal-title" id="myModalLabel">Nº <?php echo $fila->numero?></h4>
										<h4 class="modal-title" id="myModalLabel">Cue <?php echo $fila->cue?></h4>
						      </div>
						      <div class="modal-body">
										<?php
										$personaIdModal=$dato_director->personaId;
										$escuelaModal=$fila->escuelaId;
										include("includes/mod_cen/personas/persona_ver_director_modal.php");
										// echo "<a href='index.php?men=personas&id=2&personaId=$dato_director->personaId&escuelaId=$fila->escuelaId'>Director</a>";
										?>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

						      </div>
						    </div>
						  </div>
						</div>
					<?php


						//	echo $dato_director->personaId;
					}else{
						 echo "Sin Dato";
					}

						//var_dump($dato_director);
					echo "</td>";
					echo "<td>";
					if($rti>0)//Si existe rti para la escuela
					{
						echo "<a href='index.php?mod=slat&men=escuelas&id=17&escuelaId=".$fila->escuelaId."'>".$rti."</a>";
					}
					else
					{
						echo "0";
					}
					echo "</td>";

					$informe = new Informe(null,$fila->escuelaId);

					$buscar_informe = $informe->buscar();

					$cant = mysqli_num_rows($buscar_informe);


					/*if($_SESSION["tipo"]=="ETT"){
						while ($fila1 = mysqli_fetch_object($buscar_informe)){

							$referente= new Referente($fila1->referenteId);
							$buscar_referente = $referente->buscar();
							$dato_referente = mysqli_fetch_object($buscar_referente);

							if($dato_referente->tipo=="Supervisor"){
								$cant=$cant-1;
							}

						}

					}*/

					//echo $cant;
					//if($fila->referenteId==$_SESSION["referenteId"] || $_SESSION["tipo"]=="Supervisor" || $_SESSION["tipo"]=="ETJ" ){
					//	if($_SESSION["tipo"]=="ETT"){
								echo "<td><a href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
									 Crear</a>&nbsp&nbsp<a href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver&nbsp(".$cant.")</a></td>";
					//	}else{
							// echo "<td><a href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
								//	 Crear</a>&nbsp&nbsp<a href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver&nbsp(".$cant.")</a></td>";
					//**	}
					//}else{

					//	if($_SESSION["tipo"]=="ETT"){
					 	//	echo "<td><a href='index.php?mod=slat&men=informe&id=4&escuelaId=".$fila->escuelaId."'>Ver&nbsp(".$cant.")</a></td>";
					 //	}else{
					 //		echo "<td><a href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver&nbsp(".$cant.")</a></td>";
					 	//}
					//}

			  		/*echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>"."<img src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></td>";
			  		*			  		<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".
			  				"<img  src='img/iconos/modificar_p.png' alt='modificar' longdesc='Modificar Datos de Persona'></a></div></td>";
			  		**/
			  		//echo "<td>"."<a href='index.php?men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>Ver más</a>"."</td>";
			  		echo "</tr>";
		  	  		echo "\n";

	      	}
					echo "</tbody>";
	      	echo "</table>";
					echo "</div>";
					echo "</div>";
					echo "<div class='span11'>";
					echo "<div id='map'></div>";
					echo "</div>";

			//}
		}else{
			$escuela=new Escuela(NULL);
		}
		//var venta= "<?php echo $_GET['registro']  ";
?>



<script type="text/javascript">
$(document).ready(function() {
	$('#example').DataTable( {
         "language": {
             "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
         },
				"order": [[ 0, "asc" ]],
     } );
} );
</script>
