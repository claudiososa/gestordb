<script type="text/javascript" src="includes/mod_cen/formularios/js/mod_doc.js"></script>
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Modificar Documento</div>
    <div class="panel-body">
      <form name="formArchivoModif" enctype="multipart/form-data" class="" id="formDocModif" action="" method="post">
        <input type="hidden" name="documentoId" value="<?php echo $datoDocumento->documentoId; ?>">
        <input type="hidden" name="nombreArchivo" value="<?php echo $datoDocumento->nombreArchivo; ?>">
      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">Titulo del Documento</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" maxlength="50" name="tituloDoc" id="tituloDoc"value='<?php echo $datoDocumento->titulo; ?>'>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="descripcion">Descripción</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" maxlength="120" id="descripcion"name="descripcion" value='<?php echo $datoDocumento->descripcion; ?>'>
        </div>
      </div>

       <div class="form-group">
        <div class="col-md-12">
          <label class="control-label">Categoría</label>
        </div>
        <div class="col-md-12">
        <select  class="form-control" id="tipo" name="categoria_doc">

              <?php //echo  "<option value='0'> Seleccionar</option>";

              		//echo "<option value='".$datoDocumento->categoriaDocId."'>".$_GET["nombreCategoria"]."</option>";
              ?>
              <?php
                //$selected="";
                //$selected="selected ";
                while($fila=mysqli_fetch_object($buscarcategoria)){
                  if ($fila->categoriaDocId==$datoDocumento->categoriaDocId) {
                    echo "<option selected value='".$fila->categoriaDocId."'>".$fila->categoriaDocId."-".$fila->nombreCategoria."</option>";  # code...
                  }else{
                  echo "<option value='".$fila->categoriaDocId."'>".$fila->categoriaDocId."-".$fila->nombreCategoria."</option>";
                  }
                 // $selected="";
                }

              ?>
        </select>
        </div>
    </div>

     <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="destacado">Destacado</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="destacado">
           <?php
           if ($datoDocumento->destacado==1) {
            echo '<option selected value="1">SI</option>';
           }else{
            echo '<option value="1">SI</option>';
           }

           if ($datoDocumento->destacado==0) {
            echo '<option selected value="0">NO</option>';
           }else{
            echo '<option value="0">NO</option>';
           }
           ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label">Documento Actual</label>
        </div>
        <div class="col-md-12">

          <?php
          echo '<a href="documentacion/'.$datoDocumento->nombreArchivo.'">Descargar Documento Actual</a>';
          ?>
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label">Adjuntar archivos (Peso máximo por archivo 1024 kb)</label>
        </div>
        <div class="col-md-12" id="input2">
          <input id="input-img" name="input-img[]"  multiple="true" type="file" class="file-loading">
        </div>
      </div>

       <div class="form-group">
           <div class="col-md-12">
            <label class="control-label">Permisos Documentos</label>
           </div>

         <div class="col-sm-6" id="permisodoc">
            <ul class="form-group" id="subtipo" name="subtipo">

             <?php

              $seleccion=$permisos;

          while($fila = mysqli_fetch_object($buscarTipoPermiso))
          {
               if (strpos($seleccion, $fila->tipoReferente))
                  {
                    echo '<li class="checkbox"><input type="checkbox" name="tipo[]" value='.$fila->tipoReferente.' checked>'.$fila->tipoReferente.'</li>';
                  }
                    else
                    {
                      echo '<li class="checkbox"><input type="checkbox" name="tipo[]" value='.$fila->tipoReferente.'>'.$fila->tipoReferente.'</li>';
                     }
           }
             ?>

            </ul>
          </div>
          </div>




      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" id="btn-ndoc"name="modif_doc" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>
