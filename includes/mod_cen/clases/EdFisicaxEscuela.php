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


   // buscar

public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM Ed_Fisica_Escuela";
		if($this->id_Ed_Fisica!=NULL || $this->personaId!=NULL || $this->escuelaId!=NULL || $this->turno!=NULL || $this->nivel!=NULL || $this->cant_horas_semanal!=NULL || $this->tipoCargo!=NULL || $this->grado_año!=NULL || $this->seccion_division!=NULL || $this->titulo!=NULL)
		{
			$sentencia.=" WHERE ";


		if($this->id_Ed_Fisica!=NULL)
		{
			$sentencia.=" id_Ed_Fisica=$this->id_Ed_Fisica && ";		}


		if($this->personaId!=NULL)
		{
			$sentencia.=" personaId=$this->personaId && ";		}	
		
		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId=$this->escuelaId && ";		}

		if($this->turno!=NULL)
		{
			$sentencia.=" turno=$this->turno && ";
		}

		if($this->nivel!=NULL)
		{
			$sentencia.=" nivel=$this->nivel && ";
		}

		if($this->cant_horas_semanal!=NULL )
		{
			$sentencia.=" cant_horas_semanal=$this->cant_horas_semanal && ";
		}


		if($this->tipoCargo!=NULL)
		{
			$sentencia.=" tipoCargo=$this->tipoCargo && ";
		}


		if($this->grado_año!=NULL)
		{
			$sentencia.=" grado_año=$this->grado_año && ";
		}
		if($this->seccion_division!=NULL)
		{
			$sentencia.=" seccion_division=$this->seccion_division && ";
		}

		if($this->titulo!=NULL)
		{
			$sentencia.=" titulo=$this->titulo && ";
		}


		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY id_Ed_Fisica";

		//echo $sentencia;
		return $conexion->query($sentencia);

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
} // fin de la CLASE

/**
 * AL PRESIONAR BUSCAR PROFESOR
 */
/*
if (isset($_POST['dni'])) {
	include_once('persona.php');
	$persona= new Persona(null,null,null,$_POST['dni']);
	$datoPersona = $persona->buscar();
	$cantidadPersona=mysqli_num_rows($datoPersona);


	//$datoCurso=2;
		$estado= [];
	if ($cantidadPersona > 0) {

		$dato = mysqli_fetch_object($datoPersona);

		$profesor = new Profesores(null,$dato->personaId,$_POST['escuelaId']);

		$datoProfesor = $profesor->buscar('cantidad');
		//Maestro::debbugPHP($datoProfesor);
		if ($datoProfesor == 0 ) {
			$temporal=array('personaId'=>$dato->personaId,
											'dni'=>$dato->dni,
											'nombre'=>$dato->nombre,
											'apellido'=>$dato->apellido,
											'telefono'=>$dato->telefonoM,
											'email'=>$dato->email,
											'cuil'=>$dato->cuil
											);
			array_push($estado,$temporal);
		}else{
			$temporal=array('dni'=>'existe');
			array_push($estado,$temporal);
		}


	}else{
		$temporal=array('dni'=>'error');
		array_push($estado,$temporal);
	}
	$json = json_encode($estado);
	//Maestro::debbugPHP($json);
	echo $json;
}
*/
?>