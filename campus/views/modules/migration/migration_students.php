<?php
	if($_SESSION["typeUser"]<>'Admin'){
		header("location:index.php?action=ingresar");
		exit();
	}

	$users = new ControllerStudent();
	$migrar = $users->migrationStudentController();
?>
