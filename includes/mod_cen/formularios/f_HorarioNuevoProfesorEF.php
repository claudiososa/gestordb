<div id="formNewTeacher" class="col-md-12">
  <hr />
  <form class="" action="" method="post">
    <div class="form-group">
      <label  for="teacherDni">DNI</label>
      <input type="text" name="teacherDni" id="teacherDni" value="">
    </div>
    <input type="hidden" name="escuelaId2" id="escuelaId2" value="<?php echo $_GET['escuelaId'] ?>">
    <button type="button" id="searchTeacher" class="btn btn-warning" name="button">Buscar Profesor</button>
  </form>
</div>
<div class="formNewPerson" id="formNewPerson">
  <form class="" action="" method="post">
    <div class="form-group">
      <label  for="nameTeacher">Nombre</label><br>
      <input type="text" name="nameTeacher" id="nameTeacher" value="">
    </div>
    <div class="form-group">
        <label  for="surnameTeacher">Apellido</label><br>
        <input type="text" name="surnameTeacher" id="surnameTeacher" value="">
    </div>
    <div class="form-group">
      <label  for="phoneTeacher">Telefono</label><br>
      <input type="text" name="phoneTeacher" id="phoneTeacher" value="">
    </div>
    <div class="form-group">
      <label  for="emailTeacher">Email</label><br>
      <input type="text" name="emailTeacher" id="emailTeacher" value="">
    </div>



    <div class="form-group">
      <label  for="titulo">Titulo</label><br>
      <input type="text" name="titulo" id="titulo" value="">
    </div>
    <input type="hidden" id="statusTeacher" name="statusTeacher" value="">
    <input type="hidden" id="personaId" name="personaId" value="">
    <input type="hidden" id="cuilTeacher" name="cuilTeacher" value="">
    <button type="button" id="saveTeacher" class="btn btn-warning" name="button">Guardar Profesor</button>
  </form>
</div>
