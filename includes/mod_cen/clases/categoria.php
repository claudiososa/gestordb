<?php

include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class categoria
{
	private $idCategoria;
 	private $nombre;
	

function __construct($idCategoria=NULL,$nombre=NULL)
	{
		$this->idCategoria = $idCategoria;
 		$this->nombre =$nombre;
				
	}


	

	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM categoria WHERE idCategoria=".$this->idCategoria;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		
		$this->idCategoria = $elemento->idCategoria;
 		$this->nombre =$elemento->nombre;
				
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

    

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM categoria";
		if($this->idCategoria!=NULL ||  $this->nombre!=NULL )
		{
			$sentencia.=" WHERE ";


		if($this->idCategoria!=NULL)
		{
			$sentencia.=" idCategoria = $this->idCategoria && ";
		}

		
		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre=$this->nombre && ";
		}

		

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY idCategoria ASC"; 
		
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
