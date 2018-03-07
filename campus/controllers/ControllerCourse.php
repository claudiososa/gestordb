<?php

class ControllerCourse{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){

		include "views/template.php";

	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){
		if(isset( $_GET['action'])){
			$enlaces = $_GET['action'];
		}else{
			$enlaces = "index";
    }
		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		include $respuesta;
	}


	// Nuevo Curso

	public function newCourseController(){
		if(isset($_POST["nameRegistro"])){

  		$datosController = array(
                      //"Course"=>$_POST["CourseRegistro"],
                      "name"=>$_POST["nameRegistro"],
                      "turn"=>$_POST["turnRegistro"],
											"preceptor"=>$_POST["preceptorRegistro"]
  									);
  		$respuesta = Courses::newCourseModel($datosController, "courses");

  		if ($respuesta =="success") {
        return "saved";
  			//header("location:index.php?action=ok");
  		}else{
  			header("location:index.php");
  		}

		}
	}

	// Nuevo inscripto a Curso

	public function newInscriptionController(){
		if($_GET["person_id"]){

  		$datosController = array(
                      //"Course"=>$_POST["CourseRegistro"],
                      "course_id"=>$_GET["id"],
                      "student_id"=>$_GET["person_id"]
  									);
  		$respuesta = Courses::newInscriptionModel($datosController, "students_courses");

  		if ($respuesta =="success") {
        return "saved";
  			//header("location:index.php?action=ok");
  		}else{
  			header("location:index.php");
  		}

		}
	}

	//Vista de Cursos
	//*******************************
  public function viewCourseController($person_id=NULL){
		if(!isset($_GET['id'])){
			if(!isset($person_id)){
				$respuesta = Courses::viewCourseModel("courses");
			}else{
				$respuesta = Courses::viewCourseModel("courses",$person_id);
			}
		}else{
			$respuesta = Courses::viewCourseModel("courses",$_GET['id']);
		}
    return $respuesta;
		//var_dump($respuesta[1][2]);
	}

	//busqueda de curso de un alumno determinado
	//*******************************
	public function searchStudentInCourseController($id){
		$respuesta = Courses::searchStudentInCourseModel("students_courses",$id);

		return $respuesta;
		//var_dump($respuesta[1][2]);
	}

	//Vista de Cursos
	//*******************************
  public function viewCourseStudentController(){
		if(isset($_GET['edit'])){
			$respuesta = Courses::viewCourseModel("courses");
		}elseif(isset($_GET['id'])){
			$respuesta = Courses::viewCourseStudentModel("courses",$_GET['id']);
		}else{
			$respuesta = Courses::viewCourseStudentModel("courses");
		}
    return $respuesta;
		//var_dump($respuesta[1][2]);
	}

	//Vista de Alumnos del curso
	//*******************************
  public function viewStudentController($course){
		$respuesta = Courses::viewCourseModel("students_courses",$course);
    return $respuesta;
		//var_dump($respuesta[1][2]);
	}

	// Editar usuarios
	//*********************************************************
	public function editCourseController(){
		$datos = $_GET["id"];
		$respuesta=Courses::editCourseModel($datos,"courses");
    return $respuesta;
    /*
		echo '<input type="hidden" value="'.$respuesta["course_id"].'" name="course_idEditar">
					<input type="text" value="'.$respuesta["name"].'" placeholder="name" name="nameEditar" required>
          <input type="text" value="'.$respuesta["turn"].'" placeholder="turn" name="turnEditar" required>
          <input type="text" value="'.$respuesta["lastname"].'" placeholder="Apellidos" name="lastnameEditar" required>
          <input type="text" value="'.$respuesta["firstname"].'" placeholder="Nombres" name="firstnameEditar" required>
          <input type="text" value="'.$respuesta["birthday"].'" placeholder="Fecha de Nacimiento" name="birthdayEditar" required>
          <input type="text" value="'.$respuesta["sexo"].'" placeholder="Sexo" name="sexoEditar" required>
          <input type="text" value="'.$respuesta["phone"].'" placeholder="Telefono Fijo" name="phoneEditar" required>
          <input type="text" value="'.$respuesta["movil"].'" placeholder="Telefono Celular" name="movilEditar" required>
					<input type="email" value="'.$respuesta["email"].'" placeholder="Email" name="emailEditar" required>
          <input type="text" value="'.$respuesta["address"].'" placeholder="Dirección" name="addressEditar" required>

					<input type="submit" value="Actualizar">
		';*/
		//echo $respuesta[1];
		//return $respuesta;
		//var_dump($respuesta);
	}

	// Actualizar usuarios
	//*********************************************************
	public function updateCourseController(){
		if(isset($_POST["course_idEditar"])){

			$datosController =  array(
                      "course_id"=>$_POST["course_idEditar"],
                      "name"=>$_POST["nameEditar"],
                      "turn"=>$_POST["turnEditar"],
											"preceptor"=>$_POST["preceptorEditar"]

			);

		$respuesta = Courses::updateCourseModel($datosController,"courses");
		if($respuesta == "success"){
			return 'saved';
		}else {
			echo "Error";
		}
		//echo $respuesta;
	}
}


// Borar usuarios
//*********************************************************
public function deleteCourseController(){
	if(isset($_GET["idBorrar"])){
		$datos=$_GET["idBorrar"];
		$respuesta= Courses::deleteCourseModel($datos,"courses");

		if($respuesta == "success"){
			header("location:index.php?action=Course");
		}
	}
}


// Borar usuarios
//*********************************************************
public function deleteStudentCourseController($id){
		$respuesta= Courses::deleteStudentCourseModel($id,"students_courses");

		if($respuesta == "success"){
			//header("location:index.php?action=inscription&id=1");
			//
			echo '<script> alert("Los datos fueron guardados correctamente");
			window.location.href = "index.php?action=inscription&id='.$_GET['id'].'";

			</script>';
			return $respuesta;
		}
}

// devuelve los cursos de un preceptor en particular
//*********************************************************
public function myCoursesController($id){
		$respuesta= Courses::myCoursesModel($id,"courses");

		//if($respuesta == "success"){
			//header("location:index.php?action=inscription&id=1");
			return $respuesta;
		//}
}

}

?>
