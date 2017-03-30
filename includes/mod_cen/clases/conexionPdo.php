<?php
class ConexionPdo
{

  public function getConexion(){
    $conexion = new PDO("mysql:host=localhost;dbname=vicomser_conect","vicomser_conect","vicomser_conect");
      //var_dump($this->conexion);
      return $conexion;
  }
}
