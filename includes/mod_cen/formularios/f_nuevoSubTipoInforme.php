<?php

include_once("includes/mod_cen/clases/categoria.php");

$c_categoria= new categoria(null,null);
$b_referente= $c_categoria->buscar();

?>


<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Nuevo Subtipo de CATEGORIA
    </div>
    
    <div class="panel-body">

      <form class="" action="" method="post">
      
   
   <div class="form-group">
    <div class="col-md-12">

    <label class="control-label">Categoria</label>
      
      <div class="col-md-12">
          
          <select class="form-control" name="tipoId" >
          <?php echo  "<option value=''> Seleccionar</option>";?>
          
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
  </div>


     <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">Nombre de SubCategoria</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="nombre" value="">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="descripcion">Descripción</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="descripcion" value="">
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="estado">Estado</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="estado">
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
          </select>
        </div>
      </div>
          


      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="guardar_sub_categoria" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>