<?php   

include_once('conexion.php');

class Piso
{
	private $pisoId;
 	private $escuelaId;
 	private $estado;
 	private $apCantidad;
 	private $switchCantidad;

 
 	function __construct($pisoId=NULL,$escuelaId=NULL,$estado=NULL,$apCantidad=NULL,$switchCantidad=NULL)
	{
			 //seteo los atributos
		 	$this->pisoId = $pisoId;
		 	$this->escuelaId = $escuelaId;
		 	$this->estado = $estado;
		 	$this->apCantidad =$apCantidad;
		 	$this->switchCantidad =$switchCantidad;
		 	 
	}
	
	public function agregar()
	{   
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion(); 

		$sentencia="INSERT INTO piso (pisoId,escuelaId,estado,apCantidad,switchCantidad)
		VALUES (NULL,'". $this->escuelaId."','". $this->estado."','". $this->apCantidad."','".$this->switchCantidad."');";

		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	
	}
		 
	public function editar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		

		$sentencia="UPDATE piso SET escuelaId = '$this->escuelaId',estado = '$this->estado', apCantidad = '$this->apCantidad', switchCantidad = '$this->switchCantidad'$this->turnos'WHERE escuelaId = '$this->escuelaId'";
				
					
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function eliminar()
	{
        $nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="DELETE FROM piso WHERE pisoId=".$this->pisoId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
			
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	
   public function getPiso()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM piso WHERE pisoId=".$this->pisoId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->pisoId = $elemento->pisoId;
	 	$this->escuelaId = $elemento->escuelaId;
	 	$this->estado = $elemento->estado;
	 	$this->apCantidad = $elemento->apCantidad;
	 	$this->switchCantidad = $elemento->switchCantidad;
		return $this;
			
    }
    
   public function getEscuelaId()
   {
		return $this->escuelaId;
	}
	
	public function getEstado()
   {
		return $this->estado;
	}
	
	public function getApCantidad()
   {
		return $this->apCantidad;
	}
	
	public function getSwitchCantidad()
   {
		return $this->switchCantidad;
	}
}
?>
