<?php

include_once('conexionv2.php');

class CompartePredio
{
	private $id;
 	private $escuelaId;
 	private $predio;
	private $referenteId;

function __construct($id=NULL,$escuelaId=NULL,$predio=NULL,$referenteId=NULL)
	{
		$this->id= $id;
 		$this->escuelaId = $escuelaId;
 		$this->predio =$predio;
		$this->referenteId = $referenteId;
 	}


	public function agregar(){
		
	}


	public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	  $sentencia="SELECT * FROM escuelapredio";

		if($this->id!=NULL || $this->escuelaId!=NULL || $this->predio!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->id!=NULL)
		{
			$sentencia.=" id = $this->id && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId LIKE '%$this->escuelaId%'  && ";
		}

		if($this->predio!=NULL)
		{
			$sentencia.=" predio=$this->predio && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY escuelaId DESC";
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
