<?php

class ControllerAttendance{

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


	// Nuevo asistencia
	public function newAttendanceController($id,$status){
		if(isset($_POST["submitAttendance"])){
  		$datosController = array(
                      "student_id"=>$id,
                      "date_attendance"=>$_POST["date"],
                      "status"=>$status,
                      "user_id"=>$_SESSION['user_id'],
                      "date_update"=>date("Y-m-d")

  									);
  		$respuesta = CrudAttendance::newAttendanceModel($datosController, "attendances");

  		if ($respuesta =="success") {
        return "saved";
  			//header("location:index.php?action=ok");
  		}else{
  			return "NoT saved";
  		}

		}
	}

  // Actualizar asistencia
  public function updateAttendanceController($attendance_id,$id,$status){
    if(isset($_POST["submitAttendance"])){
      $datosController = array(
                      "attendance_id"=>$attendance_id,
                      "student_id"=>$id,
                      "date_attendance"=>$_POST["date"],
                      "status"=>$status,
                      "user_id"=>$_SESSION['user_id'],
                      "date_update"=>date("Y-m-d")

                    );
      $respuesta = CrudAttendance::updateAttendanceModel($datosController, "attendances");

      if ($respuesta =="success") {
        return "saved";
        //header("location:index.php?action=ok");
      }else{
        return "NoT saved";
      }

    }
  }



  //Vista de buscar estudiante en asistencia, con fecha indicada
	//************************************************************
  public function viewAttendanceStudentController($id,$date){
		$respuesta = CrudAttendance::viewAttendanceStudentModel($id,$date,"attendances");
    return $respuesta;
  }

	//Vista de usuarios
	//*******************************
  public function viewStudentController(){
		$respuesta = Students::viewStudentModel("courses");
    return $respuesta;
  }

	// Editar usuarios
	//*********************************************************
	public function editStudentController(){
		$datos = $_GET["id"];
		$respuesta=Students::editStudentModel($datos,"courses");
    return $respuesta;
	}

	// Actualizar usuarios
	//*********************************************************
	public function updateStudentController(){
		if(isset($_POST["course_idEditar"])){

			$datosController =  array(
                      "course_id"=>$_POST["course_idEditar"],
                      "name"=>$_POST["nameEditar"],
                      "turn"=>$_POST["turnEditar"]

			);

		$respuesta = Students::updateStudentModel($datosController,"courses");
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
public function deleteStudentController(){
	if(isset($_GET["idBorrar"])){
		$datos=$_GET["idBorrar"];
		$respuesta= Students::deleteStudentModel($datos,"courses");

		if($respuesta == "success"){
			header("location:index.php?action=Student");
		}
	}
}
// Migrar student
//*********************************************************
public function migrationStudentController(){
	$respuesta = Person::vistaPersonModel("persons","Alumno");
	foreach ($respuesta as $key => $item) {
		$datosController = array(
										"student_id"=>$item["person_id"]

									);
		$guardarUser = CrudStudent::newStudentModel($datosController, "students");
	}

}

}

?>
