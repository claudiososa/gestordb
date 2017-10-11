<form class="form-horizontal" action="index.php?mod=slat&men=escuelas&id=25" method='POST'>
  <div class="form-group">
    <label class="col-md-3 col-md-offset-2"><h3>Busqueda de Escuelas</h3></label>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2">Número</label>
    <div class="col-md-10">
      <div class="row">
         <div class="col-sm-5">
            <input type="text" size="4" class="form-control"  name="numero" placeholder="Ingrese número" autofocus>
         </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-2">CUE</label>
    <div class="col-md-10">
      <div class="row">
         <div class="col-sm-5">
            <input type="text" size="4" class="form-control"  name="cue" placeholder="Ingrese CUE" autofocus>
         </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-2">Nombre</label>
    <div class="col-md-10">
      <div class="row">
         <div class="col-sm-5">
            <input type="text" size="4" class="form-control"  name="nombre" placeholder="Ingrese nombre" autofocus>
         </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-2">Departamento</label>
    <div class="col-md-10">
      <div class="row">
         <div class="col-sm-5">
           <?php
           $departamento= new Departamentos();
               $total=$departamento->getTotal();
               echo "<select class='form-control' name='localidadId'>";
                 echo	"<option value='NULL'>Todos</option>";
               for($val=2;$val<=$total;$val++) {
                 $departamento= new Departamentos($val);
                 $dato=$departamento->getDepartamento();
                 echo	"<option value='".$dato->getDepartamentoId()."' >".$dato->getDescripcion()."</option>";
                 }
               echo "</select>";?>

         </div>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-2">Nivel</label>
    <div class="col-md-10">
      <div class="row">
         <div class="col-sm-5">
         <select class='form-control' name="nivel">
           <option value="0" label="Todos">Todos</option>
           <option value="Sin registrar" label="Sin registrar">Sin registrar</option>
             <option value="Primaria Común" label="Primaria Común">Primaria Común</option>
             <option value="Primaria Especial" label="Primaria Especial">Primaria Especial</option>
             <option value="Secundaria Común" label="Secundaria Común">Secundaria Común</option>
             <option value="Secundaria Técnica" label="Secundaria Técnica"  >Secundaria Técnica</option>
             <option value="Secundaria Rural" label="Secundaria Rural">Secundaria Rural</option>
             <option value="ISFD" label="ISFD">ISFD</option>
             <option value="IEM" label="IEM">IEM</option>
             <option value="Capacitación" label="Capacitación">Capacitación</option>

         </select>
         </div>
       </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-md-2 col-md-offset-2">
      <input type='submit' class="btn btn-primary" value='Buscar'>
    </div>
  </div>

</form>
