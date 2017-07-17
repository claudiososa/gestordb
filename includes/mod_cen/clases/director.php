<?php



class Director
{
	private $directorId;
 	private $escuelaId;
 	private $personaId;
 	private $tipocargo;
	private $tipoautoridad;
	private $persona;
 	function __construct($directorId=NULL,$escuelaId=NULL,$personaId=NULL,$tipocargo=NULL,$tipoautoridad=NULL)
	{
			 //seteo los atributos
		 	$this->directorId = $directorId;
		 	$this->escuelaId = $escuelaId;
		 	$this->personaId = $personaId;
		 	$this->tipocargo =$tipocargo;
			$this->tipoautoridad =$tipoautoridad;

	}

	public function agregar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="INSERT INTO directores (escuelaId,personaId,tipocargo)
		VALUES (".$this->escuelaId.",".$this->personaId.",'". $this->tipocargo."');";

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


		$sentencia="UPDATE directores SET personaId = '$this->personaId', tipocargo = '$this->tipocargo' WHERE directorId = '$this->directorId'";
		//,direccion = '$this->direccion',facebook = '$this->facebook' WHERE personaId = '$this->personaId'

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{

			/*$consulta="SELECT * FROM directores WHERE personaId<>'$this->personaId' AND dni='$this->dni'";

			if (mysqli_num_rows($conexion->query($consulta))>0)
			{
				echo "El DNI, ingresado ya existe"."<br><br>";
				echo "<a href='?men=personas&id=3&personaId=".$this->personaId."'>Regresar</a>";

			}
			$consulta="SELECT * FROM personas WHERE personaId<>'$this->personaId' AND cuil='$this->cuil'";
			$resultado=$conexion->query($consulta);
			if (mysqli_num_rows($conexion->query($consulta))>0)
			{
				echo "El CUIL, ingresado ya existe"."<br><br>";
				echo "<a href='?men=personas&id=3&personaId=".$this->personaId."'>Regresar</a>";
			}	*/
			//return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM directores WHERE directorId=".$this->directorId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}
	public static function existeAutoridad($escuelaId)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT directorId,escuelaId,personaId,directores.tipoautoridad_id,tipoautoridad FROM directores left join tipoautoridad on directores.tipoautoridad_id=tipoautoridad.tipoautoridad_id where escuelaId=".$escuelaId;
		return $conexion->query($sentencia);

	}
	public static function existeAutoridadIdDirector($directorId)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT directorId,personaId,tipocargo,escuelaId FROM directores where directorId=".$directorId;
		return $conexion->query($sentencia);

	}
	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT directores.directorId,directores.escuelaId,directores.personaId,directores.tipoautoridad_id,tipoautoridad,
		 personas.nombre,personas.apellido,personas.telefonoM,personas.telefonoC,personas.email
		FROM directores
		left join tipoautoridad
		on directores.tipoautoridad_id=tipoautoridad.tipoautoridad_id
		join personas
		on directores.personaId=personas.personaId";
		if($this->directorId!=NULL || $this->escuelaId!=NULL)
		{
			$sentencia.=" WHERE ";

		}
		if($this->directorId!=NULL)
		{
			$sentencia.=" directorId = $this->directorId && ";
		}

		if($this->escuelaId!=NULL)
		{
			$sentencia.=" escuelaId = $this->escuelaId && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		//echo $sentencia;


		return $conexion->query($sentencia);

	}



   public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM personas WHERE personaId=".$this->personaId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->personaId = $elemento->personaId;
	 	$this->apellido = $elemento->apellido;
	 	$this->nombre = $elemento->nombre;
	 	$this->dni = $elemento->dni;
	 	$this->cuil = $elemento->cuil;
	 	$this->telefonoC = $elemento->telefonoC;
	 	$this->telefonoM = $elemento->telefonoM;
	 	$this->direccion = $elemento->direccion;
	 	$this->email = $elemento->email;
	 	$this->email2 = $elemento->email2;
	 	$this->facebook = $elemento->facebook;
	 	$this->twitter = $elemento->twitter;
	 	$this->localidadId = $elemento->localidadId;
	 	$this->cpostal = $elemento->cpostal;
		return $this;

    }

   public function getNombre()
   {
		return $this->nombre;
	}

	public function getApellido()
   {
		return $this->apellido;
	}

	public function getDni()
   {
		return $this->dni;
	}

	public function getCuil()
   {
		return $this->cuil;
	}

	public function getEmail()
   {
		return $this->email;
	}

	public function getEmail2()
   {
		return $this->email2;
	}

	public function getTelefonoM()
   {
		return $this->telefonoM;
	}

	public function getTelefonoC()
   {
		return $this->telefonoC;
	}

	public function getDireccion()
   {
		return $this->direccion;
	}

	public function getFacebook()
   {
		return $this->facebook;
	}

	public function getTwitter()
   {
		return $this->twitter;
	}

	public function getLocalidadId()
   {
		return $this->localidadId;
	}

	public function getCpostal()
   {
		return $this->cpostal;
	}
}

include_once('persona.php');
if(isset($_POST['opcion']))//llamadas ayax
{
	switch($_POST['opcion'])
	{
		case 'buscarpordni':
			$autoridad = new persona(null,null,null,$_POST['dni']);
			$persona=$autoridad->buscar();
			$fila = mysqli_fetch_object($persona);
			if($fila){
				$data=$fila;
				echo json_encode($data);//envio como objeto json
			}
			else
			{
				echo 0;
			}
			break;

	}
}
?>
