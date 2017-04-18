<script type="text/javascript" src="includes/mod_cen/formularios/js/form_personaf.js"></script>
			<?php
			if($_SESSION["tipo"]=="Coordinador")
				{
					?>
					<div class="form-group">
						<label class="control-label col-md-2">Apellido</label>
						<div class="col-md-10">
							<div class="row">
								 <div class="col-sm-5">
									  <input size="30" type="text" name="apellido" value="<?php echo $persona->getApellido()?>" placeholder="Ingrese Apellido" autofocus>
								 </div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2">Nombre</label>
						<div class="col-md-10">
							<div class="row">
								 <div class="col-sm-5">
									  <input size="30" type="text" name="nombre" value="<?php echo $persona->getNombre()?>" placeholder="Ingrese Nombres">
								 </div>
							</div>
						</div>
					</div>

					<?php
					//echo $_SESSION["tipo"];

				}else {
					?>
					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label">Apellido</label>
						</div>
						<div class="col-md-3">
							  <input class="form-control" type="text" name="apellido" value="<?php echo $persona->getApellido()?>" placeholder="Ingrese Apellido" required>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12">
							<label class="control-label">Nombre</label>
						</div>
						<div class="col-md-3">
							  <input class="form-control" type="text" name="nombre" value="<?php echo $persona->getNombre()?>" placeholder="Ingrese Nombres" required>
						</div>
					</div>


					<?php
				}

				?>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">DNI</label>
				</div>
				<div class="col-md-3">
					  <input class="form-control" placeholder="Nº DNI sin puntos" size="30" title="Es un dato obligatorio - Ingresar sin puntos" type="text" name="dni" pattern="[0-9]{7,8}" value="<?php echo $persona->getDni() ?>" required>
				</div>
			</div>


			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">CUIL</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Nº CUIL sin puntos, ni guiones" size="30" title="Ingresar sin guiones ni puntos"  type="text" name="cuil" id="cuil" pattern="[0-9]{11}" value="<?php echo $persona->getCuil()?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Teléfono Casa</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Nº Teléfono, solo números" size="30" title="Ingresar solo números" type="text" name="telefonoC" pattern="[0-9]{1,18}" value="<?php echo $persona->getTelefonoC() ?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Teléfono Celular</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Nº Teléfono, solo números" size="30" title="Ingresar solo números" type="text" name="telefonoM" pattern="[0-9]{1,18}" value="<?php echo $persona->getTelefonoM() ?>"/>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Correo electrónico</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Correo electrónico 1" title="Dato Obligatorio" size="30" type="email" name="email" value="<?php echo $persona->getEmail() ?>" required >
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Correo electrónico 2</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Correo electrónico 2" size="30" type="email" name="email2" value="<?php echo $persona->getEmail2() ?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Dirección</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Dirección" size="30" type="text" name="direccion" value="<?php echo $persona->getDireccion() ?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Facebook</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Cuenta en facebook" size="30" type="text" name="facebook" value="<?php echo $persona->getFacebook()?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Twitter</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Cuenta en twitter" size="30" type="text" name="twitter" value="<?php echo $persona->getTwitter()?>">
				</div>
			</div>


			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Localidad</label>
				</div>
				<div class="col-md-3">

							<select class="form-control" 	name="localidadId">
							<?php while($fila = mysqli_fetch_object($resultado))
							{
							if ($fila->localidadId == $persona->getLocalidadId()) {
								echo "<option value=".$fila->localidadId." selected>".$fila->nombre."</option>;"."\n";
							}
							else {
								echo "<option value=".$fila->localidadId.">".$fila->nombre."</option>;"."\n";
							}
							}
							?>
							</select>

				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Código Postal</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Código postal" size="30" type="text" name="cpostal" value="<?php echo $persona->getCpostal()?>">
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-12">
					<label class="control-label">Ubicación</label>
				</div>
				<div class="col-md-3">
					<input class="form-control" placeholder="Coordenadas" size="30" type="text" name="ubicacion" value="<?php echo $persona->getUbicacion()?>">
				</div>
			</div>
