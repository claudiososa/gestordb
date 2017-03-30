<?php   

include_once('conexion.php');
include_once("localidades.php");

class Escuela
{
	private $escuelaId;
 	private $referenteId;
 	private $cue;
 	private $numero;
 	private $nombre;
 	private $domicilio;
	private $nivel;
	private $localidadId;
 	private $turnos;
 	private $telefono;

 
 	function __construct($escuelaId=NULL,$referenteId=NULL,$cue=NULL,$numero=NULL,$nombre=NULL,$domicilio=NULL,$nivel=NULL,$localidadId=NULL,$turnos=NULL,$telefono=NULL)
	{
			 //seteo los atributos
		 	$this->escuelaId = $escuelaId;
		 	$this->referenteId = $referenteId;
		 	$this->cue = $cue;
		 	$this->numero =$numero;
		 	$this->nombre =$nombre;
		 	$this->domicilio = $domicilio;
		 	$this->nivel = $nivel;
		 	$this->localidadId = $localidadId;
		 	$this->turnos = $turnos;
		 	$this->telefono = $telefono;		 
	}
	
	public function agregar()
	{   
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO escuelas (escuelaId,referenteId,cue,numero,nombre,domicilio,nivel,localidadId,turnos,telefono)
		VALUES (NULL,$this->referenteId,".$this->cue.",".$this->numero.",'".$this->nombre."','".$this->domicilio."','".$this->nivel."',".$this->localidadId.",'".$this->turnos."','".$this->telefono."');";
		
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
		
		$sentencia="UPDATE escuelas SET referenteId ='$this->referenteId',cue = '$this->cue', numero = '$this->numero', nombre = '$this->nombre',domicilio = '$this->domicilio', nivel = '$this->nivel', localidadId = '$this->localidadId', turnos = '$this->turnos', telefono = '$this->telefono' WHERE escuelaId = '$this->escuelaId'";
							
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function editarref()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="UPDATE escuelas SET referenteId ='$this->referenteId' WHERE escuelaId = '$this->escuelaId'";
							
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
		
		$sentencia="DELETE FROM escuelas WHERE escuelaId=".$this->escuelaId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
			
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	
	public function buscarRef(){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();		
		$sentencia="SELECT * FROM escuelas WHERE escuelaId=$this->escuelaId AND referenteId=$this->referenteId";
		return $conexion->query($sentencia);	
	}
	
	public function buscarcue()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM escuelas WHERE cue=$this->cue";
		$resultado=$conexion->query($sentencia);
		$cant=mysqli_num_rows($resultado);
		//echo $cant;
		if($cant>0) {
			return 1;
		}else {
			return 0;		
		}	
	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM escuelas";
		if($this->escuelaId!=NULL || $this->referenteId!=NULL || $this->cue!=NULL || $this->numero!=NULL || $this->nombre!=NULL || $this->domicilio!=NULL || $this->nivel!=NULL || $this->localidadId!=NULL || $this->turnos!=NULL )
		{
			$sentencia.=" WHERE ";
		
		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId=$this->escuelaId && ";
		}
		
		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId=$this->referenteId && ";
		}
		
		if($this->cue!=NULL)
		{
			$sentencia.=" cue LIKE '%$this->cue%' && ";
		}
				
		if($this->numero!=NULL)
		{
			$sentencia.=" numero=$this->numero && ";
		}
		
		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre LIKE '%$this->nombre%' && ";
		}
		
		if($this->domicilio!=NULL)
		{
			$sentencia.=" domicilio LIKE '%$this->domicilio%' && ";
		}
		
		if($this->nivel!=NULL)
		{
			$sentencia.=" nivel LIKE '$this->nivel' && ";
		}

		if($this->localidadId>1)
			{
			$localidad= new Localidad(null,null,$this->localidadId);
			$resultado1=$localidad->buscar();
			
				while($fila1=mysqli_fetch_object($resultado1)) 
				{
					$sentencia.=" localidadId=$fila1->localidadId || ";					
	     		}
		}
		
		if($this->turnos!=NULL)
		{
			$sentencia.=" turnos LIKE '%$this->turnos%' && ";
		}
		
		if($this->telefono!=NULL)
		{
			$sentencia.=" telefono LIKE '%$this->telefono%' && ";
		}
		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY numero";	
	
		//echo $sentencia;	
		return $conexion->query($sentencia);
			
	}
	
	public function Cargo()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();		
		$sentencia="SELECT * FROM escuelas WHERE referenteId=".$this->referenteId;
		//echo $sentencia;
		//echo $this->referenteId;
		return $conexion->query($sentencia);					
    }    

   public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM escuelas WHERE escuelaId=".$this->escuelaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->escuelaId = $elemento->escuelaId;
	 	$this->referenteId = $elemento->referenteId;
	 	$this->cue = $elemento->cue;
	 	$this->numero = $elemento->numero;
	 	$this->nombre = $elemento->nombre;
	 	$this->domicilio = $elemento->domicilio;
	 	$this->nivel = $elemento->nivel;
	 	$this->localidadId = $elemento->localidadId;
	 	$this->turnos = $elemento->turnos;
	 	$this->telefono = $elemento->telefono;
		return $this;
			
    }
    
   public function getReferenteId()
   {
		return $this->referenteId;
	}
	
	public function getCue()
   {
		return $this->cue;
	}
	
	public function getNumero()
   {
		return $this->numero;
	}
	
	public function getNombre()
   {
		return $this->nombre;
	}
	
	public function getDomicilio()
   {
		return $this->domicilio;
	}
	
	public function getNivel()
   {
		return $this->nivel;
	}
	
	public function getLocalidadId()
   {
		return $this->localidadId;
	}
	
	public function getTurnos()
   {
		return $this->turnos;
	}
	
	public function getTelefono()
   {
		return $this->telefono;
	}
	
	public function __get($var)
   {
		return $this->$var;
	
	}
	
		
	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}
		
}
?>
