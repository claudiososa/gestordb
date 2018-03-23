<?php
include_once('conexion.php');
//include_once("maestro.php");

class ImgRespuesta
{
	private $imgRespuestaId;
 	private $respuestaId;
 	private $nombre;
 	private $formato;


function __construct($imgRespuestaId=NULL,$respuestaId=NULL,$nombre=NULL, $formato=NULL)
	{
		$this->imgRespuestaId = $imgRespuestaId;
 		$this->respuestaId = $respuestaId;
 		$this->nombre =$nombre;
 		$this->formato = $formato;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO img_respuesta (imgRespuestaId,respuestaId,nombre,formato)
		VALUES (NULL,'". $this->respuestaId."','". $this->nombre."','". $this->formato."');";
    //echo $sentencia;

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	/*public function editar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
				$sentencia="UPDATE leido SET contenido = '$this->contenido',
				fechaVisita = '$this->fechaVisita'
				,formato = '$this->formato' WHERE imgRespuestaId = '$this->imgRespuestaId'";
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}*/

	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM img_respuesta WHERE imgRespuestaId=".$this->imgRespuestaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->respuestaId = $elemento->respuestaId;
 		$this->nombre =$elemento->nombre;
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

		$sentencia="SELECT * FROM img_respuesta";
		if($this->respuestaId!=NULL || $this->nombre!=NULL
		|| $this->formato!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->respuestaId!=NULL)
		{
			$sentencia.=" respuestaId = $this->respuestaId && ";
		}

		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre='$this->nombre' && ";
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
