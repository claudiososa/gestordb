<script type="text/javascript" src="views/js/graphic/Chart.min.js"></script>
<script type="text/javascript" src="views/js/graphicChart.PieceLabel.js-master/build/Chart.PieceLabel.min.js"></script>
<div class="container">


<?php
$students = new controllerStatis();

echo '<br><br><br><br><br><br><br>';
echo '<h6>Alumnos Total  <label class="btn btn-primary">'.$students->totalStudentsController().'</label></h6><br>';
echo '<h6>Alumnos de Turno Mañana  <label class="btn btn-primary">'.$students->totalStudentsController('Mañana').'</label></h6><br>';
echo '<h6>Alumnos de Turno Tarde <label class="btn btn-primary">'.$students->totalStudentsController('Tarde').'</label></h6><br>';


$asistenciaGeneral=$students->attendanceStudentsController();

$asistenciaTurnoTarde=$students->attendanceStudentsController('Tarde');

$asistenciaTurnoMañana=$students->attendanceStudentsController('Mañana');

$turnos = array(
array("Mañana", $students->totalStudentsController('Mañana')),
array("Tarde", $students->totalStudentsController('Tarde'))
);
//
?>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading"><h5>Cantidad de alumnos por Turnos</h5></div><br>
      <div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
        <canvas id="myChart4" width="600" height="300"></canvas>
        <?php
          echo $students->grafico('pie',$turnos,'myChart4');
        ?>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading"><h5>Cantidad General de Presentes, Ausentes, Media Falta, Justificada</h5></div><br>
      <div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
        <canvas id="myChart3" width="600" height="300"></canvas>
        <?php
          echo $students->grafico('bar',$asistenciaGeneral,'myChart3');
        ?>
      </div>
    </div>
  </div>
</div>
<br><br>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading"><h5>Asistencia de turno tarde</h5></div><br>
      <div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
        <canvas id="myChart6" width="600" height="300"></canvas>
        <?php
          echo $students->grafico('bar',$asistenciaTurnoTarde,'myChart6');
        ?>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading"><h5>Asistencia de turno Mañana </h5></div><br>
      <div class="panel-body"><!--contenido de grafica instituciones con energia electrica-->
        <canvas id="myChart7" width="600" height="300"></canvas>
        <?php
          echo $students->grafico('bar',$asistenciaTurnoMañana,'myChart7');
        ?>
      </div>
    </div>
  </div>
</div>


<?php
$cursos =$students->listCoursesController("Tarde");
echo '<br><br><br><br>';
echo '<h6>Cursos turno tarde<h6> <br><br>';
echo '<div class="row">';
foreach ($cursos as $key => $value) {
  $id=$cursos[$key][0];
  $cant =$students->totalCourseController($cursos[$key][0]);
  $attendance=$students->attendanceCourseController($cursos[$key][0]);
  $presente=0;$ausente=0;$justificada=0;$mediaFalta=0;
  foreach ($attendance as $key1 => $value) {
    //echo $attendance[$key][3];
    switch ($attendance[$key1][3]) {
      case 'P':
        $presente++;
        break;
      case 'A':
        $ausente++;
        break;
      case 'M':
        $mediaFalta++;
        break;
      case 'J':
        $justificada++;
        break;
      default:
        # code...
        break;
    }
  }
  $asistenciaCurso = array(
  array("Presente", $presente),
  array("Ausente", $ausente),
  array("MediaFalta", $mediaFalta),
  array("Justificada", $justificada)
  );

    echo '<div class="col-md-6">';

  //echo '<div>Curso: '.$cursos[$key][1].'Turno : '.$cursos[$key][2].' Cantidad de Alumnos:'.$cant.'</div>';
      //
      echo ' <div id="accordion" role="tablist" aria-multiselectable="true">
              <div class="card">
                  <div class="card-header" role="tab" id="heading'.$id.'">
                    <h6 class="mb-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$id.'" aria-expanded="true" aria-controls="collapse'.$id.'">';
                            echo 'Curso:&nbsp '.$cursos[$key][1].'&nbsp&nbsp&nbspTurno : '.$cursos[$key][2].'<br> Cantidad de Alumnos:&nbsp&nbsp'.$cant;
                  echo '</a>
                  </h6>
              </div>';
      echo '<div id="collapse'.$id.'" class="collapse hide" role="tabpanel" aria-labelledby="heading'.$id.'">
      <div class="card-block">
        <canvas id="'.$cursos[$key][0].'" width="600" height="300"></canvas>';
        echo $students->grafico("pie",$asistenciaCurso,"$id");
        echo '</div>
    </div>
  </div></div></div>';
}
echo '</div>';
$cursos=$students->listCoursesController("Mañana");
echo '<br><br><br><br>';
echo 'Cursos turno Mañana <br><br>';
echo '<div class="row">';
foreach ($cursos as $key => $value) {
  $id=$cursos[$key][0];
  $cant =$students->totalCourseController($cursos[$key][0]);
  $attendance=$students->attendanceCourseController($cursos[$key][0]);
  $presente=0;$ausente=0;$justificada=0;$mediaFalta=0;
  foreach ($attendance as $key1 => $value) {
    //echo $attendance[$key][3];
    switch ($attendance[$key1][3]) {
      case 'P':
        $presente++;
        break;
      case 'A':
        $ausente++;
        break;
      case 'M':
        $mediaFalta++;
        break;
      case 'J':
        $justificada++;
        break;
      default:
        # code...
        break;
    }
  }
  $asistenciaCurso = array(
  array("Presente", $presente),
  array("Ausente", $ausente),
  array("MediaFalta", $mediaFalta),
  array("Justificada", $justificada)
  );

    echo '<div class="col-md-6">';
    echo ' <div id="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="heading'.$id.'">
                  <h6 class="mb-0">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$id.'" aria-expanded="true" aria-controls="collapse'.$id.'">';
                          echo 'Curso:&nbsp '.$cursos[$key][1].'&nbsp&nbsp&nbspTurno : '.$cursos[$key][2].'<br> Cantidad de Alumnos:&nbsp&nbsp'.$cant;
                echo '</a>
                </h6>
            </div>';
    echo '<div id="collapse'.$id.'" class="collapse hide" role="tabpanel" aria-labelledby="heading'.$id.'">
    <div class="card-block">
      <canvas id="'.$cursos[$key][0].'" width="600" height="300"></canvas>';
      echo $students->grafico("pie",$asistenciaCurso,"$id");
      echo '</div>
  </div>
</div></div></div>';
}
echo '</div>'; ?>
</div>
 <script type="text/javascript" src="views/js/graphic/botongrafico.js"></script>
