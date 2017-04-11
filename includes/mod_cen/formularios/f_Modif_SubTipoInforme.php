<?php

include_once("includes/mod_cen/clases/SubTipoInforme.php");
include_once("includes/mod_cen/informes/listarSubtipo.php");
include_once("includes/mod_cen/informes/update_subtipo_informe.php");
include_once("includes/mod_cen/clases/categoria.php");


$c_categoria= new categoria(null,null);
$b_referente= $c_categoria->buscar();

?>


<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      MODIFICAR SUB-CATEGORIA
    </div>

    <div class="panel-body">

      <form class="" action="" method="post">


       <div class="form-group">
        <div class="col-md-12">

        <label class="control-label" for="tipoId">Categoria</label>
        </div>

        <div class="col-md-12">

           <select class="form-control" name="tipoId" >
           "<option value='<?php echo $_GET["tipoId"]; ?>'>
                  <?php echo $_GET["tipoId"]; ?>

              </option>";



          <?php
          while($fila = mysqli_fetch_object($b_referente)) {

            if($fila->idCategoria>0) {

              echo "<option value=".$fila->idCategoria.">".$fila->idCategoria."-".$fila->nombre."</option>";
            }
          }
          ?>
          </select>

        </div>
      </div>

        <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">SubCategoria</label>
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
          <input type="text" class="form-control" name="nombre" value="<?php echo $_GET["nombre"]; ?>">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="descripcion">Descripción</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="descripcion" value="<?php echo $_GET["descripcion"]; ?>">
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="estado">Estado</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="estado" >
            <option selected value='<?php echo $_GET["estado"]; ?> '> <?php echo $_GET["estado"]; ?> </option>
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
          </select>
        </div>
      </div>



      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="modificar_sub_categoria" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>
