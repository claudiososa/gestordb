<?php

include_once('conexion.php');

class EdFisicaxEscuela
{
	private $id_Ed_Fisica;
	private $personaId;
	private $escuelaId;
	private $turno;	
	private $nivel;
	private $cant_horas_semanal;
 	private $tipoCargo;
 	private $grado_año;
 	private $seccion_division;
 	private $titulo;

 	function __construct($id_Ed_Fisica=NULL,$personaId=NULL,$escuelaId=NULL,$turno=NULL,$nivel=NULL,$cant_horas_semanal=NULL,$tipoCargo=NULL,$grado_año=NULL,$seccion_division=NULL,$titulo=NULL)
	{
			 //seteo los atributos
			$this->id_Ed_Fisica = $id_Ed_Fisica;
			$this->personaId = $personaId;
			$this->escuelaId = $escuelaId;
			$this->turno = $turno;
			$this->nivel = $nivel;
		 	$this->cant_horas_semanal = $cant_horas_semanal;
		 	$this->tipoCargo = $tipoCargo;
		 	$this->grado_año = $grado_año;
		 	$this->seccion_division = $seccion_division;
		 	$this->titulo = $titulo;
	}

	public function agregar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO  Ed_Fisica_Escuela (id_Ed_Fisica,personaId,escuelaId,turno,nivel,cant_horas_semanal,tipoCargo,grado_año,seccion_division,titulo)
		VALUES (NULL,'". $this->personaId."','". $this->escuelaId."','". $this->turno."','".$this->nivel."','".$this->cant_horas_semanal."','".$this->tipoCargo."','".$this->grado_año."','".$this->seccion_division."','".$this->titulo."');";
    //echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

 /*	public function editar()
	{ 

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

    $sentencia = "UPDATE rtixescuela SET turno=$this->turno, estado=$this->estado  WHERE escuelaId=$this->escuelaId AND rtiID=$this->rtiId";

		//$sentencia="UPDATE rtixescuela SET personaId = '$this->personaId', titulo = '$this->titulo', capacitacionTec = '$this->capacitacionTec', capacitacionPed = '$this->capacitacionPed' WHERE rtiId = '$this->rtiId'";
    //echo $sentencia;
		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM rtixescuela";
		if($this->escuelaId!=NULL || $this->rtiId!=NULL || $this->turno!=NULL || $this->ingreso!=NULL || $this->estado!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId=$this->escuelaId && ";		}

		if($this->rtiId!=NULL)
		{
			$sentencia.=" rtiId =$this->rtiId && ";
		}

		if($this->turno!=NULL)
		{
			$sentencia.=" turno LIKE '%$this->turno%' && ";
		}

		if($this->ingreso!=NULL)
		{
			$sentencia.=" ingreso LIKE '%$this->ingreso%' && ";
		}

		if($this->estado!=NULL)
		{
			$sentencia.=" estado LIKE '%$this->estado%' && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY escuelaId";

		//echo $sentencia;
		return $conexion->query($sentencia);

	}

	public function Cargo()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		//$sentencia="SELECT * FROM rti WHERE referenteId=".$this->referenteId;
		$sentencia="SELECT cargos.escuelaId,cargos.turno,rti.rtiId,rti.personaId,personas.nombre,personas.apellido,personas.telefonoM FROM cargos inner join rti on cargos.rtiId=rti.rtiId inner join personas on rti.personaId=personas.personaId WHERE escuelaId=".$this->escuelaId;
		//echo $sentencia;
		//echo $this->referenteId;
		return $conexion->query($sentencia);
    }



   public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM rtixescuela WHERE escuelaId=".$this->escuelaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->rtiId = $elemento->rtiId;
	 	$this->turno = $elemento->turno;
	 	$this->ingreso = $elemento->ingreso;
	 	$this->estado = $elemento->estado;

		return $this;

    }

	public function getRtiId()
   {
		return $this->rtiId;
	}

	public function getTurno()
   {
		return $this->turnoId;
	}

	public function getIngreso()
   {
		return $this->ingreso;
	}

	public function getEstado()
	{
		return $this->estado;
	}
*/
}
?>