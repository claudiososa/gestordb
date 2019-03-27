<div class="card">
	<div class="card-body">
		<form action='' method='POST'>
		  <div class="form-group">
		    <label>Número</label>
		    <input type="text" class="form-control search"  name="numero" placeholder="Ingrese número" autofocus>

		  </div>
		  <div class="form-group">
		    <label >Cue</label>
		    <input type="text" class="form-control search" name="cue" placeholder="Ingrese CUE">
		  </div>
			<div class="form-group">
				<label >Nombre</label>
				<input type="text" class="form-control search" name="nombre" placeholder="Ingrese Nombre">
			</div>
			<div class="form-group">
				<label class="search" >Departamento</label>
				<?php
				 $departamento= new Departamentos();
				 $total=$departamento->getTotal();?>
				<select class="form-control" name="localidadId" placeholder="Ingrese Nombre">
					<option value="0">Ninguno</option>
					<?php
					for($val=2;$val<=$total;$val++) {
						$departamento= new Departamentos($val);
						$dato=$departamento->getDepartamento();
						echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
						}
					 ?>
				 </select>
			</div>

		  <button type="submit" class="btn btn-primary" value="Buscar">Buscar</button>
		</form>
	</div>
</div>
