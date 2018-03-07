
<?php

include_once('conexion.php');
include_once("maestro.php");

class Dispositivo
{
	private $estadisAccesoId;
 	private $referenteId;
 	private $fechaHoraAcceso;
	private $dispositivo;
 	


function __construct($estadisAccesoId=NULL,$referenteId=NULL,$fechaHoraAcceso=NULL,$dispositivo=NULL)
	{
		$this->estadisAccesoId = $estadisAccesoId;
 		$this->referenteId = $referenteId;
 		$this->fechaHoraAcceso =$fechaHoraAcceso;
		$this->dispositivo = $dispositivo;
 		
	}


	public function agregar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="INSERT INTO estadisAcceso (estadisAccesoId,referenteId,fechaHoraAcceso,dispositivo)
		VALUES (NULL,'". $this->referenteId."','". $this->fechaHoraAcceso."','".$this->dispositivo."');";



		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}


/*
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

   
*/
	public function buscar($limit=null,$fechaIni=NULL,$fechaFin=NULL,$disp=NULL,$perfil=NULL)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT estadisAccesoId,fechaHoraAcceso,dispositivo,personas.apellido,personas.nombre,referentes.tipo FROM estadisAcceso JOIN referentes ON (estadisAcceso.referenteId = referentes.referenteId) JOIN personas ON ( referentes.personaId = personas.personaId) WHERE estadisAcceso.referenteId != 1 ";

		if ((isset($fechaIni)) && (isset($fechaFin))){

			$sentencia.=" && CAST(fechaHoraAcceso AS DATE) BETWEEN '".$fechaIni."' AND '".$fechaFin."'";
		}
		if ((isset($fechaIni)) &&(!isset($fechaFin))) {

			$sentencia.=" && CAST(fechaHoraAcceso AS DATE) = '".$fechaIni."'";
		}
		if (isset($disp)){

			$sentencia.=" && estadisAcceso.dispositivo = '".$disp."'";

		}

		if (isset($perfil)){

			$sentencia.=" && referentes.tipo = '".$perfil."'";

		}


		
		if($this->estadisAccesoId!=NULL || $this->referenteId!=NULL || $this->fechaHoraAcceso!=NULL || $this->dispositivo!=NULL)
		{
			 $sentencia.=" && ";


		if($this->estadisAccesoId!=NULL)
		{
			$sentencia.=" estadisAccesoId = $this->estadisAccesoId && ";
		}

		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId = $this->referenteId && ";
		}

		if($this->fechaHoraAcceso!=NULL)
		{
			$sentencia.=" fechaHoraAcceso=$this->fechaHoraAcceso && ";
		}

		if($this->dispositivo!=NULL)
		{
			$sentencia.=" dispositivo = $this->dispositivo && ";
		}

		
		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY estadisAccesoId DESC";
		if(isset($limit)){
		 $sentencia.=" LIMIT ".$limit;
		  }
		//echo $sentencia;
		return $conexion->query($sentencia);

	}



	


/*
	public function __get($var)
	{
		return $this->$var;

	}


	public function __set($var,$valor)
	{
		$this->$var=$valor;
	}
*/
}
