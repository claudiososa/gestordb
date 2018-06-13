<script type="text/javascript" src="includes/mod_cen/formularios/js/form_personaf.js"></script>
<script type="text/javascript" src="includes/mod_cen/formularios/js/perfilEditar.js"></script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar datos</h4>
      </div>
      <div class="modal-body">
        <!-- panel body inicio -->
<?php 
//action="index.php?men=personas&id=12"
 ?>
        <form name ="form" class="form-horizontal formuploadajax" enctype="multipart/form-data"  id="formuploadajax" method="post" action="" >
					<input type="hidden" name="personaId" id="personaId" value="<?php echo $personaId ?>"/>
										
						<div class="form-group">
						<label for="" class="col-sm-2 control-label">Apellidos</label>
						<div class="col-sm-10">
						   <input size="30" type="text" name="apellido" id="apellido" value="<?php echo $persona->getApellido()?>" placeholder="Ingrese Apellido" autofocus>
						</div>
						</div>
						<div class="form-group">
						<label for="" class="col-sm-2 control-label">Nombres</label>
						<div class="col-sm-10">
						  <input size="30" type="text" name="nombre" id="nombre" value="<?php echo $persona->getNombre()?>" placeholder="Ingrese Nombres">
						</div>
						</div>
						<div class="form-group">
						<label for="" class="col-sm-2 control-label">Foto de perfil</label>
						
						<div class="col-md-4">

						<!-- carga de foto de perfil inicio -->

							 <?php 
							       $nomArchivoFoto="./img/perfil/";
							       if ($persona->getFotoPerfil() == "") {
								         $nomArchivoFoto.= "0000.jpg";
							       }else {
							           $nomArchivoFoto.= $persona->getFotoPerfil();
							          
							             }

							       echo  "<img src='$nomArchivoFoto'  alt='perfil'  class=' img-responsive img-circle' id='fotoPerfil2' style='max-width:60%;' > "; 
							
							$fotoperfil=$persona->getFotoPerfil();
							
						    echo "<input type='hidden' name='fotoPerfil' id='fotoPerfil' value='$fotoperfil' >";
						       
						        ?>	
						        <!-- carga de foto de perfil Fin -->


							<!-- <br><img src="img/iconos/pruebaFotoPerfil/foto-perfil.jpg" alt="..." class=" img-responsive img-circle" style="max-width:60%;"> -->

						</div>
						</div>
					

<div class="form-group">
<label for="" class="col-sm-2 control-label">Dni</label>
<div class="col-sm-10">
   <input class="form-control" placeholder="Nº DNI sin puntos" size="30" title="Es un dato obligatorio - Ingresar sin puntos" type="text" name="dni" id="dni" pattern="[0-9]{7,8}" value="<?php echo $persona->getDni() ?>" required>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Cuil</label>
<div class="col-sm-10">
  <input class="form-control" placeholder="Nº CUIL sin puntos, ni guiones" size="30" title="Ingresar sin guiones ni puntos"  type="text" name="cuil" id="cuil" pattern="[0-9]{11}" value="<?php echo $persona->getCuil()?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Telefono Casa</label>
<div class="col-sm-10">
  <input class="form-control" placeholder="Nº Teléfono, solo números" size="30" title="Ingresar solo números" type="text" name="telefonoC" id="telefonoC" pattern="[0-9]{1,18}" value="<?php echo $persona->getTelefonoC() ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Celular</label>
<div class="col-sm-10">
<input class="form-control" placeholder="Nº Teléfono, solo números" size="30" title="Ingresar solo números" type="text" name="telefonoM" id="telefonoM" pattern="[0-9]{1,18}" value="<?php echo $persona->getTelefonoM() ?>"/>
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Email</label>
<div class="col-sm-10">
<input class="form-control" placeholder="Correo electrónico 1" title="Dato Obligatorio" size="30" type="email" name="email" id="email" value="<?php echo $persona->getEmail() ?>" required >
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Direccion</label>
<div class="col-sm-10">
<input class="form-control" placeholder="Dirección" size="30" type="text" name="direccion" id="direccion" value="<?php echo $persona->getDireccion() ?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Facebook</label>
<div class="col-sm-10">
<input class="form-control" placeholder="Cuenta en facebook" size="30" type="text" name="facebook" id="facebook" value="<?php echo $persona->getFacebook()?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Twitter</label>
<div class="col-sm-10">
<input class="form-control" placeholder="Cuenta en twitter" size="30" type="text" name="twitter" id="twitter" value="<?php echo $persona->getTwitter()?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Localidad</label>
<div class="col-sm-10">
	<select class="form-control" 	name="localidadId" id="localidadId">
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
<label for="" class="col-sm-2 control-label">Codigo Postal</label>
<div class="col-sm-10">
<input class="form-control" placeholder="Código postal" size="30" type="text" name="cpostal" id="cpostal" value="<?php echo $persona->getCpostal()?>">
</div>
</div>
<div class="form-group">
<label for="" class="col-sm-2 control-label">Ubicacion</label>
<div class="col-sm-10">
<input class="form-control" placeholder="Coordenadas" size="30" type="text" name="ubicacion" id="ubicacion" value="<?php echo $persona->getUbicacion()?>">
</div>
</div>

<div class="form-group">

   <div class="col-md-12">
        <label class="control-label">Adjuntar archivos (máximo 5 archivos, peso máximo por archivo 1024 kb)</label>
   </div>
   <div class="col-md-12">
        <input id="input-img" name="input-img[]"  multiple="true" type="file" class="file-loading">
   </div>
  
</div>


<div class="form-group">

  <div class="col-md-12">

  <input type="submit" class="btn btn-warning saveDatos" name='boton1'  value="Guardar Cambios">
    
  </div>
  
</div> 


</form>
<!-- panel body final -->
      </div>
      <div class="modal-footer">
		<!--		<button type="button" id="boton1" class="btn btn-primary">Aplicar Cambios</button>  -->
			<!--	 <button type="button" class="btn btn-warning saveDatos" name='boton1' id="saveDatos" data-dismiss="modal" > Guardar Cambios </button> -->
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

				<!-- <input type='submit' id="boton1" class="btn btn-primary" value='Aplicar Cambios'> -->
      </div>
    </div>
  </div</div>


