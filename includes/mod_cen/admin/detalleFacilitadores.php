
<style type="text/css">
hr {
    border-top: 2px solid #59AE1E;
  }

</style>

<?php

require_once("includes/mod_cen/clases/informe.php");
require_once("includes/mod_cen/clases/persona.php");
require_once("includes/mod_cen/clases/referente.php");
require_once("includes/mod_cen/clases/HorarioFacilitadores.php");
require_once("includes/mod_cen/clases/SumarTiempos.class.php");
require_once("includes/mod_cen/clases/CursoFacilitadores.php");


$informes= new informe();
//create object referenteId and filter of status active
$referenteId=$_SESSION['referenteId'];

//$referente= new Referente($referenteId);
//$resultado_ett_acargo = $referente->Cargo("Activo");

$referente_ett= new Referente(null,null,"Facilitador");
$buscar_ett=$referente_ett->Tipo("Facilitador","Activo");
//var_dump($buscar_ett);
// todos los informes creados por referente Conectar Igualdad
//$arrayFacilitadores = array ('Facilitador','CoordinadorFacilitador');
//$informeEquipoSupevisorSecundaria = $informes->buscar(20,null,$arrayFacilitadores);
//$nFacilitador = 0;

echo '<div class="container">';


echo'<div class="col-md-1"><img class="img-responsive img-circle" src="includes/mod_cen/portada/imgPortadas/contrato (2).png"></div><h4><b>Informes Facilitadores</b><img class="img-responsive img-circle" onclick="history.back()" align="right" src="includes/mod_cen/portada/imgPortadas/back/flecha-hacia-la-izquierda (7).png"></h4>';

echo '<hr>';

echo'<br>';
echo'<br>';
echo'<br>';


    echo "<p class=''><h3>Lista de Facilitadores</h3></p>";
    echo "<table class='table table-hover table-striped table-condensed tablesorter'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>N</th>";
    echo "<th>Apellido y Nombre</th>";
    echo "<th>Total</th>";
    echo "<th>Mes Actual</th>";
    echo "<th>Horario</th>";
    echo "<th>Alumnos</th>";
    echo "<th>M</th>";
    echo "<th>I</th>";
    echo "<th>T</th>";
    echo "<th>V</th>";
    echo "<th>N</th>";
    echo "<th>Cant Cursos</th>";
    echo "<th>Cant Prof.</th>";
    echo "<th>Total Horas</th>";
    echo "<th>Hora Catedra</th>";
    echo "<th>Hora Sandwich</th>";
    echo "</tr>";
    echo "</thead>";

    $cursoFacil = new CursoFacilitadores();
    $horario = new HorarioFacilitadores();

    echo "<tbody id='bodyTablaCargo'>";

  while ($fila=mysqli_fetch_object($buscar_ett)){
      $nFacilitador++;
      $horario->referenteId=$fila->referenteId;

      $datoHorario= $horario->buscar();
      $tiempos = array();
      $horaCatedra = array();
      $horaSandwich = array();

      while ($filaR = mysqli_fetch_object($datoHorario)) {
        //var_dump($filaR->horaSalida);

        $horaI = $filaR->horaIngreso;
        $horaS = $filaR->horaSalida;
        //echo $horaI."--".$horaS.'<br>';
        //var_dump($horaI);
        //var_dump($horaS);
        //echo '<br><br>';
        $date1='2016-11-30 '.$horaI;
        $date2='2016-11-30 '.$horaS;
        //var_dump($date1);
        //var_dump($date2);

        $fecha1 = new DateTime($date1);//fecha inicial
        $fecha2 = new DateTime($date2);//fecha de cierre

        $intervalo = $fecha1->diff($fecha2);
        //print $intervalo->format("%H:%I:%S");
        $nuevaHora =$intervalo->format("%H:%I:%S").'.00';

        //$sumaHora =$intervalo->format('%Y años %m meses %d days %H horas %i minutos
        //%s segundos');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos

        //var_dump($intervalo);
        //echo $nuevaHora.'<br><br>';

        if ($filaR->cursoFacilitadoresId==1) {
          array_push($horaSandwich,$nuevaHora);
        }else{
          array_push($horaCatedra,$nuevaHora);
        }

        array_push($tiempos,$nuevaHora);
        //var_dump($tiempos);

        // Inicializamos el tiempo


        //$horaIngreso = 'casa';
        //$hora2 = $filaR->horaSalida;

      }

      $tiempoInicial = new SumaTiempos();
      $tiempoCatedra = new SumaTiempos();
      $tiempoSandwich = new SumaTiempos();
      // Recorremos los tiempos y los vamos sumando
      foreach ($tiempos as $parcial) {
          $tiempoInicial->sumaTiempo(new SumaTiempos($parcial));
      }

      foreach ($horaCatedra as $parcial) {
          $tiempoCatedra->sumaTiempo(new SumaTiempos($parcial));
      }

      foreach ($horaSandwich as $parcial) {
          $tiempoSandwich->sumaTiempo(new SumaTiempos($parcial));
      }

      // Mostramos el tiempo final

      $cantidadHoras = substr($tiempoInicial->verTiempoFinal(),0,8);
      $cantidadCatedra = substr($tiempoCatedra->verTiempoFinal(),0,8);
      $cantidadSandwich = substr($tiempoSandwich->verTiempoFinal(),0,8);


      $cursoFacil->referenteId=$fila->referenteId;
      $alumnos = $cursoFacil->cantidades(); //cantidad total de alumnos para este referente
      $alumnosTotales = $alumnosTotales + $alumnos->alumnos;

      $alumnosM = $cursoFacil->cantidades('M');
      $alumnosMT= $alumnosMT+$alumnosM->alumnos;
      $alumnosI = $cursoFacil->cantidades('I');
      $alumnosIT= $alumnosIT+$alumnosI->alumnos;
      $alumnosT = $cursoFacil->cantidades('T');
      $alumnosTT= $alumnosTT+$alumnosT->alumnos;
      $alumnosV = $cursoFacil->cantidades('V');
      $alumnosVT= $alumnosVT+$alumnosV->alumnos;
      $alumnosN = $cursoFacil->cantidades('N');
      $alumnosNT= $alumnosNT+$alumnosN->alumnos;

      $cantidadCursos = $cursoFacil->cantidadCursos();
      $totalCursos = $totalCursos + $cantidadCursos;

      $profesores = $cursoFacil->cantidadProfesores();
      $totalProfesores = $totalProfesores + $profesores;
      //var_dump($alumnos);

      echo "<tr>";
      echo "<td>".$nFacilitador."</td>";
      echo "<td><a href='index.php?mod=slat&men=referentes&id=2&personaId=".$fila->personaId."&referenteId=".$fila->referenteId."'>".$fila->apellido.", ".$fila->nombre."</a></td>";
      echo "<td>";
      $informe_ett= new informe(null,null,$fila->referenteId);
      $buscar_informe=$informe_ett->buscar();
      $cantidad=mysqli_num_rows($buscar_informe);

      $mesAc=date("m");
      $buscarMesActualInforme=$informe_ett->summary('mesAñoReferente',null,null,null,$mesAc,'2017',null,$fila->referenteId);
      $totalMes=mysqli_num_rows($buscarMesActualInforme);


      //echo $cantidad;
      echo '<a class="btn btn-success" href="?mod=slat&men=informe&id=6&referenteId='.$fila->referenteId.'">'.$cantidad.'</a>';
      echo "</td>";
      echo "<td>";
      echo '<a class="btn btn-success" href="?mod=slat&men=informe&date&id=6&year='.$año.'&month='.$mes.'&referenteId='.$fila->referenteId.'">'.$totalMes.'</a>';
      echo "</td>";
      echo "<td>";
      echo '<a class="btn btn-success" href="?mod=slat&men=referentes&id=12&referenteId='.$fila->referenteId.'">Ver Horario</a>';
      echo "</td>";

      echo "<td>";
      if ($alumnos->alumnos<>null) {
        echo '<a class="btn btn-success" href="?mod=slat&men=referentes&id=12&referenteId='.$fila->referenteId.'">'.$alumnos->alumnos.'</a>';
      }else{
        echo '<a class="btn btn-success" href="?mod=slat&men=referentes&id=12&referenteId='.$fila->referenteId.'">0</a>';
      }
      echo "</td>";

      echo "<td>";
      if ($alumnosM->alumnos==null) {
        echo '0';
      }else{
        echo $alumnosM->alumnos;
      }
      echo "</td>";

      echo "<td>";
      if ($alumnosI->alumnos==null) {
        echo '0';
      }else{
        echo $alumnosI->alumnos;
      }

      echo "</td>";
      echo "<td>";
      if ($alumnosT->alumnos==null) {
        echo '0';
      }else{
        echo $alumnosT->alumnos;
      }
      echo "</td>";

      echo "<td>";
      if ($alumnosV->alumnos==null) {
        echo '0';
      }else{
        echo $alumnosV->alumnos;
      }
      echo "</td>";

      echo "<td>";
      if ($alumnosN->alumnos==null) {
        echo '0';
      }else{
        echo $alumnosN->alumnos;
      }
      echo "</td>";

      echo "<td>";
      if ($cantidadCursos==null) {
        echo '0';
      }else{
        echo $cantidadCursos;
      }
      echo "</td>";

      echo "<td>";
      echo $profesores;
      echo "</td>";

      echo "<td>";
        echo $cantidadHoras;
      echo "</td>";
      echo "<td>";
        echo "<a href='#!' class='btn btn-info'>".$cantidadCatedra."<a>";
      echo "</td>";
      echo "<td>";
        echo $cantidadSandwich;
      echo "</td>";
      echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";
 ?>
    <div class="alert alert-info">
      Cantidad total de Facilitadores: <?php echo $nFacilitador ?><br>
      Cantidad total de Alumnos: <?php echo $alumnosTotales ?><br><hr>
      Turno Mañana: <?php echo $alumnosMT ?><br>
      Turno Intermedio: <?php echo $alumnosIT ?><br>
      Turno Tarde: <?php echo $alumnosTT ?><br>
      Turno Vespertino: <?php echo $alumnosVT ?><br>
      Turno Noche: <?php echo $alumnosNT ?><br><hr>
      Cantidad total de Cursos:  <?php echo $totalCursos ?><br>
      Cantidad total de profesores: <?php echo $totalProfesores ?><br>

    </div>
</div>
<br>
<center>
 <img class="img-responsive img-circle" onclick="history.back()"  src="includes/mod_cen/portada/imgPortadas/back/flecha-hacia-la-izquierda (7).png"></center>
