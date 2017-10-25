<div class="card">
<?php

  $courses = new ControllerCourse();
  $mycourses = $courses->myCoursesController($_SESSION["user_id"]);
  //var_dump($mycourses);

  echo '<div class="container"> <div class="table-responsive"><br><br><br><br><br>
  <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Curso</th>
              <th>Turno</th>
              <th>Asistencia</th>
              <th>Administrar Alumnos</th>
              <th>Asistencia Anterior</th>
            </tr>
          </thead>
          <tbody>
  ';
  foreach ($mycourses as $key => $value) {
    echo '<tr><td>'.$value["course_id"].'</td>';
    echo '<td>'.$value["name"].'</td>';
    echo '<td>'.$value["turn"].'</td>';
    echo '<td><a class="btn btn-primary" href="index.php?action=attendance&id='.$value["course_id"].'">Tomar Asistencia</a></td>';
    echo '<td><a class="btn btn-primary" href="index.php?action=inscription&id='.$value["course_id"].'">Inscribir Alumnos</a></td>';
    echo '<td><a class="btn btn-primary" href="index.php?action=attendanceDate&id='.$value["course_id"].'">Asistencia Anterior</a></td>';


  }
  echo '
        </tbody>
        </table></div></div>';

?>
</div>
