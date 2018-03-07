

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      MODIFICAR TIPO AUTORIDADES
    </div>

    <div class="panel-body">

      <form class="" action="" method="post">


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="tipoId">ID Autoridad</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="tipoId" value="<?php echo $_GET["tipoId"]; ?>" disabled>
        </div>
      </div>


       <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="tipoReferente">Tipo Autoridad Abreviado</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="tipoReferente" value="<?php echo $_GET["tipoReferente"]; ?>">
        </div>
      </div>



      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="cargoAutoridad">Tipo Autoridad Nombre</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="cargoAutoridad" value="<?php echo $_GET["cargoAutoridad"]; ?>">
        </div>
      </div>

      
      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="login">Login</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="login" >
            <option selected value='<?php echo $_GET["login"]; ?> '>
             <?php 

             if ($_GET["login"] == 1) {
               echo "Permitido";
             } else {
               echo "Denegado";
             }
             
             ?> </option>
            <option value="1">Permitido</option>
            <option value="0">Denegado</option>
          </select>
        </div>
      </div>



      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="modificarTipoAutoridad" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>
