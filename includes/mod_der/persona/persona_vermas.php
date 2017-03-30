<?php
if (isset($_GET['personaId'])){
			$personaId=$_GET['personaId'];
		}else {
			$personaId=$_SESSION["personaId"];		
		}
		
?>
<a href='?men=personas&id=3&personaId=<?php echo $personaId;?>'> Actualizar datos </a><br>
<a href='?men=personas&id=6&personaId=<?php echo $personaId;?>'>Cambiar contraseña </a>
