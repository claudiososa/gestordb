<?php
	include_once('clases/escuela.php');
	include_once('clases/localidades.php');
    //include_once('clases/piso.php');
    include_once('clases/persona.php');
    include_once('clases/referente.php');
		
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
    /*$piso= new Piso($escuelaId);
      $datospiso = $piso->getPiso();*/
     
	$referente= new Referente($datos->getReferenteId());
	$persona_id= $referente->getContacto();
	$persona= new Persona($persona_id->getPersonaId());		
	$nombre= $persona->getContacto();
		
		
		?>
		<table class="informe">
			<tr>
				<th>Número</th>
				<td><?php echo $datos->getNumero()?></td>
			</tr>
			<tr>
				<th>CUE</th>
				<td><?php echo $datos->getCue()?></td>
			</tr>
			<tr>
				<th>Nombre</th>
				<td><?php echo $datos->getNombre() ?></td>
			</tr>
			<tr>
				<th>Domicilio</th>
				<td><?php echo $datos->getDomicilio() ?></td>
			</tr>
			<tr>
				<th>Teléfono</th>
				<td><?php echo $datos->getTelefono() ?></td>
			</tr>
			<tr>
				<th>Nivel</th>
				<td><?php echo $datos->getNivel() ?></td>
			</tr>
			
			<tr>
				<th>Turnos</th>
				<td>
				<?php $turnos=str_split($datos->getTurnos()); ?>
				<input disabled type="checkbox" name="tm" value="s" <?php if($turnos[0]=='s') echo 'checked' ?> >Mañana		
				<input disabled type="checkbox" name="tt" value="s" <?php if($turnos[1]=='s') echo 'checked' ?> >Tarde			
				<input disabled type="checkbox" name="tv" value="s" <?php if($turnos[2]=='s') echo 'checked' ?> >Vespertino				
				<input disabled type="checkbox" name="tn" value="s" <?php if($turnos[3]=='s') echo 'checked' ?> >Noche
				<input disabled type="checkbox" name="tj" value="s" <?php if($turnos[4]=='s') echo 'checked' ?> >Jornada Extendida												
		</td>
			</tr>
			<tr>
				<th>Localidad</th>
				<td><?php echo $localidad->getNombre(); ?></td>
			</tr>
			<tr>
				<th>Sitio Web</th>
				<td><?php echo $datos->getSitio(); ?></td>
			</tr>
			<tr>
				<th>Página o Perfil de Facebook</th>
				<td><?php echo $datos->getFacebook(); ?></td>
			</tr>
			<tr>
				<th>Twitter</th>
				<td><?php echo $datos->getTwitter(); ?></td>
			</tr>
			<tr>
				<th>Youtube</th>
				<td><?php echo $datos->getYoutube(); ?></td>
			</tr>
			<tr>
				<th>Ubicación</th>
				<td><?php echo $datos->getUbicacion(); ?></td>
			</tr>
			<tr>
				<th>Referente a cargo</th>
				<td><?php 
						echo $nombre->getNombre().", ".$nombre->getApellido(); 
					 ?>
				</td>
			</tr>
			<?php /*<tr>
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
