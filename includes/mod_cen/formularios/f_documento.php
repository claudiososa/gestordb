<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Nuevo Documento
    </div>
    <div class="panel-body">

      <form class="" action="" method="post">



      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="nombre">Titulo del Documento</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="tituloDoc" value="">
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
          <label class="control-label" for="destacado">Destacado</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="destacado">
            <option value="1">SI</option>
            <option value="0">NO</option>
          </select>
        </div>
      </div>


      <div id="wrap">
        <label class="control-label" for="adjuntar">Adjuntar Archivo</label>
       <div class="field">
         <ul class="options">
          <li>
        <input type="file" id="myfile" name="myfile" class="rm-input" onchange="selectedFile();"/></li>
          <li>
      <div id="fileSize"></div></li>
    <li>
    <div id="fileType"></div></li>
   
   </ul>
   </div>
  
  </div>




          
       <div class="col-sm-6">
        <label class="control-label" for="permisos">Permisos</label>
            <ul>
              <?php
              while ($fila = mysqli_fetch_object($buscarTipoReferente))
              {
                    echo '<li class="checkbox"><input type="checkbox" name="tipo[]" value='.$fila->tipo.'>'.$fila->tipo.'</li>';
              }
              ?>
            </ul>
          </div>


      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="guardar_doc" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>
