<?php   

include_once('conexion.php');

class rtixescuela
{
	private $escuelaId;
	private $rtiId;
 	private $turno;
 	private $ingreso;
 	private $estado;
 	
 	function __construct($escuelaId=NULL,$rtiId=NULL,$turno=NULL,$ingreso=NULL,$estado=NULL)
	{
			 //seteo los atributos
			$this->escuelaId = $escuelaId;
		 	$this->rtiId = $rtiId;
		 	$this->turno = $turno;
		 	$this->ingreso = $ingreso;	 
		 	$this->estado = $estado;
	}
	
	
	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM rtixescuela";
		if($this->escuelaId!=NULL || $this->rtiId!=NULL || $this->turno!=NULL || $this->ingreso!=NULL || $this->estado!=NULL)
		{
			$sentencia.=" WHERE ";
		
		
		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId=$this->escuelaId && ";		}
		
		if($this->rtiId!=NULL)
		{
			$sentencia.=" rtiId =$this->rtiId && ";
		}
				
		if($this->turno!=NULL)
		{
			$sentencia.=" turno LIKE '%$this->turno%' && ";
		}
		
		if($this->ingreso!=NULL)
		{
			$sentencia.=" ingreso LIKE '%$this->ingreso%' && ";
		}
		
		if($this->estado!=NULL)
		{
			$sentencia.=" estado LIKE '%$this->estado%' && ";
		}
		
		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY escuelaId";	
	
		//echo $sentencia;			
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
		
		$sentencia="SELECT * FROM rtixescuela WHERE escuelaId=".$this->escuelaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->rtiId = $elemento->rtiId;
	 	$this->turno = $elemento->turno;
	 	$this->ingreso = $elemento->ingreso;
	 	$this->estado = $elemento->estado;
	 	 
		return $this;
			
    }
    
	public function getRtiId()
   {
		return $this->rtiId;
	}
	
	public function getTurno()
   {
		return $this->turnoId;
	}
	
	public function getIngreso()
   {
		return $this->ingreso;
	}
	
	public function getEstado()
	{
		return $this->estado;
	}
}
?>
