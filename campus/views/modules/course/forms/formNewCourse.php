<h4>Formulario Crear Curso</h4>
<form method="post" onsubmit="return validarRegistro()">
	<input type="hidden" name="courseRegistro" id="courseRegistro" required>

	<div class="form-group">
		<div class="col-md-12"><label class="control-label" for="nameRegistro">Nombre</label></div>
		<div class="col-md-12">
			<input type="text" placeholder="Ingrese nombre del curso" name="nameRegistro" id="nameRegistro" required>
  	</div>
	</div>
  <div class="form-group">
    <div class="col-md-12"><label for="turnRegistro">Turno</label></div>
    <div class="col-md-12">
      <select class="control-label" name="turnRegistro">
        <option value="Mañana">Mañana</option>
        <option value="Tarde">Tarde</option>
      </select>
    </div>
  </div>

	<div class="form-group">
		<div class="col-md-12"><label for="turnRegistro">Preceptor/a</label></div>
		<div class="col-md-12">
			<select class="control-label" name="preceptorRegistro">
				<?php
				foreach ($lista as $key => $value):
					echo '<option value="'.$value['user_id'].'">'.$value['lastname'].', '.$value['firstname'].'</option>';
				endforeach;
				?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<input type="submit" value="Crear Curso" name='saveCourse'>
  </div>
</form>
