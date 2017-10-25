<?php
require_once "conexion.php";
class Statis extends Conexion{

  /**
   * Metodo para verificar total de alumnos del colegio y por turno
   */

  public function totalStudentsModel($datos=NULL,$tabla){
    //var_dump($datos);
    //
    $returnArray=0;
    $conexion = new Conexion();
    //var_dump($datos);
    if(isset($datos)){
      if($datos=='Tarde' || $datos=='Mañana'){
      $stmt = $conexion->prepare("SELECT * FROM $tabla
                                  INNER JOIN courses
                                  ON students_courses.course_id=courses.course_id
                                  WHERE courses.turn='$datos'");
      }elseif($datos=='allArray'){
      $stmt = $conexion->prepare("SELECT * FROM $tabla");
      $returnArray=1;
      }
    }else{
      $stmt = $conexion->prepare("SELECT * FROM $tabla");
    }
    //var_dump($stmt);
    $stmt->execute();
    //$valor=$stmt->rowCount();
    //return $stmt->fetchAll();
//var_dump($valor);
    if($returnArray==1){
      return $stmt->fetchAll();
    }else{
      return $stmt->rowCount();
    }
    $stmt->close();
  }


  public function attendanceStudentsModel($turn=NULL,$tabla){
    $conexion = new Conexion();
    if(isset($turn)){
      $stmt = $conexion->prepare("SELECT * FROM $tabla
                                  INNER JOIN students_courses
                                  ON attendances.student_id=students_courses.student_id
                                  INNER JOIN courses
                                  ON students_courses.course_id=courses.course_id
                                  WHERE courses.turn='$turn'");
    }else{
      $stmt = $conexion->prepare("SELECT * FROM $tabla");
    }
    $stmt->execute();
    return $stmt->fetchAll();
    $stmt->close();
  }

  public function attendanceCourseModel($course,$tabla,$month=NULL){
    $conexion = new Conexion();
    if(isset($month)){
      $stmt = $conexion->prepare("SELECT * FROM $tabla
                                  INNER JOIN students_courses
                                  ON attendances.student_id=students_courses.student_id
                                  INNER JOIN courses
                                  ON students_courses.course_id=courses.course_id
                                  WHERE courses.course_id='$course' AND MONTH(date_attendance)=$month");
    }else{
      $stmt = $conexion->prepare("SELECT * FROM $tabla
                                  INNER JOIN students_courses
                                  ON attendances.student_id=students_courses.student_id
                                  INNER JOIN courses
                                  ON students_courses.course_id=courses.course_id
                                  WHERE courses.course_id='$course'");
    }

    //echo var_dump($stmt);
    $stmt->execute();
    return $stmt->fetchAll();
    $stmt->close();
  }

  /**
   * Metodo para verificar cantidad de total de alumnos en curso
   */

  public function totalCourseModel($course,$tabla){
    $conexion = new Conexion();
    $stmt = $conexion->prepare("SELECT * FROM $tabla
                                INNER JOIN courses
                                ON students_courses.course_id=courses.course_id
                                WHERE courses.course_id='$course'");

    $stmt->execute();
    return $stmt->rowCount();
    $stmt->close();
  }

  /**
   * Metodo para verificar cantidad de total de alumnos en curso
   */

  public function listCoursesModel($turn,$tabla){
    $conexion = new Conexion();
    $stmt = $conexion->prepare("SELECT * FROM $tabla
                                WHERE turn='$turn' ORDER BY name ASC");

    $stmt->execute();
    return $stmt->fetchAll();
    $stmt->close();
  }




  //View of Student
  //******************************
    public function viewAttendanceStudentModel($id,$date,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("SELECT * FROM $tabla  WHERE student_id=:student_id AND date_attendance=:date_attendance");

      $stmt->bindParam(":student_id",$id,PDO::PARAM_INT);
      $stmt->bindParam(":date_attendance",$date);
      //echo $date;
      //var_dump($stmt);
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt->close();
    }

    //Actualizar asistencia
    //************************************************
    public function updateAttendanceModel($datosModel,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("UPDATE $tabla
                                  SET student_id=:student_id,
                                      date_attendance=:date_attendance,
                                      status=:status,
                                      user_id=:user_id,
                                      date_update=:date_update
                                  WHERE attendance_id=:attendance_id");

      $stmt->bindParam(":attendance_id",$datosModel["attendance_id"],PDO::PARAM_INT);
      $stmt->bindParam(":student_id",$datosModel["student_id"],PDO::PARAM_INT);
      $stmt->bindParam(":date_attendance",$datosModel["date_attendance"]);
      $stmt->bindParam(":status",$datosModel["status"],PDO::PARAM_STR);
      $stmt->bindParam(":user_id",$datosModel["user_id"],PDO::PARAM_INT);
      $stmt->bindParam(":date_update",$datosModel["date_update"]);

      if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }


    //Editar usuarios
    //************************************************
    public function editStudentModel($datos,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("SELECT *
                                  FROM $tabla
                                  WHERE student_id=:student_id");
      $stmt->bindParam(":student_id",$datos,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch();
      $stmt->close();
    }



    //Actualizar usuarios
    //************************************************
    public function deleteStudentModel($datos,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("DELETE FROM $tabla WHERE student_id=:student_id");
      $stmt->bindParam(":student_id",$datos,PDO::PARAM_INT);

    if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }


}
?>
