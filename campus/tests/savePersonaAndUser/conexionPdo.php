<?php
class ConexionPdo
{

  public function getConexion(){
    $conexion = new PDO("mysql:host=localhost;dbname=vicomser_pdo","vicomser_pdo","Vicomser.c79");
      //var_dump($this->conexion);
      return $conexion;
  }


}


//$conexion = new ConexionPdo();

//var_dump(getConexion());
