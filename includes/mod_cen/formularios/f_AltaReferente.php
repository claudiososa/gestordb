<form class="" action="" method="post">
  <label for="">Persona Id</label>
  <input type="text" name="personaId" value="<?php if(isset($_POST["personaId"]) && $guardar=="Error al guardar") echo $_POST["personaId"]; ?>">
  <label for="">Tipo</label>
  <input type="text" name="tipo" value="<?php if(isset($_POST["tipo"]) && $guardar=="Error al guardar") echo $_POST["tipo"]; ?>">
  <label for="">rol</label>
  <input type="text" name="rol" value="<?php if(isset($_POST["rol"]) && $guardar=="Error al guardar") echo $_POST["rol"]; ?>">
  <label for="">EtJ Cargo</label>
  <input type="text" name="etjcargo" value="<?php if(isset($_POST["etjcargo"]) && $guardar=="Error al guardar") echo $_POST["etjcargo"]; ?>">
  <label for="">Fecha ingreso</label>
  <input type="date" name="fechaIngreso" value="<?php if(isset($_POST["fechaIngreso"]) && $guardar=="Error al guardar") echo $_POST["fechaIngreso"]; ?>">
  <label for="">titulo</label>
  <input type="text" name="titulo" value="<?php if(isset($_POST["titulo"]) && $guardar=="Error al guardar") echo $_POST["titulo"]; ?>">
  <label for="">Estado</label>
  <input type="text" name="estado" value="<?php if(isset($_POST["estado"]) && $guardar=="Error al guardar") echo $_POST["estado"]; ?>">
  <input type="submit" name="guardar_referente" value="Guardar">
</form>
