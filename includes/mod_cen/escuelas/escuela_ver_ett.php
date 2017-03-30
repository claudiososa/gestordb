<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/rti.php");
include_once("includes/mod_cen/clases/informe.php");
?>
<div class="container">
	<form class="form-horizontal" action='' method='POST'>
		<div class="form-group">
			<label class="col-md-3 col-md-offset-2"><h3>Busqueda de Escuelas</h3></label>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Número</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="numero" placeholder="Ingrese número" autofocus>
					 </div>
				</div>
			</div>
		</div>
			<div class="form-group">
			<label class="control-label col-md-2">CUE</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="cue" placeholder="Ingrese CUE" autofocus>
					 </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Nombre</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="nombre" placeholder="Ingrese nombre" autofocus>
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
							echo	"<option value=0>Ninguno</option>";
							for($val=2;$val<=$total;$val++) {
								$departamento= new Departamentos($val);
								$dato=$departamento->getDepartamento();
								echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
								}
							echo "</select>";
						?>
					 </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-2 col-md-offset-2">
				<input type='submit' class="btn btn-primary" value='Buscar'>
			</div>
		</div>
	</form>
</div>
<div class="table-responsive">
<div class="container">
<?php

if(($_POST))
	{

				$cue=$_POST["cue"];
				$numero=$_POST["numero"];
				$nombre=$_POST["nombre"];
				$localidadId=$_POST["localidadId"];

				$escuela=new Escuela(NULL,null,$cue,$numero,$nombre,null,null,$localidadId,null);

				$resultado = $escuela->buscar();
				$resultado2= $escuela->buscar();
				$primero=0;
				$cantidad=0;
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
			echo "<thead>";
					echo "<tr>";
				  	echo "<th>Nº</th>";
				  	echo "<th>CUE</th>";
				  	echo "<th>Nombre de Escuela</th>";
				  	echo "<th>Localidad</th>";
				  	echo "<th>Referente a Cargo</th>";
				  	echo "<th>ETJ a Cargo</th>";
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


					$crearreferente=new Referente($fila->referenteId);
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();
			  		$etjCargo=$traerreferente->getEtj();

			  		$crearPersona=new Persona($r_personaId);
			  		$traerPersona=$crearPersona->getContacto();
			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();

			  		$crearEtj= new Persona($etjCargo);
			  		$traerEtj=$crearEtj->getContacto();
			  		$nombreEtj= $traerEtj->getNombre();
			  		$apellidoEtj= $traerEtj->getApellido();
			  		$idEtj=$traerEtj->getPersonaId();


			  		echo "<tr>";
			  		echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
			  		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=2&escuelaId=".$fila->escuelaId."'>".substr($fila->nombre,0,40)."</a></td>";
			  		//echo "<td>".substr($fila->nombre,0, 40)."</td>";

			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1=mysqli_fetch_object($busca_loc);
			  		echo "<td>".$fila1->nombre."</td>";

			  		echo "<td>";

			  				if($encontrado==0)
			  					echo "<div class='divSimple' id='ref_".$fila->referenteId."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$apellidoPersona.", ".$nombrePersona.
					  			"</a></div>";
					  		else
					  			echo "<div class='divSimple' id='ref_".$fila->referenteId.$encontrado."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$apellidoPersona.", ".$nombrePersona.
					  			"</a></div>";

					  		echo "<div class='divSimple1'>&nbsp;&nbsp;&nbsp;";


					echo "</td>";

					echo "<td>";
					echo "<div class='divSimple' id='ref_".$fila->referenteId.$encontrado."'>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$etjCargo."&referenteId=".$idEtj."'>".$apellidoEtj.", ".$nombreEtj.
					"</a></div>";
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

					// - descontar cantidad de informe si fue creado por supervisor
					//////////////////////////////////////////////////

					/*while ($fila1 = mysqli_fetch_object($buscar_informe)){

							$referente= new Referente($fila1->referenteId);
							$buscar_referente = $referente->buscar();
							$dato_referente = mysqli_fetch_object($buscar_referente);

							//if($dato_referente->tipo=="Supervisor"){
								$cant=$cant-1;
							//}

					}*/
					echo "<td><a href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>
									 Crear</a>&nbsp&nbsp<a href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver&nbsp(".$cant.")</a></td>";
					echo "</tr>";
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
echo "</div>";
echo "</div>";
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
