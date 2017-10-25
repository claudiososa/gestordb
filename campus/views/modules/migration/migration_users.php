<?php
	if($_SESSION["typeUser"]<>'Admin'){
		header("location:index.php?action=ingresar");
		exit();
	}

	$users = new MvcController();
	$migrar = $users->migrationUsersController();
?>
