<div class="container">
<h3>Cambio de Contraseña</h3>

<form class="form-horizontal" action="?men=personas&id=6&personaId=<?php echo $_GET['personaId']?>" method="post">
	<div class="form-group">
		<div class="col-md-12"><label class="control-label">Contraseña Actual</label></div>
		<div class="col-md-3">
			<input class="form-control" placeholder="Contraseña Actual" size="40"  type="password" name="contra_actual" required>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12"><label class="control-label">Nueva Contraseña</label></div>
		<div class="col-md-3">
			<input class="form-control" placeholder="Nueva contraseña"  type="password"  name="contra_nueva" required>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12"><label class="control-label">Repetir contraseña</label></div>
		<div class="col-md-3">
			<input class="form-control" placeholder="Repetir nueva contraseña" size="40" type="password" name="contra_nueva2" required>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<input class='btn btn-primary' type='submit' name='enviar' value='Cambiar Contraseña'>		
		</div>
	</div>
</form>
</div>