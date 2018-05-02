
<style type="text/css">
hr {
    border-top: 2px solid #FFC61B;
  }

</style>
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


/**
 * Inclusión de formulario para la busqueda de Escuelas
 */
 echo '<div class="container wow flipInX">';
 echo'<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/busqueda (3).png"></div><h4><b>Búsqueda de Escuelas</b></h4>';

 echo '<hr>';
echo'</div>';
 echo'<br>';

 //echo'<a>';
 //echo'<div class="col-md-3 col-md-offset-5 pull-right" onclick="history.back()">';
 //echo'<img class="img-responsive img-circle"  src="includes/mod_cen/portada/imgPortadas/flecha-hacia-la-izquierda (4).png">';
 //echo'</div>';
 //echo'<div class="col-md-3 col-md-offset-5 pull-right hidden-xs" onclick="history.back()">';
 //echo'<p>Volver Atrás</p>';
 //echo'</div>';
 //echo'</a>';


 //echo'<br>';
 //echo'<br>';
 echo'<br>';
 echo'<br>';

include_once("includes/mod_cen/formularios/f_buscar_escuela_etj.php");

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

				$cantidadEscuela=mysqli_num_rows($resultado);

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

            <!-- <div id="tabs">
              <ul>
                <li><a href="#tabs-1">Escuela</a></li>
                <li><a href="ajax/content4-broken.php">Autoridades Esc.</a></li>
                <li><a href="ajax/content5.html">SUPER</a></li>
                <li><a href="#tabs-2">PLANIED</a></li>
                <li><a href="ajax/content2.html">PMI</a></li>
                <li><a href="ajax/content3-slow.php">ESC.FUTURO</a></li>

              </ul>-->
              <!-- ###########CONTENIDO EJEMPLO############ -->
              <!-- <div id="tabs-1">
                  <h4 align="center">COLEGIO SECUNDARIO XXXXXXXXXXX</h4>
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6 col-xs-6">
                          <h5>N°: 5001</h5>
                        </div>
                        <div class="col-md-6 col-xs-6">
                          <h5>CUE:66250100</h5>

                        </div>
                        <div class="col-md-6 col-xs-6">
                          <h5>Localidad: Salta</h5>

                        </div>
                        <div class="col-md-6 col-xs-6">
                          <h5>Direccion:xxxxxxxxxx</h5>

                        </div>
                        <div class="col-md-6 col-xs-6">
                          <img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="Telefono">254688445</>

                        </div>
                        <div class="col-md-6 col-xs-12">
                          <img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="email">email@gmail.com</>

                        </div>
                        <div class="col-md-6 col-xs-6">
                        <h5>Total Informes: (20)</h5>

                        </div>
                        <div class="col-md-6 col-xs-12">
                          <img src="img/iconos/pruebaFotoPerfil/ubicacion.png" alt=""></>

                        </div>

                      </div>

                    </div>
                    <!-- <div class="col-md-6 col-xs-12 col-xs-push-2 col-md-push-2">
                        <img src="img/iconos/busquedaEsc/imagen-no-disponible1.jpg" align="center" class="img-responsive" alt="Imagen no disponible" style="max-width: 300px; max-height: 300px">
                    </div> -->

                    <!-- <div class="col-md-6 col-xs-12">
                        <img src="img/iconos/busquedaEsc/normal4.jpg" align="center" class="img-responsive img-thumbnail" alt="FotoEscxxxx"style="max-width: 300px; max-height: 300px" >
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <img src="img/iconos/busquedaEsc/normal4.jpg" align="center" class="img-responsive img-thumbnail" alt="FotoEscxxxx"style="max-width: 300px; max-height: 300px" >
                    </div>

                  </div> -->
                <!-- <div class="row">
                  <div class="col-md-3">
                    <h5>N°: 5001</h5>

                  </div>
                  <div class="col-md-3">
                    <h5>CUE:66250100</h5>

                  </div>
                  <div class="col-md-6">
                    <img src="img/iconos/busquedaEsc/imagen-no-disponible1.jpg" align="center"class="img-responsive" alt="Imagen no disponible">

                  </div>

                </div> -->

                <!-- <div class="row">
                  <div class="col-md-3">
                    <h5>Localidad: Salta</h5>

                  </div>
                  <div class="col-md-3">
                    <h5>Direccion:xxxxxxxxxx</h5>

                  </div>

                </div> -->

                <!-- <div class="row">
                  <div class="col-md-3">
                    <img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="Telefono">254688445</>

                  </div>
                  <div class="col-md-3">
                    <img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="email">email@gmail.com</>

                  </div>
                  <div class="col-md-3">
                  <h5>Total Informes: (20)</h5>

                  </div>
                  <div class="col-md-3">
                    <img src="img/iconos/pruebaFotoPerfil/ubicacion.png" alt=""></>

                  </div>

                </div> -->
<!--
              </div> -->


              <!-- ###EJEMPLO DE INTERFAZ PARA VISTA PLANIED### -->

              <!-- <div id="tabs-2">
                <div class="row">
                  <div class="col-md-4">
                    <div class="panel panel-default">
                      <div class="panel-body">
                        <h4 align="center">ETT</h4>
                        <hr>
                        <div class="row">
                          <div class="col-md-8">
                            <h4>VIDAURRE JULIO</h4>

                          </div>

                          <div class="col-md-4">
                            <img src="img/iconos/pruebaFotoPerfil/foto-perfil.jpg" alt="..." class=" img-responsive img-circle" style="max-width:60%;">

                          </div>

                        </div>
                        <h4><img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" alt="">:35896944</h4>
                        <h4><img src="img/iconos/pruebaFotoPerfil/gmail (1).png" alt="">:email@gmail.com</h4>
                        <h4>Escuelas a cargo:(10)</h4>



                      </div>
                    </div>

                  </div>

                </div> -->
                <!-- <div class="panel panel-default">
                  <div class="panel-body">

                  </div>
                </div> -->
<!--
              </div>
            </div>
 -->

            <!-- <script>
  $( function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
  } );
  </script> -->
 <!-- -->


						<?php

						echo "<div class='row' style='margin: 5px;padding: 3px;'>Cantidad de escuelas encontradas: <b>".$cantidadEscuela."</b></div>";

							$arreglo[]=array();
							$arreglo["0"]="0";
							$i=0;


							while ($fila = mysqli_fetch_object($resultado2))
							{
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


								/**
								 * Verificar cantidad de rti de la institución
								 * el dato se guarda en la variable cantidadRti
								 */
								$dato_rti=Rti::existeRtixinstitucion($fila->escuelaId);
								$cantidadRti=mysqli_num_rows($dato_rti);

								/**
								 * Busqueda de informes de la institución actual
								 * Cantidad encontradas en variable $cantInformes
								 * Ultimos 3 informes almacenados en $ultimosInformes
								 */
									$informe = new Informe(null,$fila->escuelaId);
									$buscar_informe = $informe->buscar();
									$cantInformes = mysqli_num_rows($buscar_informe);
									$ultimosInformes = $informe->buscar("3");


									/**
									 * Buscar referente de conectar igualdad de la de la escuela actual
									 * guarda el dato en $datoEtt - incluye el nombre y apellido del referente
									 */
									$referente=new Referente($fila->referenteId);
									$buscar_referente=$referente->buscar();
									$datoEtt=mysqli_fetch_object($buscar_referente);

									/**
									 * Buscar referente de PMI de la de la escuela actual
									 * guarda el dato en $datoEtt - incluye el nombre y apellido del referente
									 */

									if ($fila->referenteIdPmi==0){
										$referente=new Referente("1");
									}else{
										$referente=new Referente($fila->referenteIdPmi);
									}

									$buscar_referente=$referente->buscar();
									$datoAtt=mysqli_fetch_object($buscar_referente);

									/**
									 * Buscar dato de persona de referente ETJ de la escuela actual
									 * guarda el dato en $datoEtj
									 */
									$persona= new Referente($datoEtt->etjcargo);
									$buscar_referente=$persona->buscar();
									$datoEtj=mysqli_fetch_object($buscar_referente);

									/**
									 * Buscar director de la institución
									 * se guarda el objeto con datso en $datoDirector
									 */
									 $director2= director::existeAutoridad($fila->escuelaId);
			 						 $director = mysqli_fetch_object($director2);

			  					 $personaDire =  new Persona($director->personaId);
			  					 $buscarDirector = $personaDire->buscar();

			  					 $datoDirector=mysqli_fetch_object($buscarDirector);

									 if($director==NULL){
										  $personaDirector= new Persona("1");
											$buscarPersona = $personaDirector->buscar();
											$datoDirector =mysqli_fetch_object($buscarPersona);
									 }


									 /**
										* [$locali description]
										* @var Localidad
										*/
									  //var_dump($fila->supervisor_id);
										if($fila->supervisor_id==NULL){
											$personaSupervisor= new Persona("1");
										}else{
											$personaSupervisor= new Persona($fila->supervisor_id);
										}

										$buscar_supervisor=$personaSupervisor->buscar();
										$datoSupervisor=mysqli_fetch_object($buscar_supervisor);

									$locali=new Localidad($fila->localidadId,null);
									$busca_loc= $locali->buscar();
									$fila1=mysqli_fetch_object($busca_loc);
								echo "<div class='row' style='margin: 5px;padding: 3px;'>";
								echo '<div class="panel-group">';
								echo '<div class="panel panel-default">';
								//echo '<div class="panel-heading">';
								?>




									<h1 class="panel-title">
									 <a data-toggle="collapse" href="#collapse1<?php echo $fila->escuelaId ?>">
									 	<div class="alert alert-info" role="alert" >
											<b>
									 		<?php
									 		echo $fila->numero." - ".$fila->cue." - ".substr($fila->nombre,0,40);
									 		?>
									 		</b>
										</div>
									</a>
								 </h1>





							 <div id="collapse1<?php echo $fila->escuelaId ?>" class="panel-collapse collapse">

			 				<div class="col-md-6">
								 <div class="alert alert-success" role="alert">Datos de la Institución</div>
								 <?php
								 echo "<div><b>Nº Colegio</b></div>";
								 echo "<div>".$fila->numero."</div>";
								 echo "<div><b>CUE</b></div>";
								 echo "<div>".$fila->cue."</div>";
								 echo "<div><b>Nombre</b></div>";
								 echo "<div>".$fila->nombre."</div>";
								 echo"<div><b>Localidad</b></div>";
								 echo "<div>".$fila1->nombre."</div>";
								 echo"<div><b>Dirección</b></div>";
								 echo "<div>".$fila->domicilio."</div>";
								 echo"<div><b>Teléfono</b></div>";
								 echo "<div>".$fila->telefono."</div>";
								 echo"<div><b>Email</b></div>";
								 echo "<div>".$fila->email."</div>";
								 echo "<br></div>";

								 echo '<div class="col-md-6">';
								 echo '<div class="alert alert-success" role="alert">Informes Creados</div>';
								 echo"<div><b>Cantidad Total</b></div>";
								 echo "<div><a href='index.php?mod=slat&men=informe&id=2&escuelaId=".$fila->escuelaId."'>Ver todos los informes &nbsp(".$cantInformes.")</a></div>";
								 echo"<div><b>Últimos Informes creados</b></div>";
								 echo "<div>";
								 echo "<ul class='list-group'>";

								 while($ultimos = mysqli_fetch_object($ultimosInformes))
								 {

									 $date = date_create($ultimos->fechaCarga);
									 $fecha=date_format($date, 'd-m-Y');
									 echo "<li class='list-group-item list-group-item-success'>
									 <div><a href='index.php?mod=slat&men=informe&id=3&informeId=".$ultimos->informeId."'>".substr($ultimos->titulo,0, 45)."...</a></div>
									 <div>Fecha Creación: ".$fecha."</div>
									 <div>Creado por: ".$ultimos->apellido." ".$ultimos->nombre."</div>
									 </li>";
									 //echo "<div><a href='index.php?mod=slat&men=informe&id=3&informeId=".$ultimos->informeId."'>".substr($ultimos->titulo,0, 30)."... -> ".$fecha."</a></div>";
								 }
								 echo "</ul>";
								 echo "</div>";
								 echo "<br>";
								 echo"<div><b><a class='btn btn-primary' href='index.php?mod=slat&men=informe&id=1&escuelaId=".$fila->escuelaId."'>Crear Nuevo Informe</a></b></div>";
								 echo "<br></div>";

								 echo '<div class="col-md-6">';
								 echo '<div class="alert alert-success" role="alert">Referente ETT Conectar Igualdad</div>';
								 echo"<div><b>Apellido y Nombre</b></div>";
								 echo "<div>".$datoEtt->apellido.", ".$datoEtt->nombre."</div>";
								 echo"<div><b>Teléfono</b></div>";
								 echo "<div>".$datoEtt->telefonoM." / ".$datoEtt->telefonoC."</div>";
								 echo"<div><b>Correo Electrónico</b></div>";
								 echo "<div>".$datoEtt->email."</div>";
								 echo "<br></div>";

								 	$facilitador = new FacilEscuelas(null,$fila->escuelaId);
								 	$buscarFacil= $facilitador->buscar();

									if (mysqli_num_rows($buscarFacil)>0) {
										echo '<div class="col-md-6">';
										echo '<div class="alert alert-success" role="alert">Facilitador Escuela del Futuro</div>';
										while ($filaEscuela = mysqli_fetch_object($buscarFacil))
										{
											echo"<div><b>Apellido y Nombre</b></div>";
											echo "<div>".$filaEscuela->apellido.", ".$filaEscuela->nombre."</div>";
											echo"<div><b>Teléfono</b></div>";
											echo "<div>".$filaEscuela->telefonoM." / ".$filaEscuela->telefonoC."</div>";
											echo"<div><b>Correo Electrónico</b></div>";
											echo "<div>".$filaEscuela->email."</div>";
											echo "<br>";
										}
										echo "</div>";
									}



								 echo '<div class="col-md-6">';
								 echo '<div class="alert alert-success" role="alert">Referente ETJ Conectar Igualdad</div>';
								 echo"<div><b>Apellido y Nombre</b></div>";
								 echo "<div>".$datoEtj->apellido.", ".$datoEtj->nombre."</div>";
								 echo"<div><b>Teléfono</b></div>";
								 echo "<div>".$datoEtj->telefonoM." / ".$datoEtj->telefonoC."</div>";
								 echo"<div><b>Correo Electrónico</b></div>";
								 echo "<div>".$datoEtj->email."</div>";
								 echo "<br></div>";

								 echo '<div class="col-md-6">';
								 echo '<div class="alert alert-success" role="alert">Referente ATT PMI (Plan Mejora Institucional)</div>';
								 echo"<div><b>Apellido y Nombre</b></div>";
								 echo "<div>".$datoAtt->apellido.", ".$datoAtt->nombre."</div>";
								 echo"<div><b>Teléfono</b></div>";
								 echo "<div>".$datoAtt->telefonoM." / ".$datoAtt->telefonoC."</div>";
								 echo"<div><b>Correo Electrónico</b></div>";
								 echo "<div>".$datoAtt->email."</div>";
								 echo "<br></div>";

								 echo '<div class="col-md-6">';
								 echo '<div class="alert alert-success" role="alert">Datos de Directivo</div>';
								 echo"<div><b>Apellido y Nombre</b></div>";
								 echo "<div>".$datoDirector->apellido.", ".$datoDirector->nombre."</div>";
								 echo"<div><b>Teléfono</b></div>";
								 echo "<div>".$datoDirector->telefonoM." / ".$datoDirector->telefonoC."</div>";
								 echo"<div><b>Correo Electrónico</b></div>";
								 echo "<div>".$datoDirector->email."</div>";
								 echo "<br></div>";

								 echo '<div class="col-md-6">';
								 echo '<div class="alert alert-success" role="alert">Datos de Supervisor</div>';
								 echo"<div><b>Apellido y Nombre</b></div>";
								 echo "<div>".$datoSupervisor->apellido.", ".$datoSupervisor->nombre."</div>";
								 echo"<div><b>Teléfono</b></div>";
								 echo "<div>".$datoSupervisor->telefonoM." / ".$datoSupervisor->telefonoC."</div>";
								 echo"<div><b>Correo Electrónico</b></div>";
								 echo "<div>".$datoSupervisor->email."</div>";
								 echo "<br></div>";

								 echo '<div class="col-md-6">';
								echo '<div class="alert alert-success" role="alert">Datos de RTI</div>';

								echo"<div><b>Cantidad de RTI</b></div>";
								echo "<div><a href='index.php?mod=slat&men=escuelas&id=17&escuelaId=".$fila->escuelaId."'>".$cantidadRti."</a></div>";
								echo "<br></div>";

								?>

								</div>

								</div>
								</div>

							 </div>
							<?php

						}
						  	echo "<div class='span11'>";
				      	echo "<div id='map'></div>";
				      	echo "</div>";


						//}
					}else{
						$escuela=new Escuela(NULL);
					}
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
<script type="text/javascript" src="includes/mod_cen/portada/js/animatePortadas.js"></script>
