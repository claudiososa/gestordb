<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Nueva Persona
    </div>
    <div class="panel-body">

      <form class="" action="" method="post">

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="apellido">Apellido</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="apellido" value="<?php if(isset($_POST["apellido"]) && $guardar=="Error al guardar") echo $_POST["apellido"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="nombre">Nombre</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="nombre" value="<?php if(isset($_POST["nombre"]) && $guardar=="Error al guardar") echo $_POST["nombre"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="dni">DNI</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="dni" value="<?php if(isset($_POST["dni"]) && $guardar=="Error al guardar") echo $_POST["dni"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="cuil">CUIL</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="cuil" value="<?php if(isset($_POST["cuil"]) && $guardar=="Error al guardar") echo $_POST["cuil"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="telefonoC">Telefono Casa</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="telefonoC" value="<?php if(isset($_POST["telefonoC"]) && $guardar=="Error al guardar") echo $_POST["telefonoC"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="telefonoM">Telefono Celular</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="telefonoM" value="<?php if(isset($_POST["telefonoM"]) && $guardar=="Error al guardar") echo $_POST["telefonoM"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="direccion">Dirección</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="direccion" value="<?php if(isset($_POST["direccion"]) && $guardar=="Error al guardar") echo $_POST["direccion"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="email">Correo Electrónico</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="email" value="<?php if(isset($_POST["email"]) && $guardar=="Error al guardar") echo $_POST["email"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="email2">Correo Electrónico 2</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="email2" value="<?php if(isset($_POST["email2"]) && $guardar=="Error al guardar") echo $_POST["email2"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="facebook">Facebook</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="facebook" value="<?php if(isset($_POST["facebook"]) && $guardar=="Error al guardar") echo $_POST["facebook"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="twitter">Twitter</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="twitter" value="<?php if(isset($_POST["twitter"]) && $guardar=="Error al guardar") echo $_POST["twitter"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="localidadId">Localidad</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="localidadId" value="<?php if(isset($_POST["localidadId"]) && $guardar=="Error al guardar") echo $_POST["localidadId"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="cpostal">Código Postal</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="cpostal" value="<?php if(isset($_POST["cpostal"]) && $guardar=="Error al guardar") echo $_POST["cpostal"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12"><label class="control-label" for="ubicacion">Ubicación</label></div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="ubicacion" value="<?php if(isset($_POST["ubicacion"]) && $guardar=="Error al guardar") echo $_POST["ubicacion"]; ?>">
        </div>
      </div>

      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="guardar_persona" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>
