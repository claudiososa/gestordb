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



public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM permiso_categoria_doc WHERE $categoriaPermisoId = '$this->categoriaPermisoId'";
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

public function eliminarPermisos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM permiso_categoria_doc WHERE categoriaDocId = '$this->categoriaDocId'";
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
	 
	  $sentencia="SELECT * FROM permiso_categoria_doc";

	if($this->categoriaPermisoId!=NULL || $this->categoriaDocId!=NULL || $this->tipoReferente!=NULL )
		{
			$sentencia.=" WHERE ";


		if($this->categoriaPermisoId != NULL)
		{
			$sentencia.=" categoriaPermisoId = $this->categoriaPermisoId && ";
		}

		if($this->categoriaDocId != NULL)
		{
			$sentencia.=" categoriaDocId =  $this->categoriaDocId  && ";
		}

		if($this->tipoReferente != NULL)
		{
			$sentencia.=" tipoReferente = $this->tipoReferente && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY categoriaPermisoId ASC";
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

if(isset($_POST["opcion"])){


$tipoPermiso = new PermisoCategoriaDoc(NULL,$_POST["opcion"],Null);
$buscarTipoPermiso = $tipoPermiso->buscar();


   $resultado="<ul class='form-group' id='subtipo' name='subtipo'> ";


	while($fila = mysqli_fetch_object($buscarTipoPermiso))
		{
			$resultado.="<li class='checkbox'><input type='checkbox' name='tipo[]' value='".$fila->tipoReferente."'>".$fila->tipoReferente."</li>";
		}
		
	$resultado.="</ul>";	
	
	echo $resultado;
}

