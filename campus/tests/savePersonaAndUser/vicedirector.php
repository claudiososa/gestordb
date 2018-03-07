<?php
require_once "conexion.php";
class Datos extends Conexion{
  //Registro de usuarios

  public function registroUsuarioModel($datosModel,$tabla){
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (user_id, user_name, password, type, status)
    VALUES (user_id,:user_name,:password,:type,:status)");

    $stmt->bindParam(":user_id",$datosModel["usuario"],PDO::PARAM_INT);

    $stmt->bindParam(":user_name",$datosModel["usuario"],PDO::PARAM_INT);
    $stmt->bindParam(":password",$datosModel["password"],PDO::PARAM_STR);
  //  $stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
    $stmt->bindParam(":type",$datosModel["type"],PDO::PARAM_STR);
    $stmt->bindParam(":status",$datosModel["status"],PDO::PARAM_STR);

  if($stmt->execute()){
      return $stmt;
      //return "success";
    }else{
      return "error";
    }

    $stmt->close();
  }

//Ingreso de usuarios
//******************************
    public function ingresoUsuarioModel($datosModel,$tabla){
      $stmt = Conexion::conectar()->prepare("SELECT user_id, user_name,password,type,attempts FROM $tabla WHERE user_name=:user_name");
      $stmt->bindParam(":user_name",$datosModel["usuario"],PDO::PARAM_INT);

      //$stmt->bindParam(":password",$datosModel["password"],PDO::PARAM_STR);

      $stmt->execute();
      return $stmt->fetch();
      $stmt->close();
    }

    //Intentos de usuarios
    //******************************
        public function intentosUsuarioModel($datosModel,$tabla){
          $stmt = Conexion::conectar()->prepare("UPDATE users SET attempts=:intentos WHERE user_id=:user_id");

          $stmt->bindParam(":intentos",$datosModel["intentos"],PDO::PARAM_INT);
          $stmt->bindParam(":user_id",$datosModel["usuarioId"],PDO::PARAM_INT);

          //$stmt->bindParam(":password",$datosModel["password"],PDO::PARAM_STR);

          if($stmt->execute()){
              return "success";
            }else{
              return "error";
            }

            $stmt->close();
          }



    //Vista de usuarios
    //******************************
        public function vistaUsuarioModel($tabla){
          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
          //$stmt->bindParam(":user_name",$datosModel["usuario"],PDO::PARAM_STR);

          //$stmt->bindParam(":password",$datosModel["password"],PDO::PARAM_STR);

          $stmt->execute();
          return $stmt->fetchAll();
          $stmt->close();
        }

    //Editar usuarios
    //************************************************
    public function editarUsuarioModel($datos,$tabla){
      $stmt = Conexion::conectar()->prepare("SELECT user_id, user_name,password,type,status FROM $tabla WHERE user_id=:user_id");
      $stmt->bindParam(":user_id",$datos,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch();
      $stmt->close();
    }

    //Actualizar usuarios
    //************************************************
    public function actualizarUsuarioModel($datos,$tabla){
      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET user_name=:user_name, password=:password, type=:type, status=:status WHERE user_id=:user_id");
      $stmt->bindParam(":user_id",$datos["id"],PDO::PARAM_INT);
      $stmt->bindParam(":user_name",$datos["usuario"],PDO::PARAM_INT);
      $stmt->bindParam(":password",$datos["password"],PDO::PARAM_STR);
      //$stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
      $stmt->bindParam(":type",$datos["type"],PDO::PARAM_STR);
      $stmt->bindParam(":status",$datos["status"],PDO::PARAM_STR);

    if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }

    //Actualizar usuarios
    //************************************************
    public function borrarUsuarioModel($datos,$tabla){
      $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE user_id=:user_id");
      $stmt->bindParam(":user_id",$datos,PDO::PARAM_INT);

    if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }


}
?>
