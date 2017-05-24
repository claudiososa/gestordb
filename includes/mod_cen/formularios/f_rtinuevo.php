<form action="" method="post" id="form1">
  <input name="txtidpersona" type="hidden" id="txtidpersona" value="" />
  <input name="txtidesacuela" type="hidden" id="txtidesacuela" value="<?php echo $_GET['escuelaId'] ?>"/>
  <input name="idrti" type="hidden" id="idrti" value="<?php if(isset($_GET['rtiId'])){ echo round($_GET['rtiId'],0);}?>" />
  <div class="form-group">
    <div class="col-md-12">
      <label for="" class="control-label">Estado</label>
    </div>
    <div class="col-md-12">
      <select class="form-control" name="estado">
        <?php foreach ($datoestado AS $valor)
				if($valor==$info_rti->estado){
					echo "<option value='$valor' selected>$valor</option>";
				}else{
				echo "<option value='$valor'>$valor</option>";
				}
         ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-12">
      <label for="" class="control-label">Turno</label>
    </div>
    <div class="col-md-12">
      <select class="form-control" name="cbestado">
        <?php foreach ($datoturno AS $valor)
          if($valor==$info_rti->turno){
            echo "<option value='$valor' selected>$valor</option>";
          }else{
          echo "<option value='$valor'>$valor</option>";
          }


         ?>
      </select>
    </div>
  </div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Nro. de Documento</label>
		</div>
		<div class="col-md-12">
			<input  class="form-control" name="txtdni" type="text" id="txtdni" value="<?php if(isset($_GET['personaId'])){ echo $persona->dni;}?>" <?php //if(isset($_GET['personaId'])){?> <?php ?> autofocus="autofocus"/>



		</div>
	</div>



  <div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Apellido</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txtapellido" id="txtapellido" class="hades"  />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Nombre</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txtnombre" id="txtnombre" class="hades" />
		</div>
	</div>


	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">CUIL</label>
		</div>
		<div class="col-md-12">
  		<input class="form-control" type="text" name="txtcuit" id="txtcuit" class="hades" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Domicilio</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txtdomicilio" id="txtdomicilio" class="hades" />

		</div>
	</div>



	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Localidad</label>
		</div>
		<div class="col-md-12">
			<select class="form-control" name="cblocalidad" id="cblocalidad">
						<?php
		do {
		?>
						<option value="<?php echo $row_rscondicioniva->localidadId?>"><?php echo $row_rscondicioniva->nombre?></option>
						<?php
		} while ($row_rscondicioniva = mysqli_fetch_object($dato_localidad));

		?>
					</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Código Postal</label>
		</div>
		<div class="col-md-12">
		 <input class="form-control" type="text" name="txtcp" id="txtcp" class="hades" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Código Postal</label>
		</div>
		<div class="col-md-12">
		 <input class="form-control" type="text" name="txtcp" id="txtcp" class="hades" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Teléfono 1</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txttelefono1" id="txttelefono1" class="hades" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Teléfono 2</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txttelefono2" id="txttelefono2" class="hades" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Email 1</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txtemail1" id="txtemail1" class="hades" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Email 2</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txtemail2" id="txtemail2" class="hades" />
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Facebook</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txtfacebook" id="txtfacebook" class="hades"/>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label">Twitter</label>
		</div>
		<div class="col-md-12">
			<input class="form-control" type="text" name="txttwitter" id="txttwitter" class="hades" />

		</div>
	</div>

	<div class="form-group">
		<div class="col-md-12">
			<label for="" class="control-label"></label>
		</div>
		<div class="col-md-12">
			<?php if(!isset($_GET['personaId'])){?>
			<input class="btn btn-primary" type="button" name="cmdlimpiar" id="cmdlimpiar" value="Limpiar" />
			<?php }?>
			<input class="btn btn-primary" type="submit" name="cmdregistrar" id="cmdregistrar" value="Guardar" />
		</div>
	</div>
</form>
