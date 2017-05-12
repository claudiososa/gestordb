<script type="text/javascript" src="includes/mod_cen/formularios/js/form_relevamiento.js"></script>
<!--
<script type="text/javascript" src="includes/mod_cen/formularios/js/prueba.js"></script>-->
<form name="form" action="" method="POST">
	<input type="hidden" name="escuelaId" value="<?php echo $escuelaId ?>"/>
<table><?php
			if($_SESSION["tipo"]=="Coordinador")
				{
					?>
					<div class="form-group">
		          <div class="col-lg-12">
						      	<label class="control-label"><br>Número</label>
		          </div>
				   	  <div class="col-md-12">
			              <input class="form-control"type="text" placeholder="solo números - 4 digitos"  name="numero" pattern="[0-9]{4}" value="<?php echo $datos->getNumero()?>"/>
			        </div>
			    </div>

				  <div class="form-group">
					    <div class="col-md-12">
					    	    <label class="control-label"><br>CUE:</label>
					    </div>
					    <div class="col-md-12">
                    <input class="form-control"size="30" placeholder="solo números - 7 a 9 digitos"  type="text" name="cue" pattern="[0-9]{7,9}" value="<?php echo $datos->getCue()?>"/>
					    </div>
				  </div>

           <div class="form-group">
	             <div class="col-md-12">
		                 <label class="control-label"><br>Nombre:</label>
	             </div>
	             <div class="col-md-12">
                     <input class="form-control"size="30" type="text" name="nombre" id="nombref_escuela" value="<?php echo $datos->getNombre() ?>"/>
			         </div>
           </div>

					<?php
				}else {
					?>

				   <div class="form-group">
						    <div class="col-md-12">
						       	<label class="control-label"><br>Número:</label>
						    </div>
					      <div class="col-md-12">
                     <input class="form-control" size="30"  placeholder="solo números - 4 digitos" type="text" name="numero" pattern="[0-9]{4}" value="<?php echo $datos->getNumero()?>" readonly>
					      </div>
					 </div>

					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label"><br>CUE:</label>
						</div>
						<div class="col-md-12">
					<input class="form-control"size="30"  placeholder="solo números - 7 a 9 digitos" type="text" name="cue" pattern="[0-9]{7,9}" value="<?php echo $datos->getCue()?>" readonly>
								</div>
					</div>

<div class="form-group">
	<div class="col-md-12">
		<label class="control-label"><br>Nombre:</label>
	</div>
	<div class="col-md-12">
		<input class="form-control" size="30" type="text" id="nombref_escuela"name="nombre" value="<?php echo $datos->getNombre() ?>" readonly>

			</div>
</div>


						<?php
				}
				?>
				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label"><br>Domicilio:<label>
</div>
					<div class="col-md-12">

<input class="form-control"size="30" type="text" name="domicilio" value="<?php echo $datos->getDomicilio()?>" readonly></div>
							</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label"><br>Teléfono:<label>

					</div>
					<div class="col-md-12">
<input class="form-control" placeholder="Nº Teléfono, solo números" title="Ingresar solo números" type="text" id="tel_escuela"name="telefono" pattern="[0-9]{1,18}" value="<?php echo $datos->getTelefono()?>" />

							</div>
				</div>

				<div class="form-group">
							 <div class="col-md-12">
								 <label class="control-label"><br>Localidad</label>
							 </div>
							 <div class="col-md-12">
								 <select name="localidadId" class="form-control">
 								<?php while($fila = mysqli_fetch_object($resultado))
 								{
 								if ($fila->localidadId == $escuela->getLocalidadId()) {
 									echo "<option value=".$fila->localidadId." selected>".$fila->nombre."</option>;"."\n";
 								}
 								else {
 									echo "<option value=".$fila->localidadId.">".$fila->nombre."</option>;"."\n";
 								}
 								}
 								?>
 								</select>
							</div>
				</div>
        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label" ><br>Cue de otras instituciones que funcionan en el mismo edificio:<label>
          </div>
          <div class="col-md-12">
              <input class="form-control"size="30" type="text" name="otroCue" placeholder="Si es mas de un CUE ingréselos separandolos por comas (,)" id="cue" value="<?php if($datoRelevamiento<>NULL){echo $datoRelevamiento->otroCue;} ?>" >
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>La institución ¿Tiene regimen de internado o albergue?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('internado','relevamientoElectrico');
             //var_dump($datoRelevamiento);
             ?>

             <select  class="form-control" name="internado" id="internado">
               <?php
							 	echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){

                     if($valor==$datoRelevamiento->internado){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group">
					<div class="col-md-12">
						<label class="control-label" ><br>Cantidad Total de Personal (Directivos,Docentes, Auxiliares y otros Cargos:<label>
					</div>
					<div class="col-md-12">
              <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="totalCargos" name="totalCargos" value="<?php if($datoRelevamiento<>NULL)	echo $datoRelevamiento->totalCargos ?>" />
					</div>
				</div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label" ><br>Matricula de Alumnos:<label>
          </div>
          <div class="col-md-12">
              <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="matricula" name="matricula"  value="<?php if($datoRelevamiento<>NULL) echo $datoRelevamiento->matricula ?>" />
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>La institución ¿Tiene energía eléctrica?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('energia','relevamientoElectrico');
         ?>
             <select  class="form-control" name="energia" id="energia">
               <?php
							 	echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){

                     if($valor==$datoRelevamiento->energia){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group"id="tipoInstalacion">
          <div class="col-md-12">
            <label class="control-label" ><br>En caso de respuesta afirmativa a la pregunta anterior indicar -> Tipo de Instalacion de Energia eléctrica<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('tipoInstalacion','relevamientoElectrico');
         ?>
             <select  class="form-control" name="tipoInstalacion" id="tipoinstalacion">
               <?php
							 		echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){
								     if($valor==$datoRelevamiento->tipoInstalacion){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group" id="Funcion">
          <div class="col-md-12">
            <label class="control-label"><br>¿Cómo funciona?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('comoFunciona','relevamientoElectrico');
         ?>
             <select  class="form-control" name="comoFunciona" id="funcion">
               <?php
							 	echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){
								    	if($valor==$datoRelevamiento->comoFunciona){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label" ><br>Cantidad de Aulas:<label>
          </div>
          <div class="col-md-12">
              <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="cantidadAulas" name="cantidadAulas"   value="<?php if($datoRelevamiento<>NULL) echo $datoRelevamiento->cantidadAulas ?>" />
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label" ><br>Cantidad de Computadoras Instaladas:<label>
          </div>
          <div class="col-md-12">
              <input class="form-control" placeholder="Cantidad Total" title="Ingresar un número total" type="text" id="cantidadPcInstaladas" name="cantidadPcInstaladas"  value="<?php if($datoRelevamiento<>NULL) echo $datoRelevamiento->cantidadPcInstaladas ?>" />
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>¿Tiene heladera?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('heladera','relevamientoElectrico');
         ?>
             <select  class="form-control" name="heladera" id="heladera">
               <?php
							 	 echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){
								     if($valor==$datoRelevamiento->heladera){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>Indicar si tiene otros equipos eléctricos instalados:<label>
              </div>
          <div class="col-md-12">
						<?php //$turnos=str_split($datos->getTurnos()); ?>


            <?php
						if($datoRelevamiento<>NULL)
						{
							$otros=str_split($datoRelevamiento->otros);
						}else{
							$otros=str_split('nnnnn');
							//$otros=array("","","","","");
						}
						//var_dump($otros);
						?>

            <label class="checkbox-inline">
              <input type="checkbox" name="televisor" value="televisor"
              <?php
              if($datoRelevamiento<>NULL){
                if($otros[0]=='s') echo 'checked';
              }
              ?>
              >Televisor
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="cañon" value="cañon"
              <?php
              if($datoRelevamiento<>NULL){
                if($otros[1]=='s') echo 'checked';
              }
              ?> >Cañon
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="reproductor" value="reproductor CD/DVD"
              <?php
              if($datoRelevamiento<>NULL){
                if($otros[2]=='s') echo 'checked';
              }
                ?> >Reproductor CD/DVD
            </label><br>
            <label class="checkbox-inline">
              <input type="checkbox" name="impresora" value="impresora"
              <?php
              if($datoRelevamiento<>NULL){
                if($otros[3]=='s') echo 'checked';
              }
              ?> >Impresora
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" name="otro" value="otro"
              <?php
              if($datoRelevamiento<>NULL){
                if($otros[4]=='s') echo 'checked';
              }
                ?>
                 >Otro
            </label>

						<input hidden type="text" name="otrosactual" value="<?php
						if($datoRelevamiento<>NULL)
						{
							echo $datoRelevamiento->otros;
						}else{
							echo 'nnnnn';
							//$otros=array("","","","","");
						}
						 //echo $datoRelevamiento->otros
						 ?>" readonly>
              </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>¿Tiene suficiente Energía?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('suficienteEnergia','relevamientoElectrico');
         ?>
             <select  class="form-control" name="suficienteEnergia" id="energiasuf">
               <?php
							 	 echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){
								     if($valor==$datoRelevamiento->suficienteEnergia){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>¿Tiene Calefón?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('calefon','relevamientoElectrico');
         ?>
             <select  class="form-control" name="calefon" id="calefon">
               <?php
							 	 echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                 	if($datoRelevamiento<>NULL){
									  if($valor==$datoRelevamiento->calefon){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>¿Necesita Calefón Solar?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('necesitaCalefonSolar','relevamientoElectrico');
         ?>
             <select  class="form-control" name="necesitaCalefonSolar" id="calefonsolar">
               <?php
							 	 echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){
									    if($valor==$datoRelevamiento->necesitaCalefonSolar){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>¿Necesita bombeo de agua para el Calefón Solar?<label>
          </div>
          <div class="col-md-12">
         <?php
             $internado=Maestro::estructura('necesitaBombeoAgua','relevamientoElectrico');
         ?>
             <select  class="form-control" name="necesitaBombeoAgua" id="bombeo">
               <?php
							 	 echo "<option value='0'>Seleccione...</option>";
                 foreach ($internado AS $valor)
                   if($datoRelevamiento<>NULL){
							       if($valor==$datoRelevamiento->necesitaBombeoAgua){
                       echo "<option selected value='$valor'>$valor</option>";
                     }else{
                       echo "<option value='$valor'>$valor</option>";
                     }
                   }else{
                     echo "<option value='$valor'>$valor</option>";
                   }

               echo '</select>';
             ?>
         </div>
        </div>

				<div class="form-group">
					<div class="col-md-12">
						<label class="control-label"><br>¿Tiene conectividad a Internet?<label>
					</div>
					<div class="col-md-12">
				 <?php
						 $internado=Maestro::estructura('conectividad','relevamientoElectrico');
				 ?>
						 <select  class="form-control" name="conectividad" id="conectividad">
							 <?php
							 	 echo "<option value='0'>Seleccione...</option>";
								 foreach ($internado AS $valor)
									 if($datoRelevamiento<>NULL){
									    if($valor==$datoRelevamiento->conectividad){
											 echo "<option selected value='$valor'>$valor</option>";
										 }else{
											 echo "<option value='$valor'>$valor</option>";
										 }
									 }else{
										 echo "<option value='$valor'>$valor</option>";
									 }

							 echo '</select>';
						 ?>
				 </div>
				</div>

				<div class="form-group" id="proveedor">
					<div class="col-md-12">
						<label class="control-label"><br>Indicar que proveedor de conectividad (puede indicar más de uno):<label>
							</div>
					<div class="col-md-12">
						<?php //$turnos=str_split($datos->getTurnos()); ?>


						<?php
						if($datoRelevamiento<>NULL)
						{
							$otrosC=str_split($datoRelevamiento->tipoConectividad);
						}else{
							$otrosC=str_split('nnnnnn');
							//$otros=array("","","","","");
						}
						//var_dump($otros);
						?>

						<label class="checkbox-inline">
							<input type="checkbox" name="Claro" value="Claro"id="claro"
							<?php
							if($datoRelevamiento<>NULL){
								if($otrosC[0]=='s') echo 'checked';
							}
							?>
							>Claro
						</label>
						<label class="checkbox-inline">
							<input type="checkbox" name="Arnet" value="Arnet"id="arnet"
							<?php
							if($datoRelevamiento<>NULL){
								if($otrosC[1]=='s') echo 'checked';
							}
							?> >Arnet
						</label>
						<label class="checkbox-inline">
							<input type="checkbox" name="Fibertel" value="Fibertel"id="fibertel"
							<?php
							if($datoRelevamiento<>NULL){
								if($otrosC[2]=='s') echo 'checked';
							}
								?>
								 >Fibertel (CableVision)
						</label>
						<label class="checkbox-inline">
							<input type="checkbox" name="EmpresaLocal" value="Empresa Local de Conectividad" id="local"
							<?php
							if($datoRelevamiento<>NULL){
								if($otrosC[3]=='s') echo 'checked';
							}
								?> >Empresa Local de Conectividad
						</label><br>
						<label class="checkbox-inline">
							<input type="checkbox" name="Satelital" value="Satelital" id="satelital"
							<?php
							if($datoRelevamiento<>NULL){
								if($otrosC[4]=='s') echo 'checked';
							}
							?> >Satelital
						</label>

						<label class="checkbox-inline">
							<input type="checkbox" name="otro" value="otro" id="otro"
							<?php
							if($datoRelevamiento<>NULL){
								if($otrosC[5]=='s') echo 'checked';
							}
								?>
								 >Otro
						</label>

						<input hidden type="text" name="otrosconectividad" value="<?php
						if($datoRelevamiento<>NULL)
						{
							echo $datoRelevamiento->tipoConectividad;
						}else{
							echo 'nnnnnn';
							//$otros=array("","","","","");
						}
						 //echo $datoRelevamiento->otros
						 ?>" readonly>
							</div>
				</div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label"><br>Comentario:<label>
          </div>
          <div class="col-md-12">
              <input class="form-control" placeholder="ingrese comentario" title="Ingrese comentario" type="textarea" rows="10" cols="40" id="comentario" name="comentario"  value="<?php if($datoRelevamiento<>NULL) echo $datoRelevamiento->comentario ?>" />
          </div>
        </div>

        <div align="center">

                		<div class="form-group" "input-group">
				                <button type="submit" class="btn btn-success btn-lg" id="botonF_escuela">
                               <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aplicar cambios
                        </button>
                    </div>

            </div>
</table>
</form>
