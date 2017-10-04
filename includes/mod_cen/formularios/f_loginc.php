<div class="container">
	<form class="form-horizontal" action="index.php?mod=slat&men=admin&id=3" method="POST" >
		<div class="form-group">
				<div><label class="col-md-3">Login como Referente</label></div>
			</div>
			<div class="form-group">
				<div class="col-md-3">
						<select class="form-control" name="referenteId" >
						<?php
						while($fila = mysqli_fetch_object($b_referente)) {
							$c_persona= new Persona($fila->personaId);
							$b_persona=$c_persona->buscar();
							$d_persona=mysqli_fetch_object($b_persona);
							if($fila->referenteId>1) {
								echo "<option value='".$fila->referenteId."'>".$fila->tipo." -".$d_persona->apellido." ,".$d_persona->nombre."</option>";
							}
						}
						?>
						</select>

				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6"><input class="btn btn-primary" type="submit" value="Login" /></div>
			</div>
	</form>
</div>
