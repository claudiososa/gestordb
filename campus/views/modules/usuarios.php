<?php


if($_SESSION["typeUser"]<>'Admin'){
	header("location:index.php?action=ingresar");
	exit();
}

 ?>
<h1>USUARIOS</h1>

	<table class="table table-condensed">

		<thead>

			<tr>
				<th>Usuario</th>
				<th>Contraseña</th>
				<th>Tipo</th>
				<th>Estado</th>
				<th></th>
				<th></th>
			</tr>

		</thead>

		<tbody>
			<?php
			$ver = new MvcController();
			$ver->vistaUsuariosController();
			$ver->borrarUsuarioController();

			 ?>

		</tbody>
	</table>

	<?php
	if(isset($_GET["action"])){
		if($_GET["action"]=="cambio"){
			echo "Cambio Exitoso";
		}
	}
	 ?>
