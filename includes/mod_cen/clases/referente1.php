<?php

include_once('conexion.php');
include_once('persona.php');


class Referente
{
	private $referenteId;
 	private $personaId;
 	private $tipo;
 	private $rol;
 	private $etjcargo;
 	private $fechaIngreso;
	private $titulo;
	private $estado;

 	function __construct($referenteId=NULL,$personaId=NULL,$tipo=NULL,$rol=NULL,$etjcargo=NULL,$fechaIngreso=NULL,$titulo=NULL,$estado=NULL)
	{
			 //seteo los atributos
		 	$this->referenteId = $referenteId;
		 	$this->personaId = $personaId;
		 	$this->tipo = $tipo;
		 	$this->rol = $rol;
		 	$this->etjcargo = $etjcargo;
		 	$this->fechaIngreso = $fechaIngreso;
		 	$this->titulo = $titulo;
		 	$this->estado = $estado;
	}

	public function agregar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO referentes (referenteId,personaId,tipo,rol,etjcargo,fechaIngreso,titulo,estado)
		VALUES (NULL,'". $this->personaId."','". $this->tipo."','". $this->rol."','".$this->etjcargo."','". $this->fechaIngreso."','". $this->titulo."','". $this->estado."');";

		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function editar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="UPDATE referentes SET personaId = '$this->personaId', tipo = '$this->tipo', rol = '$this->rol', etjcargo = '$this->etjcargo', fechaIngreso = '$this->fechaIngreso', titulo = '$this->titulo' , estado = '$this->estado' WHERE referenteId = '$this->referenteId'";

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

		$sentencia="DELETE FROM referentes WHERE referenteId=".$this->referenteId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function buscarRef(){
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT * FROM referentes WHERE tipo='ETT' OR tipo='ETJ'";
		return $conexion->query($sentencia);
	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes";
		if($this->referenteId!=NULL ||$this->personaId!=NULL || $this->tipo!=NULL || $this->rol!=NULL || $this->etjcargo!=NULL || $this->fechaIngreso!=NULL || $this->titulo!=NULL || $this->estado!=NULL )
		{
			$sentencia.=" WHERE ";

		if($this->referenteId!=NULL)
		{
			$sentencia.=" referenteId=$this->referenteId && ";
		}

		if($this->personaId!=NULL)
		{
			$sentencia.=" personaId LIKE '%$this->personaId%' && ";
		}

		if($this->tipo!=NULL)
		{
			$sentencia.=" tipo LIKE '%$this->tipo%' && ";
		}

		if($this->rol!=NULL)
		{
			$sentencia.=" rol LIKE '%$this->rol%' && ";
		}

		if($this->etjcargo!=NULL)
		{
			$sentencia.=" etjcargo LIKE '%$this->etjcargo%' && ";
		}

		if($this->fechaIngreso!=NULL)
		{
			$sentencia.=" fechaIngreso LIKE '%$this->fechaIngreso%' && ";
		}

		if($this->titulo!=NULL)
		{
			$sentencia.=" titulo LIKE '%$this->titulo%' && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" estado = '$this->estado' && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY tipo";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}

	public function getTotal()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes WHERE tipo='ETT'";
		$resultado=$conexion->query($sentencia);
		return mysqli_num_rows($resultado);

	}

	public function Cargo($estado=null)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE etjcargo=".$this->referenteId." AND estado='".$estado."'" ;
		//echo $sentencia;
		return $conexion->query($sentencia);
    }


    public function Tipo($tipo=mull,$estado=null)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE tipo='".$tipo."' AND estado='".$estado."'";
		return $conexion->query($sentencia);
    }

    public function DatoPersona()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId WHERE referenteId=".$this->referenteId;
		return $conexion->query($sentencia);
    }

		public function Persona($id)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes inner join personas on referentes.personaId=personas.personaId
		WHERE referenteId=".$id;
		return $conexion->query($sentencia);
    }

  public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM referentes WHERE referenteId=".$this->referenteId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->referenteId = $elemento->referenteId;
	 	$this->personaId = $elemento->personaId;
	 	$this->tipo = $elemento->tipo;
	 	$this->rol = $elemento->rol;
	 	$this->etjcargo = $elemento->etjcargo;
	 	$this->fechaIngreso = $elemento->fechaIngreso;
	 	$this->titulo = $elemento->titulo;
	 	$this->estado = $elemento->estado;
		return $this;

    }


	public function getPersonaId()
	{
		return $this->personaId;
	}

	public function getNombre()
	{
		$persona = new Persona($this->personaId);
		$persona = $persona->getContacto();
		return $persona->getNombre();
	}

	public function getApellido()
	{
		$persona = new Persona($this->personaId);
		$persona = $persona->getContacto();
		return $persona->getApellido();
	}

	public function getTipo()
   {
		return $this->tipo;
	}

	public function getRol()
   {
		return $this->rol;
	}

	public function getEtj()
   {
		return $this->etjcargo;
	}

	public function getFechaIngreso()
   {
		return $this->fechaIngreso;
	}

	public function getTitulo()
   {
		return $this->titulo;
	}

	public function getEstado()
	{
		return $this->estado;
	}

}
?>
