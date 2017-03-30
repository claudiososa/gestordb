<?php
		include_once('includes/mod_cen/clases/persona.php');
		include_once('includes/mod_cen/clases/referente.php');
		include_once('includes/mod_cen/clases/localidades.php');

		$referenteId=$_GET['referenteId'];

		$referente= new Referente($referenteId);
		$referente = $referente->getContacto();

		$personaId = $referente->getPersonaId();
		$persona= new Persona($personaId);
		$persona = $persona->getContacto();

		$localidad = new Localidad($persona->getLocalidadId());
		$localidad = $localidad->getLocalidad();

		$nuevoETJ = new Persona($referente->getEtj());
		$ETJ = $nuevoETJ->getContacto();

		$location=new Localidad();
		$resultado=$location->buscar();

		?>
		<h1>Información de la persona</h1>
		<form method="POST" >
		<input type="hidden" name="personaId" value="<?php echo $personaId ?>"/>
		<input type="hidden" name="referenteId" value="<?php echo $referenteId ?>"/>
		<table>

		<?php include_once('includes/mod_cen/formularios/personaf.php'); ?>

		</table>
		<h1>Informacion de la Conectar Igualdad</h1>
		<table>
			<tr>
				<th>Cargo:</th>
				<td>
					<select name="tipo">
							<option value="ETJ" <?php if ($referente->getTipo()=="ETJ"){ echo "selected"; }?>>ETJ</option>
							<option value="Coordinador" <?php if ($referente->getTipo()=="Coordinador"){ echo "selected"; }?>>Coordinador</option>
							<option value="ETT" <?php if ($referente->getTipo()=="ETT"){ echo "selected"; }?>>ETT</option>
							<option value="Tallerista" <?php if ($referente->getTipo()=="Tallerista"){ echo "selected"; }?>>Tallerista</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Rol</th>
				<td> <input type="text" name="rol" value="<?php echo $referente->getRol()?>"/>
				</td>
			</tr>
			<tr>
				<th> Referente a cargo</th>
				<td>
				<?php
				if ($referente->getTipo() == "ETT") {
					echo "<select name='etjcargo'>";
					$ETJS = new Referente(NULL,NULL,"ETJ");
					$allETJ = $ETJS->buscar();
					while ($fila2 = mysqli_fetch_object($allETJ))
					{
						$datoETJ = new Persona($fila2->personaId);
						$datoETJ = $datoETJ->getContacto();
						if ($fila2->referenteId == $referente->getEtj()) {
								echo "<option value=".$fila2->referenteId." selected>".$datoETJ->getApellido().", ".$datoETJ->getNombre()."</option>;"."\n";
							}
						else {
						//	echo "<option value='0032' selected>Ortin, Cristian Javier</option>;"."\n";
							echo "<option value=".$fila2->referenteId.">".$datoETJ->getApellido().", ".$datoETJ->getNombre()."</option>;"."\n";
							}
					}
					if($referente->getReferenteId() == "0032"){
						echo "<option value='0032' selected>Ortin, Cristian Javier</option>";
					}else{
						echo "<option value='0032'>Ortin, Cristian Javier</option>";
					}
					echo "</select>";
				}elseif($referente->getTipo() == "ETJ"){
					?>
					<select  name="etjcargo">
						<option value="0032">Cristian Javier Ortin</option>
					</select>
					<?php
				}
				?>
				</td>
			</tr>
			<tr>
				<th>Fecha de ingreso</th>
				<td> <input type="text" name="fechaIngreso" value="<?php echo $referente->getFechaIngreso()?>"/>
				</td>
			</tr>
			<tr>
				<th>Titulo</th>
				<td> <input type="text" name="titulo" value="<?php echo $referente->getTitulo() ?>"/>
				</td>
			</tr>
			<tr>
				<th>Estado</th>
				<td>
					<select class="" name="estado">
						 <?php
						 if($referente->getEstado()=="Activo" || $referente->getEstado()=="Inactivo")
						 {
								 ?>
								<option value="Activo" <?php if($referente->getEstado()=="Activo"){echo "Selected";}?>>Activo</option>
								<option value="Inactivo" <?php if($referente->getEstado()=="Inactivo"){echo "Selected";}?>>Inactivo</option>
								<?php
							} ?>
					</select>
				</td>
			</tr>
			<tr>
				<th></th>
				<td> <button type="submit" name="boton2" formaction="index.php?men=referentes&id=4">Editar</button>
				</td>
			</tr>
		</table>
