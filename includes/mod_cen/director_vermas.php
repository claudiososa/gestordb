<?php
		include_once('clases/persona.php');
		include_once('clases/rti.php');
		include_once('clases/localidades.php');
		include_once('clases/cargo.php');
		include_once('clases/director.php');
		
		$personaId=$_GET['personaId'];
		$directorId=$_GET['directorId'];
		$director= new Rti($personaId);
		$director = $director->getContacto();
		$personaId=$director->getPersonaId();
		$traerdirector= director::existeAutoridadIdDirector($directorId);
		$director2 = mysqli_fetch_object($traerdirector);
		
		include_once('persona_vermas.php');
		echo "<tr> <td> Cargo: </td><td> ".$director2->tipocargo."</td></tr>";		
		?>
        
		</table>
