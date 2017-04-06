<script type="text/javascript" src="includes/mod_cen/formularios/js/form_escuelas.js"></script>

<form name="form" action="index.php?men=escuelas&id=4" method="POST" >
		<input type="hidden" name="escuelaId" value="<?php echo $escuelaId ?>"/>
      <input type="hidden" name="referenteId" value="<?php echo $datos->getReferenteId() ?>"/>
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
		<input class="form-control" size="30" type="text" id="nombref_escuela"name="nombre" value="<?php echo $datos->getNombre() ?>">

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

<input class="form-control"size="30" type="text" name="domicilio" value="<?php echo $datos->getDomicilio()?>"/></div>
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
						 <label class="control-label"><br>Nivel</label>
					 </div>
					 <div class="col-md-12">
						 <?php
								if($datos->getNivel()=="") {
							 ?>
							 <select name="nivel">
												<option value="" label="Sin registrar">Sin registrar</option>
										 <option value="Primaria Común" label="Primaria Común">Primaria Común</option>
										 <option value="Primaria Especial" label="Primaria Especial">Primaria Especial</option>
										 <option value="Secundaria Común" label="Secundaria Común">Secundaria Común</option>
										 <option value="Secundaria Técnica" label="Secundaria Técnica"  >Secundaria Técnica</option>
										 <option value="Secundaria Rural" label="Secundaria Rural">Secundaria Rural</option>
										 <option value="ISFD" label="ISFD">ISFD</option>
										 <option value="IEM" label="IEM">IEM</option>
										 <option value="Capacitación" label="Capacitación">Capacitación</option>

							 </select>

							<?php
								}else {
									 ?>

							 <select name="nivel" class="form-control">
												<option value="" label="Sin registrar">Sin registrar</option>
										 <option value="Primaria Común" label="Primaria Común"<?php if($datos->getNivel()=="Primaria Común"){echo "selected";}?> >Primaria Común</option>
										 <option value="Primaria Especial" label="Primaria Especial"<?php if($datos->getNivel()=="Primaria Especial"){echo "selected";}?> >Primaria Especial</option>
										 <option value="Secundaria Común" label="Secundaria Común" <?php if($datos->getNivel()=="Secundaria Común"){echo "selected";}?> >Secundaria Común</option>
										 <option value="Secundaria Técnica" label="Secundaria Técnica" <?php if($datos->getNivel()=="Secundaria Técnica"){echo "selected";}?>>Secundaria Técnica</option>
										 <option value="Secundaria Rural" label="Secundaria Rural" <?php if($datos->getNivel()=="Secundaria Rural"){echo "selected";}?> >Secundaria Rural</option>
										 <option value="ISFD" label="ISFD"<?php if($datos->getNivel()=="ISFD"){echo "selected";}?> >ISFD</option>
										 <option value="IEM" label="IEM"<?php if($datos->getNivel()=="IEM"){echo "selected";}?> >IEM</option>
										 <option value="Capacitación" label="Capacitación" <?php if($datos->getNivel()=="Capacitación"){echo "selected";}?>>Capacitación</option>
							 </select>
							 <?php
								}
						 ?>
					</div>
			 </div>


						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label"><br>Turnos:<label>
									</div>
							<div class="col-md-12">
								<?php $turnos=str_split($datos->getTurnos()); ?>
								<label class="checkbox-inline">
									<input type="checkbox" name="tm" value="s" <?php if($turnos[0]=='s') echo 'checked' ?> >Mañana
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="tt" value="s" <?php if($turnos[1]=='s') echo 'checked' ?> >Tarde
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="tv" value="s" <?php if($turnos[2]=='s') echo 'checked' ?> >Vespertino
								</label><br>
								<label class="checkbox-inline">
									<input type="checkbox" name="tn" value="s" <?php if($turnos[3]=='s') echo 'checked' ?> >Noche
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" name="tj" value="s" <?php if($turnos[4]=='s') echo 'checked' ?> >Jornada Extendida
								</label>

								<input hidden type="text" name="turnoactual" value="<?php echo $datos->getTurnos() ?>" readonly>

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
								<label class="control-label"><br>Sitio Web:<label>

							</div>
							<div class="col-md-12">
<input class="form-control" size="30" type="text" id="sitio_escuela"name="sitio" value="<?php echo $datos->getSitio()?>"/>

									</div>
						</div>


						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label"><br>Página o perfil de Facebook:<label>

							</div>
							<div class="col-md-12">
<input class="form-control"size="30" type="text" name="facebook" value="<?php echo $datos->getFacebook()?>"/>

									</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label"><br>Cuenta Twitter:<label>

							</div>
							<div class="col-md-12">
<input class="form-control"size="30" type="text" name="twitter" value="<?php echo $datos->getTwitter()?>"/>

									</div>
						</div>


						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label"><br>Canal YouTube:<label>

							</div>
							<div class="col-md-12">
<input class="form-control"size="30" type="text" name="youtube" value="<?php echo $datos->getYoutube()?>"/>

									</div>
						</div>


						<div class="form-group">
							<div class="col-md-12">
								<label class="control-label"><br>Ubicación:<label>
							</div>
							<div class="col-md-12">
								<input class="form-control"size="30" type="text" name="ubicacion" value="<?php echo $datos->getUbicacion()?>"/>


									</div>
						</div>

            <div colspan="2">
            				  <div class="span11">
                  					<div id="map"></div>
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
