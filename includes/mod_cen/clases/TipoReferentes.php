<?php

include_once('conexion.php');
include_once("maestro.php");

class TipoReferentes
{

 	private $tipoId;
	private $tipoReferente;
 	private $cargoAutoridad;
	private $login;
  private $linea;



function __construct($tipoId=NULL,$tipoReferente=NULL,$cargoAutoridad=NULL,$login=NULL,$linea=NULL)
	{

 		$this->tipoId = $tipoId;
		$this->tipoReferente = $tipoReferente;
 		$this->cargoAutoridad = $cargoAutoridad;
		$this->login = $login;
    $this->linea = $linea;

	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="INSERT INTO tipoReferentes (tipoId,tipoReferente,cargoAutoridad,login,linea)
		VALUES (NULL,'". $this->tipoReferente."','". $this->cargoAutoridad."','". $this->login."','". $this->linea."');";



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

		$sentencia="UPDATE tipoReferentes SET  tipoReferente = '$this->tipoReferente',cargoAutoridad = '$this->cargoAutoridad', login = '$this->login', linea = '$this->linea'
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

		$sentencia="DELETE FROM tipoReferentes WHERE tipoId = '$this->tipoId'";
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	//eliminar

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM tipoReferentes";

		if($this->tipoId!=NULL || $this->tipoReferente!=NULL || $this->cargoAutoridad!=NULL || $this->login!=NULL|| $this->linea!=NULL)
		{
			$sentencia.=" WHERE ";



		if($this->tipoId!=NULL)
		{
			$sentencia.=" tipoId = $this->tipoId && ";
		}

		if($this->tipoReferente!=NULL)
		{
			$sentencia.=" tipoReferente = '$this->tipoReferente' && ";
		}

		if($this->cargoAutoridad!=NULL)
		{
			$sentencia.=" cargoAutoridad=$this->cargoAutoridad && ";
		}

		if($this->login!=NULL)
		{
			$sentencia.=" login = $this->login && ";
		}

    if($this->linea!=NULL)
		{
			$sentencia.=" linea = $this->linea && ";
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
