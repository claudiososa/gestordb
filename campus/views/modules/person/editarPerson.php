<div class="container">

<?php

if(!$_SESSION["validar"]){
	header("location:index.php?action=ingresar");
	exit();
}

 ?><br>
<h1>Editar Datos de Persona</h1>

<form method="post">
	<?php
	$editar = new ControllerPerson();
	$editar->editarPersonController();
	$save = $editar->actualizarPersonController();
	if ($save=="success") {
		echo '<script> alert("Los datos fueron modificados correctamente");
		window.location.href = "index.php?action=searchPerson";

		</script>';
	}
 ?>

</form>

</div>
