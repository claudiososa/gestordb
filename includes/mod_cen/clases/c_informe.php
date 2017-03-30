<?php   
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class Informe
{
	private $informeId;
 	private $escuelaId;
 	private $referenteId;
 	private $tipo;
 	private $titulo;
 	private $objetivo;
 	private $contenido;
 	private $desde;
	private $hasta; 	
 	private $fechaVisita;	
 	private $fechaCarga;
 	private $fechaModificado;
 	
 		
 	 
function __construct($informeId=NULL,$escuelaId=NULL,$referenteId=NULL,$tipo=NULL,$titulo=NULL,$objetivo=NULL,$contenido=NULL,$desde=NULL,$hasta=NULL,$fechaVisita=NULL,$fechaCarga=NULL,$fechaModificado=NULL)
	{
		$this->informeId = $informeId;
 		$this->escuelaId = $escuelaId;
 		$this->referenteId =$referenteId;
 		$this->tipo =$tipo;
 		$this->titulo =$titulo;
 		$this->objetivo =$objetivo;
 		$this->contenido =$contenido;
 		$this->desde =$desde;
		$this->hasta = $hasta; 	
 		$this->fechaVisita = $fechaVisita;
 		$this->fechaCarga = $fechaCarga;
 		$this->fechaModificado = $fechaModificado;
 				
	}
	
	
	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	
		$sentencia="INSERT INTO informes (informeId,escuelaId,referenteId,tipo,titulo,objetivo,contenido,desde,hasta,fechaVisita,fechaCarga,fechaModificado)
		VALUES (NULL,'". $this->escuelaId."','". $this->referenteId."','". $this->tipo."','".$this->titulo."','". $this->objetivo."','". $this->contenido."','". $this->desde."','". $this->hasta."','". $this->fechaVisita."','". $this->fechaCarga."','". $this->fechaModificado."');";
	
		
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
				$sentencia="UPDATE informes SET informeId = '$this->informeId', referenteId = '$this->referenteId', tipo = '$this->tipo',titulo = '$this->titulo', objetivo = '$this->objetivo', contenido = '$this->contenido', desde = '$this->desde', hasta = '$this->hasta', fechaVisita = '$this->fechaVisita' ,fechaCarga = '$this->fechaCarga', fechaModificado = '$this->fechaModificado' WHERE informeId = '$this->informeId'";		
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	
	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM informes WHERE escuelaId=".$this->escuelaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado); 
		$this->informeId = $elemento->informeId;
 		$this->escuelaId = $elemento->escuelaId;
 		$this->referenteId =$elemento->referenteId;
 		$this->tipo =$elemento->tipo;
 		$this->titulo =$elemento->titulo;
 		$this->objetivo =$elemento->objetivo;
 		$this->contenido =$elemento->contenido;
 		$this->desde =$elemento->desde;
		$this->hasta = $elemento->hasta; 	
 		$this->fechaVisita = $elemento->fechaVisita;
 		$this->fechaCarga = $elemento->fechaCarga;
 		$this->fechaModificado = $elemento->fechaModificado;
 		
		return $this;
			
    }
	
    public static function camposet($campo,$tabla){
    	$nuevaConexion=new Conexion();
    	$conexion=$nuevaConexion->getConexion();
    	$sentencia="SHOW COLUMNS FROM $tabla LIKE '$campo'";
    	$query=$conexion->query($sentencia);
    	$result = mysqli_fetch_assoc($query);
    	$result=$result['Type'];
    	$result=substr($result, 5, strlen($result)-5);
    	$result=substr($result, 0, strlen($result)-2);
    	$result = explode("','",$result);
    	return $result;
    }
	   
    public function estructura($campo){
    	$nuevaConexion=new Conexion();
    	$conexion=$nuevaConexion->getConexion();
    	$sentencia="SHOW COLUMNS FROM encuentros LIKE '$campo'";
    	$query=$conexion->query($sentencia);
    	$result = mysqli_fetch_assoc($query);
    	$result=$result['Type'];
    	$result=substr($result, 5, strlen($result)-5);
    	$result=substr($result, 0, strlen($result)-2);
    	$result = explode("','",$result);
    	return $result;
    }
    		
	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM informes";
		if($this->informeId!=NULL || $this->escuelaId!=NULL || $this->tipo!=NULL || $this->referenteId!=NULL || $this->fechaVisita!=NULL || $this->contenido!=NULL)
		{
			$sentencia.=" WHERE ";  
		
		
		if($this->informeId!=NULL)
		{
			$sentencia.=" informeId = $this->informeId && ";
		}
		
		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId = $this->escuelaId && ";
		}
		
		if($this->tipo!=NULL)
		{
			$sentencia.=" tipo=$this->tipo && ";
		}
		
		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId='$this->referenteId' && ";
		}
		
		if($this->fechaVisita!=NULL)
		{
			$sentencia.=" fechaVisita='$this->fechaVisita' && ";
		}
		
		if($this->contenido!=NULL)
		{
			$sentencia.=" contenido=$this->contenido && ";
		}
					
		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY informeId";	
		//echo $sentencia;	
		return $conexion->query($sentencia);
			
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
	
	