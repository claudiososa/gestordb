



<div class="container">
  <form class="form-horizontal" action='' method='POST'>
    <div class="form-group">
      <label class="col-md-3 col-md-offset-2"><h3>Alta de Vice-Director</h3></label>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Escuela ID</label>
      <div class="col-md-10">
        <div class="row">
           <div class="col-sm-5">
              <input type="text" size="4" class="form-control"  name="escuelaId" value="<?php echo $_GET["escuelaId"]; ?>" disabled>
           </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2">Persona ID</label>
      <div class="col-md-10">
        <div class="row">
           <div class="col-sm-5">
              <input type="text" size="4" class="form-control"  name="personaId" placeholder="" autofocus>
           </div>
        </div>
      </div>
    </div>
    

      <div class="form-group">
    <label class="control-label col-md-2">Turno</label>
    <div class="col-md-10">
      <div class="row">
         <div class="col-sm-5">
           <select class="form-control" name="turno">
             <option value="" label="VACIO"> Seleccionar</option>
             <option value="MATUTINO" label="MATUTINO">MATUTINO</option>
             <option value="TARDE" label="TARDE">TARDE</option>
             <option value="VESPERTINO" label="VESPERTINO">VESPERTINO</option>
             <option value="NOCHE" label="NOCHE">NOCHE</option>

          </select>
         </div>
      </div>
    </div>
  </div>



    <div class="form-group">
      <div class="col-md-2 col-md-offset-2">
        <input type='submit' class="btn btn-primary" name="guardar_vicedirector" value='GUARDAR'>
      </div>
    </div>
  </form>
</div>
<div class="table-responsive">
<div class="container">
