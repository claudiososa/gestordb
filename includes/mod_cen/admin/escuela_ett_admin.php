<?php 
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once('includes/mod_cen/clases/director.php');//Agregada Arredes
include_once('includes/mod_cen/clases/supervisor.php');//Agregada Arredes
include_once('includes/mod_cen/clases/rti.php');//Agregada Arredes

//identifica al usuario logeado y asigna dato a la variable $referenteId
$referenteId=$_SESSION['referenteId'];


$escuela= new Escuela(null,$referenteId);



$escuelas_ett= $escuela->buscar();

$resultado = $escuela->Cargo();

$referente= new Referente($referenteId);

$buscandoreferente=$referente->buscar();
$dato=mysqli_fetch_object($buscandoreferente);

$persona= new Persona($dato->personaId);
$buscandopersona=$persona->buscar();

//$dato persona tiene todos los datos de basicos de la persona - ejempl nombre dni telefono...
$dato_persona=mysqli_fetch_object($buscandopersona);


$cantidad = mysqli_num_rows($resultado);
$escuela->nivel="Secundaria Común";
$sc_nivel=$escuela->buscar();
$csc_nivel= mysqli_num_rows($sc_nivel);

$escuela->nivel="Secundaria Técnica";
$st_nivel=$escuela->buscar();
$cst_nivel= mysqli_num_rows($st_nivel);

$escuela->nivel="Secundaria Rural";
$sr_nivel=$escuela->buscar();
$csr_nivel= mysqli_num_rows($sr_nivel);

$escuela->nivel="Primaria Común";
$pc_nivel=$escuela->buscar();
$cpc_nivel= mysqli_num_rows($pc_nivel);

$escuela->nivel="Primaria Especial";
$pe_nivel=$escuela->buscar();
$cpe_nivel= mysqli_num_rows($pe_nivel);


$escuela->nivel="ISFD";
$t_nivel=$escuela->buscar();
$ct_nivel= mysqli_num_rows($t_nivel);

$escuela->nivel="Sin registrar";
$registrar_nivel=$escuela->buscar();
$sin_nivel= mysqli_num_rows($registrar_nivel);
$cantidad=0;
$primero=0;
$con_ubicacion=0;
?>
				<script type="text/javascript">
				var map;
				$(document).ready(function(){
					map = new GMaps({

							
					<?php 
					if($dato_persona->ubicacion<>""){
						$con_ubicacion=1;
						$lat= substr($dato_persona->ubicacion,0,10);
						$lng= substr($dato_persona->ubicacion,12,10);
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
						 	content: '<div class="overlay"><?php echo $dato_persona->nombre;?></div>'
						});
						map.addMarker({
							  lat: <?php echo $lat;?>,
							  lng:  <?php echo $lng;?>,
							  title: '<?php echo $dato_persona->nombre;?>',
							  infoWindow: {
										  content: '<p><?php echo "<b>Nombre</b> ".$dato_persona->nombre;?></p>'
						}
																});	
					<?php }
					
					
					while ($fila = mysqli_fetch_object($escuelas_ett)) 
							{
							$cantidad++;
							if($fila->ubicacion<>"" && $primero==0 && $con_ubicacion==0){	
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
								} elseif ($fila->ubicacion<>""){
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
						//}
					       ?>		
						
						});
					
						</script>			
				
			<?php



	echo "<table border='0'>";
	echo "<tr><th colspan='10'><h1>Mis Escuelas </h1></th></tr>"; 
	echo "<tr><th colspan='10'>Cantidad Total: ".$cantidad." | Secundaria Común: ".$csc_nivel." | Secundaria Rural: ".$csr_nivel
	." | Secundaria Técnica: ".$cst_nivel." | Primaria Común: ".$cpc_nivel." | Primaria Especial: ".$cpe_nivel
	." | ISFD: ".$ct_nivel." | SIN REGISTRAR:".$sin_nivel."</h1></th></tr>";
	echo "<tr ><th>CUE</th>";
	echo "<th>Nº</th>";
	echo "<th>Nombre</th>";
	echo "<th>Nivel</th>";
	echo "<th>Localidad</th>";
	echo "<th>Informe</th>";
	echo "<th>Piso</th>";
	echo "<th>Autoridad</th>";
	echo "<th>Supervisor</th>";
	echo "<th>RTI</th>";	
	echo "</tr>";	
while ($fila = mysqli_fetch_object($resultado))
{
	echo "<tr>";
	echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=3&escuelaId=".$fila->escuelaId."'>".$fila->cue."</a></td>";
	echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=3&escuelaId=".$fila->escuelaId."'>".$fila->numero."</a></td>";
	echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=3&escuelaId=".$fila->escuelaId."'>".$fila->nombre."</a></td>";	
	echo "<td>".$fila->nivel."</td>";
	$obj_local= new Localidad($fila->localidadId,null,null);
	$dato_local=$obj_local->buscar();
	$localidad=mysqli_fetch_object($dato_local);
	echo "<td>".$localidad->nombre."</td>";
	echo "<td>"."<a href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>Crear</a>"."</td>";
	if($fila->nivel=="Primaria Común") {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=7&escuelaId=".$fila->escuelaId."'>ADM</a>"."</td>";
	}else {
		echo "<td>"."<a href='index.php?mod=slat&men=escuelas&id=8&escuelaId=".$fila->escuelaId."'>Piso</a>"."</td>";
	}
	
	echo "<td>";
	$director= director::existeAutoridad($fila->escuelaId);
	$director2 = mysqli_fetch_object($director);
	$dato_supervisor=supervisor::existeSupervisor($fila->escuelaId);
	$supervisor=mysqli_fetch_object($dato_supervisor);
	$dato_rti=Rti::existeRtixinstitucion($fila->escuelaId);
	$rti=mysqli_num_rows($dato_rti);
	if(isset($director2->directorId)>0)//Si existe director
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=13&personaId=".$director2->personaId."&directorId=".$director2->directorId."&escuelaId=".$fila->escuelaId."'>".$director2->tipoautoridad."</a>";	
	}
	else
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=13&escuelaId=".$fila->escuelaId."' style='color:#F00; font-weight:bold' >Sin Autoridad</a>";	
	}
	echo "</td>";
	echo "<td>";
	if($supervisor->supervisor_id>0)//Si existe supervisor para la escuela
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=15&personaId=".$supervisor->supervisor_id."&escuelaId=".$fila->escuelaId."'>".$supervisor->apellido.",".$supervisor->nombre."</a>";	
	}
	else
	{
		echo "<a href='index.php?mod=slat&men=escuelas&id=15&escuelaId=".$fila->escuelaId."' style='color:#F00; font-weight:bold' >Sin Supervisor</a>";	
	}
	echo "</td>";
	echo "<td>";
	if($rti>0)//Si existe rti para la escuela
	{
		echo "<a href='index.php?mod=slat&men=referentes&id=8&escuelaId=".$fila->escuelaId."'>".$rti."</a>";	
	}
	else
	{
		echo "<a href='index.php?mod=slat&men=referentes&id=8&escuelaId=".$fila->escuelaId."' style='color:#F00; font-weight:bold' >0</a>";	
	}
	echo "</td>";	
	echo "</tr>";
	echo "\n";
	
}	
echo "</table>";
echo "<div class='span11'>";
echo "<div id='map'></div>";
echo "</div>";	
?>

