<?php
		include_once('clases/persona.php');
		include_once('clases/referente.php');
		include_once('clases/localidades.php');
		$referenteId=$_GET['referenteId'];
		//echo $personaId;
		$referente= new Referente($referenteId);
		$referente = $referente->getContacto();
		
		$personaId = $referente->getPersonaId();
		
		$nuevoETJ = new Persona($referente->getEtj());
		$ETJ = $nuevoETJ->getContacto();		
		
		include_once('includes/mod_cen/personas/persona_vermas.php');
		?>
		
		<h1> Información de Conectar Igualdad</h1>
		<table>
			<tr>
				<th>Cargo</th>
				<td><?php echo $referente->getTipo()?></td>
			</tr>
			<tr>
				<th>Rol</th>
				<td><?php echo $referente->getRol()?></td>
			</tr>
			<tr>
				<th>Referente a cargo</th>
				<td><?php echo $ETJ->getApellido().", ".$ETJ->getNombre()?></td>
			</tr>
			<tr>
				<th>Fecha de ingreso</th>
				<td><?php echo $referente->getFechaIngreso()?></td>
			</tr>
			<tr>
				<th>Titulo</th>
				<td><?php echo $referente->getTitulo()?></td>
			</tr>
		
		</table>
