<form action="index.php?mod=slat&men=escuelas&id=7" method="POST" >
		<input type="hidden" name="escuelaId" value="<?php echo $escuelaId ?>"/>
      <input type="hidden" name="referenteId" value="<?php echo $datos->getReferenteId() ?>"/>	
		<table>
			<tr>
				<th>NUMERO:</th>
				<td> <?php echo $datos->getNumero();?></td>
			</tr>
			<tr>
				<th>CUE</th>
				<td><?php echo $datos->getCue();?></td>
			</tr>
			<tr>
				<th>NOMBRE</th>
				<td><?php echo $datos->getNombre() ?></td>
			</tr>	
			<?php
			if($existe==0) {?>			
													
			<tr>
				<th>¿Tiene ADM?</th>
				<td>
					<input type="radio" name="estado" value="No" checked="checked" size="2"> No
					<input type="radio" name="estado" value="Si" size="2"> Si
				</td>
			</tr>
			<tr>
				<th>Servidor</th>
				<td>
				<select name="servidor" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Router</th>
				<td>
				<select name="router" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>
			<tr>
				<th>Pizarra Digital</th>
				<td>
				<select name="pizarraDigital" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Proyector</th>
				<td>
				<select name="proyector" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>					
			<tr>
				<th>Impresora</th>
				<td>
				<select name="impresora" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>				
			<tr>
				<th>Ups</th>
				<td>
				<select name="ups" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Camara Fotografía Digital</th>
				<td>
				<select name="camaraFoto" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Pendrive</th>
				<td>
				<select name="pendrive" >
							<option label="No tiene" value="No tiene" >No Tiene</option>
							<option label="Funciona" value="Funciona" >Funciona</option>
							<option label="Presenta falla" value="Presenta falla" >Presenta Falla</option>
							<option label="En Servicio Técnico" value="En Servicio Técnico">En Servicio Técnico</option>
							<option label="Robado" value="Robado">Robado</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Cantidad de Netbooks Recibidas</th>
				<td>
				<input type="number" min="0" max="90"  name="cantidadNetbook">			
				</td>
			</tr>	
			<tr>
				<th>Marca de Netbook</th>
				<td>
				<select name="netMarca" >
							<option label="Cdr" value="Cdr" >Cdr</option>
							<option label="Exo" value="Exo" >Exo</option>
							<option label="Positivo BGH" value="Positivo BGH" >Positivo BGH</option>
							<option label="Samsung" value="Samsung" >Samsung</option>
							<option label="Dell" value="Dell">Dell</option>
							<option label="Otra" value="Otra">Otra</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Cantidad de Netbooks Funciona</th>
				<td>
				<input type="number" min="0" max="90"  name="netFunciona">			
				</td>
			</tr>	
			<tr>
				<th>Cantidad Netbooks que no Funcionan</th>
				<td>
				<input type="number" min="0" max="90"  name="netFalla">			
				</td>
			</tr>	
			<tr>
				<th>Estado de Migración a Huayra</th>
				<td>
				<select name="migraHuayra" >
							<option label="Sin migrar" value="Sin migrar" >Sin migrar</option>
							<option label="Migrado Completo" value="Migrado Completo" >Migrado Completo</option>
							<option label="Migrado Incompleto" value="Migrado Incompleto" >Migrado Incompleto</option>
							<option label="No requiere" value="No requiere" >No requiere</option>
				<select>				
				</td>
			</tr>	
			<tr>
				<th>Observaciones</th>
				<td>
				<textarea name="observaciones" cols="40" rows="4"></textarea>			
				</td>
			</tr>	
			<?php }else {
					if($datoadm->estado=="No") {?>
					<tr>
						<th>Tiene ADM?</th>
				   	<td>	<input type="radio" name="estado" value="No" checked="checked" size="2"> No
								<input type="radio" name="estado" value="Si" size="2"> Si
						</td>					
					</tr>
				<?php }else {?>				      
			       <input type="hidden" name="estado" value="<?php echo $datoadm->estado ?>"/>	
					<tr>
							<th>¿Tiene ADM?</th>
							<td><?php echo $datoadm->estado ?></td>
					</tr><?php }?>
			<tr>
				<th>Servidor</th>
				<td>
				<select name="servidor" >
							<option label="No tiene" value="No tiene" <?php if($datoadm->servidor=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->servidor=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->servidor=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->servidor=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->servidor=='Robado'){echo 'selected';}?> >Robado</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Router</th>
				<td>
				<select name="router" >
						<option label="No tiene" value="No tiene" <?php if($datoadm->router=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->router=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->router=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->router=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->router=='Robado'){echo 'selected';}?> >Robado</option>
				</select>				
				</td>
			</tr>
			<tr>
				<th>Pizarra Digital</th>
				<td>
				<select name="pizarraDigital" >
						<option label="No tiene" value="No tiene" <?php if($datoadm->pizarradigital=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->pizarradigital=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->pizarradigital=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->pizarradigital=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->pizarradigital=='Robado'){echo 'selected';}?> >Robado</option>
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Proyector</th>
				<td>
				<select name="proyector" >
						<option label="No tiene" value="No tiene" <?php if($datoadm->proyector=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->proyector=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->proyector=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->proyector=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->proyector=='Robado'){echo 'selected';}?> >Robado</option>
				</select>				
				</td>
			</tr>					
			<tr>
				<th>Impresora</th>
				<td>
				<select name="impresora" >
							<option label="No tiene" value="No tiene" <?php if($datoadm->impresora=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->impresora=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->impresora=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->impresora=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->impresora=='Robado'){echo 'selected';}?> >Robado</option>
				</select>				
				</td>
			</tr>				
			<tr>
				<th>Ups</th>
				<td>
				<select name="ups" >
							<option label="No tiene" value="No tiene" <?php if($datoadm->ups=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->ups=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->ups=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->ups=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->ups=='Robado'){echo 'selected';}?> >Robado</option>
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Camara Fotografía Digital</th>
				<td>
				<select name="camaraFoto" >
							<option label="No tiene" value="No tiene" <?php if($datoadm->camarafoto=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->camarafoto=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->camarafoto=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->camarafoto=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->camarafoto=='Robado'){echo 'selected';}?> >Robado</option>
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Pendrive</th>
				<td>
				<select name="pendrive" >
							<option label="No tiene" value="No tiene" <?php if($datoadm->pendrive=='No tiene'){echo 'selected';}?> >No Tiene</option>
							<option label="Funciona" value="Funciona" <?php if($datoadm->pendrive=='Funciona'){echo 'selected';}?> >Funciona</option>
							<option label="Presenta falla" value="Presenta Falla" <?php if($datoadm->pendrive=='Presenta Falla'){echo 'selected';}?> >Presenta Falla</option>
							<option label="En Servicio técnico" value="En Servicio técnico" <?php if($datoadm->pendrive=='En Servicio técnico'){echo 'selected';}?> >En Servicio Técnico</option>
							<option label="Robado" value="Robado" <?php if($datoadm->pendrive=='Robado'){echo 'selected';}?> >Robado</option>
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Cantidad de Netbooks Recibidas</th>
				<td>
				<input type="number" min="0" max="90"  name="cantidadNetbook" value="<?php echo $datoadm->cantidadnetbook;?>">			
				</td>
			</tr>	
			<tr>
				<th>Marca de Netbook</th>
				<td>
				<select name="netMarca" >
							<option label="Cdr" value="Cdr" <?php if($datoadm->netmarca=='Cdr'){echo 'selected';}?> >Cdr</option>
							<option label="Exo" value="Exo" <?php if($datoadm->netmarca=='Exo'){echo 'selected';}?> >Exo</option>
							<option label="Positivo BGH" value="Positivo BGH" <?php if($datoadm->netmarca=='Positivo BGH'){echo 'selected';}?> >Positivo BGH</option>
							<option label="Samsung" value="Samsung" <?php if($datoadm->netmarca=='Samsung'){echo 'selected';}?> >Samsung</option>
							<option label="Dell" value="Dell" <?php if($datoadm->netmarca=='Dell'){echo 'selected';}?>>Dell</option>
							<option label="Otra" value="Otra" <?php if($datoadm->netmarca=='Otra'){echo 'selected';}?> >Otra</option>	
				</select>				
				</td>
			</tr>	
			<tr>
				<th>Cantidad de Netbooks Funciona</th>
				<td>
				<input type="number" min="0" max="90"  name="netFunciona" value="<?php echo $datoadm->netfunciona;?>" >			
				</td>
			</tr>	
			<tr>
				<th>Cantidad Netbooks que no Funcionan</th>
				<td>
				<input type="number" min="0" max="90"  name="netFalla" value="<?php echo $datoadm->netfalla;?>">			
				</td>
			</tr>	
			<tr>
				<th>Estado de Migración a Huayra</th>
				<td>
				<select name="migraHuayra" >
							<option label="Sin migrar" value="Sin migrar" <?php if($datoadm->migrahuayra=='Sin migrar'){echo 'selected';}?> >Sin migrar</option>
							<option label="Migrado Completo" value="Migrado Completo" <?php if($datoadm->migrahuayra=='Migrado Completo'){echo 'selected';}?> >Migrado Completo</option>
							<option label="Migrado Incompleto" value="Migrado Incompleto" <?php if($datoadm->migrahuayra=='Migrado Incompleto'){echo 'selected';}?> >Migrado Incompleto</option>
							<option label="No requiere" value="No requiere" <?php if($datoadm->migrahuayra=='No requiere'){echo 'selected';}?> >No requiere</option>
				<select>				
				</td>
			</tr>	
			<tr>
				<th>Observaciones</th>
				<td>
				<textarea name="observaciones" cols="40" rows="4"  ><?php echo $datoadm->observaciones;?> </textarea>			
				</td>
			</tr>				
		<?php } ?>
		<tr>
				<th></th>
				<td> <input type="submit" value="Aplicar cambios" />
				</td>
			</tr>
		</table>