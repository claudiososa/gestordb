<?php
		include_once('includes/mod_cen/clases/persona.php');
		include_once('includes/mod_cen/clases/rti.php');
		include_once('includes/mod_cen/clases/localidades.php');

		$personaId=$_GET['personaId'];

		$rti= new Rti(NULL);

		include_once('includes/mod_cen/persona/persona_vermas.php');		
		?>
		<form method="POST" >
		<input type="hidden" name="personaId" value="<?php echo $personaId ?>"/>
		<input type="hidden" name="rtiId" value="<?php echo $rtiId ?>"/>		
		
		<h1>Informacion de la Conectar Igualdad</h1>
		<table>
			<tr>
				<th>Titulo</th>
				<td> <input type="text" name="titulo" value="<?php echo $rti->getTitulo()?>"/>
				</td>
			</tr>
			<tr>
				<th>Capacitación Técnica</th>
				<td> <select name="capacitacionTec">
				<option value="Si" <?php if ($rti->getCapacitacionTec()=="Si"){ echo "selected"; }?>>Si</option>
				<option value="No" <?php if ($rti->getCapacitacionTec()=="No"){ echo "selected"; }?>>No</option>
				</select>
				</td>
			</tr>
			<tr>
				<th>Capacitación Pedagógica</th>
				<td> <select name="capacitacionPed">
				<option value="Si" <?php if ($rti->getCapacitacionPed()=="Si"){ echo "selected"; }?>>Si</option>
				<option value="No" <?php if ($rti->getCapacitacionPed()=="No"){ echo "selected"; }?>>No</option>
				</select>
				</td>
			</tr>
			<tr>
				<th></th>
				<td> <button type='submit' name='boton4' formaction='index.php?men=rtis&id=11'>Agregar RTI</button> 
				</td>
			</tr>
			</table>
			</form>
