<?php
include_once("includes/mod_cen/clases/persona.php");
include_once("includes/mod_cen/clases/rti.php");

if ($_GET['rtiId']){
			$rtiId=$_GET['rtiId'];
			$dato= new Rti($rtiId,null,null,null,null);
			$resultado= $dato->buscar();
			$rti=mysqli_fetch_object($resultado);
			
		}
?>

<a href='index.php?men=rtis&id=3&personaId=<?php echo $_GET['personaId'];?>&rtiId=<?php echo $rtiId;?>'> Actualizar datos</a>
