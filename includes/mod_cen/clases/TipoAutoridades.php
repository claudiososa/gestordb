<?php

include_once('conexion.php');
include_once("maestro.php");

class TipoAutoridades
{
	
 	private $tipoId;
 	private $cargoAutoridad;
	private $login;
 	


function __construct($tipoId=NULL,$cargoAutoridad=NULL,$login=NULL)
	{
		
 		$this->tipoId = $tipoId;
 		$this->cargoAutoridad = $cargoAutoridad;
		$this->login = $login;
 		
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="INSERT INTO tipoAutoridades (tipoId,cargoAutoridad,login)
		VALUES (NULL,'". $this->cargoAutoridad."','". $this->login."');";



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

		$sentencia="UPDATE tipoAutoridades SET  cargoAutoridad = '$this->cargoAutoridad', login = '$this->login'
		WHERE tipoId = '$this->tipoId'";

			
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	// eliminar

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM tipoAutoridades WHERE tipoId = '$this->tipoId'";
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}




	//eliminar




	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM tipoAutoridades WHERE tipoId=".$this->tipoId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);

		
 		$this->tipoId = $elemento->tipoId;
 		$this->cargoAutoridad =$elemento->cargoAutoridad;
		$this->login =$elemento->login;
 		

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

		$sentencia="SELECT * FROM tipoAutoridades";

		if($this->tipoId!=NULL || $this->cargoAutoridad!=NULL || $this->login!=NULL)
		{
			$sentencia.=" WHERE ";


		
		if($this->tipoId!=NULL)
		{
			$sentencia.=" tipoId = $this->tipoId && ";
		}

		if($this->cargoAutoridad!=NULL)
		{
			$sentencia.=" cargoAutoridad=$this->cargoAutoridad && ";
		}

		if($this->login!=NULL)
		{
			$sentencia.=" login = $this->login && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY tipoId ASC";
		//if(isset($limit)){
			//$sentencia.=" LIMIT ".$limit;
		//}
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
