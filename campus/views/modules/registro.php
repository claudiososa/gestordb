<?php

if($_SESSION["typeUser"]<>'Admin'){
	header("location:index.php?action=ingresar");
	exit();
}
	$type=General::camposet('type','users');
	$status=General::camposet('status','users');
?>
<h4>Registro de Usuario</h4>
<form method="post" onsubmit="return validarRegistro()">
	<div class="form-group">
		<div class="col-md-12">
			<label class="control-label" for="usuario">Usuario</label>
		</div>
		<div class="col-md-12">
			<input type="text" placeholder="Usuario" name="usuarioRegistro" id="usuarioRegistro" required>
  	</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<label class="control-label" for="password">Contraseña</label>
		</div>
		<div class="col-md-12">
			<input type="password" placeholder="Contraseña" name="passwordRegistro" id="passwordRegistro" required>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label" for="type">Tipo de Usuario</label>
		<select  class="form-control" name="typeRegistro">

			<?php
				foreach ($type AS $valor)

					//if($valor==$informe->prioridad) {
					//	echo "<option selected value='$valor'>$valor</option>";
				//	}else {
						echo "<option value='$valor'>$valor</option>";
			//		}

			echo '</select>';
		?>
	</div>
	<div class="form-group">
		<label class="control-label" for="status">Estado</label>
		<select  class="form-control" name="statusRegistro">

			<?php
				foreach ($status AS $valor)

					//if($valor==$informe->prioridad) {
					//	echo "<option selected value='$valor'>$valor</option>";
				//	}else {
						echo "<option value='$valor'>$valor</option>";
			//		}

			echo '</select>';
		?>
	</div>
	<div class="form-group">
		<input type="submit" value="Enviar">
  </div>
</form>

<?php

$registro = new MvcController();
$registro->registroUsuarioController();

if(isset($_GET["action"])){
	if($_GET["action"]=="ok"){
		echo "Registro Exitoso";
	}
}

 ?>
