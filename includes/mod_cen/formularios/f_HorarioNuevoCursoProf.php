<form class="" action="" method="post">
  <div class="col-md-6">
  <div class="form-group">
    <br>
    <label  for="courseName">Curso</label>
    <select class="form-control" name="courseName" id="courseName">
        <option value="0">Seleccione</option>
        <option value="1">1°</option>
        <option value="2">2°</option>
        <option value="3">3°</option>
        <option value="4">4°</option>
        <option value="5">5°</option>
        <option value="6">6°</option>
        <option value="7">7°</option>
    </select>
  </div>

  <div class="form-group">
    <label  for="divisionName">Division</label>
    <select class="form-control" name="divisionName" id="divisionName">
        <option value="0">Seleccione</option>
        <option value="1">1ra</option>
        <option value="2">2da</option>
        <option value="3">3ra</option>
        <option value="4">4ta</option>
        <option value="5">5ta</option>
        <option value="6">6ta</option>
        <option value="7">7ma</option>
        <option value="8">8va</option>
        <option value="9">9na</option>
        <option value="10">10ma</option>
        <option value="11">11va</option>
        <option value="Otro">Otro</option>
    </select>
  </div>

  <div class="form-group">
    <label  for="turn">Turno</label>
    <select class="form-control" name="turn" id="turn">
      <option value="0">Seleccione</option>
      <option value="Mañana">Mañana</option>
      <option value="Intermedio">Intermedio</option>
      <option value="Tarde">Tarde</option>
      <option value="Vespertino">Vespertino</option>
      <option value="Noche">Noche</option>
      <option value="Alternancia">Alternacia </option>
      <option value="Completo">Completo</option>
    </select>
  </div>

  <div class="form-group">
    <label  for="nivel">Nivel</label>
    <select class="form-control" name="nivel" id="nivel">
      <option value="0">Seleccione</option>
      <option value="C. Basico">Ciclo Básico</option>
      <option value="C. Basico Comun">Ciclo Básico Común</option>
      <option value="C. Basico Tecnico">Ciclo Básico Técnico</option>
      <option value="C. Orientado">Ciclo Orientado</option>
      <option value="C. Superior">Ciclo Superior</option>
      <option value="EGB">EGB</option>
      <option value="Inicial">Inicial</option>
      <option value="Polimodal">Polimodal</option>
      <option value="Secundario">Secundario</option>
      <option value="Superior">Superior</option>
    </select>
  </div>

  <div class="form-group">
    <label  for="cantidadHoras">Cantidad Horas Semanal</label>
    <br>
    <input type="number" name="cantidadHoras" min="1" max="20" value="1" id="cantidadHoras">
  </div>


    <div class="form-group">
      <label  for="tipoCargo">Tipo de Cargo</label>
      <select class="form-control" name="tipoCargo" id="tipoCargo">
        <option value="0">Seleccione</option>
        <option value="Titular">Titular</option>
        <option value="Interino">Interino</option>
        <option value="Suplente">Suplente</option>
        <option value="Otro">Otro</option>
      </select>
    </div>
  <input type="hidden" name="escuelaId" id="escuelaId" value="<?php echo $_GET['escuelaId'] ?>">
  <input type="hidden" name="id_Ed_FisicaxEscuela" id="id_Ed_FisicaxEscuela" value="<?php echo $filaProf->id_Ed_FisicaxEscuela ?>">
 <?php echo "<button type='button' id='saveCourse".$fila->escuelaId."".$filaProf->personaId."' class='btn btn-warning saveCourse' name='button'>Guardar Curso</button>" ;?>
   </div>
</form>
