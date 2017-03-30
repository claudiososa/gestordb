<?php
if (isset($_GET['personaId'])){
			$personaId=$_GET['personaId'];
		}
?>

<a href='index.php?men=personas&id=3&personaId=<?php echo $personaId;?>'>Actualizar datos</a>
