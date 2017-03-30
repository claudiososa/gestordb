<?php   

include_once('conexion.php');
include_once('persona.php');

class Cargo
{
	private $cargoId;
	private $rtiId;
 	private $escuelaId;
 	private $turno;
 	
 	function __construct($cargoId=NULL,$rtiId=NULL,$escuelaId=NULL,$turno=NULL)
	{
			 //seteo los atributos
			$this->cargoId = $cargoId;
		 	$this->escuelaId = $escuelaId;
		 	$this->rtiId = $rtiId;
		 	$this->turno = $turno;	 
	}
	
	public function agregar()
	{
		
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO cargos (cargoId,rtiId,escuelaId,turno)
		VALUES (NULL,'". $this->rtiId."','". $this->escuelaId."','". $this->turno."');";

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
		
	}
		 
	public function editar()
	{
		
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		

		$sentencia="UPDATE cargos SET rtiId = '$this->rtiId', escuelaId = '$this->escuelaId', turno = '$this->turno' WHERE cargoId = '$this->cargoId'";
					
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="DELETE FROM cargos WHERE cargoId=".$this->cargoId;
		if ($conexion->query($sentencia)) {
			return 1;
			
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	
	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM cargos";
		if($this->rtiId!=NULL || $this->escuelaId!=NULL || $this->turno!=NULL)
		{
			$sentencia.=" WHERE ";
		
		
		if($this->rtiId!=NULL)
		{
			$sentencia.=" rtiId LIKE '%$this->rtiId%' && ";
		}
		
		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId LIKE '%$this->escuelaId%' && ";
		}
				
		if($this->turno!=NULL)
		{
			$sentencia.=" turno LIKE '%$this->turno%' && ";
		}
		
		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY escuelaId";	
	
			
		return $conexion->query($sentencia);
			
	}
	
	public function Cargo()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();		
		//$sentencia="SELECT * FROM rti WHERE referenteId=".$this->referenteId;
		$sentencia="SELECT cargos.escuelaId,cargos.turno,rti.rtiId,rti.personaId,personas.nombre,personas.apellido,personas.telefonoM FROM cargos inner join rti on cargos.rtiId=rti.rtiId inner join personas on rti.personaId=personas.personaId WHERE escuelaId=".$this->escuelaId; 
		//echo $sentencia;
		//echo $this->referenteId;
		return $conexion->query($sentencia);					
    }    
	    
	    

   public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM cargos WHERE cargoId=".$this->cargoId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->rtiId = $elemento->rtiId;
	 	$this->escuelaId = $elemento->escuelaId;
	 	$this->turno = $elemento->turno;
		return $this;
			
    }
    
   public function getCargoId()
   {
		return $this->cargoId;
	}

	public function getRtiId()
   {
		return $this->rtiId;
	}
	
	public function getEscuelaId()
   {
		return $this->escuelaId;
	}
	
	public function getTurno()
   {
		return $this->turno;
	}
	


}
?>
