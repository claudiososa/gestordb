<?php

include_once('conexion.php');
include_once("maestro.php");

class SubTipoInforme
{
	private $subTipoId;
 	private $tipoId;
 	private $nombre;
	private $descripcion;
 	private $estado;
 	private $fechaModif;
	private $userModif;


function __construct($subTipoId=NULL,$tipoId=NULL,$nombre=NULL,$descripcion=NULL,
	$estado=NULL, $fechaModif=NULL,$userModif=NULL)
	{
		$this->subTipoId = $subTipoId;
 		$this->tipoId = $tipoId;
 		$this->nombre =$nombre;
		$this->descripcion = $descripcion;
 		$this->estado =$estado;
 		$this->fechaModif =$fechaModif;
 		$this->userModif =$userModif;

	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="INSERT INTO SubTipoInforme (subTipoId,tipoId,nombre,descripcion,estado,fechaModif,userModif)
		VALUES (NULL,'". $this->tipoId."','". $this->nombre."','".$this->descripcion."',
		'".$this->estado."','". $this->fechaModif."','". $this->userModif."');";



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

		$sentencia="UPDATE SubTipoInforme SET  tipoId = '$this->tipoId', nombre = '$this->nombre',descripcion = '$this->descripcion'
		,estado = '$this->estado', fechaModif = '$this->fechaModif',
		userModif = '$this->userModif'
		WHERE subTipoId = '$this->subTipoId'";

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

	// eliminar

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM SubTipoInforme WHERE subTipoId = '$this->subTipoId'";
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}




	//eliminar




	public function getDatos()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM SubTipoInforme WHERE tipoId=".$this->tipoId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);

		$this->subTipoId = $elemento->subTipoId;
 		$this->tipoId = $elemento->tipoId;
 		$this->nombre =$elemento->nombre;
		$this->descripcion =$elemento->descripcion;
 		$this->estado =$elemento->estado;
 		$this->fechaModif =$elemento->fechaModif;
		$this->userModif =$elemento->userModif;

		return $this;

    }

    public static function camposet($campo,$tabla){
    	$nuevaConexion=new Conexion();
    	$conexion=$nuevaConexion->getConexion();
    	$sentencia="SHOW COLUMNS FROM $tabla LIKE '$campo'";
    	$query=$conexion->query($sentencia);
    	$result = mysqli_fetch_assoc($query);
    	$result=$result['Type'];
    	$result=substr($result, 5, strlen($result)-5);
    	$result=substr($result, 0, strlen($result)-2);
    	$result = explode("','",$result);
    	return $result;
    }



	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM SubTipoInforme";
		if($this->subTipoId!=NULL || $this->tipoId!=NULL || $this->nombre!=NULL || $this->descripcion!=NULL 	|| $this->estado!=NULL || $this->fechaModif!=NULL || $this->userModif!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->subTipoId!=NULL)
		{
			$sentencia.=" subTipoId = $this->subTipoId && ";
		}

		if($this->tipoId!=NULL)
		{
			$sentencia.=" tipoId = $this->tipoId && ";
		}

		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre=$this->nombre && ";
		}

		if($this->descripcion!=NULL)
		{
			$sentencia.=" descripcion = $this->descripcion && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" estado=$this->estado && ";
		}

		if($this->fechaModif!=NULL)
		{
			$sentencia.=" fechaModif=$this->fechaModif && ";
		}

		if($this->userModif!=NULL)
		{
			$sentencia.=" userModif='$this->userModif' && ";
		}



		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY subTipoId ASC";
		//if(isset($limit)){
			//$sentencia.=" LIMIT ".$limit;
		//}
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

if(isset($_POST["opcion"])){
	$subTipo=new SubTipoInforme(NULL,$_POST["opcion"]);
	$buscarSubTipo=$subTipo->buscar();
	//$lista=array();
	$indiceFila=0;
	$indiceColumna=0;
	//$resultado="";
	if(mysqli_num_rows($buscarSubTipo)>0) {
		$resultado="<select class='form-control' id='subtipo' name='subtipo' >";
		$resultado.="<option selected value='0'>Seleccione</option>";
		while($fila = mysqli_fetch_object($buscarSubTipo))
		{
			$resultado.="<option value='".$fila->subTipoId."'>".$fila->nombre."</option>";
		}
		//echo json_encode($lista);
		$resultado.="</select>";
	}

	echo $resultado;
}
