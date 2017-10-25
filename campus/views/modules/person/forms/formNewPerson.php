<script type="text/javascript" src="views/modules/person/js/formNewPerson.js"></script>
<br><br><h4>Formulario Crear Persona</h4><br>
<form method="post" onsubmit="return validarRegistro()">
	<?php
	if (isset($_GET['id'])) {
		echo '<input type="hidden" name="person_IdEditar" value='.$_GET["id"].'>';
	}else {
		echo '<input type="hidden" name="personRegistro" id="personRegistro">';
	}
	 ?>


	<div class="form-group">
		<label class="control-label" for="lastnameRegistro">Tipo de Usuario:</label>

			<?php
			if($_SESSION["typeUser"]=='Preceptor/a'){
				echo '<input type="text" name="typeRegistro" Value="Alumno" class="form-control mb-2 mr-sm-2 mb-sm-0" readonly>';
			}else{
				?>
				<select class="form-control" name="typeRegistro">
						<option value="Alumno">Alumno</option>
						<option value="Docente">Docente</option>
						<option value="Tutor">Tutor</option>
						<option value="Director/a">Director/a</option>
						<option value="Preceptor/a">Preceptor/a</option>
						<option value="Admin">Administrador</option>
				</select>

			<?php
			}

			?>

  <?php
		if($_SESSION["typeUser"]<>'Preceptor/a'){
				echo '<div class="col-md-12"><label class="control-label" for="lastnameRegistro">Estado de Usuario</label></div>';
		}
	?>

	<div class="col-md-12">
		<?php
		 if($_SESSION["typeUser"]=='Preceptor/a'){
			echo '<input type="hidden" name="statusRegistro" Value="Inactivo" readonly>';
		}else{
			?>
		<select class="control-form" name="statusRegistro">
				<option value="Inactivo">Inactivo</option>
				<option value="Activo">Activo</option>
		</select>
		<?php
		}

		?>

	</div>

<br>
	<div class="form-group">
		<label for="lastnameRegistro">Apellido:</label>
			<input type="text" class="form-control" placeholder="Apellido" name="lastnameRegistro"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['lastname']."'";
			} ?>
			id="lastnameRegistro" required autofocus>

	</div>

	<div class="form-group">
	<label for="firstnameRegistro">Nombre:</label>

			<input type="text" class="form-control" placeholder="Nombre" name="firstnameRegistro"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['firstname']."'";
			} ?>
			 id="firstnameRegistro" required>

	</div>

	<div class="form-group">
		<label for="dniRegistro">DNI:</label>

		  <input type="text" class="form-control" placeholder="DNI" name="dniRegistro" maxlength="8"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['dni']."'";
				if ($_SESSION['typeUser']=='Preceptor/a') {
					echo " readonly ";
				}
			} ?>
			 id="dniRegistro" required>

  </div>

  <div class="form-group">
    <label  for="cuilRegistro">CUIL:</label>

      <input type="text" class="form-control" placeholder="CUIL" name="cuilRegistro" maxlength="15"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['cuil']."'";
			} ?>
			  id="cuilRegistro" required>

  </div>

  <div class="form-group">
  <label class="control-label" for="birthdayRegistro">Fecha Nac:</label>

      <input type="date" class="form-control" placeholder="Fecha Nacimiento" name="birthdayRegistro"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['birthday']."'";
			} ?>
			 id="birthdayRegistro" >

  </div>

  <div class="form-group">
<label class="control-label" for="sexoRegistro">Sexo:</label>

			<select class="form-control" name="sexoRegistro" id="sexoRegistro">
				<?php
				if(isset($_GET['id'])){
					if($respuesta['sexo']=="M"){
					echo '<option value="M" selected>Masculino</option>';
					echo '<option value="F">Femenino</option>';
					}else{
					echo '<option value="M">Masculino</option>';
					echo '<option value="F" selected>Femenino</option>';
					}
				}else{
					echo '<option value="M">Masculino</option>';
					echo '<option value="F">Femenino</option>';
				}

				?>

			</select>


  </div>

  <div class="form-group">
    <label class="control-label" for="phoneRegistro">Telefono Fijo</label>

      <input type="text" class="form-control" placeholder="Teléfono Fijo" name="phoneRegistro" maxlength="15"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['phone']."'";
			} ?>
			  id="phoneRegistro">

  </div>

  <div class="form-group">
    <label for="movilRegistro">Teléfono Celular</label>

      <input type="text" class="form-control" placeholder="Teléfono Celular" name="movilRegistro" maxlength="15"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['movil']."'";
			} ?>
			id="movilRegistro" >

  </div>

  <div class="form-group">
<label  for="emailRegistro">Email</label>

      <input type="email" class="form-control" placeholder="Email" name="emailRegistro"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['email']."'";
			} ?>
			id="emailRegistro" >

  </div>

  <div class="form-group">
    <label for="direccionRegistro">Dirección</label>
      <input type="text" class="form-control" placeholder="Dirección" name="addressRegistro"
			<?php
			if(isset($_GET['id'])){
				echo "value='".$respuesta['address']."'";
			} ?>
			 id="addressRegistro" >
  </div>


	<div class="form-group" align="center">
		<button type="submit" class="btn btn-primary" id="submitRegistro" value="Guardar">Guardar</button>
  </div>
</form>
<br><br>
