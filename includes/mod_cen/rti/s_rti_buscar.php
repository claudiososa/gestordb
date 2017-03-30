<?php
include_once("clases/escuela.php");
include_once("clases/departamentos.php");
include_once("clases/localidades.php");
include_once("clases/persona.php");
include_once("clases/referente.php");
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
							echo "<select name='localidadId'>";
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
				echo "<b>Resultados</b> ->".$cantidad;	
				echo "<table class='table table-hover table-striped table-condensed'>";
				echo "<tr>";
			  		echo "<th>Nº</th>";
			  		echo "<th>CUE</th>";
			  		echo "<th>Nombre de Escuela</th>";
			  		echo "<th>Localidad</th>";
			  		echo "<th>Recurso</th>";
			  		echo "<th>Referente a Cargo</th>";
			  		echo "<th>Ver</th>";
				echo "</tr>";
				
				while ($fila = mysqli_fetch_object($resultado2)) 
				{
					
					
					$crearreferente=new Referente($fila->referenteId);			  		
			  		$traerreferente= $crearreferente->getContacto();
			  		$r_personaId=$traerreferente->getPersonaId();
			  		
			  		$crearPersona=new Persona($r_personaId);
			  		$traerPersona=$crearPersona->getContacto();
			  		$nombrePersona= $traerPersona->getNombre();
			  		$apellidoPersona= $traerPersona->getApellido();
			  		$persona=$traerPersona->getPersonaId();
			  		echo "<tr>";
			  		echo "<td>".$fila->numero."</td>";
			  		echo "<td>".$fila->cue."</td>";
			  		echo "<td>".substr($fila->nombre,0, 40)."</td>";
			  		
			  		$locali=new Localidad($fila->localidadId,null);
			  		$busca_loc= $locali->buscar();
			  		$fila1=mysqli_fetch_object($busca_loc);
			  		echo "<td>".$fila1->nombre."</td>";
			  		if($fila->nivel=="Primaria Común" && $_SESSION['tipo']=='admin') {
						echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=7&escuelaId=".$fila->escuelaId."'>ADM</a>"."</td>";		  
					}else {
							echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=8&escuelaId=".$fila->escuelaId."'>Piso</a>"."</td>";		  		
					}
			  		echo "<td>"."<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$r_personaId."&referenteId=".$fila->referenteId."'>".$nombrePersona.", ".$apellidoPersona."</td>";
			  		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=10&escuelaId=".$fila->escuelaId."'>Ver más</a>"."</td>";		  
		 	  		echo "</tr>";
		  	  		echo "\n";
		  	  		
	      		}
	      	echo "</table>";
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