<?php   

include_once('conexion.php');

class Localidad
{
	private $localidadId;
 	private $nombre;
 	private $departamento;
 	
 	function __construct($localidadId=NULL,$nombre=NULL,$departamento=NULL)
	{
			 //seteo los atributos
		 	$this->localidadId = $localidadId;
		 	$this->nombre = $nombre;
		 	$this->departamento = $departamento;	 
	}
	
	public function agregar()
	{
		
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO localidades (localidadId,nombre,departamento)
		VALUES (NULL,'". $this->nombre."','". $this->dni. $this->departamento."');";

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
		

		$sentencia="UPDATE localidades SET nombre = '$this->nombre', departamento = 'this->departamento' WHERE localidadId = '$this->localidadId'";		
					
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
		
		$sentencia="DELETE FROM localidades WHERE localidadId=".$this->localidadId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
			
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	
	}
	    
	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM localidades";
		if($this->localidadId!=NULL || $this->nombre!=NULL || $this->departamento!=NULL )
		{
			$sentencia.=" WHERE ";
		
		
		if($this->localidadId!=NULL)
		{
			$sentencia.=" localidadId=$this->localidadId && ";
		}
		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre LIKE '%$this->nombre%' && ";
		}
				
		if($this->departamento!=NULL)
		{
			$sentencia.=" departamento=".$this->departamento." && ";
		}
		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY nombre,departamento";	
	
			
		return $conexion->query($sentencia);
			
	}

   public function getLocalidad()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM localidades WHERE localidadId=".$this->localidadId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->localidadId = $elemento->localidadId;
	 	$this->nombre = $elemento->nombre;
	 	$this->departamento = $elemento->departamento;
		return $this;
			
    }
   
    
    
   public function getNombre()
   {
		return $this->nombre;
	}

	public function getDepartamento()
   {
		return $this->departamento;
	}
	
}
?>
