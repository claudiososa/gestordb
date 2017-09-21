<form class="" action="" method="post">
  <hr>
  <div class="form-group">
    <label  for="horaDia">Dia</label>
    <input type="text" name="horaDia" value="" readonly="">
  </div>

  <div class="form-group">
    <label  for="HoracourseName">Curso</label>
    <select class="form-control" name="HoracourseName" id="HoracourseName">
      <option value="0">Seleccione</option>
      <?php
      while ($fila = mysqli_fetch_object($cursosActuales2)) {
        echo '<option value="0">'.$fila->curso.'-'.$fila->division.'-Turno:'.Cursos::turno($fila->turno).'</option>';
      }
       ?>
    </select>
  </div>

  <div class="form-group">
    <label  for="horaTeacherName">Profesor/a</label>
    <select class="form-control" name="horaTeacherName" id="horaTeacherName">
        <option value="0">Seleccione</option>
        <?php
        while ($fila = mysqli_fetch_object($profesoresActuales2)) {
          echo '<option value="0">'.$fila->nombre.'-'.$fila->apellido.'</option>';
        }
         ?>
    </select>
  </div>

  <div class="form-group">
    <label  for="asignatura">Asignatura</label>
    <select class="form-control" name="asignatura" id="asignatura">
        <option value="0">Seleccione</option>
        <option value="1">Matematica</option>
        <option value="2">Lengua</option>

    </select>
  </div>

  <div class="form-group">
    <label  for="horaInicio">Hora Inicio</label><br>
    <input type="text" name="" class="timepicker" value="">
  </div>

  <div class="form-group">
    <label  for="horaFinal">Hora Final</label><br>
    <input type="text" name="" class="horaFinal" value="">
  </div>

 <button type="button" id="saveHour" class="btn btn-warning" name="button">Guardar Hora</button>
</form>
