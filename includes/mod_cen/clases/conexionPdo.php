<?php
class ConexionPdo
{

  public function getConexion(){
    $conexion = new PDO("mysql:host=localhost;dbname=vicomser_conectar","vicomser_conectar","Conectar.79");
      //var_dump($this->conexion);
      return $conexion;
  }
}
