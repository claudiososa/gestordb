<?php

include_once("conexion.php");
include_once("maestro.php");

class Documento
{
	private $documentoId;
	private $categoriaDocId;
	private $nombreArchivo;
	private $titulo;
	private $descripcion;
	private $destacado;
	private $fechaSubida;
	private $fechaUpdate;
 	


function __construct($documentoId=NULL,$categoriaDocId=NULL,$nombreArchivo=NULL,$titulo=NULL,$descripcion=NULL,$destacado=NULL,$fechaSubida=NULL,$fechaUpdate=NULL)
	{
		$this->documentoId= $documentoId;
 		$this->categoriaDocId = $categoriaDocId;
 		$this->nombreArchivo = $nombreArchivo;
 		$this->titulo = $titulo;
 		$this->descripcion = $descripcion;
 		$this->destacado = $destacado;
 		$this->fechaSubida = $fechaSubida;
 		$this->fechaUpdate = $fechaUpdate;



 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO documentos (documentoId,categoriaDocId,nombreArchivo,titulo,descripcion,destacado,fechaSubida,fechaUpdate)
		VALUES (NULL,'". $this->categoriaDocId."','". $this->nombreArchivo."','". $this->titulo."','". $this->descripcion."','". $this->destacado."','". $this->fechaSubida."','". $this->fechaUpdate."');";
   // echo $sentencia;

		if ($conexion->query($sentencia)) {
			
			$orden="SELECT MAX(documentoId) AS id FROM documentos";
			$datoFila = mysqli_fetch_object($conexion->query($orden));

			return $datoFila->id;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}
	
	

public function editar()
	{
	
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="UPDATE documentos SET categoriaDocId = '$this->categoriaDocId',nombreArchivo = '$this->nombreArchivo',titulo = '$this->titulo',descripcion = '$this->descripcion',destacado = '$this->destacado',fechaSubida = '$this->fechaSubida',fechaUpdate = '$this->fechaUpdate'
		 WHERE documentoId = '$this->documentoId'";

			
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
	 
	  $sentencia="SELECT * FROM documentos";

	if($this->documentoId!=NULL || $this->categoriaDocId!=NULL || $this->nombreArchivo!=NULL || $this->titulo!=NULL || $this->descripcion!=NULL || $this->destacado!=NULL || $this->fechaSubida!=NULL || $this->fechaUpdate!=NULL)
		{
			$sentencia.=" WHERE ";


		

		if($this->documentoId != NULL)
		{
			$sentencia.=" documentoId =  $this->documentoId  && ";
		}

		if($this->categoriaDocId != NULL)
		{
			$sentencia.=" categoriaDocId = $this->categoriaDocId && ";
		}

		if($this->nombreArchivo != NULL)
		{
			$sentencia.=" nombreArchivo = $this->nombreArchivo && ";
		}

		if($this->titulo!= NULL)
		{
			$sentencia.=" titulo = $this->titulo && ";
		}

		if($this->descripcion != NULL)
		{
			$sentencia.=" descripcion = $this->descripcion && ";
		}

		if($this->destacado != NULL)
		{
			$sentencia.=" destacado = $this->destacado && ";
		}

		if($this->fechaSubida != NULL)
		{
			$sentencia.=" fechaSubida = $this->fechaSubida && ";
		}

		if($this->fechaUpdate != NULL)
		{
			$sentencia.=" fechaUpdate = $this->fechaUpdate && ";
		}



		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY documentoId ASC";
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