

<div class="container">
  <form class="form-horizontal" action='' method='POST'>
    <div class="form-group">
      <label class="col-md-3 col-md-offset-2"><h3>Carga de Imagenes</h3></label>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Imagen ID</label>
      <div class="col-md-10">
        <div class="row">
           <div class="col-sm-5">
              <input type="text" size="4" class="form-control"  name="escuelaId" value="101" disabled>
           </div>
           </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Informe ID</label>
      <div class="col-md-10">
        <div class="row">
           <div class="col-sm-5">
              <input type="text" size="4" class="form-control"  name="personaId" placeholder="" autofocus>
           </div>
        </div>
      </div>
    </div>


    
    <div id="wrap">
    <label class="control-label col-md-2">Carga de Imagenes</label>
      <div class="field">
      <ul class="options">
      
          <li>
                              <input type="file" id="myfile" name="myfile" class="rm-input" onchange="selectedFile();"/></li>
          <li>
      <div id="fileSize"></div></li>
          <li>
      <div id="fileType"></div></li>
          <li>
                              <input type="button" value="Subir Archivo" onClick="uploadFile()" class="rm-button" /></li>
      </ul>
      </div>
    
      </div>




    <div class="form-group">
      <div class="col-md-2 col-md-offset-2">
        <input type='submit' class="btn btn-primary" name="enviarImagen" value='Enviar'>
      </div>
    </div>
  </form>
</div>
<div class="table-responsive">
<div class="container">
