

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Modificar Categoría de Documentos
    </div>
    <div class="panel-body">

      <form class="" action="" method="post">
      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">Nombre de Categoría</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="nombre" value='<?php echo $_GET["nombreCategoria"]; ?>'>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="descripcion">Descripción</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="descripcion" value='<?php echo $_GET["descripcionCategoria"]; ?>'>
        </div>
      </div>

     
          <div class="col-sm-6">
            <ul>
              <?php
              $seleccion=$_GET["tipoReferente"];
             
             
              while ($fila = mysqli_fetch_object($buscarTipoReferente))
              {

                  if (strpos($seleccion, $fila->tipo)){


                    echo '<li class="checkbox"><input type="checkbox" name="tipo[]" value='.$fila->tipo.' checked>'.$fila->tipo.'</li>'; }
                    else{
                      echo '<li class="checkbox"><input type="checkbox" name="tipo[]" value='.$fila->tipo.'>'.$fila->tipo.'</li>';


                    }
              }
              ?>
            </ul>
          </div>


      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="modif_categoria_doc" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>