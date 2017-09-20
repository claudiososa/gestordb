<form class="" action="" method="post">
  <div class="form-group">
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
        <option value="1ra">1ra</option>
        <option value="2da">2da</option>
        <option value="3ra">3ra</option>
        <option value="4ta">4ta</option>
        <option value="5ta">5ta</option>
        <option value="6ta">6ta</option>
        <option value="7ma">7ma</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
        <option value="G">G</option>
    </select>
  </div>

  <div class="form-group">
    <label  for="turn">Turno</label>
    <select class="form-control" name="turn" id="turn">
        <option value="0">Seleccione</option>
        <option value="M">Mañana</option>
        <option value="I">Intermedio</option>
        <option value="T">Tarde</option>
        <option value="V">Vespertino</option>
        <option value="N">Noche</option>
    </select>
  </div>

  <div class="form-group">
    <label  for="quantityStudents">Cantidad Alumnos</label>
    <br>
    <input type="number" name="quantityStudents" min="1" max="50" value="1" id="quantityStudents">
  </div>
  <input type="hidden" name="escuelaId" id="escuelaId" value="<?php echo $_GET['escuelaId'] ?>">
 <button type="button" id="saveCourse" class="btn btn-warning" name="button">Guardar Curso</button>
</form>
