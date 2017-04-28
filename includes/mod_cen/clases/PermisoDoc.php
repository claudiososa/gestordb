<?php

include_once("conexion.php");
include_once("maestro.php");

class PermisoDoc
{
	private $docPermisoId;
 	private $documentoId;
 	private $tipoReferente;



function __construct($docPermisoId=NULL,$documentoId=NULL,$tipoReferente=NULL)
	{
		$this->docPermisoId= $docPermisoId;
 		$this->documentoId = $documentoId;
 		$this->tipoReferente = $tipoReferente;
 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO permiso_doc (docPermisoId,documentoId,tipoReferente)
		VALUES (NULL,'". $this->documentoId."','". $this->tipoReferente."');";
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
		$sentencia="UPDATE permiso_doc SET documentoId = '$this->documentoId',tipoReferente = '$this->tipoReferente'
		 WHERE docPermisoId = '$this->docPermisoId'";

			
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

// buscar nuevo

public function buscar($limit=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	 
	  $sentencia="SELECT * FROM permiso_doc";

	if($this->docPermisoId!=NULL || $this->documentoId!=NULL || $this->tipoReferente!=NULL )
		{
			$sentencia.=" WHERE ";


		if($this->docPermisoId != NULL)
		{
			$sentencia.=" docPermisoId = $this->docPermisoId && ";
		}

		if($this->documentoId != NULL)
		{
			$sentencia.=" documentoId =  $this->documentoId  && ";
		}

		if($this->tipoReferente != NULL)
		{
			$sentencia.=" tipoReferente = $this->tipoReferente && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY docPermisoId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
		return $conexion->query($sentencia);

	}



// buscar original

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

	}
*/


	public function __get($var)
	{
		return $this->$var;

	}


	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}

}