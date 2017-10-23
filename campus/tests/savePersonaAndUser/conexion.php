<?php
 class Conexion extends PDO {
   private $tipo_de_base = 'mysql';
   private $host = 'localhost';
   private $nombre_de_base = 'vicomser_pdo';
   private $usuario = 'vicomser_pdo';
   private $contrasena = 'Vicomser.c79';
   public function __construct() {
      //Sobreescribo el método constructor de la clase PDO.
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   }
 }
/*
class Conexion{
  public function conectar(){
    $link = new PDO("mysql:host=localhost;dbname=vicomser_pdo","vicomser_pdo","Vicomser.c79");
    //var_dump($link);
    return $link;
  }
}
*/
?>
