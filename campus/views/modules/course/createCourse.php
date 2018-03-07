<?php
/**
 * Verificar si el usuario es de tipo Admin para acceder a este archivo
 * en el caso que no sea asi se redireccion a pagina ingresar
 */
if($_SESSION["typeUser"]<>'Admin'){
	header("location:index.php?action=ingresar");
	exit();
}


$registro = new ControllerCourse();
$ver = new ControllerPerson();
$lista = $ver->vistaPersonController('persons','Preceptor/a');

/**
 * Inclusion de formulario de crear nuevo en el caso de que
 * la url contenga la variable create sino solo muestra boton nuevo curso
 */

 if(isset($_GET['create'])){
 	include_once 'forms/formNewCourse.php';
 }else{
 	echo '<a href="index.php?action=createCourse&create"><label class="btn btn-primary">Nuevo Curso</label></a>';
 }


/**
 * Verifica si viene por variable tipo Post algun contenido
 */
if(!empty($_POST)){
	// Si la variable saveCourse no esta vacia, realiza proceso de guardado de nuevo curso.
	if(!empty($_POST['saveCourse']))
	{
		$newCourse = $registro->newCourseController();
		if($newCourse=='saved')
	  {
	    echo "El curso fue con Exito";
	  }
		include_once 'forms/formNewCourse.php';

		// Si la variable updateCourse no esta vacia, realiza proceso de actualizacion de curso.
	}elseif(!empty($_POST['updateCourse'])){
		$respuesta = $registro->editCourseController();
		$updateCourse = $registro->updateCourseController();
		include_once 'forms/formEditCourse.php';
		if($updateCourse=='saved')
		{
			echo "El curso fue actualizado con Exito";
		}
	}
}

if(isset($_GET['edit'])){
	$respuesta = $registro->editCourseController();
	include_once 'forms/formEditCourse.php';
}

/**
 * Lista de Cursos creados con la boton de Editar y Eliminar
 * @var [type]
 */
if(isset($_GET['savedUpdate']))
{
  echo 'Se actualizo con exito';
}

/**
 * Lista de cursos existentes actuales
 */

$viewCourse = $registro->viewCourseStudentController();

echo '<table class="table table-condensed">
      <thead>
      <th>Id</th>
      <th>Nombre del Curso</th>
      <th>Turno</th>
      <th>Preceptor</th>
			<th>Accion</th>
			<th>Inscribir</th>
      </thead>
      <tbody>';
$resultado = new ControllerPerson();
foreach ($viewCourse as $key => $item) {

  $dato=$resultado->searchPersonController('person_id',$item["preceptor"]);
  echo '<tr';
  if(isset($_POST['updateCourse'])){
    if ($item["course_id"]==$_POST["course_idEditar"]){
      echo ' class="info" ';
    }
  }
  echo '>';

  echo '
  <td>'.$item["course_id"].'</td>
  <td>'.$item["name"].'</td>
  <td>'.$item["turn"].'</td>';
	if($dato<>NULL){
		foreach ($dato as $key => $value)
		{
			echo '<td>'.$value["lastname"].', '.$value["firstname"].'</td>';
		}
	}else{
		echo '<td>Sin asignar</td>';
	}

	echo '<td><a class="btn btn-primary" href="index.php?action=createCourse&id='.$item["course_id"].'&edit='.$item["course_id"].'">Modificar</a></td>';
  echo '<td><a class="btn btn-primary" href="index.php?action=inscription&id='.$item["course_id"].'">Inscribir Alumnos</a></td>';
	//<td><a  class="btn btn-primary" href="index.php?action=deleteCourse&id='.$item["course_id"].'">Borrar</a></td>';

  if(isset($_POST['updateCourse'])){
    if ($item["course_id"]==$_POST["course_idEditar"]){
      echo '<td>Modificado..</td>';
    }
  }

  echo '</tr>';
}
echo '</tbody></table>';
 ?>
