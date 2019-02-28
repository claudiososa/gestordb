<script type="text/javascript" src="includes/mod_cen/formularios/js/f_nuevoDoc.js"></script>
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-5 col-8 align-self-center">
        <h5 class=" m-b-0 m-t-0">Subir Documento</h5>

      </div>

    </div>
    <div class="card">

      <div class="card-body">


        <form name="formArchivo" enctype="multipart/form-data" class="" id="formDoc" action="index.php?mod=slat&men=informe&id=17" method="post">


        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label" for="nombre">Titulo del Documento</label>
          </div>
          <div class="col-md-12">
            <input type="text" id="tituloDoc" class="form-control" name="tituloDoc" maxlength="50" value="">
          </div>
        </div>


        <div class="form-group">
          <div class="col-md-12">
            <label class="control-label" for="descripcion">Descripción</label>
          </div>
          <div class="col-md-12">
            <input type="text" id="descripcion" class="form-control" maxlength="120" name="descripcion" value="">
          </div>
        </div>


         <div class="form-group">
          <div class="col-md-12">
            <label class="control-label">Categoría</label>
          </div>
          <div class="col-md-12">
          <select  class="form-control" id="tipo" name="categoria_doc">

                <?php echo  "<option value='0'> Seleccionar</option>";?>
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
                <option value="0">NO</option>
                <option value="1">SI</option>

            </select>
          </div>
        </div>

        <div class="form-group" >
          <div class="col-md-12">
            <label class="control-label">Adjuntar archivos (Peso máximo por archivo 10 MB)</label>
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

              </ul>
            </div>

            </div>





        <div class="form-group"><br>
          <div class="col-md-12">
            <input type="submit" class="btn btn-primary" id="btn-ndoc" name="guardar_doc" value="Guardar">
          </div>
        </div>

        </form>
      </div>
      </div>
  </div>

</div>
