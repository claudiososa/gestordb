<?php
class ConexionPdo
{

  public function getConexion(){
    $conexion = new PDO("mysql:host=localhost;dbname=conectar","conectar","conectar");
      //var_dump($this->conexion);
      return $conexion;
  }
}
