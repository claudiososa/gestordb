<div class="container">


<?php

if($_SESSION["typeUser"]<>'Admin' && $_SESSION["typeUser"]<>'Preceptor/a'){
	header("location:index.php?action=ingresar");
	exit();
}

include_once 'forms/formNewPerson.php';

$registro = new ControllerPerson();
$save = $registro->registroPersonController();

if($_POST){
	if($save=="success"){
		echo '<script> alert("Los datos fueron guardados correctamente");
		window.location.href = "index.php?action=searchPerson";

		</script>';
	}else{
		echo "Error al guardar";
	}
}

 ?>
</div>
