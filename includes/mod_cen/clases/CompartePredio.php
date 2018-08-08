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
		$bd=Conexion2::getInstance();
		$sentencia = "INSERT INTO escuelaPredio (id,escuelaId,predio,referenteId)
									VALUES (NULL,'".$this->escuelaId."','".$this->predio."','".$this->referenteId."')";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoPredio=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function editar(){
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE escuelaPredio SET escuelaId=$this->escuelaId,predio=$this->predio,referenteId=$this->referenteId
									WHERE id=$this->id";
		if ($bd->ejecutar($sentencia)) {
			return $ultimoPredio=$bd->lastID();
		}else{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno.":".$conexion->error;
		}
	}

	public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	  $sentencia="SELECT * FROM escuelaPredio";

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
