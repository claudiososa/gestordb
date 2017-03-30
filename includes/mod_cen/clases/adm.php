<?php   

include_once('conexion.php');

class Adm
{
	private $admId;
 	private $escuelaId;
 	private $estado;
 	private $servidor;
 	private $router;
 	private $pizarraDigital;
	private $proyector;
	private $impresora;
 	private $ups;
 	private $camaraFoto;
 	private $pendrive;
 	private $cantidadNetbook;
 	private $netMarca;
 	private $netFunciona;
 	private $netFalla;
 	private $migrahuayra;
 	private $observaciones;
 	
 	/*function __construct ($migrahuayra)
 	{
		$this->migrahuayra=$migrahuayra; 	
 	}*/
 	function __construct($admId=NULL,$escuelaId=NULL,$estado=NULL,$servidor=NULL,$router=NULL,$pizarraDigital=NULL,$proyector=NULL,$impresora=NULL,$ups=NULL,$camaraFoto=NULL,$pendrive=NULL,$cantidadNetbook=NULL,$netMarca=NULL,$netFunciona=NULL,$netFalla=NULL,$migrahuayra=NULL,$observaciones=NULL)
	{
			 //seteo los atributos
			$this->admId=$admId;
 			$this->escuelaId=$escuelaId;
 			$this->estado=$estado;
 			$this->servidor=$servidor;
 			$this->router=$router;
 			$this->pizarraDigital=$pizarraDigital;
			$this->proyector=$proyector;
			$this->impresora=$impresora;
 			$this->ups=$ups;
 			$this->camaraFoto=$camaraFoto;
 			$this->pendrive=$pendrive;
 			$this->cantidadNetbook=$cantidadNetbook;
 			$this->netMarca=$netMarca;
 			$this->netFunciona=$netFunciona;
 			$this->netFalla=$netFalla;
 			$this->migrahuayra=$migrahuayra;
 			$this->observaciones=$observaciones;		 			 	 
	}
	
	public function agregar()
	{
		
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO adm (admId,escuelaId,estado,servidor,router,pizarradigital,proyector,impresora,ups,camarafoto,pendrive,cantidadnetbook,netmarca,netfunciona,netfalla,migrahuayra,observaciones)
		VALUES (NULL,'". $this->escuelaId."','". $this->estado."','". $this->servidor."','".$this->router."','". $this->pizarraDigital."','". $this->proyector."','". $this->impresora."','". $this->ups."','". $this->camaraFoto."','". $this->pendrive."','". $this->cantidadNetbook."','". $this->netMarca."','". $this->netFunciona."','". $this->netFalla."','". $this->migrahuayra."','". $this->observaciones."');";
		//echo $sentencia;
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
		

		$sentencia="UPDATE adm SET escuelaId = '$this->escuelaId', estado = '$this->estado', servidor = '$this->servidor', router = '$this->router', pizarradigital = '$this->pizarraDigital', proyector = '$this->proyector', impresora = '$this->impresora', ups = '$this->ups', camarafoto = '$this->camaraFoto', pendrive = '$this->pendrive', cantidadnetbook = '$this->cantidadNetbook', netmarca = '$this->netMarca', netfunciona = '$this->netFunciona', netfalla = '$this->netFalla', migrahuayra = '$this->migrahuayra', observaciones = '$this->observaciones' WHERE admId = '$this->admId'";
		//,direccion = '$this->direccion',facebook = '$this->facebook' WHERE personaId = '$this->personaId'		
					
		if ($conexion->query($sentencia)) {
			return 1;
		}else {
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="DELETE FROM personas WHERE personaId=".$this->personaId;
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
		
		$sentencia="SELECT * FROM adm";
		if($this->escuelaId!=NULL || $this->estado!=NULL || $this->servidor!=NULL || $this->router!=NULL || $this->pizarraDigital!=NULL || $this->proyector!=NULL || $this->impresora!=NULL || $this->ups!=NULL || $this->camaraFoto!=NULL || $this->pendrive!=NULL || $this->cantidadNetbook!=NULL || $this->netMarca!=NULL || $this->netFunciona!=NULL || $this->netFalla!=NULL || $this->migrahuayra!=NULL || $this->observaciones!=NULL )
		{
			$sentencia.=" WHERE ";
		
		
		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId = $this->escuelaId && ";
		}
		
		if($this->estado!=NULL)
		{
			$sentencia.=" estado='$this->estado' && ";
		}
				
		if($this->servidor!=NULL)
		{
			$sentencia.=" servidor LIKE '%$this->servidor%' && ";
		}
		
		if($this->router!=NULL)
		{
			$sentencia.=" router LIKE '%$this->router%' && ";
		}

		if($this->pizarraDigital!=NULL)
		{
			$sentencia.=" pizarradigital LIKE '%$this->pizarraDigital%' && ";
		}
		
		if($this->proyector!=NULL)
		{
			$sentencia.=" proyector LIKE '%$this->proyector%' && ";
		}
		
		if($this->impresora!=NULL)
		{
			$sentencia.=" impresora LIKE '%$this->impresora%' && ";
		}
		
		if($this->ups!=NULL)
		{
			$sentencia.=" ups LIKE '%$this->ups%' && ";
		}
		
		if($this->camaraFoto!=NULL)
		{
			$sentencia.=" camarafoto LIKE '%$this->camaraFoto%' && ";
		}
		
		if($this->pendrive!=NULL)
		{
			$sentencia.=" pendrive LIKE '%$this->pendrive%' && ";
		}
		
		if($this->cantidadNetbook!=NULL)
		{
			$sentencia.=" cantidadnetbook LIKE '%$this->cantidadNetbook%' && ";
		}
		
		if($this->netMarca!=NULL)
		{
			$sentencia.=" netmarca LIKE '%$this->netMarca%' && ";
		}
		
		if($this->netFunciona!=NULL)
		{
			$sentencia.=" netfunciona LIKE '%$this->netFunciona%' && ";
		}
		
		if($this->netFalla!=NULL)
		{
			$sentencia.=" netfalla LIKE '%$this->netFalla%' && ";
		}
		
		if($this->migrahuayra!=NULL)
		{
			$sentencia.=" migrahuayra='$this->migrahuayra' && ";
		}
				
		if($this->observaciones!=NULL)
		{
			$sentencia.=" observaciones LIKE '%$this->observaciones%' && ";
		}
		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);	
		
		}
		
		$sentencia.="  ORDER BY escuelaId";	
	
		//echo $sentencia;	
		return $conexion->query($sentencia);
			
	}
	
	    

   public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		
		$sentencia="SELECT * FROM adm WHERE admId=".$this->admId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->admId=$elemento->admId;
 		$this->escuelaId=$elemento->escuelaId;
 		$this->estado=$elemento->estado;
 		$this->servidor=$elemento->servidor;
 		$this->router=$elemento->router;
 		$this->pizarraDigital=$elemento->pizarradigital;
		$this->proyector=$elemento->proyector;
		$this->impresora=$elemento->impresora;
 		$this->ups=$elemento->ups;
 		$this->camaraFoto=$elemento->camarafoto;
 		$this->pendrive=$elemento->pendrive;
 		$this->cantidadNetbook=$elemento->cantidadnetbook;
 		$this->netMarca=$elemento->netMarca;
 		$this->netFunciona=$elemento->netfunciona;
 		$this->netFalla=$elemento->netfalla;
 		$this->migrahuayra=$elemento->migrahuayra;
 		$this->observaciones=$elemento->observaciones;		 	 
				
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
	
	public function getServidor()
   {
		return $this->servidor;
	}
	
	public function getRouter()
   {
		return $this->router;
	}
	
	public function getPizarraDigital()
   {
		return $this->pizarraDigital;
	}
	
	public function getProyector()
   {
		return $this->proyector;
	}
	
	public function getImpresora()
   {
		return $this->impresora;
	}
	
	public function getUps()
   {
		return $this->ups;
	}
	
	public function getCamaraFoto()
   {
		return $this->camaraFoto;
	}
		
	public function getPendrive()
   {
		return $this->pendrive;
	}
	
	public function getCantidadNetbook()
   {
		return $this->cantidadNetbook;
	}
	
	public function getNetMarca()
   {
		return $this->netMarca;
	}
	
	public function getNetFunciona()
   {
		return $this->netFunciona;
	}
	
	public function getNetFalla()
   {
		return $this->netFalla;
	}
	
	public function __get($var)
   {
		return $this->$var;
	
	}
	
	public function getObservaciones()
   {
		return $this->observaciones;
	}
	
	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}
	
	public function setEstado($estado)
	{
		$this->estado=$estado;
	}			
}
?>
