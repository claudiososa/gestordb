<script type="text/javascript" src="views/modules/course/js/validateAttendance.js"></script>
<div class="container">

<?php
if($_POST){
	$attendanceStudent1 = new ControllerAttendance();
	$attendance = new ControllerAttendance();
  //var_dump($_POST);
	//echo '<br><br>';
	//echo count($_POST);
	//
	foreach ($_POST as $key => $value) {
		if ($key <> "date" AND $key <> "submitAttendance"){
			switch ($_POST[$key]) {
				case 'Presente':
					$status='P';
					break;
				case 'Ausente':
					$status='A';
					break;
				case 'Media F.':
						$status='M';
						break;
				case 'Justificada':
								$status='J';
								break;
				case 'Doble Ausente':
								$status='AA';
								break;
				case 'Doble Tarde':
								$status='MM';
								break;
				default:
					# code...
					break;
			}
			$searchAttendance1 = $attendanceStudent1->viewAttendanceStudentController($key,$_POST['date']);
				if(isset($searchAttendance1)){
					if(count($searchAttendance1)>0){
						$attendance->updateAttendanceController($searchAttendance1[0]['attendance_id'],$key,$status);
				  }else{
						$attendance->newAttendanceController($key,$status);
					}
			  }
		}
	}
	$variablephp = "index.php?action=mycourses";
	?>

	<script type="text/javascript">
/*
		if (guardado=='agregarcompleto') {
			alert ("Aula Satelite fue creada");
		}else if(guardado=='editarcompleto'){
			alert ("Aula Satelite fue modificada");
		}else{
			alert ("Erro al guardar");
		}*/
		alert("Se guardo con éxito");
		var variablejs = "<?php echo $variablephp; ?>" ;
		 function redireccion(){window.location=variablejs;}
		 setTimeout ("redireccion()", 0);
	</script>
	<?php
}

$registro = new ControllerCourse();
$viewCourse = $registro->viewStudentController($_GET['id']);
$studends = count($viewCourse);

echo "<script>
	$(document).ready(function () {";
		foreach ($viewCourse as $key => $item) {

		echo '$("#bt'.$item['student_id'].'").click(function(){';
      //echo 'alert("hola mundo");';
      //	total1=150;
  		//	cuotas=1;
  		//	subtotal='.$y.';
  		//	siguiente='.$y.'+1;
		echo 'if($(this).attr("value")=="Presente"){';
      echo '$(this).attr("value","Ausente");';
			echo '$("#'.$item['student_id'].'").attr("value","Ausente");';
      echo '$("#tr'.$item['student_id'].'").addClass("bg-danger text-white");';
      echo '$("#bt'.$item['student_id'].'").removeClass("btn btn-success");';
      echo '$("#bt'.$item['student_id'].'").addClass("btn btn-danger");';

    echo '}else if ($(this).attr("value")=="Ausente"){';
      echo '$(this).attr("value","Media F.");';
			echo '$("#'.$item['student_id'].'").attr("value","Media F.");';
      //echo 'alert($(this).attr("value"));';
      echo '$("#tr'.$item['student_id'].'").removeClass("bg-danger text-white");';
      echo '$("#tr'.$item['student_id'].'").addClass("bg-info text-white");';
      echo '$("#bt'.$item['student_id'].'").removeClass("btn btn-danger");';
      echo '$("#bt'.$item['student_id'].'").addClass("btn btn-info");';
    echo '}else if($(this).attr("value")=="Media F."){';
			echo '$(this).attr("value","Justificada");';
			echo '$("#'.$item['student_id'].'").attr("value","Justificada");';
      //echo 'alert($(this).attr("value"));';
      echo '$("#tr'.$item['student_id'].'").removeClass("bg-info text-white");';
      echo '$("#tr'.$item['student_id'].'").addClass("bg-warning text-white");';
      echo '$("#bt'.$item['student_id'].'").removeClass("btn btn-info");';
      echo '$("#bt'.$item['student_id'].'").addClass("btn btn-warning");';
			echo '}else if($(this).attr("value")=="Justificada"){';
				echo '$(this).attr("value","Doble Ausente");';
				echo '$("#'.$item['student_id'].'").attr("value","Doble Ausente");';
	      //echo 'alert($(this).attr("value"));';
	      echo '$("#tr'.$item['student_id'].'").removeClass("bg-warning text-white");';
	      echo '$("#tr'.$item['student_id'].'").addClass("bg-inverse text-white");';
	      echo '$("#bt'.$item['student_id'].'").removeClass("btn btn-warning");';
	      echo '$("#bt'.$item['student_id'].'").addClass("btn btn-inverse");';
			echo '}else if($(this).attr("value")=="Doble Ausente"){';
					echo '$(this).attr("value","Doble Tarde");';
					echo '$("#'.$item['student_id'].'").attr("value","Doble Tarde");';
		      //echo 'alert($(this).attr("value"));';
		      echo '$("#tr'.$item['student_id'].'").removeClass("bg-inverse text-white");';
		      echo '$("#tr'.$item['student_id'].'").addClass("bg-warning text-white");';
		      echo '$("#bt'.$item['student_id'].'").removeClass("btn btn-inverse");';
		      echo '$("#bt'.$item['student_id'].'").addClass("btn btn-warning");';
			echo '}else{';
				echo '$(this).attr("value","Presente");';
				echo '$("#'.$item['student_id'].'").attr("value","Presente");';
	      //echo 'alert($(this).attr("value"));';
	      echo '$("#tr'.$item['student_id'].'").removeClass("bg-warning text-white");';
	      echo '$("#tr'.$item['student_id'].'").addClass("text-black");';
	      echo '$("#bt'.$item['student_id'].'").removeClass("btn btn-warning");';
	      echo '$("#bt'.$item['student_id'].'").addClass("btn btn-success");';
		echo '}

		});';
		}
	echo "});";


echo "</script>";
echo '<br>';


//echo '<br><br><div class="panel panel-success"><h4>Tomar Asistencia para...</h4></div>';


$attendanceStudent = new ControllerAttendance();

$course = new ControllerCourse();
$nameCourse = $course->viewCourseStudentController();
?>

<h5>Tomar asistencia para el Curso: <?php echo '<label class="btn btn-primary">'.$nameCourse[0]['name'].'</label>'; ?> Turno: <?php echo '<label class="btn btn-primary">'.$nameCourse[0]['turn'].'</label>'; ?></h5><br>
<?php


//echo 'Curso: '.$nameCourse [0] ['name'].' Turno: '.$nameCourse [0] ['turn'];
//echo date("d-m-Y");
//echo '<br><br>';


echo '<form class="formAttendance" action="" method="post">';
echo '<input type="date" readonly name="date" value="'.date("Y-m-d").'">';
//var_dump($viewCourse);
echo '<br><br>';
echo '<div class="card">';
echo '<div class="table-responsive">

<table class="table table-sm table-bordered">
      <thead>
      <th>Id</th>
      <th>Apellido</th>
      <th>Nombre</th>
      <th>DNI</th>
      <th>Acción</th>
      </thead>
      <tbody>';
      foreach ($viewCourse as $key => $item) {
				$searchAttendance = $attendanceStudent->viewAttendanceStudentController($item["student_id"],date("Y-m-d"));
				//var_dump($searchAttendance);
				//echo '<br><br>';
				if(isset($searchAttendance)){
				if(count($searchAttendance)>0){
						//echo $searchAttendance[0]['status'];
						//echo '<br><br>';
						switch ($searchAttendance[0]['status']) {
							case 'P':
								echo '<tr  id="tr'.$item["student_id"].'">';
								break;
							case 'A':
								echo '<tr class="bg-danger text-white" id="tr'.$item["student_id"].'">';
									break;
							case 'M':
									echo '<tr class="bg-info text-white" id="tr'.$item["student_id"].'">';
											break;
						  case 'J':
									echo '<tr class="bg-warning text-white" id="tr'.$item["student_id"].'">';
									break;
							case 'AA':
									echo '<tr class="bg-inverse text-white" id="tr'.$item["student_id"].'">';
									break;
							case 'MM':
									echo '<tr class="bg-warning text-white" id="tr'.$item["student_id"].'">';
									break;
							default:

								break;
						}
				}else{
					echo '<tr  id="tr'.$item["student_id"].'">';
				}
			}


        echo '<th scope="row">'.$item['student_id'].'</th>';
        echo '<td>'.$item['lastname'].'</td>';
        echo '<td>'.$item['firstname'].'</td>';
        echo '<td>'.$item['dni'].'</td>';


				if(count($searchAttendance)>0){
						//echo $searchAttendance[0]['status'];
						//echo '<input  type="hidden" name="st'.$item["student_id"].'" value="'.$searchAttendance[0]['attendance_id'].'">';
						//echo '<input  type="hidden" name="st'.$item["student_id"].'" value="'.$item["student_id"].'">';
						switch ($searchAttendance[0]['status']) {
							case 'P':
								echo '<td><input  type="hidden" id="'.$item['student_id'].'" name="'.$item['student_id'].'" value="Presente"></td>';
								echo '<td><input class="btn btn-success" type="button" id="bt'.$item['student_id'].'" name="bt'.$item['student_id'].'" value="Presente"></td>';
								break;
							case 'A':
								echo '<td><input  type="hidden" id="'.$item['student_id'].'" name="'.$item['student_id'].'" value="Ausente"></td>';
								echo '<td><input class="btn btn-danger" type="button" id="bt'.$item['student_id'].'" name="bt'.$item['student_id'].'" value="Ausente"></td>';
									break;
							case 'M':
										echo '<td><input  type="hidden" id="'.$item['student_id'].'" name="'.$item['student_id'].'" value="Media F."></td>';
										echo '<td><input class="btn btn-info" type="button" id="bt'.$item['student_id'].'" name="bt'.$item['student_id'].'" value="Media F."></td>';
											break;
							case 'AA':
										echo '<td><input  type="hidden" id="'.$item['student_id'].'" name="'.$item['student_id'].'" value="Doble Ausente"></td>';
										echo '<td><input class="btn btn-inverse" type="button" id="bt'.$item['student_id'].'" name="bt'.$item['student_id'].'" value="Doble Ausente"></td>';
										break;
							case 'MM':
										echo '<td><input  type="hidden" id="'.$item['student_id'].'" name="'.$item['student_id'].'" value="Doble Tarde"></td>';
										echo '<td><input class="btn btn-warning" type="button" id="bt'.$item['student_id'].'" name="bt'.$item['student_id'].'" value="Doble Tarde"></td>';
										break;
							default:
								echo '<td><input  type="hidden" id="'.$item['student_id'].'" name="'.$item['student_id'].'" value="Justificada"></td>';
								echo '<td><input class="btn btn-warning" type="button" id="bt'.$item['student_id'].'" name="bt'.$item['student_id'].'" value="Justificada"></td>';
								break;
						}
				}else{
					echo '<input  type="hidden" id="'.$item['student_id'].'" name="'.$item['student_id'].'" value="Presente">';
						echo '<td><input class="btn btn-success" type="button" id="bt'.$item['student_id'].'" name="bt'.$item['student_id'].'" value="Presente"></td>';
				}
        echo '</tr>';
      }
echo '</tbody></table></div></card>';
?>
<input type="submit" class="btn btn-success" name="submitAttendance" value="Guardar Asistencia">
</form>

</div>
