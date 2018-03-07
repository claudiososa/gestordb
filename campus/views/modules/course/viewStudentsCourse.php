
<?php

/**
 * Verificar si el usuario es de tipo Admin o Director para acceder a este archivo
 * en el caso que no sea asi se redireccion a pagina ingresar
 */
if($_SESSION["typeUser"]<>'Admin' && $_SESSION["typeUser"]<>'Director/a'){
	header("location:index.php?action=ingresar");
	exit();
}

if(isset($_GET)){
  $course = new ControllerCourse();
  $viewCourse = $course->viewCourseStudentController();
}

 ?>
 <br>

 <div class="container">



<h6>Alumnos para el Curso: <?php echo '<label class="btn btn-primary">'.$viewCourse[0]['name'].'</label>'; ?> Turno: <?php echo '<label class="btn btn-primary">'.$viewCourse[0]['turn'].'</label>'; ?></h6><br>

<br>
<div class="card">
<?php
if($_POST){

	/**
	 * toma los datos de post para realizar busqueda en tabla persona. muestra informacion en formato tabla
	 */
  $resultado = new ControllerPerson();
  $dato=$resultado->searchPersonController('inscription');
  //var_dump($dato);

	echo '<div class="table-responsive">
	<table class="table">
        <thead>
        <th>Id</th>
        <th>Apellido</th>
        <th>Nombre</th>
        <th>DNI</th>
				<th>Acción</th>
        </thead>
        <tbody>';
  foreach ($dato as $key => $item) {
    echo '<tr>
      <td>'.$item["person_id"].'</td>
      <td>'.$item["lastname"].'</td>
      <td>'.$item["firstname"].'</td>
      <td>'.$item["dni"].'</td>';
			echo '<td>';
      if($item["type"]=='Alumno'){
        $inscription = new ControllerCourse();
        //var_dump($inscription);
        $verificar = $inscription->searchStudentInCourseController($item["person_id"]);
        if($verificar){
          echo $verificar[0]['name'].' '.$verificar[0]['turn'];
        }else{
					echo '<a class="btn btn-primary" href="index.php?action=inscription&id='.$_GET['id'].'&person_id='.$item["person_id"].'">Inscribir</a>';
        }
      }
			echo '</td>
						</tr>';
  }
  echo '</tbody></table></div>';
}

if($_GET['action']=='inscription' AND isset($_GET['id']) AND isset($_GET['person_id'])  ){
  $registro = new ControllerCourse();
  $viewCourse = $registro->newInscriptionController();
  $url = 'location:index.php?action=inscription&id='.$_GET['id'];
  header($url);
  echo 'tiene lista para guardar';
}
if($_GET['action']=='inscription' AND isset($_GET['delete'])){
	$registro = new ControllerCourse();
	$delete = $registro->deleteStudentCourseController($_GET['student_id']);
	//var_dump($delete);
}

if($_GET['action']=='viewStudentsCourse' AND $_GET['id'] ){

	$registro = new ControllerCourse();
  $viewCourse = $registro->viewStudentController($_GET['id']);
  //var_dump($viewCourse);
  echo '
	<div class="table-responsive">
	<table class="table">

        <thead>
        <th>Id</th>
        <th>Apellido</th>
        <th>Nombre</th>
        <th>DNI</th>
				<th>Acción</th>
        </thead>
        <tbody>';
        foreach ($viewCourse as $key => $item) {
          echo '<tr>';
          echo '<td>'.$item['student_id'].'</td>';
          echo '<td>'.$item['lastname'].'</td>';
          echo '<td>'.$item['firstname'].'</td>';
          echo '<td>'.$item['dni'].'</td>';
					echo '<td></td>';
          //<a class="btn btn-primary" href="index.php?action=inscription&delete&student_id='.$item['student_id'].'">Eliminar Inscripción</a></td>';
          echo '</tr>';
        }
  echo '</tbody></table></div>';
}
?>
</div>
</div>
