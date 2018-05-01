<?php

include_once('conexion.php');
//include_once("maestro.php");

class EscuelaTipoAutoridad
{
	private $id;
 	private $nivel;
 	private $tipoAutoridad;

function __construct($id=NULL,$nivel=NULL,$tipoAutoridad=NULL)
	{
		$this->id= $id;
 		$this->nivel = $nivel;
 		$this->tipoAutoridad =$tipoAutoridad;
 	}


	public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	  $sentencia="SELECT * FROM escuelaTipoAutoridad";

		if($this->id!=NULL || $this->nivel!=NULL || $this->tipoAutoridad!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->id!=NULL)
		{
			$sentencia.=" id = $this->id && ";
		}

		if($this->nivel!=NULL)
		{
			$sentencia.=" nivel LIKE '%$this->nivel%'  && ";
		}

		if($this->tipoAutoridad!=NULL)
		{
			$sentencia.=" tipoAutoridad=$this->tipoAutoridad && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY nivel DESC";
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
