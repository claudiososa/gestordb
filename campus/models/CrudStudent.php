<?php
require_once "conexion.php";
class CrudStudent extends Conexion{
  //Register of student

  public function newStudentModel($datos,$tabla){
    $conexion = new Conexion();
    $stmt = $conexion->prepare("INSERT INTO $tabla (student_id)
    VALUES (:student_id)");
    $stmt->bindParam(":student_id",$datos["student_id"],PDO::PARAM_INT);
    

//var_dump($datosModel);
    if($stmt->execute()){
      return "success";
    }else{
      return "error";
    }

    $stmt->close();
  }
  //View of Student
  //******************************
    public function viewStudentModel($tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("SELECT * FROM $tabla ");
      $stmt->execute();
      return $stmt->fetchAll();
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
    public function updateStudentModel($datosModel,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("UPDATE $tabla
                                  SET name=:name, turn=:turn
                                  WHERE student_id=:student_id");

      $stmt->bindParam(":student_id",$datosModel["student_id"],PDO::PARAM_INT);
      $stmt->bindParam(":name",$datosModel["name"],PDO::PARAM_STR);
      $stmt->bindParam(":turn",$datosModel["turn"],PDO::PARAM_STR);

      if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

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
