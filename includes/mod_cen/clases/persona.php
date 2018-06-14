<?php

include_once('conexion.php');
include_once('conexionv2.php');
include_once('maestro.php');

class Persona
{
	private $personaId;
 	private $apellido;
 	private $nombre;
 	private $dni;
 	private $cuil;
 	private $telefonoC;
	private $telefonoM;
	private $direccion;
 	private $email;
 	private $email2;
 	private $facebook;
 	private $twitter;
 	private $localidadId;
 	private $cpostal;
 	private $ubicacion;
 	private $fotoPerfil;

 	function __construct($personaId=NULL,$apellido=NULL,$nombre=NULL,$dni=NULL,$cuil=NULL,$telefonoC=NULL,$telefonoM=NULL,$direccion=NULL,$email=NULL,$email2=NULL,$facebook=NULL,$twitter=NULL,$localidadId=NULL,$cpostal=NULL,$ubicacion=NULL,$fotoPerfil=NULL)
	{
			 //seteo los atributos
		 	$this->personaId = $personaId;
		 	$this->apellido = $apellido;
		 	$this->nombre = $nombre;
		 	$this->dni =$dni;
		 	$this->cuil =$cuil;
		 	$this->telefonoC = $telefonoC;
		 	$this->telefonoM = $telefonoM;
		 	$this->direccion = $direccion;
		 	$this->email = $email;
		 	$this->email2 = $email2;
		 	$this->facebook = $facebook;
		 	$this->twitter = $twitter;
		 	$this->localidadId = $localidadId;
		 	$this->cpostal = $cpostal;
		 	$this->ubicacion = $ubicacion;
		 	$this->fotoPerfil = $fotoPerfil;
	}

	public function update()
	{
		$bd=Conexion2::getInstance();
		$sentencia="UPDATE personas SET
		 									apellido = '$this->apellido',
											nombre = '$this->nombre',
											dni = '$this->dni',
											cuil = '$this->cuil',
											telefonoC = '$this->telefonoC',
											telefonoM = '$this->telefonoM',
											direccion = '$this->direccion',
											email = '$this->email',
											email2 = '$this->email2',
											facebook = '$this->facebook',
											twitter = '$this->twitter',
											localidadId = '$this->localidadId',
											cpostal = '$this->cpostal',
											ubicacion = '$this->ubicacion',
											fotoPerfil = '$this->fotoPerfil'
											WHERE personaId = '$this->personaId'";
			//Maestro::debbugPHP($sentencia);
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoRegistroId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }

	}

	public function updateShort()
	{
		$bd=Conexion2::getInstance();
		$sentencia="UPDATE personas SET
		 									apellido = '$this->apellido',
											nombre = '$this->nombre',
											cuil = '$this->cuil',
											telefonoM = '$this->telefonoM',
											email = '$this->email',
											localidadId = '$this->localidadId'
											WHERE personaId = '$this->personaId'";
			//Maestro::debbugPHP($sentencia);
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoRegistroId=$this->personaId;
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }

	}

	public function addShort()
	{
		//$sentencia = 'personas';

		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO personas (personaId,apellido,nombre,dni,cuil,telefonoC,
																							telefonoM,direccion,
																							email,email2,facebook,twitter,localidadId,cpostal,ubicacion)
		            VALUES (NULL,
                        '". $this->apellido."',
												'". $this->nombre."',
												'". $this->dni."',
												'". $this->cuil."',
												'',
												'". $this->telefonoM."',
												'',
												'". $this->email."',
												'',
												'',
												'',
												'". $this->localidadId."',
												'',
												'');";



		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoRegistroId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
		 
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO personas (personaId,apellido,nombre,dni,cuil,telefonoC,
																							telefonoM,direccion,
																							email,email2,facebook,twitter,localidadId,cpostal,ubicacion,fotoPerfil)
		            VALUES (NULL,
                        '". $this->apellido."',
												'". $this->nombre."',
												'". $this->dni."',
												'". $this->cuil."',
												'". $this->telefonoC."',
												'". $this->telefonoM."',
												'". $this->direccion."',
												'". $this->email."',
												'". $this->email2."',
												'". $this->facebook."',
												'". $this->twitter."',
												'". $this->localidadId."',
												'". $this->cpostal."',
												'". $this->ubicacion."',
												'". $this->fotoPerfil."');";

		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoRegistroId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }

		/*
		$stmt = ConexionPdo::getConexion()->prepare("INSERT INTO personas (personaId,apellido,nombre,dni,cuil,telefonoC,telefonoM,direccion,
																							email,email2,facebook,twitter,localidadId,cpostal,ubicacion)
		VALUES (null,:apellido,:nombre,:dni,:cuil,:telefonoC,:telefonoM,:direccion,:email,:email2,:facebook,:twitter,:localidadId,:cpostal,:ubicacion)");
		Maestro::debbugPHP($stmt);
		$stmt->bindParam(":apellido",$this->apellido,PDO::PARAM_STR);
		$stmt->bindParam(":nombre",$this->nombre,PDO::PARAM_STR);
		$stmt->bindParam(":dni",$this->dni,PDO::PARAM_INT);
		$stmt->bindParam(":cuil",$this->cuil,PDO::PARAM_INT);
		$stmt->bindParam(":telefonoC",$this->telefonoC,PDO::PARAM_STR);
		$stmt->bindParam(":telefonoM",$this->telefonoM,PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$this->direccion,PDO::PARAM_STR);
		$stmt->bindParam(":email",$this->email,PDO::PARAM_STR);
		$stmt->bindParam(":email2",$this->email2,PDO::PARAM_STR);
		$stmt->bindParam(":facebook",$this->facebook,PDO::PARAM_STR);
		$stmt->bindParam(":twitter",$this->twitter,PDO::PARAM_STR);
		$stmt->bindParam(":localidadId",$this->localidadId,PDO::PARAM_INT);
		$stmt->bindParam(":cpostal",$this->cpostal,PDO::PARAM_INT);
		$stmt->bindParam(":ubicacion",$this->ubicacion,PDO::PARAM_STR);


		//$nuevaConexion=new Conexion();
		//$conexion=$nuevaConexion->getConexion();

		//$sentencia="INSERT INTO personas (personaId,apellido,nombre,dni,cuil,telefonoC,telefonoM,direccion,email,email2,facebook,twitter,localidadId,cpostal,ubicacion)
		//VALUES (NULL,'". $this->apellido."','". $this->nombre."','". $this->dni."','".$this->cuil."','". $this->telefonoC."','". $this->telefonoM."','". $this->direccion."','". $this->email."','". $this->email2."','". $this->facebook."','". $this->twitter."','". $this->localidadId."','". $this->cpostal."','". $this->ubicacion."');";

	/*	if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

		if($stmt->execute()){
			//return $stmt->lastInsertId();
			return "guardado";
		} else{
			return "Error al guardar";
		}
  */
	}

	public function editar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="UPDATE personas SET apellido = '$this->apellido',
																		nombre = '$this->nombre',
																		dni = '$this->dni',
																		cuil = '$this->cuil',
																		telefonoC = '$this->telefonoC',
																		telefonoM = '$this->telefonoM',
																		direccion = '$this->direccion',
																		email = '$this->email',
																		email2 = '$this->email2',
																		facebook = '$this->facebook',
																		twitter = '$this->twitter',
																		localidadId = '$this->localidadId',
																		cpostal = '$this->cpostal',
																		ubicacion = '$this->ubicacion',
																		fotoPerfil = '$this->fotoPerfil'
																	WHERE personaId = '$this->personaId'";
		//,direccion = '$this->direccion',facebook = '$this->facebook' WHERE personaId = '$this->personaId'
		//return $sentencia;
		if ($conexion->query($sentencia)) {
			return $sentencia;
		}else
		{
			$consulta="SELECT * FROM personas WHERE personaId<>'$this->personaId' AND dni='$this->dni'";

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
			}
			//return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM personas WHERE personaId=".$this->personaId;
		if ($conexion->query($sentencia)) {
			header("Location:index.php?id=1");

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM personas";
		if($this->personaId!=NULL || $this->apellido!=NULL || $this->nombre!=NULL || $this->dni!=NULL || $this->cuil!=NULL || $this->telefonoC!=NULL || $this->telefonoM!=NULL || $this->direccion=NULL || $this->email!=NULL || $this->email2!=NULL || $this->facebook!=NULL || $this->twitter!=NULL || $this->localidadId!=NULL || $this->cpostal!=NULL )
		{
			$sentencia.=" WHERE ";

		if($this->personaId!=NULL)
		{
			$sentencia.=" personaId=$this->personaId && ";
		}


		if($this->apellido!=NULL)
		{
			$sentencia.=" apellido LIKE '%$this->apellido%' && ";
		}

		if($this->nombre!=NULL)
		{
			$sentencia.=" nombre LIKE '%$this->nombre%' && ";
		}

		if($this->dni!=NULL)
		{
			$sentencia.=" dni = '$this->dni' && ";
		}

		if($this->cuil!=NULL)
		{
			$sentencia.=" cuil LIKE '%$this->cuil%' && ";
		}

		if($this->telefonoC!=NULL)
		{
			$sentencia.=" telefonoC LIKE '%$this->telefonoC%' && ";
		}

		if($this->telefonoM!=NULL)
		{
			$sentencia.=" telefonoM LIKE '%$this->telefonoM%' && ";
		}

		if($this->direccion!=NULL)
		{
			$sentencia.=" direccion LIKE '%$this->direccion%' && ";
		}

		if($this->email!=NULL)
		{
			$sentencia.=" email LIKE '%$this->email%' && ";
		}

		if($this->email2!=NULL)
		{
			$sentencia.=" email2 LIKE '%$this->email2%' && ";
		}

		if($this->facebook!=NULL)
		{
			$sentencia.=" facebook LIKE '%$this->facebook%' && ";
		}

		if($this->twitter!=NULL)
		{
			$sentencia.=" twitter LIKE '%$this->twitter%' && ";
		}

		if($this->localidadId>1)
			{
			$localidad= new Localidad(null,null,$this->localidadId);
			$resultado1=$localidad->buscar();

				while($fila1=mysqli_fetch_object($resultado1))
				{
					$sentencia.=" localidadId=$fila1->localidadId || ";
	     		}
			}

		if($this->cpostal!=NULL)
		{
			$sentencia.=" cpostal LIKE '%$this->cpostal%' && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY apellido,nombre";
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
	 	$this->ubicacion = $elemento->ubicacion;
	 	$this->fotoPerfil = $elemento->fotoPerfil;
		return $this;

    }

	public function getPersonaId()
   {
		return $this->personaId;
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

	public function getUbicacion()
	{
		return $this->ubicacion;
	}
	
	public function getFotoPerfil()
	{
		return $this->fotoPerfil;
	}
}
?>
