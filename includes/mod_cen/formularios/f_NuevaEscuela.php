<script type="text/javascript" src="includes/mod_cen/formularios/js/form_nuevaEscuela.js"></script>
<div class="container">

<div class="panel panel-primary">
	<div class="panel-heading">Nueva Escuela</div>
	<div class="panel-body">
				<form action="index.php?mod=slat&men=escuelas&id=24" method="POST" >

					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" >Numero</label>

						</div>
						<div class="col-md-12">
						<input class="form-control"size="40"  placeholder="solo números - 4 digitos" type="text" name="numero" pattern="[0-9]{4}" id="numEsc">

						</div>

					</div>

					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" >CUE</label>

						</div>
						<div class="col-md-12">
						<input class="form-control" size="40" placeholder="solo números - 7 a 9 digitos"  type="text" name="cue" pattern="[0-9]{7,9}" id="cueEsc">
						</div>

					</div>

					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" >Nombre</label>

						</div>
						<div class="col-md-12">
						<input class="form-control" size="40" type="text" name="nombre" placeholder="Nombre" id="nombreEsc">
						</div>

					</div>


					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" >Domicilio</label>

						</div>
						<div class="col-md-12">
					<input class="form-control" size="40" type="text" name="domicilio" placeholder="Domicilio">
						</div>

					</div>

					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label" >Teléfono</label>

						</div>
						<div class="col-md-12">
					<input class="form-control" placeholder="Nº Teléfono, solo números" size="40" title="Ingresar solo números" type="text" name="telefono" pattern="[0-9]{1,18}" />
						</div>

					</div>


					<div class="form-group">
						<div class="col-md-12">
							 <label class="control-label"><br>Nivel</label>
						</div>
						<div class="col-md-12">
							<?php
									$nivelInst=Escuela::estructura('nivel','escuelas');
									?>
									<select  class="form-control" name="nivel" <?php
											foreach ($nivelInst AS $valor){
												echo "<option value='$valor'>$valor</option>";
											}
												//if($valor==$escuela->nivel) {
												//	echo "<option selected value='$valor'>$valor</option>";
												//}else {

											//	}

										echo '</select>';
									?>
							</div>
						</div>

						<div class="form-group">
						<div class="col-md-12">
								<label class="control-label"><br>Localidad</label>
						</div>
						<div class="col-md-12">
								<select name="localidadId" class="form-control" >
														 <?php
				while($fila = mysqli_fetch_object($resultado))
				{
					echo "<option value=".$fila->localidadId.">".$fila->nombre."</option>;"."\n";
				}
				?>
									</select>
						</div>
						</div>

						<div class="form-group" "input-group">
								<button type="submit" class="btn btn-success" name="guardar_escuela" value="GUARDAR" id="btn_nuevaEsc">Guardar</button>
						</div>


</form>
</div>

</div>

</form>
</div>
