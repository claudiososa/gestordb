<?php
		include_once('clases/persona.php');
		include_once('clases/rti.php');
		include_once('clases/localidades.php');
		include_once('clases/cargo.php');
		include_once('clases/escuela.php');
		
		$rtiId=$_GET['rtiId'];
		
		$rti= new Rti($rtiId);
		$rti = $rti->getContacto();
		$personaId=$rti->getPersonaId();
		
		include_once('persona_vermas.php');
				
		?>
		
		<h1> Información de Conectar Igualdad</h1>
		<table>
			<tr>
				<th>Titulo</th>
				<td><?php echo $rti->getTitulo()?></td>
			</tr>
			<tr>
				<th>Capacitación Técnica</th>
				<td><?php echo $rti->getCapacitacionTec()?></td>
			</tr>
			<tr>
				<th>Capacitación Pedagógica</th>
				<td><?php echo $rti->getCapacitacionPed()?></td>
			</tr>
		</table>
		
		<h1> Escuelas a cargo </h1>
		<table>
		<?php
		$cargo = new Cargo(NULL,$rtiId);
		$allcargos = $cargo->buscar();
		while ($fila = mysqli_fetch_object($allcargos))
		{
			
		$escuela = new Escuela($fila->escuelaId);
		$escuela = $escuela->getContacto();	
		
		echo "<tr>";
		echo "<th> Escuela </th>";
		echo "<td>".$escuela->getNombre()."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th> Turno </th>";
		echo "<td>".$fila->turno."</td>";
		echo "<tr>";
		}
		?>
		</table>
