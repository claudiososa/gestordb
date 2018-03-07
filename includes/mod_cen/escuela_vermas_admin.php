		<?php
		include_once('clases/escuela.php');
		include_once('clases/localidades.php');
      include_once('clases/persona.php');
      include_once('clases/referente.php');
      include_once('clases/adm.php');
		
		$escuelaId=$_GET['escuelaId'];
		if(isset($_GET['referenteId'])) {
			$referenteId=$_GET["referenteId"];
			$escuid=$_GET["escuelaId"];
			$escuela1=new Escuela($escuid,$referenteId);
			$salida= $escuela1->editarref();	
		}	
		
		$escuela= new Escuela($escuelaId);
		$datos = $escuela->getContacto();
      $nuevalocalidad = new Localidad($datos->getLocalidadId());
		$localidad = $nuevalocalidad->getLocalidad();
           
		$referente= new Referente($datos->getReferenteId());
		$persona_id= $referente->getContacto();
		$persona= new Persona($persona_id->getPersonaId());		
		$nombre= $persona->getContacto();
		
		$nuevoETJ = new Persona($referente->getEtj());
		$ETJ = $nuevoETJ->getContacto();	
		
		
		?>
		<table class="informe">
			<tr>
				<th>NUMERO</th>
				<td><?php echo $datos->getNumero()?></td>
			</tr>
			<tr>
				<th>CUE</th>
				<td><?php echo $datos->getCue()?></td>
			</tr>
			<tr>
				<th>NOMBRE</th>
				<td><?php echo $datos->getNombre() ?></td>
			</tr>
			<tr>
				<th>DOMICILIO</th>
				<td><?php echo $datos->getDomicilio() ?></td>
			</tr>
			<tr>
				<th>NIVEL</th>
				<td><?php echo $datos->getNivel() ?></td>
			</tr>
			
			<tr>
				<th>TURNOS</th>
				<?php $turnos=str_split($datos->getTurnos()); ?>
				<td>				
				<input disabled type="checkbox" name="tm" value="s" <?php if($turnos[0]=='s') echo 'checked' ?> >Mañana		
				<input disabled type="checkbox" name="tt" value="s" <?php if($turnos[1]=='s') echo 'checked' ?> >Tarde			
				<input disabled type="checkbox" name="tv" value="s" <?php if($turnos[2]=='s') echo 'checked' ?> >Vespertino				
				<input disabled type="checkbox" name="tn" value="s" <?php if($turnos[3]=='s') echo 'checked' ?> >Noche
				<input disabled type="checkbox" name="tj" value="s" <?php if($turnos[4]=='s') echo 'checked' ?> >Jornada Extendida
				<?php //echo $datos->getTurnos() ?></td>
			</tr>
			<tr>
				<th>LOCALIDAD</th>
				<td><?php echo $localidad->getNombre(); ?></td>
			</tr>
			<tr>
				<th>Referente a cargo</th>
				<td><?php 
						echo "<a href='index.php?mod=slat&men=referentes&id=2&personaId=".$nombre->getPersonaId()."&referenteId=".$datos->getReferenteId()."'>".$nombre->getNombre().", ".$nombre->getApellido().  "  -   Telf: ".$nombre->getTelefonoM()."  - Email: ".$nombre->getEmail(); 
					 ?>
				</td>
			</tr>
			<tr>
				<th>ETJ a cargo</th>
				<td><?php 
						echo $ETJ->getApellido().", ".$ETJ->getNombre().  "  -   Telf: ".$ETJ->getTelefonoM()."  - Email: ".$ETJ->getEmail(); 
					 ?>
				</td>
			</tr>
			<?php
				 $adm=new Adm(null,$escuelaId);
				 $b_adm= $adm->buscar();
				 $encontrar=mysqli_num_rows($b_adm);
				 			 
				 if($encontrar>0) {
						$datoAdm=mysqli_fetch_object($b_adm);					 	
				 	?>
				 	<tr>
				<th>¿Tiene ADM?</th>
				<td>
					<?php echo $datoAdm->estado; ?> 
				</td>
			</tr>
			<tr>
				<th>Servidor</th>
				<td>
				<?php echo $datoAdm->servidor; ?> 			
				</td>
			</tr>	
			<tr>
				<th>Router</th>
				<td>
				<?php echo $datoAdm->router; ?> 			
				</td>
			</tr>
			<tr>
				<th>Pizarra Digital</th>
				<td>
				<?php echo $datoAdm->pizarradigital; ?> 				
				</td>
			</tr>	
			<tr>
				<th>Proyector</th>
				<td>
				<?php echo $datoAdm->proyector; ?> 			
				</td>
			</tr>					
			<tr>
				<th>Impresora</th>
				<td>
				<?php echo $datoAdm->impresora; ?> 			
				</td>
			</tr>				
			<tr>
				<th>Ups</th>
				<td>
				<?php echo $datoAdm->ups; ?> 				
				</td>
			</tr>	
			<tr>
				<th>Camara Fotografía Digital</th>
				<td>
				<?php echo $datoAdm->camarafoto; ?> 			
				</td>
			</tr>	
			<tr>
				<th>Pendrive</th>
				<td>
				<?php echo $datoAdm->pendrive; ?> 			
				</td>
			</tr>	
			<tr>
				<th>Cantidad de Netbooks Recibidas</th>
				<td>
					<?php echo $datoAdm->cantidadnetbook; ?> 			
				</td>
			</tr>	
			<tr>
				<th>Marca de Netbook</th>
				<td>
				<?php echo $datoAdm->netmarca; ?> 		
				</td>
			</tr>	
			<tr>
				<th>Cantidad de Netbooks Funciona</th>
				<td>
				<?php echo $datoAdm->netfunciona; ?> 			
				</td>
			</tr>	
			<tr>
				<th>Cantidad Netbooks que no Funcionan</th>
				<td>
				<?php echo $datoAdm->netfalla; ?> 		
				</td>
			</tr>	
			<tr>
				<th>Estado de Migración a Huayra</th>
				<td>
				<?php echo $datoAdm->migrahuayra; ?> 			
				</td>
			</tr>	
			<tr>
				<th>Observaciones</th>
				<td>
				<?php echo $datoAdm->observaciones; ?> 			
				</td>	 	
			<?php	 	
				 }				
			 /*<tr>
				<th>PISO TECNOLOGICO</th>
			</tr>
			<tr>
				<th>Estado del Piso</th> 
				<td><?php echo $datospiso->getEstado(); ?></td>
			</tr>
            <tr>
				<th>Cantidad de AP</th> 
				<td><?php echo $datospiso->getapCantidad(); ?></td>
			</tr>
            <tr>
				<th>Cantidad de SWITCH</th> 
				<td><?php echo $datospiso->getswitchCantidad(); ?></td>
			</tr>*/?>
		</table>	
