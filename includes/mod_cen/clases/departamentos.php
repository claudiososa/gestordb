<?php   

include_once('conexion.php');

class Departamentos
{
	private $departamentoId;
 	private $descripcion;
 	 	
 	function __construct($departamentoId=NULL,$descripcion=NULL)
	{
			 //seteo los atributos
		 	$this->departamentoId = $departamentoId;
		 	$this->descripcion = $descripcion;		 		 
	}
	
		

   public function getDepartamento()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM departamentos WHERE departamentoId=".$this->departamentoId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->departamentoId = $elemento->departamentoId;
	 	$this->descripcion = $elemento->descripcion;	 	
		return $this;
			
   }
   
   public static function nombre_depa($departamentoId){
   		$nuevaConexion=new Conexion();
   		$conexion=$nuevaConexion->getConexion();
   	
   		$sentencia="SELECT * FROM departamentos WHERE departamentoId=".$departamentoId;
   		return $conexion->query($sentencia);   	
   }
   
   public function getTotal()
   {
	   $nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM departamentos";
		$resultado=$conexion->query($sentencia);
		return mysqli_num_rows($resultado);
   
   }
   
   public function getDepartamentoId()
   {
		return $this->departamentoId;   
   }
   public function getDescripcion()
   {
		return $this->descripcion;
	}
	
}
?>
