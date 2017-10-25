<?php
require_once "conexion.php";
class Courses extends Conexion{
  //Registro de usuarios

  public function newCourseModel($datosModel,$tabla){
    $conexion = new Conexion();
    $stmt = $conexion->prepare("INSERT INTO $tabla (course_id, name,turn,preceptor)
    VALUES (null, :name, :turn, :preceptor)");

    $stmt->bindParam(":name",$datosModel["name"],PDO::PARAM_STR);
    $stmt->bindParam(":turn",$datosModel["turn"],PDO::PARAM_STR);
    $stmt->bindParam(":preceptor",$datosModel["preceptor"],PDO::PARAM_INT);

//var_dump($datosModel);
    if($stmt->execute()){
      return "success";
    }else{
      return "error";
    }

    $stmt->close();
  }

  public function newInscriptionModel($datosModel,$tabla){
    $conexion = new Conexion();
    $stmt = $conexion->prepare("INSERT INTO $tabla (student_course_id, course_id,student_id)
    VALUES (null, :course_id, :student_id)");

    $stmt->bindParam(":course_id",$datosModel["course_id"],PDO::PARAM_INT);
    $stmt->bindParam(":student_id",$datosModel["student_id"],PDO::PARAM_INT);

//var_dump($datosModel);
    if($stmt->execute()){
      return "success";
    }else{
      return "error";
    }

    $stmt->close();
  }

  //buscar curso de un alumno determinado
  //******************************
    public function searchStudentInCourseModel($tabla,$id){
      $conexion = new Conexion();
      $prepareStmt = "SELECT courses.name,courses.turn
                        FROM $tabla
                        JOIN courses
                        ON (courses.course_id = students_courses.course_id)
                        WHERE student_id=:student_id";
        $stmt = $conexion->prepare($prepareStmt);
        $stmt->bindParam(":student_id",$id,PDO::PARAM_INT);

      //var_dump($stmt);
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt->close();
    }


  //Vista de cursos
  //******************************
    public function viewCourseModel($tabla,$id){
      $conexion = new Conexion();
      if(!isset($id)){
        $stmt = $conexion->prepare("SELECT * FROM $tabla ");
      }else{
        $prepareStmt = "SELECT *
                        FROM $tabla
                        JOIN persons
                        ON (students_courses.student_id = persons.person_id)
                        WHERE course_id=:course_id ORDER BY persons.lastname ASC";
        $stmt = $conexion->prepare($prepareStmt);
        $stmt->bindParam(":course_id",$id,PDO::PARAM_INT);
      }
      //echo $id.'<br>';
      //var_dump($stmt);
      $stmt->execute();
      return $stmt->fetchAll();
      $stmt->close();
    }

    public function viewCourseStudentModel($tabla,$id=null){
      $conexion = new Conexion();
      if(!isset($id)){
        $stmt = $conexion->prepare("SELECT * FROM $tabla ");
      }else{
        $prepareStmt = "SELECT *
                        FROM $tabla
                        WHERE course_id=:course_id";
        $stmt = $conexion->prepare($prepareStmt);
        $stmt->bindParam(":course_id",$id,PDO::PARAM_INT);
      }

      $stmt->execute();
      return $stmt->fetchAll();
      $stmt->close();
    }

    //Vista de alumnos en curso
    //******************************
      public function viewStudentModel($tabla,$course){
        $conexion = new Conexion();
        $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE course_id = $course");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
      }



    //Editar usuarios
    //************************************************
    public function editCourseModel($datos,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("SELECT *
                                  FROM $tabla
                                  WHERE course_id=:course_id");
      $stmt->bindParam(":course_id",$datos,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch();
      $stmt->close();
    }

    //Actualizar Curso
    //************************************************
    public function updateCourseModel($datosModel,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("UPDATE $tabla
                                  SET name=:name, turn=:turn, preceptor=:preceptor
                                  WHERE course_id=:course_id");

      $stmt->bindParam(":course_id",$datosModel["course_id"],PDO::PARAM_INT);
      $stmt->bindParam(":name",$datosModel["name"],PDO::PARAM_STR);
      $stmt->bindParam(":turn",$datosModel["turn"],PDO::PARAM_STR);
      $stmt->bindParam(":preceptor",$datosModel["preceptor"],PDO::PARAM_INT);

      if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }

    //Actualizar usuarios
    //************************************************
    public function deleteCourseModel($datos,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("DELETE FROM $tabla WHERE course_id=:course_id");
      $stmt->bindParam(":course_id",$datos,PDO::PARAM_INT);

    if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }

    //elminar alumno de curso.
    //************************************************
    public function deleteStudentCourseModel($id,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("DELETE FROM $tabla WHERE student_id=:student_id");
      $stmt->bindParam(":student_id",$id,PDO::PARAM_INT);

    if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }

    public function myCoursesModel($id,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("SELECT * FROM $tabla WHERE preceptor=:person_id");
      $stmt->bindParam(":person_id",$id,PDO::PARAM_INT);
//return 'Hola mundo';
    if($stmt->execute()){
        return $stmt->fetchAll();
      }else{
        return "error";
      }

      $stmt->close();
    }


}
?>
