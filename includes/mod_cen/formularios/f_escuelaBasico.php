<form name="form" action="" method="POST" >
	<input type="hidden" name="escuelaId" value="<?php echo $datos->getEscuelaId() ?>"/>

  <div class="form-group">
	    <div class="col-md-12">
       	<label class="control-label"><br>Número:</label>
	    </div>
      <div class="col-md-12">
         <input class="form-control" size="30"  placeholder="solo números - 4 digitos" type="text" name="numero" pattern="[0-9]{4}" value="<?php echo $datos->getNumero()?>" readonly>
      </div>
	</div>
  <div class="form-group">
		<div class="col-md-12">
			<label class="control-label"><br>CUE:</label>
		</div>
		<div class="col-md-12">
			<input class="form-control"size="30"  placeholder="solo números - 7 a 9 digitos" type="text" name="cue" pattern="[0-9]{7,9}" value="<?php echo $datos->getCue()?>" readonly>
		</div>
	</div>

<div class="form-group">
	<div class="col-md-12">
		<label class="control-label"><br>Nombre de la Institución:</label>
	</div>
	<div class="col-md-12">
		<input class="form-control" size="30" type="text" id="nombre" name="nombre" value="<?php echo $datos->getNombre()?>">
	</div>
</div>

<div class="form-group">
		<div class="col-md-12">
				<label class="control-label"><br>Domicilio:<label>
    </div>
    <div class="col-md-12">
      <input class="form-control"size="30" type="text" name="domicilio" value="<?php echo $datos->getDomicilio()?>">
    </div>
</div>
<div class="form-group">
		<div class="col-md-12">
			<label class="control-label"><br>Teléfono:<label>
		</div>
		<div class="col-md-12">
      <input class="form-control" placeholder="Nº Teléfono, solo números" title="Ingresar solo números" type="text" id="tel_escuela" name="telefono" pattern="[0-9]{1,18}"
      value="<?php echo $datos->getTelefono()?>" />
		</div>
	</div>

	<div class="form-group">
		 <div class="col-md-12">
			 <label class="control-label"><br>Localidad</label>
		 </div>
		 <div class="col-md-12">
			 <select name="localidadId" class="form-control">
 				<?php while($fila = mysqli_fetch_object($resultado))
 							{
   							if ($fila->localidadId == $datos->getLocalidadId()) {
   									echo "<option value=".$fila->localidadId." selected>".$fila->nombre."</option>;"."\n";
   							}else {
   									echo "<option value=".$fila->localidadId.">".$fila->nombre."</option>;"."\n";
   							}
 							}
 								?>
 				</select>
			</div>
		</div>

    <div align="center">
  		<div class="form-group" "input-group">
        <button type="submit" class="btn btn-success btn-lg" id="botonF_escuela">
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aplicar cambios
        </button>
      </div>
    </div>
</form>
