<?php
include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class Img
{
	private $imgId;
 	private $informeId;
 	private $nombre;
 	private $formato;


function __construct($imgId=NULL,$informeId=NULL,$nombre=NULL, $formato=NULL)
	{
		$this->imgId = $imgId;
 		$this->informeId = $informeId;
 		$this->nombre =$nombre;
 		$this->formato = $formato;
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO img (imgId,informeId,nombre,formato)
		VALUES (NULL,'". $this->informeId."','". $this->nombre."','". $this->formato."');";
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
				,formato = '$this->formato' WHERE imgId = '$this->imgId'";
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

		$sentencia="SELECT * FROM img WHERE imgId=".$this->imgId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->informeId = $elemento->informeId;
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

		$sentencia="SELECT * FROM img";
		if($this->informeId!=NULL || $this->nombre!=NULL
		|| $this->formato!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->informeId!=NULL)
		{
			$sentencia.=" informeId = $this->informeId && ";
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
