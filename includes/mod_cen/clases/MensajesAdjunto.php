<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class MensajesAdjunto
{
	private $mensajesAdjuntoId;
 	private $mensajeId;
 	private $archivo;
 	private $formato;


function __construct($mensajesAdjuntoId=NULL,$mensajeId=NULL,$archivo=NULL, $formato=NULL)
	{
		$this->mensajesAdjuntoId = $mensajesAdjuntoId;
 		$this->mensajeId = $mensajeId;
 		$this->archivo =$archivo;
 		$this->formato = $formato;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO mensajesAdjunto (mensajesAdjuntoId,mensajeId,archivo,formato)
		VALUES (NULL,'". $this->mensajeId."','". $this->archivo."','". $this->formato."');";
    echo $sentencia;

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

		$sentencia="SELECT * FROM mensajesAdjunto WHERE mensajesAdjuntoId=".$this->mensajesAdjuntoId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->mensajeId = $elemento->mensajeId;
 		$this->archivo =$elemento->archivo;
		$this->formato = $elemento->formato;
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


	public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM mensajesAdjunto";
		if($this->mensajeId!=NULL || $this->archivo!=NULL
		|| $this->formato!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->mensajeId!=NULL)
		{
			$sentencia.=" mensajeId = $this->mensajeId && ";
		}

		if($this->archivo!=NULL)
		{
			$sentencia.=" archivo='$this->archivo' && ";
		}

		if($this->formato!=NULL)
		{
			$sentencia.=" formato='$this->formato' && ";
		}



		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY formato ASC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
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
