<?php

include_once("conexion.php");
include_once("maestro.php");

class TipoPermisos
{
	private $tipoPermisosId;
 	private $tipoId;
 	private $tipoReferente;



function __construct($tipoPermisosId=NULL,$tipoId=NULL,$tipoReferente=NULL)
	{
		$this->tipoPermisosId= $tipoPermisosId;
 		$this->tipoId = $tipoId;
 		$this->tipoReferente =$tipoReferente;
 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO tipopermisos (tipoPermisosId,tipoId,tipoReferente)
		VALUES (NULL,'". $this->tipoId."','". $this->tipoReferente."');";
    echo $sentencia;

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	public function editar()
	{
	//	$fecha_a=date("Y-m-d H:i:s");
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="UPDATE tipopermisos SET tipoId = '$this->tipoId',tipoReferente = '$this->tipoReferente'
		 WHERE tipoPermisosId = '$this->tipoPermisosId'";

			//	$sentencia="UPDATE informes SET prioridad = '$this->prioridad',tipo = '$this->tipo'
				//,titulo = '$this->titulo', contenido = '$this->contenido', WHERE informeId = '$this->informeId'";
		//echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}


	public function buscar($limit=NULL)
	{
/*
		SELECT tipoId,tipoReferente,tipoinformes.nombre
		FROM
		tipopermisos
		JOIN tipoinformes
		ON (tipopermisos.tipoId = tipoinformes.tipoInformeId)
		WHERE tipoReferente="ETJ"*/

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	  $sentencia="SELECT tipoId,tipoReferente,tipoinformes.nombre FROM tipopermisos JOIN tipoinformes ON (tipopermisos.tipoId=tipoinformes.tipoInformeId)";

		if($this->tipoPermisosId!=NULL || $this->tipoId!=NULL || $this->tipoReferente!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->tipoPermisosId!=NULL)
		{
			$sentencia.=" tipoPermisosId = $this->tipoPermisosId && ";
		}

		if($this->tipoId!=NULL)
		{
			$sentencia.=" tipoId = $this->tipoId && ";
		}

		if($this->tipoReferente!=NULL)
		{
			$sentencia.=" tipoReferente='$this->tipoReferente' && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY tipoinformes.nombre DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
	//	echo $sentencia;
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
