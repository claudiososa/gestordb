
<style type="text/css">
hr {
    border-top: 2px solid #FFC61B;
  }


</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="gmap/gmaps.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/jsEscuelaVerEtj.js"></script>
<!-- <script type="text/javascript" src="includes/mod_cen/escuelas/js/agregaMisEscuelasSupervisor.js"></script> -->
<script type="text/javascript" src="includes/mod_cen/clases/ajax/ajaxInforme.php"></script>
<script type="text/javascript" src="includes/mod_cen/clases/ajax/ajaxPersona.php"></script>

<script type="text/javascript" src="includes/mod_cen/escuelas/js/validarMisEscuelasSnp.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informeNuevo.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/ajax.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/picker.date.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/legacy.js"></script>
<script type="text/javascript" src="includes/mod_cen/escuelas/js/informes.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    let referenteId2 = '<?php echo $_SESSION['referenteId'];?>'
    let tipoR = '<?php echo $_SESSION['tipo'];?>'
    let reports = 'ETT'
</script>
<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/departamentos.php");
include_once("includes/mod_cen/clases/localidades.php");
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/rti.php");
include_once("includes/mod_cen/clases/informe.php");
include_once("includes/mod_cen/clases/director.php");
include_once("includes/mod_cen/clases/EscuelaReferentes.php");

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

									//******** Modificaciones para leer de la tabla escuelaReferentes para ETT ********//
									//**********************************************************************************

											$escuelasETT=new EscuelaReferentes(null,$fila->escuelaId,'19'); // buscamos las escuelas del ETT
											$buscar_referenteETT=$escuelasETT->buscar2();// devuelve todos los datos de las escuelas del ETT
											$datoBuscarETT=mysqli_fetch_object($buscar_referenteETT);


										if ($datoBuscarETT->referenteId == NULL){  // Preguntamos si no existe ETT para la escuela (tambien puede ser que la escuela no tenga entrada en la tabla escuelaReferentes)

										$referente=new Referente('0001');     // vamos a mostrar Sin, Asignar
									  }else{

			                            $referente=new Referente($datoBuscarETT->referenteId);  // vamos a mostrar el ETT

									  }

									 // Fin de modificaciones para leer de la tabla escuelaReferentes para ETT
									//************************************************************************

									//$referente=new Referente($fila->referenteId);
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


								//******* Modificaciones para leer de la tabla escuelaReferentes para ETJ
								//***********************************************************************

								if ($datoBuscarETT->referenteId == NULL){  // preguntamos si no tiene ETT asignado

								$escuelasETJ=new EscuelaReferentes(null,$fila->escuelaId,'20'); // buscamos la escuelas del ETJ
								$buscar_referenteETJ=$escuelasETJ->buscar2();// devuelve todos los datos de la escuelas del ETJ
								$datoBuscarETJ=mysqli_fetch_object($buscar_referenteETJ);

								if ($datoBuscarETJ->referenteId == NULL ) {   // preguntamos si NO tiene ETJ asignado (tambien puede ser que la escuela no tenga entrada en la tabla escuelaReferentes)

								$persona= new Referente('0001');     // vamos a mostrar Sin, Asignar
								$buscar_referente=$persona->buscar();
								$datoEtj=mysqli_fetch_object($buscar_referente);

								}else{

										$persona= new Referente($datoBuscarETJ->referenteId);  // vamos a mostrar el ETJ asignado
										$buscar_referente=$persona->buscar();
										$datoEtj=mysqli_fetch_object($buscar_referente);

								     }


								}else{  // buscamos datos del ETJ a cargo del ETT de la escuela

								$persona= new Referente($datoEtt->etjcargo);
								$buscar_referente=$persona->buscar();
								$datoEtj=mysqli_fetch_object($buscar_referente);

								}

								// ******Fin de modificaciones para leer de la tabla escuelaReferentes para ETJ******
								//*****************************************************************************
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
								// echo "<div class='row' style='margin: 5px;padding: 3px;'>";
								// echo '<div class="panel-group">';
								// echo '<div class="panel panel-default">';

								?>


                <div class="col-md-12" >
                  <ul class="list-group">
                    <li class="list-group-item">

                      <div class="row">
                        <!-- escuela sin foto -->
                      <?php echo '  <div class="col-md-9" id="escuela'.$fila->escuelaId.'">
                          <h4><b>';
    									 		echo $fila->numero." - ".substr($fila->nombre,0,40);
    									 		?></b></h4>
                        </div>
                      </div>
                      <!-- </row -->
                      <?php echo '<div class="" id="ver'.$fila->escuelaId.'" style="display:none">'; ?>

                        <!-- modificacion -->
                        <div class="row">
                          <div class="col-md-8">
                             <div class="row">
                              <!-- padding-left 20px -->
                              <div class="col-md-8">
                                <h5>Cue: <?php echo $fila->cue?></h5>
                                <h5>Localidad: <?php echo $fila1->nombre ?></h5>
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <img src="img/iconos/pruebaFotoPerfil/ubicacion.png" class="img-responsive" alt="iconoGoogleMaps" align="left"><?php echo $fila->domicilio ?>
                              </div>
                              <div class="col-md-6">
                                <?php
                                if ($fila->telefono) {
                                  echo '<img src="img/iconos/pruebaFotoPerfil/llamada-smartphone.png" class="img-responsive" alt="iconoGoogleMaps" align="left">'.$fila->telefono.'';
                                }
                                ?>
                              </div>
                              <div class="col-md-6">
                                <?php
                                if ($fila->email) {
                                  echo '<img src="img/iconos/pruebaFotoPerfil/gmail (1).png" class="img-responsive" alt="iconoGoogleMaps" align="left">'.$fila->email.'';
                                }
                                 ?>
                              </div>
                              <!-- <div class="col-md-6">
                                hola
                              </div> -->

                            </div>

                          </div>
                          <div class="col-md-4">
                            <img class="img-thumbnail" src="img/iconos/busquedaEsc/imagen-no-disponible1.jpg" alt="imagen no disponible">
                          </div>
                          <?php echo '<button type="button" name="button" id="nuevoInforme'.$fila->escuelaId.'">Nuevo Informe</button>
                          <div class="form-group">
                            <div class="" id="padreIr">

                            </div>
                          </div>'; ?>

                        </div>
                        <!-- modificacion -->

      <br>
      				<!-- botones por programas -->



      				<div class="row" >
      		     <div class="col-md-8 col-md-offset-2">

       <?php
      					echo '<div class="btn-group" role="group" aria-label="..." >
        					<button type="button" class="btn btn-default" id="planied'.$fila->escuelaId.'">
      							PLANIED (13)</button>
        					<button type="button" class="btn btn-default" id="super'.$fila->escuelaId.'">SUPERVISION (2)</button>

      						<button type="button" class="btn btn-default" id="autoridadesEsc'.$fila->escuelaId.'">AUTORIDADES ESCUELA</button>

      					</div>';
                  // <button type="button" class="btn btn-default" id="futuro'.$fila->escuelaId.'">ESC FUTURO</button>
        ?>
      				</div>
      				</div>
<!-- fin botones por programas -->
<!-- contenido por prograMAS -->

<br>

<!-- div de contenido por programas -->
<?php echo '
<div class="row">
  <div class="col-md-12" id="programas'.$fila->escuelaId.'" style="display:none">
    <div class="panel panel-default">
      <div class="panel-body" id="bodyProgramas'.$fila->escuelaId.'">

      </div>
    </div>

  </div>


</div>
'; ?>
<!-- FIN CONTENIDO PROGRAMAS -->
                      </div>

                    </li>

                  </ul>

                </div>
<?php

						}

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
