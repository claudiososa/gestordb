<div class="container">
	<form class='form-horizontal' action='' method='POST'>
	<div class="form-group">
			<label class="control-label col-md-3 col-md-offset-2"><h3>Busqueda de Escuelas</h3></label>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Número</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <input class="form-control" size="30" type="text" name="numero" placeholder="sin puntos" autofocus>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">CUE</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <input size="30" class="form-control"  type="text" name="cue" placeholder="sin guiones" >
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Nombre</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <input size="30" class="form-control"  type="text" name="nombre">
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Departamento</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					<?php
				$departamento= new Departamentos();
				$total=$departamento->getTotal();
				echo "<select class='form-control' name='localidadId'>";
					echo	"<option value='0'>Todos</option>";
					echo	"<option value='1'>Sin registrar</option>";
				for($val=2;$val<=$total;$val++) {
					$departamento= new Departamentos($val);
					$dato=$departamento->getDepartamento();
					echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
					}
				echo "</select>";?>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Nivel</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
				 <select class="form-control" name="nivel">
		 					<option value="0" label="todos">Todos</option>
		 					<option value="Sin registrar" label="Sin registrar">Sin registrar</option>
								<option value="Primaria Común" label="Primaria Común">Primaria Común</option>
								<option value="Primaria Especial" label="Primaria Especial">Primaria Especial</option>
								<option value="Secundaria Común" label="Secundaria Común">Secundaria Común</option>
								<option value="Secundaria Técnica" label="Secundaria Técnica"  >Secundaria Técnica</option>
								<option value="Secundaria Rural" label="Secundaria Rural">Secundaria Rural</option>
								<option value="ISFD" label="ISFD">ISFD</option>
								<option value="IEM" label="IEM">IEM</option>
								<option value="Capacitación" label="Capacitación">Capacitación</option>

					</select>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Referente</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					<select class="form-control" name="referenteId" >
					echo	"<option value='0'>Todos</option>";
					<?php
					while($fila = mysqli_fetch_object($b_referente)) {
						$c_persona= new Persona($fila->personaId);
						$b_persona=$c_persona->buscar();
						$d_persona=mysqli_fetch_object($b_persona);
						if($fila->referenteId>1) {
							echo "<option value=".$fila->referenteId.">".$fila->tipo." -".$d_persona->apellido." ,".$d_persona->nombre."</option>";
						}
					}
					?>
					</select>
				 </div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2">Recurso Tecnológico</label>
		<div class="col-md-10">
			<div class="row">
				 <div class="col-sm-5">
					 <select class="form-control" name="recursotec">
		 					<option value="0" label="todos">Todos</option>
		 					<option value="PISOTEC" label="PISOTEC">PISO TEC.</option>
							<option value="ADM" label="ADM">ADM</option>

					</select>
				 </div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-2 col-md-offset-2">
			<input class="btn btn-primary" type='submit' value='Buscar'>
		</div>
	</div>

	</form>
</div>
