<?php
		include_once('includes/mod_cen/clases/persona.php');
		include_once('includes/mod_cen/clases/referente.php');
		include_once('includes/mod_cen/clases/localidades.php');
		$referenteId=$_GET['referenteId'];
		//echo $personaId;
		$referente= new Referente($referenteId);
		$referente = $referente->getContacto();
		
		$personaId = $referente->getPersonaId();
		
		$nuevoETJ = new Persona($referente->getEtj());
		$ETJ = $nuevoETJ->getContacto();		
		
		echo '<div class="table-responsive">';
		echo '<div class="container">';

		include_once('includes/mod_cen/personas/persona_vermas.php');
		?>
		
		<h2> Información de Conectar Igualdad</h2>
		
				<table class='table table-hover table-striped table-condensed '>
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
			</div>
		</div>
