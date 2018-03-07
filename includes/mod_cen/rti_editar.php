<?php
		include_once('clases/persona.php');
		include_once('clases/rti.php');
		include_once('clases/localidades.php');
		include_once('clases/cargo.php');
		include_once('clases/escuela.php');
				
		if ($_POST['personaA']){
			$numescuela = $_GET['numesc'];			
			$escuelaVieja = $_POST['escuelaA'];
			$escuelaNueva = $_GET['esc'];			
			$aux=1;
			while($aux <= $numescuela){
			$nombre = "cargo$aux";
			$$nombre = unserialize(stripslashes(stripslashes($_POST[$nombre])));
			if ($$nombre->getEscuelaId() == $escuelaVieja) { $$nombre = new Cargo($$nombre->getCargoId(),$$nombre->getRtiId(),$escuelaNueva,$$nombre->getTurno()); }
			$aux = $aux +1;
			}
			
			$rti = unserialize( stripslashes( stripslashes($_POST['rtiA']) ) );
			$persona = unserialize( stripslashes( stripslashes($_POST['personaA']) ) );
		
			$rtiId=$rti->getRtiId();
			$personaId=$rti->getPersonaId();
		}
		else{	
			$rtiId=$_GET['rtiId'];
			
			//echo $personaId;
			$rti= new Rti($rtiId);
			$rti = $rti->getContacto();
			
			$personaId=$rti->getPersonaId();
			$persona= new Persona($personaId);
			$persona = $persona->getContacto();
			
			$cargoCambiar=new Cargo(NULL);
		}
					
		$localidad = new Localidad($persona->getLocalidadId());
		$localidad = $localidad->getLocalidad();
		
		$location=new Localidad();
		$resultado=$location->buscar();
				
		?>
		<h1>Información de la persona</h1>
		<form method="POST" >
		<input type="hidden" name="personaId" value="<?php echo $personaId ?>"/>
		<input type="hidden" name="rtiId" value="<?php echo $rtiId ?>"/>		
		
		<table>
			<?php include_once('formularios/personaf.php'); ?>	
		</table>	
		
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
		</table>
		
		<h1> Escuelas a cargo </h1>
		<table>
		<?php
		$cargo = new Cargo(NULL,$rtiId);
		$allcargos = $cargo->buscar();
		$numescuela = 0;
		while ($fila = mysqli_fetch_object($allcargos))
		{
		$numescuela = $numescuela + 1;
		$escuelaId=$fila->escuelaId;
		$turno = $fila->turno;
		
		$aux = 1;
		if ($_POST['personaA']){
			$nombre = "cargo$numescuela";
			$escuelaId = $$nombre->getEscuelaId();
			$aux = $aux +1;
			$turno = $$nombre->getTurno();
			}
		
					
		$escuela = new Escuela($escuelaId);
		$escuela = $escuela->getContacto();
		echo "<tr>\n";
		echo "<th> Escuela </th>\n";
		echo "<td>".$escuela->getNombre()."</td>\n";
		echo "<input type='hidden' name='cargoId$numescuela' value='".$fila->cargoId."'/>\n";
		echo "<input type='hidden' name='escuelaId$numescuela' value='$escuelaId'/>\n";
		echo "<th> Turno </th>\n";
		echo "<td> <select name='turno$numescuela'>\n";
		echo	"<option value='Mañana'"; if ($turno =='Mañana'){ echo 'selected'; } echo ">Mañana</option>\n";
		echo	"<option value='Tarde'"; if ($turno =='Tarde'){ echo 'selected'; } echo ">Tarde</option>\n";
		echo	"<option value='Vespertino'"; if ($turno =='Vespertino'){ echo 'selected'; } echo ">Vespertino</option>\n";
		echo	"<option value='Noche'"; if ($turno =='Noche'){ echo 'selected'; } echo ">Noche</option>\n";
		echo	"</select>\n";
		echo	"</td>\n";
		echo "<td> <button type='submit' name='boton1' formaction='index.php?men=rtis&id=6&esc=$escuelaId'>Cambiar</button> </td>\n";
		echo "</tr>\n";
		}
		echo "<input type='hidden' name='numescuela' value='$numescuela'/>";
		?>
		
		<tr>
				<th></th>
				<td> <button type='submit' name='boton2' formaction='index.php?men=rtis&id=4'>Editar</button> 
				</td>
			</tr>
		</table>
