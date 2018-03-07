<?php
if($_SESSION["typeUser"]<>'Admin'){
	header("location:index.php?action=ingresar");
	exit();
}
$editar = new ControllerCourse();
$respuesta = $editar->editCourseController();
$updateCourse = $editar->updateCourseController();

include_once 'forms/formEditCourse.php';

if($updateCourse=='saved')
{
  header("location:index.php?action=createCourse&savedUpdate=".$_POST['course_idEditar']);
  //echo "El curso fue actualizado con Exito";
}
?>
