<?php

include_once("conexion.php");
include_once("maestro.php");

class PermisoCategoriaDoc
{
	private $categoriaPermisoId;
 	private $categoriaDocId;
 	private $tipoReferente;



function __construct($categoriaPermisoId=NULL,$categoriaDocId=NULL,$tipoReferente=NULL)
	{
		$this->categoriaPermisoId= $categoriaPermisoId;
 		$this->categoriaDocId = $categoriaDocId;
 		$this->tipoReferente =$tipoReferente;
 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO permiso_categoria_doc (categoriaPermisoId,categoriaDocId,tipoReferente)
		VALUES (NULL,'". $this->categoriaDocId."','". $this->tipoReferente."');";
   // echo $sentencia;

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	
	// aqui cortamos y debemos pegar de nuevo metodos editar y borrar

public function editar()
	{
	
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="UPDATE permiso_categoria_doc SET categoriaDocId = '$this->categoriaDocId',tipoReferente = '$this->tipoReferente'
		 WHERE categoriaPermisoId = '$this->categoriaPermisoId'";

			
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

/*
	public function buscar($limit=NULL)
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	    $sentencia="SELECT tipoId,tipoinformes.nombre FROM tipopermisos JOIN tipoinformes ON (tipopermisos.tipoId=tipoinformes.tipoInformeId)";

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

	}*/


	public function __get($var)
	{
		return $this->$var;

	}


	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}

}