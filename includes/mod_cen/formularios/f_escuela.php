<form  action="index.php?men=escuelas&id=4" method="POST" >
		<input type="hidden" name="escuelaId" value="<?php echo $escuelaId ?>"/>
      <input type="hidden" name="referenteId" value="<?php echo $datos->getReferenteId() ?>"/>	
		<table><?php
			if($_SESSION["tipo"]=="Coordinador") 
				{
					?>
					<tr>
				<th>Número:</th>
				<td> <input size="30"  placeholder="solo números - 4 digitos" type="text" name="numero" pattern="[0-9]{4}" value="<?php echo $datos->getNumero()?>"/>
				</td>
			</tr>
			<tr>	<th>CUE</th>
				<td> <input size="30" placeholder="solo números - 7 a 9 digitos"  type="text" name="cue" pattern="[0-9]{7,9}" value="<?php echo $datos->getCue()?>"/>
				</td>
			</tr>
			<tr>
				<th>Nombre</th>
				<td> <input size="30" type="text" name="nombre" value="<?php echo $datos->getNombre() ?>"/>
				</td>
			</tr>
					<?php					
					
				}else {
					?>
					<tr>
				<th>Número:</th>
				<td> <input size="30"  placeholder="solo números - 4 digitos" type="text" name="numero" pattern="[0-9]{4}" value="<?php echo $datos->getNumero()?>" readonly>
				</td>
			</tr>
			<tr>
				<th>CUE</th>
				<td> <input size="30" placeholder="solo números - 7 a 9 digitos"  type="text" name="cue" pattern="[0-9]{7,9}" value="<?php echo $datos->getCue()?>" readonly>
				</td>
			</tr>
			<tr>
				<th>Nombre</th>
				<td> <input size="30" type="text" name="nombre" value="<?php echo $datos->getNombre() ?>">
				</td>
			</tr>				
					
					<?php						
				}
			
				?>					
			<tr>
				<th>Domicilio</th>
				<td> <input size="30" type="text" name="domicilio" value="<?php echo $datos->getDomicilio()?>"/>
				</td>
			</tr>
			<tr>
				<th>Teléfono</th>
					 <td> <input placeholder="Nº Teléfono, solo números" size="30" title="Ingresar solo números" type="text" name="telefono" pattern="[0-9]{1,18}" value="<?php echo $datos->getTelefono()?>" />
				</td>
			</tr>
			<tr>
				<th>Nivel</th>
				<?php
					 if($datos->getNivel()=="") {
					?> <td> 
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
			
				</td> <?php
					 }else {
					 		?> <td> 
					<select name="nivel">
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
				
			</tr>
			<tr>
				<th>Turnos</th>
				<td> <?php $turnos=str_split($datos->getTurnos()); ?>
				<input type="checkbox" name="tm" value="s" <?php if($turnos[0]=='s') echo 'checked' ?> >Mañana		
				<input type="checkbox" name="tt" value="s" <?php if($turnos[1]=='s') echo 'checked' ?> >Tarde			
				<input type="checkbox" name="tv" value="s" <?php if($turnos[2]=='s') echo 'checked' ?> >Vespertino<br>				
				<input type="checkbox" name="tn" value="s" <?php if($turnos[3]=='s') echo 'checked' ?> >Noche
				<input type="checkbox" name="tj" value="s" <?php if($turnos[4]=='s') echo 'checked' ?> >Jornada Extendida 											
						<input hidden type="text" name="turnoactual" value="<?php echo $datos->getTurnos() ?>" readonly>
				</td>
			</tr>
			<tr>
				<th>Localidad</th>
				<td> <select name="localidadId">
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
				</td>
			</tr>
			<tr>
			
			<th>Sitio Web</th>
				<td><input size="30" type="text" name="sitio" value="<?php echo $datos->getSitio()?>"/> 
				</td>
			</tr>
			<th>Página o Perfil de Facebook</th>
				<td><input size="30" type="text" name="facebook" value="<?php echo $datos->getFacebook()?>"/> 
				</td>
			</tr>
			<th>Cuenta Twitter</th>
				<td><input size="30" type="text" name="twitter" value="<?php echo $datos->getTwitter()?>"/> 
				</td>
			</tr>
			
			<th>Canal Youtube</th>
				<td><input size="30" type="text" name="youtube" value="<?php echo $datos->getYoutube()?>"/> 
				</td>
			</tr>
			
			<th>Ubicación</th>
				<td><input size="30" type="text" name="ubicacion" value="<?php echo $datos->getUbicacion()?>"/> 
				</td>
			</tr>
			<tr><td colspan="2">
				  <div class="span11">
      					<div id="map"></div>
    				</div>				
			</td>						
			</tr>	
			<tr>
				<th></th>
				<td> <input type="submit" value="Aplicar cambios" />
				</td>
			</tr>
		</table>