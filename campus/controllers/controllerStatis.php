<?php
require_once "models/General.php";
class ControllerStatis extends General{

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


	/**
	 * Metodo para verificar total de alumnos del colegio y por turno
	 * si desea de un turno especifico debe pasar por parametro el turno,
	 * si desea de todo el colegio
	 * debe pasar por parametro allArray
	 */

	public function totalStudentsController($turn=NULL){
		if(isset($turn)){
			if($turn=='Tarde' || $turn=='Mañana'){
				$datosController = $turn;
				$respuesta = Statis::totalStudentsModel($datosController, "students_courses");
			}elseif($turn=='allArray'){
				$datosController = $turn;
				$respuesta = Statis::totalStudentsModel($datosController, "attendances");
			}
		}else{
			$respuesta = Statis::totalStudentsModel(null,"students_courses");
		}

		//var_dump($respuesta);
		if ($respuesta>0) {
      return $respuesta;
			//header("location:index.php?action=ok");
		}else{
			header("location:index.php");
		}
	}

	/**
	 * Metodo para verificar total de asistencias de alumnos registrados en los cursos
	 * y tambien por turno
	 * si desea de un turno especifico debe pasar por parametro el turno,
	 * si desea de todo el colegio no se debe pasar ningun parametro
	 */

	public function attendanceStudentsController($turn=NULL){
		//$asistenciaGeneral=array();
		if(isset($turn)){
			$respuesta = Statis::attendanceStudentsModel($turn,"attendances");
		}else{
			$respuesta = Statis::attendanceStudentsModel(null,"attendances");
		}
		$presente=0;$ausente=0;$justificada=0;$mediaFalta=0;
		foreach ($respuesta as $key => $value) {
			//echo $attendance[$key][3];
			switch ($respuesta[$key][3]) {
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

		$asistenciaGeneral = array(
		array("Presente", $presente),
		array("Ausente", $ausente),
		array("MediaFalta", $mediaFalta),
		array("Justificada", $justificada)
		);

		if ($respuesta>0) {
      return $asistenciaGeneral;
		}else{
			header("location:index.php");
		}
	}

	/**
	 * Metodo para verificar de asistencias para un curso determinado
	 * se debe pasar por parametro el id del curso deseado
	 */

	public function attendanceCourseController($course,$month=NULL){
		if(isset($course) && $month==null){
			$respuesta = Statis::attendanceCourseModel($course,"attendances");
		}elseif($month<>NULL){
			$respuesta = Statis::attendanceCourseModel($course,"attendances",$month);
		}


		if ($respuesta>0) {
      return $respuesta;
		}else{
			header("location:index.php");
		}
	}

	/**
	 * Metodo para verificar total de alumnos del colegio y por turno
	 */

	public function totalCourseController($course){

		$respuesta = Statis::totalCourseModel($course, "students_courses");

		if ($respuesta>=0) {
			return $respuesta;
			//header("location:index.php?action=ok");
		}else{
			header("location:index.php");
		}
	}

	/**
	 * Metodo lista de cursos
	 */

	public function listCoursesController($turn){

		$respuesta = Statis::listCoursesModel($turn, "courses");

		if ($respuesta>0) {
			return $respuesta;
			//header("location:index.php?action=ok");
		}else{
			header("location:index.php");
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
			header("location:index.php?action=inscription&id=1");
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
