<?php

include_once('includes/mod_cen/clases/conexion.php');
include_once("includes/mod_cen/clases/maestro.php");

class TipoInforme
{
	private $tipoInformeId;
 	private $nombre;
 	private $descripcion;
	private $estado;
 	private $fechaModif;
 	private $usuarioModif;



function __construct($tipoInformeId=NULL,$nombre=NULL,$descripcion=NULL, $estado=NULL,
	$fechaModif=NULL,	$usuarioModif=NULL)
	{
		$this->tipoInformeId= $tipoInformeId;
 		$this->nombre = $nombre;
 		$this->descripcion =$descripcion;
		$this->estado = $estado;
 		$this->fechaModif = $fechaModif;
 		$this->usuarioModif = $usuarioModif;
 	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO tipoinformes (tipoInformeId,nombre,descripcion,estado,fechaModif,usuarioModif)
		VALUES (NULL,'". $this->nombre."','". $this->descripcion."','". $this->estado."','". $this->fechaModif."','". $this->usuarioModif."');";
    //echo $sentencia;

		if ($conexion->query($sentencia)) {
			$orden="SELECT MAX(tipoInformeId) AS id FROM tipoinformes";

			$datoFila = mysqli_fetch_object($conexion->query($orden));
			return $datoFila->id;
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
		$sentencia="UPDATE tipoinformes SET nombre = '$this->nombre',descripcion = '$this->descripcion'
		,estado = '$this->estado',fechaModif = '$this->fechaModif'
		,usuarioModif = '$this->usuarioModif' WHERE tipoInformeId = '$this->tipoInformeId'";

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
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
	  $sentencia="SELECT * FROM tipoinformes";

		if($this->tipoInformeId!=NULL || $this->nombre!=NULL || $this->descripcion!=NULL || $this->estado!=NULL || $this->descripcion!=NULL
		|| $this->fechaModif!=NULL || $this->usuarioModif!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->tipoInformeId!=NULL)
		{
			$sentencia.=" tipoInformeId = $this->tipoInformeId && ";
		}

		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre LIKE '%$this->nombre%'  && ";
		}

		if($this->descripcion!=NULL)
		{
			$sentencia.=" descripcion=$this->descripcion && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" estado=$this->estado && ";
		}

		if($this->fechaModif!=NULL)
		{
			$sentencia.=" fechaModif='$this->fechaModif' && ";
		}

		if($this->usuarioModif!=NULL)
		{
			$sentencia.=" usuarioModif=$this->usuarioModif && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY nombre DESC";
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
