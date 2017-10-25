<?php
require_once "conexion.php";
class Person extends Conexion{
  //Registro de usuarios

  public function registroPersonModel($datosModel,$tabla){
    $conexion = new Conexion();
    $stmt = $conexion->prepare("INSERT INTO $tabla (person_id, dni, cuil, lastname, firstname, birthday, sexo, phone, movil, email, address)
    VALUES (null, :dni, :cuil, :lastname, :firstname, :birthday, :sexo, :phone, :movil, :email, :address)");

    $stmt->bindParam(":dni",$datosModel["dni"],PDO::PARAM_STR);
    $stmt->bindParam(":cuil",$datosModel["cuil"],PDO::PARAM_STR);
    $stmt->bindParam(":lastname",$datosModel["lastname"],PDO::PARAM_STR);
    $stmt->bindParam(":firstname",$datosModel["firstname"],PDO::PARAM_STR);
    $stmt->bindParam(":birthday",$datosModel["birthday"],PDO::PARAM_STR);
    $stmt->bindParam(":sexo",$datosModel["sexo"],PDO::PARAM_STR);
    $stmt->bindParam(":phone",$datosModel["phone"],PDO::PARAM_STR);
    $stmt->bindParam(":movil",$datosModel["movil"],PDO::PARAM_STR);
    $stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
    $stmt->bindParam(":address",$datosModel["address"],PDO::PARAM_STR);
//var_dump($datosModel);
  if($stmt->execute()){

    $lastId = $conexion->lastInsertId();
    //echo $lastId;
    $conexion = new Conexion();
    $stmt = $conexion->prepare("SELECT * FROM persons WHERE person_id=$lastId");
    //var_dump($sentencia);
    $stmt->execute();
    $row = $stmt->fetchobject();
    //echo $fila->lastname;
    //var_dump($row);

    //$fila = $stmt->fetch();

     //
      $encriptar = md5($row->dni);
      $datosController = array(
                  "user_id"=>$row->person_id,
                  "usuario"=>$row->dni,
                  "password"=>$encriptar,
                  //"email"=>$_POST["emailRegistro"],
                  "type"=>$datosModel["type"],
                  "status"=>$datosModel["status"]
                );
  //  var_dump($datosController);
  //
  //
   $respuesta = Datos::registroUsuarioModel($datosController, "users");

    if ($datosModel["type"]=='Alumno'){
      $datosController = array(
                  "person_id"=>$row->person_id
                  );
                  //  var_dump($datosController);
     $respuesta = Datos::registroStudentModel($datosController, "students");
    }

    if ($datosModel["type"]=='Tutor'){
      $datosController = array(
                  "person_id"=>$row->person_id
                  );
                  //  var_dump($datosController);
     $respuesta = Datos::registroTutorModel($datosController, "tutors");
    }





    /*if ($respuesta =="success") {
      echo "-----Guardo Usuario correctamente";
    }else{
      echo "-----NOOOOO Guardo Usuario";
    }*/


      return "success";
    }else{
      return "error";
    }

    $stmt->close();
  }

  //buscar personas
  //SELECT *
  //FROM persons
  //JOIN users
  //ON (users.user_name = persons.dni)
  //WHERE firstname LIKE '%'
  //AND   users.type ='Docente' AND users.status='Inactivo'
  //
  public function searchPersonModel($datos,$tabla,$type=NULL){
    $conexion = new Conexion();
    $sentencia = 'SELECT * FROM '.$tabla.' JOIN users ON (users.user_name = persons.dni)';
    /*if($datos['type']=='Alumno' AND !isset($type)){
      $sentencia .=" JOIN students_courses ON (students_courses.student_id=users.user_id)";
    }*/
    $sentencia .=' WHERE';
    $carga=0;
    if($datos['person_id']<>''){
      $sentencia.=' person_id=:person_id && ';
      $carga=1;
    }

    if($datos['firstname']<>''){
      $sentencia.=' firstname LIKE :firstname && ';
      $carga=1;
    }

    if($datos['lastname']<>''){
      $sentencia.=' lastname LIKE :lastname && ';
      $carga=1;
    }

    if($datos['dni']<>''){
      $sentencia.=' dni LIKE :dni && ';
      $carga=1;
    }


    if ($carga==1){
      $sentencia=substr($sentencia,0,strlen($sentencia)-3);
    }else{
      $sentencia.=' 1';
    }
    if($datos['type']<>'todos' AND $datos['type']<>'')
    {
      $sentencia.='  AND   users.type = :type ';
    }
    if(isset($type)){
      switch ($type) {
        case 'inscription':
          //$sentencia.=" AND persons.person_id NOT IN (SELECT student_id FROM students_courses) ";
          break;
        default:
          # code...
          break;
      }
    }

    $sentencia.='  ORDER BY person_id';


    //WHERE lastname LIKE :lastname OR firstname LIKE :firstname';




    $stmt = $conexion->prepare($sentencia);
    $lastname='%'.trim($datos['lastname']).'%';
    $firstname='%'.trim($datos['firstname']).'%';
    $dni='%'.trim($datos['dni']).'%';
    if($datos['dni']<>"")
      $stmt->bindParam(':dni',$dni, PDO::PARAM_STR);
    if($datos['person_id']<>"")
        $stmt->bindParam(':person_id',$datos['person_id'], PDO::PARAM_INT);
    if($datos['lastname']<>"")
      $stmt->bindParam(':lastname',$lastname, PDO::PARAM_STR);
    if($datos['firstname']<>"")
      $stmt->bindParam(':firstname',$firstname, PDO::PARAM_STR);
      if($datos['type']<>'todos' AND $datos['type']<>'' )
      {
        $stmt->bindParam(':type',$datos['type'], PDO::PARAM_STR);
      }
    //$stmt->bindParam(':lastname',"%$datos['lastname']%");

    $stmt->execute();
    //var_dump($stmt);

    return $stmt->fetchAll();
    $stmt->close();
  }

    //Vista de usuarios
    //******************************
        public function vistaPersonModel($tabla,$tipo=NULL){
          $conexion = new Conexion();
          if(isset($tipo)){
            $sentencia = 'SELECT * FROM ';
            $sentencia .= $tabla;
            $sentencia .= ' JOIN users ON (';
            $sentencia .= $tabla;
            $sentencia .= '.person_id=users.user_id)';
            $sentencia .= ' WHERE users.type="';
            $sentencia .= $tipo.'"';
            $stmt = $conexion->prepare($sentencia);
          }else{
            $stmt = $conexion->prepare("SELECT * FROM $tabla ");
          }
          //var_dump($stmt);
          $stmt->execute();
          return $stmt->fetchAll();
          $stmt->close();
        }

    //Editar usuarios
    //************************************************
    public function editarPersonModel($datos,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("SELECT person_id, dni, cuil, lastname, firstname, birthday, sexo, phone, movil, email, address
                                            FROM $tabla
                                            WHERE person_id=:person_id");
      $stmt->bindParam(":person_id",$datos,PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch();
      $stmt->close();
    }

    //Actualizar usuarios
    //************************************************
    public function actualizarPersonModel($datosModel,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("UPDATE $tabla SET dni=:dni, cuil=:cuil, lastname=:lastname,
                                            firstname=:firstname, birthday=:birthday,
                                            sexo=:sexo, phone=:phone, movil=:movil, email=:email, address=:address
                                            WHERE person_id=:person_id");
      $stmt->bindParam(":person_id",$datosModel["person_id"],PDO::PARAM_INT);
      $stmt->bindParam(":dni",$datosModel["dni"],PDO::PARAM_INT);
      $stmt->bindParam(":cuil",$datosModel["cuil"],PDO::PARAM_STR);
      $stmt->bindParam(":lastname",$datosModel["lastname"],PDO::PARAM_STR);
      $stmt->bindParam(":firstname",$datosModel["firstname"],PDO::PARAM_STR);
      $stmt->bindParam(":birthday",$datosModel["birthday"]);
      $stmt->bindParam(":sexo",$datosModel["sexo"],PDO::PARAM_STR);
      $stmt->bindParam(":phone",$datosModel["phone"],PDO::PARAM_STR);
      $stmt->bindParam(":movil",$datosModel["movil"],PDO::PARAM_STR);
      $stmt->bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
      $stmt->bindParam(":address",$datosModel["address"],PDO::PARAM_STR);

    if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }

    //Actualizar usuarios
    //************************************************
    public function borrarPersonModel($datos,$tabla){
      $conexion = new Conexion();
      $stmt = $conexion->prepare("DELETE FROM $tabla WHERE person_id=:person_id");
      $stmt->bindParam(":person_id",$datos,PDO::PARAM_INT);

    if($stmt->execute()){
        return "success";
      }else{
        return "error";
      }

      $stmt->close();
    }


}
?>
