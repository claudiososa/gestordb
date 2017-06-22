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
	private $referenteId;
	private $tipo;




function __construct($documentoId=NULL,$categoriaDocId=NULL,$nombreArchivo=NULL,$titulo=NULL,$descripcion=NULL,$destacado=NULL,$fechaSubida=NULL,$fechaUpdate=NULL,$referenteId=NULL,$tipo=NULL)
	{
		$this->documentoId= $documentoId;
 		$this->categoriaDocId = $categoriaDocId;
 		$this->nombreArchivo = $nombreArchivo;
 		$this->titulo = $titulo;
 		$this->descripcion = $descripcion;
 		$this->destacado = $destacado;
 		$this->fechaSubida = $fechaSubida;
 		$this->fechaUpdate = $fechaUpdate;
 		$this->referenteId = $referenteId;
 		$this->tipo = $tipo;



 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO documentos (documentoId,categoriaDocId,nombreArchivo,titulo,descripcion,destacado,fechaSubida,fechaUpdate,referenteId,tipo)
		VALUES (NULL,'". $this->categoriaDocId."','". $this->nombreArchivo."','". $this->titulo."','". $this->descripcion."','". $this->destacado."','". $this->fechaSubida."','". $this->fechaUpdate."','". $this->referenteId."','". $this->tipo."');";
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



public function editar($tipo=NULL)
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		if (isset($tipo)) {
			if($tipo=='nombreArchivo'){
				$sentencia="UPDATE documentos SET nombreArchivo = '$this->nombreArchivo'
			 	WHERE documentoId = '$this->documentoId'";
			}
		}else{
			$sentencia="UPDATE documentos SET categoriaDocId = '$this->categoriaDocId',nombreArchivo = '$this->nombreArchivo',titulo = '$this->titulo',descripcion = '$this->descripcion',destacado = '$this->destacado',fechaSubida = '$this->fechaSubida',fechaUpdate = '$this->fechaUpdate',referenteId = '$this->referenteId',tipo = '$this->tipo'
			 WHERE documentoId = '$this->documentoId'";
		}


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

	  $sentencia="SELECT documentos.documentoId,documentos.categoriaDocId,documentos.nombreArchivo,
		  								 documentos.titulo,documentos.descripcion,documentos.destacado,
											 documentos.fechaSubida,documentos.fechaUpdate,
											 personas.apellido,personas.nombre
												 FROM documentos
												 INNER JOIN referentes
												 ON documentos.referenteId=referentes.referenteId
												 INNER JOIN personas
												 ON referentes.personaId=personas.personaId"
												 ;

	if($this->documentoId!=NULL || $this->categoriaDocId!=NULL || $this->nombreArchivo!=NULL
			|| $this->titulo!=NULL || $this->descripcion!=NULL || $this->destacado!=NULL
			|| $this->fechaSubida!=NULL || $this->fechaUpdate!=NULL || $this->tipo!=NULL)
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

		if($this->tipo != NULL)
		{
			$sentencia.=" documentos.tipo = '$this->tipo' && ";
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

		$sentencia.="  ORDER BY documentoId DESC";
		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia;
		return $conexion->query($sentencia);

	}


// metodo para buscar documentos segun permiso.

	public function buscarDocPermiso($cargo,$cat_id)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();




	    $sentencia="SELECT  documentos.nombreArchivo,documentos.titulo,documentos.destacado,documentos.descripcion
								FROM documentos
								JOIN permiso_doc
								ON (permiso_doc.documentoId = documentos.documentoId ) ";


		if($cargo!=NULL && $cat_id!=NULL)
			{
				$sentencia.=" WHERE permiso_doc.tipoReferente = '".$cargo."' AND documentos.categoriaDocId = ".$cat_id;

			}





		$sentencia.="  ORDER BY destacado DESC";
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

	public function destinatariosMail($permiso,$idDocumento)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();








		
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
