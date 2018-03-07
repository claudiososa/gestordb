<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      Nueva AUTORIDAD
    </div>

    <div class="panel-body">

      <form class="" action="" method="post">


   <div class="form-group">
    <div class="col-md-12">

    <label class="control-label">Tipo de Autoridad</label>

      <div class="col-md-12">

          <select class="form-control" name="tipoId" >
          <?php echo  "<option value=''> Seleccionar</option>";?>

          <?php
          while($fila = mysqli_fetch_object($tipoA)) {

            //if($fila->idCategoria>0) {
              echo "<option value=".$fila->tipoId.">[".$fila->tipoReferente."]  - ".$fila->cargoAutoridad."</option>";
            //}
          }
          ?>
          </select>
         </div>

    </div>
  </div>


     <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="escuelaId">Escuela ID</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="escuelaId" value="">
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="personaId">personaId</label>
        </div>
        <div class="col-md-12">
          <input type="text" class="form-control" name="personaId" value="">
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="mañana">Mañana</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="mañana">
            <option value="1">Si</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>



      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="intermedio">Intermedio</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="intermedio">
            <option value="1">Si</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="tarde">Tarde</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="tarde">
            <option value="1">Si</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>



      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="vespertino">Vespertino</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="vespertino">
            <option value="1">Si</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="noche">Noche</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="noche">
            <option value="1">Si</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>


      <div class="form-group">
        <div class="col-md-12">
          <label class="control-label" for="extendida">Extendida</label>
        </div>
        <div class="col-md-12">
          <select class="form-control" name="extendida">
            <option value="1">Si</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>



      <div class="form-group"><br>
        <div class="col-md-12">
          <input type="submit" class="btn btn-primary" name="guardar_nuevaAutoridad" value="Guardar">
        </div>
      </div>

      </form>
    </div>
    </div>
</div>
