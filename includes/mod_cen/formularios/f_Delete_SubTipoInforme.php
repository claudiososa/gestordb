<?php

include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("includes/mod_cen/informes/listarSubTipo.php");
//include_once("includes/mod_cen/informes/update_subtipo_informe.php");
include_once("includes/mod_cen/informes/delete_subtipo_informe.php");


?>


<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      ELIMINAR   SUB-CATEGORIA
    </div>
    
    <div class="panel-body">

      <form class="" action="" method="post">
      
         <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="tipoId">Categoria</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="tipoId" value="<?php echo $_GET["tipoId"]; ?>" disabled>
        </div>
      </div>


        <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="subTipoId">SubCategoria</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="subTipoId" value="<?php echo $_GET["subTipoId"]; ?>" disabled>
        </div> 
      </div>

     

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">Nombre de SubCategoria</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="nombre" value="<?php echo $_GET["nombre"]; ?>"  disabled>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="descripcion">Descripción</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="descripcion" value="<?php echo $_GET["descripcion"]; ?>" disabled>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="estado">Estado</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="estado" value="<?php echo $_GET["estado"]; ?>" disabled>
        </div>
      </div>


             


      <div class="form-group"><br>
        <div class="col-md-12"><br>
          <input type="submit" class="btn btn-primary" name="delete_sub_categoria" value="ELIMINAR">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>

