<?php 
class ConexionPdo
{

  public function getConexion(){
    $conexion = new PDO("mysql:host=localhost;dbname=vicomser_conect","vicomser_conect","Vicomser.c79");
      //var_dump($this->conexion);
      return $conexion;
  }


}


//$conexion = new ConexionPdo();

//var_dump(getConexion());
