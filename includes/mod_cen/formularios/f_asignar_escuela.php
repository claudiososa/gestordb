<div class="container">
	<form class="form-horizontal" action='' method='POST'>
		<div class="form-group">

			<?php
			//.Maestro::asignarEscuela($_GET['tipo']).
			if (isset($_GET['tipo'])){
				$titulo = Maestro::asignarEscuela($_GET['tipo']);
				echo '<label class="col-md-5 col-md-offset-2"><h4>Asignación de Escuelas para</h4><h4 class="alert alert-success"> '.$titulo.' </h4></label>';
			} else {
				echo '<label class="col-md-5 col-md-offset-2"><h4>Asignación de Escuelas - Busqueda de Escuelas</h4></label>';
			}
			?>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2">Número</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
							<input type="text" size="4" class="form-control"  name="numero" placeholder="Ingrese número" autofocus>
					 </div>
				</div>
			</div>
		</div>
			<div class="form-group">
			<label class="control-label col-md-2">CUE</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="cue" placeholder="Ingrese CUE" autofocus>
					 </div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-md-2">Nombre</label>
			<div class="col-md-10">
				<div class="row">
					 <div class="col-sm-5">
						  <input type="text" size="4" class="form-control"  name="nombre" placeholder="Ingrese nombre" autofocus>
					 </div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-2 col-md-offset-2">
				<input type='submit' class="btn btn-primary" value='Buscar'>
			</div>
		</div>
	</form>
</div>
