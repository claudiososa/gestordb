<?php
include_once("includes/mod_cen/clases/escuela.php");
include_once("includes/mod_cen/clases/Cursos.php");
include_once("includes/mod_cen/clases/Profesores.php");
include_once("includes/mod_cen/clases/referente.php");
include_once("includes/mod_cen/clases/HorarioFacilitadores.php");

$horario = new HorarioFacilitadores(null,$_GET['referenteId'],null,null,null,null,$_GET['escuelaId']);

$referente = new Referente($_GET['referenteId']);
$escuela = new Escuela();

$datoReferente = $referente->buscar();
$dato = mysqli_fetch_object($datoReferente);

?>

<div class="container">


<div class="panel panel-primary" id="dias">
  <div class="panel-heading">
    Referente: <?php echo "<b>".$dato->apellido.",".$dato->nombre."</b>" ?>
  </div>
  <div class="panel-body">
    <div class="panel panel-primary">
      <div class="panel-heading">Lunes</div>
      <div class="panel-body">
        <div class="formHorarioNuevaHora" id='divHorarioLUNES'>
          <table class="table">
            <thead>
              <tr>
                <th>Escuela</th>
                <th>Dia</th>
                <th>Hora Inicio</th>
                <th>Hora Final</th>
                <th>Asignatura</th>
                <th>Curso</th>
                <th>Turno</th>
                <th>Alumnos</th>
                <th>Profesor</th>
              </tr>
            </thead>
            <tbody id='LUNES'>
          <?php
            $horario->dia='LUNES';
            $buscarHorario = $horario->buscar();

              while ($fila = mysqli_fetch_object($buscarHorario)) {
                $escuela->escuelaId = $fila->escuelaId;
                $datoEscuela = $escuela->buscarUnico();

                if ($fila->cursoFacilitadoresId<>'1') {
                  echo "<tr id='hora".$fila->horarioFacilitadoresId."'>";
                  echo "<td>".$datoEscuela->numero."</td>";
                  echo "<td>".$fila->dia."</td>";
                  echo "<td>".$fila->horaIngreso."</td>";
                  echo "<td>".$fila->horaSalida."</td>";
                  echo "<td>".$fila->asignatura."</td>";
                  echo "<td>".$fila->curso."° ".$fila->division."</td>";
                  echo "<td>".Cursos::turno($fila->turno)."</td>";
                  echo "<td>".$fila->cantidadAlumnos."</td>";
                  echo "<td>".$fila->nombre."</td>";
                  echo '</tr>';
                }else{
                  echo "<tr class='alert alert-success' id='hora".$fila->horarioFacilitadoresId."'>";
                  echo "<td>".$datoEscuela->numero."</td>";
                  echo "<td>".$fila->dia."</td>";
                  echo "<td>".$fila->horaIngreso."</td>";
                  echo "<td>".$fila->horaSalida."</td>";
                  echo "<td colspan='5'>Hora Sandwich</td>";
                  echo '</tr>';
                }

              }
           ?>

         </tbody>
       </table>
        </div>
      </div>
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">Martes</div>
        <div class="panel-body">
          <div class="formHorarioNuevaHora" id='divHorarioMARTES'>
            <table class="table">
              <thead>
                <tr>
                  <th>Escuela</th>
                  <th>Dia</th>
                  <th>Hora Inicio</th>
                  <th>Hora Final</th>
                  <th>Asignatura</th>
                  <th>Curso</th>
                  <th>Turno</th>
                  <th>Alumnos</th>
                  <th>Profesor</th>
                </tr>
              </thead>
              <tbody id='MARTES'>
            <?php
              $horario->dia='MARTES';
              $buscarHorario = $horario->buscar();

              while ($fila = mysqli_fetch_object($buscarHorario)) {
                $escuela->escuelaId = $fila->escuelaId;
                $datoEscuela = $escuela->buscarUnico();

                if ($fila->cursoFacilitadoresId<>'1') {
                  echo "<tr id='hora".$fila->horarioFacilitadoresId."'>";
                  echo "<td>".$datoEscuela->numero."</td>";
                  echo "<td>".$fila->dia."</td>";
                  echo "<td>".$fila->horaIngreso."</td>";
                  echo "<td>".$fila->horaSalida."</td>";
                  echo "<td>".$fila->asignatura."</td>";
                  echo "<td>".$fila->curso."° ".$fila->division."</td>";
                  echo "<td>".Cursos::turno($fila->turno)."</td>";
                  echo "<td>".$fila->cantidadAlumnos."</td>";
                  echo "<td>".$fila->nombre."</td>";
                  echo '</tr>';
                }else{
                  echo "<tr class='alert alert-success' id='hora".$fila->horarioFacilitadoresId."'>";
                  echo "<td>".$datoEscuela->numero."</td>";
                  echo "<td>".$fila->dia."</td>";
                  echo "<td>".$fila->horaIngreso."</td>";
                  echo "<td>".$fila->horaSalida."</td>";
                  echo "<td colspan='5'>Hora Sandwich</td>";
                  echo '</tr>';
                }

              }
             ?>
           </tbody>
         </table>

          </div>
        </div>
        </div>
        <div class="panel panel-primary">
          <div class="panel-heading">Miércoles</div>
          <div class="panel-body">
            <div class="formHorarioNuevaHora" id='divHorarioMIERCOLES'>
              <table class="table">
                <thead>
                  <tr>
                    <th>Escuela</th>
                    <th>Dia</th>
                    <th>Hora Inicio</th>
                    <th>Hora Final</th>
                    <th>Asignatura</th>
                    <th>Curso</th>
                    <th>Turno</th>
                    <th>Alumnos</th>
                    <th>Profesor</th>
                  </tr>
                </thead>
                <tbody id='MIERCOLES'>
              <?php
                $horario->dia='MIERCOLES';
                $buscarHorario = $horario->buscar();

                while ($fila = mysqli_fetch_object($buscarHorario)) {
                  $escuela->escuelaId = $fila->escuelaId;
                  $datoEscuela = $escuela->buscarUnico();

                  if ($fila->cursoFacilitadoresId<>'1') {
                    echo "<tr id='hora".$fila->horarioFacilitadoresId."'>";
                    echo "<td>".$datoEscuela->numero."</td>";
                    echo "<td>".$fila->dia."</td>";
                    echo "<td>".$fila->horaIngreso."</td>";
                    echo "<td>".$fila->horaSalida."</td>";
                    echo "<td>".$fila->asignatura."</td>";
                    echo "<td>".$fila->curso."° ".$fila->division."</td>";
                    echo "<td>".Cursos::turno($fila->turno)."</td>";
                    echo "<td>".$fila->cantidadAlumnos."</td>";
                    echo "<td>".$fila->nombre."</td>";
                    echo '</tr>';
                  }else{
                    echo "<tr class='alert alert-success' id='hora".$fila->horarioFacilitadoresId."'>";
                    echo "<td>".$datoEscuela->numero."</td>";
                    echo "<td>".$fila->dia."</td>";
                    echo "<td>".$fila->horaIngreso."</td>";
                    echo "<td>".$fila->horaSalida."</td>";
                    echo "<td colspan='5'>Hora Sandwich</td>";
                    echo '</tr>';
                  }

                }
               ?>
             </tbody>
           </table>
            </div>
          </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">Jueves</div>
            <div class="panel-body">
              <div class="formHorarioNuevaHora" id='divHorarioJUEVES'>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Escuela</th>
                      <th>Dia</th>
                      <th>Hora Inicio</th>
                      <th>Hora Final</th>
                      <th>Asignatura</th>
                      <th>Curso</th>
                      <th>Turno</th>
                      <th>Alumnos</th>
                      <th>Profesor</th>
                    </tr>
                  </thead>
                  <tbody id='JUEVES'>
                <?php
                  $horario->dia='JUEVES';
                  $buscarHorario = $horario->buscar();

                  while ($fila = mysqli_fetch_object($buscarHorario)) {
                    $escuela->escuelaId = $fila->escuelaId;
                    $datoEscuela = $escuela->buscarUnico();

                    if ($fila->cursoFacilitadoresId<>'1') {
                      echo "<tr id='hora".$fila->horarioFacilitadoresId."'>";
                      echo "<td>".$datoEscuela->numero."</td>";
                      echo "<td>".$fila->dia."</td>";
                      echo "<td>".$fila->horaIngreso."</td>";
                      echo "<td>".$fila->horaSalida."</td>";
                      echo "<td>".$fila->asignatura."</td>";
                      echo "<td>".$fila->curso."° ".$fila->division."</td>";
                      echo "<td>".Cursos::turno($fila->turno)."</td>";
                      echo "<td>".$fila->cantidadAlumnos."</td>";
                      echo "<td>".$fila->nombre."</td>";
                      echo '</tr>';
                    }else{
                      echo "<tr class='alert alert-success' id='hora".$fila->horarioFacilitadoresId."'>";
                      echo "<td>".$datoEscuela->numero."</td>";
                      echo "<td>".$fila->dia."</td>";
                      echo "<td>".$fila->horaIngreso."</td>";
                      echo "<td>".$fila->horaSalida."</td>";
                      echo "<td colspan='5'>Hora Sandwich</td>";
                      echo '</tr>';
                    }

                  }
                 ?>
               </tbody>
             </table>
              </div>
            </div>
            </div>
            <div class="panel panel-primary">
              <div class="panel-heading">Viernes</div>
              <div class="panel-body">
                <div class="formHorarioNuevaHora" id='divHorarioVIERNES'>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Escuela</th>
                        <th>Dia</th>
                        <th>Hora Inicio</th>
                        <th>Hora Final</th>
                        <th>Asignatura</th>
                        <th>Curso</th>
                        <th>Turno</th>
                        <th>Alumnos</th>
                        <th>Profesor</th>
                      </tr>
                    </thead>
                    <tbody id='VIERNES'>
                  <?php
                    $horario->dia='VIERNES';
                    $buscarHorario = $horario->buscar();

                    while ($fila = mysqli_fetch_object($buscarHorario)) {
                      $escuela->escuelaId = $fila->escuelaId;
                      $datoEscuela = $escuela->buscarUnico();

                      if ($fila->cursoFacilitadoresId<>'1') {
                        echo "<tr id='hora".$fila->horarioFacilitadoresId."'>";
                        echo "<td>".$datoEscuela->numero."</td>";
                        echo "<td>".$fila->dia."</td>";
                        echo "<td>".$fila->horaIngreso."</td>";
                        echo "<td>".$fila->horaSalida."</td>";
                        echo "<td>".$fila->asignatura."</td>";
                        echo "<td>".$fila->curso."° ".$fila->division."</td>";
                        echo "<td>".Cursos::turno($fila->turno)."</td>";
                        echo "<td>".$fila->cantidadAlumnos."</td>";
                        echo "<td>".$fila->nombre."</td>";
                        echo '</tr>';
                      }else{
                        echo "<tr class='alert alert-success' id='hora".$fila->horarioFacilitadoresId."'>";
                        echo "<td>".$datoEscuela->numero."</td>";
                        echo "<td>".$fila->dia."</td>";
                        echo "<td>".$fila->horaIngreso."</td>";
                        echo "<td>".$fila->horaSalida."</td>";
                        echo "<td colspan='5'>Hora Sandwich</td>";
                        echo '</tr>';
                      }

                    }
                   ?>
                 </tbody>
               </table>
                </div>
              </div>
              </div>


        </div>
   </div>
  </div>
</div>
