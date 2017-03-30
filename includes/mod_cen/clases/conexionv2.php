<?php
class Conexion
{

	private $host="localhost";
	private $user="vicomser_conect";
	private $pass="vicomser_conect";
	private $db="vicomser_conect";
	private $stmt;
	private $array;
	static $_instance;
	private $conexion;

  /*Realiza la conexión a la base de datos.*/
	private function conectar(){
	  $this->conexion=mysqli_connect($this->host,$this->user,$this->pass,$this->db);
	  $this->conexion->query("SET NAMES utf8");
	  /* comprobar la conexión */
		if (mysqli_connect_errno()) {
			echo "Error de conexión".mysqli_connect_errno()." : ". mysqli_connect_error();
			echo "<br>";
		}
	}
	private function __construct(){
      $this->conectar();
   }
    /*Evitamos el clonaje del objeto. Patrón Singleton*/
   private function __clone(){ }
   /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/
   public static function getInstance(){
      if (!(self::$_instance instanceof self)){
         self::$_instance=new self();
      }
         return self::$_instance;
   }

/*Método para ejecutar una sentencia sql*/
   public function ejecutar($sql){
      $this->stmt=mysqli_query($this->conexion,$sql);
      return $this->stmt;
   }
   /*Método para obtener una fila de resultados de la sentencia sql*/
   public function obtener_fila($stmt,$fila){
      if ($fila==0){
         $this->array=mysqli_fetch_array($stmt);
      }else{
         mysqli_data_seek($stmt,$fila);
         $this->array=mysqli_fetch_array($stmt);
      }
      return $this->array;
   }
   //Devuelve el último id del insert introducido
   public function lastID(){
      return mysqli_insert_id($this->conexion);
   }

}
?>
