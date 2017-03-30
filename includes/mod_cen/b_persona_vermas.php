<?php
		include_once('clases/persona.php');
		include_once('clases/localidades.php');
		include_once('clases/departamentos.php');
		if (isset($_GET['personaId'])){
			$personaId=$_GET['personaId'];
		}else {
			$personaId=$_SESSION["personaId"];		
		}
		//echo $personaId;
		$persona= new Persona($personaId);
		$verpersona = $persona->getContacto();
		
		$nuevalocalidad = new Localidad($verpersona->getLocalidadId());
		$localidad = $nuevalocalidad->getLocalidad();
		
				
		$nuevodepa= new Departamentos($localidad->getDepartamento());
		$departamento= $nuevodepa->getDepartamento();
		/*echo $departamento->getDescripcion();
		echo $departamento;*/
				
		?>
		<h1>Información personal</h1>
		<table>
			<tr>
				<th>Apellido</th>
				<td><?php echo $verpersona->getApellido()?></td>
			</tr>
			<tr>
				<th>Nombre</th>
				<td><?php echo $verpersona->getNombre()?></td>
			</tr>
			<tr>
				<th>DNI</th>
				<td><?php echo $verpersona->getDni() ?></td>
			</tr>
			<tr>
				<th>CUIL</th>
				<td><?php echo $verpersona->getCuil()?></td>
			</tr>
			<tr>
				<th>Teléfono Casa</th>
				<td><?php echo $verpersona->getTelefonoC() ?></td>
			</tr>
			<tr>
				<th>Teléfono Celular</th>
				<td><?php echo $verpersona->getTelefonoM() ?></td>
			</tr>
			<tr>
				<th>Correo Electrónico 1</th>
				<td><?php echo $verpersona->getEmail() ?></td>
			</tr>
			<tr>
				<th>Correo Electrónico 2</th>
				<td><?php echo $verpersona->getEmail2() ?></td>
			</tr>
			<tr>
				<th>Dirección</th>
				<td><?php echo $verpersona->getDireccion() ?></td>
			</tr>
			<tr>
				<th>Facebook</th>
				<td><?php echo $verpersona->getFacebook()?></td>
			</tr>
			<tr>
				<th>Twitter</th>
				<td><?php echo $verpersona->getTwitter()?></td>
			</tr>
			<tr>
				<th>Localidad</th>
				<td><?php 
				
				echo $localidad->getNombre().", ".$departamento->getDescripcion(); 
				?>
				</td>
			</tr>
			<tr>
				<th>Codigo Postal</th>
				<td><?php echo $verpersona->getCpostal()?></td>
			</tr>
		</table>	
