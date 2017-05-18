

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Modificar Documento
    </div>
    <div class="panel-body">

   
    <form name="formArchivoModif" enctype="multipart/form-data" class="" id="formDocModif" action="" method="post">


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">Titulo del Documento</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="tituloDoc" value='<?php echo $_GET["titulo"]; ?>'>
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="descripcion">Descripción</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="descripcion" value='<?php echo $_GET["descripcion"]; ?>'>
        </div>
      </div>

       <div class="form-group">
        <div class="col-md-12">
          <label class="control-label">Categoría</label>
        </div>
        <div class="col-md-12">
        <select  class="form-control" id="tipo" name="categoria_doc">
             
              <?php //echo  "<option value='0'> Seleccionar</option>";

              		echo "<option value='".$_GET["categoriaDocId"]."'>".$_GET["nombreCategoria"]."</option>";
              ?>
              <?php
                //$selected="";
                //$selected="selected ";
                while($fila=mysqli_fetch_object($buscarcategoria)){
                  
                  echo "<option value='".$fila->categoriaDocId."'>".$fila->categoriaDocId."-".$fila->nombreCategoria."</option>";
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
           <?php echo  "<option value='".$_GET["destacado"]."'>".$_GET["destacado_nombre"]."</option>"; ?>
            <option value="1">SI</option>
            <option value="0">NO</option>
          </select>
        </div>
      </div>


     <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="adjuntar">Adjuntar Archivo</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="archivo" value='<?php echo $_GET["nombreArchivo"]; ?>'>
        </div>
      </div>

       <div class="form-group">  
           <div class="col-md-12">
            <label class="control-label">Permisos Documentos</label>
           </div>
         
         <div class="col-sm-6" id="permisodoc">
            <ul class="form-group" id="subtipo" name="subtipo">
              
             <?php 

              $seleccion=$_GET["permiso"];

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
          <input type="submit" class="btn btn-primary" name="modif_doc" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>



