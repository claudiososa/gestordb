<?php
include_once('conexionv2.php');
include_once('conexion.php');
include_once('persona.php');
class Rtixinstitucion
{
	private $rtiId;
 	private $personaId;
	private $escuelaId;
	private $turno;
	private $estado;
 	private $titulo;
 	private $capacitacionTec;
 	private $capacitacionPed;
	function __construct($rtiId=NULL,$personaId=NULL,$escuelaId=NULL,$turno=NULL,$estado=NULL,$titulo=NULL,$capacitacionTec=NULL,$capacitacionPed=NULL)
	{
			 //seteo los atributos
		 	$this->escuelaId = $escuelaId;
		 	$this->turno = $turno;
		 	$this->estado = $estado;
			$this->personaId = $personaId;
		 	$this->rtiId = $rtiId;
		 	$this->titulo = $titulo;
		 	$this->capacitacionTec = $capacitacionTec;
		 	$this->capacitacionPed = $capacitacionPed;
	}

}
class Rti
{
	private $rtiId;
 	private $personaId;
 	private $titulo;
 	private $capacitacionTec;
 	private $capacitacionPed;

 	function __construct($rtiId=NULL,$personaId=NULL,$titulo=NULL,$capacitacionTec=NULL,$capacitacionPed=NULL)
	{
			 //seteo los atributos
		 	$this->personaId = $personaId;
		 	$this->rtiId = $rtiId;
		 	$this->titulo = $titulo;
		 	$this->capacitacionTec = $capacitacionTec;
		 	$this->capacitacionPed = $capacitacionPed;
	}

	public static function existeRtixinstitucion($escuelaId,$rtiId=NULL,$personaId=NULL)//agregada por arredes
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		if(!isset($rtiId))
		{
			$sentencia="SELECT 	rti.rtiId,escuelaId,rti.personaId,personas.dni,personas.apellido,personas.nombre,personas.telefonoC,personas.telefonoM,personas.email,rtixescuela.turno,rtixescuela.estado,personas.cpostal
			FROM (rtixescuela
			LEFT JOIN rti
			ON rtixescuela.rtiId=rti.rtiId)
			LEFT JOIN personas
			ON rti.personaId=personas.personaId
			WHERE rtixescuela.escuelaId=".$escuelaId." order by personas.apellido,personas.nombre";
		}else{
			$sentencia="SELECT 	rti.rtiId,escuelaId,rti.personaId,personas.dni,personas.apellido,personas.nombre,personas.telefonoC,personas.telefonoM,personas.email,rtixescuela.turno,rtixescuela.estado,personas.cpostal
			FROM rtixescuela
			JOIN rti
			ON (rti.rtiId=".$rtiId.")
			JOIN personas
			ON (personas.personaId=rti.personaId)
			WHERE rtixescuela.rtiId=".$rtiId." order by personas.apellido,personas.nombre";
		}


		return $conexion->query($sentencia);

	}
	public static function rtixId($Id)//agregada por arredes
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$sentencia="SELECT rti.rtiId,escuelaId,rti.personaId,personas.dni,personas.apellido,personas.nombre,personas.direccion,personas.cuil,personas.telefonoC,personas.telefonoM,personas.email,personas.email2,personas.facebook,personas.twitter,personas.localidadId,rtixescuela.turno,rtixescuela.estado,personas.cpostal FROM (rtixescuela left join rti on rtixescuela.rtiId=rti.rtiId) left join personas on rti.personaId=personas.personaId where rtixescuela.rtiId=".$Id;
		return $conexion->query($sentencia);

	}
	public function agregar()
	{
		$bd=Conexion2::getInstance();
		//$nuevaConexion=new Conexion2();
		//$conexion=$nuevaConexion->getConexion();
		$objpersona= new Persona();
		$sentencia="INSERT INTO rti (rtiId,personaId,titulo,capacitacionTec,capacitacionPed)
		VALUES (NULL,'". $this->personaId."','". $this->titulo."','". $this->capacitacionTec."','".$this->capacitacionPed."');";
		//$resultado=;
		if ($bd->ejecutar($sentencia)) {
			$idRti=$bd->lastID();
			return $idRti;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function editar()
	{

		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();


		$sentencia="UPDATE rti SET personaId = '$this->personaId', titulo = '$this->titulo', capacitacionTec = '$this->capacitacionTec', capacitacionPed = '$this->capacitacionPed' WHERE rtiId = '$this->rtiId'";

		if ($conexion->query($sentencia)) {
			return 1;
		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
	}

	public static function quitarRti($rtiId,$escuelaId)
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();
		$eliminarrti="DELETE from rtixescuela where rtiId=".$rtiId." AND escuelaid=".$escuelaId;
		//echo eliminarrti;
		if ($conexion->query($eliminarrti)) {
					return 1;
		}else
		{
				echo "<br>"."Error al ejecutar la sentencia";
		}
	}
	public function eliminar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM rti WHERE rtiId=".$this->rtiId;
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}

	}

	public function delete()
	{
	/*	$nuevaConexion=new Conexion3();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="DELETE FROM rti WHERE rtiId=".$this->rtiId;
		if ($conexion->query($sentencia)) {
			return 1;

		}else
		{
			return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		}
*/
	}

	public function buscar()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM rti";
		if($this->rtiId!=NULL || $this->personaId!=NULL || $this->titulo!=NULL || $this->capacitacionTec!=NULL || $this->capacitacionPed!=NULL)
		{
			$sentencia.=" WHERE ";

		if($this->rtiId!=NULL)
			{
				$sentencia.=" rtiId=$this->rtiId && ";
			}

		if($this->personaId!=NULL)
		{
			$sentencia.=" personaId=$this->personaId && ";
		}

		if($this->titulo!=NULL)
		{
			$sentencia.=" titulo LIKE '%$this->titulo%' && ";
		}

		if($this->capacitacionTec!=NULL)
		{
			$sentencia.=" capacitacionTec LIKE '%$this->capacitacionTec%' && ";
		}

		if($this->capacitacionPed!=NULL)
		{
			$sentencia.=" capacitacionPed LIKE '%$this->capacitacionPed%' && ";
		}

		$sentencia=substr($sentencia,0,strlen($sentencia)-3);

		}

		$sentencia.="  ORDER BY personaId";
		//echo $sentencia;

		return $conexion->query($sentencia);

	}

	public function buscarfull($ape,$nom,$dni,$num_escuela,$cue,$estado)
		{
			$nuevaConexion=new Conexion();
			$conexion=$nuevaConexion->getConexion();



			$sentencia="SELECT  personas.apellido, personas.nombre,
													personas.dni, escuelas.numero,
													escuelas.escuelaId,escuelas.cue, rtixescuela.turno, rtixescuela.estado, personas.telefonoC, personas.telefonoM, personas.email
								 FROM rtixescuela
								JOIN rti
									ON (rtixescuela.rtiId=rti.rtiId)
								JOIN escuelas
									ON (escuelas.escuelaId=rtixescuela.escuelaId)
								JOIN personas
									ON personas.personaId=rti.personaId
							    WHERE ";



			//if($this->rtiId==NULL || $this->personaId!=NULL || $this->titulo!=NULL || $this->capacitacionTec!=NULL || $this->capacitacionPed!=NULL)
			//{




			if($ape!=NULL)
				{

					$sentencia.=" personas.apellido LIKE '$ape%' && ";

				}

			if($nom!=NULL)
			{
				$sentencia.=" personas.nombre LIKE '%$nom%' && ";
			}

			if($dni!=NULL)
			{
				$sentencia.=" personas.dni = $dni && ";
			}

			if($num_escuela!=NULL)
			{
				$sentencia.=" escuelas.numero = $num_escuela && ";
			}

			if($cue!=NULL)
			{
				$sentencia.=" escuelas.cue = $cue && ";
			}
			if($estado!=NULL)
			{
				$sentencia.=" rtixescuela.estado LIKE '$estado'&& ";
			}


			$sentencia=substr($sentencia,0,strlen($sentencia)-3);
			$sentencia.="  ORDER BY personas.apellido";

			//}




			return $conexion->query($sentencia);

		}


   public function getContacto()
	{
		$nuevaConexion=new Conexion();
		$conexion=$nuevaConexion->getConexion();

		$sentencia="SELECT * FROM rti WHERE rtiId=".$this->rtiId;
		$resultado=$conexion->query($sentencia);
		$elemento = mysqli_fetch_object($resultado);
		$this->rtiId = $elemento->rtiId;
	 	$this->personaId = $elemento->personaId;
	 	$this->titulo = $elemento->titulo;
	 	$this->capacitacionTec = $elemento->capacitacionTec;
	 	$this->capacitacionPed = $elemento->capacitacionPed;
		return $this;

    }

   public function getRtiId()
   {
		return $this->rtiId;
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

	public function getDni()
	{
		$persona = new Persona($this->personaId);
		$persona = $persona->getContacto();
		return $persona->getDni();
	}

	public function getTitulo()
   {
		return $this->titulo;
	}

	public function getCapacitacionTec()
   {
		return $this->capacitacionTec;
	}

	public function getCapacitacionPed()
   {
		return $this->capacitacionPed;
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
		case 'editarRtixinstitucion':
			$objpersona= new Persona($_POST['txtidpersona'],$_POST['txtapellido'],$_POST['txtnombre'],$_POST['txtdni'],$_POST['cuil'],$_POST['txttelefono1'],$_POST['txttelefono2'],$_POST['txtdomicilio'],$_POST['txtemail1'],$_POST['txtemail2'],$_POST['txtfacebook'],$_POST['txttwitter'],$_POST['cblocalidad']);
			$objpersona->editar();
			$persona=mysqli_fetch_object($dato_persona);

			Rti::editar();
			if($fila){
				$data=$fila;
				echo json_encode($data);//envio como objeto json
			}
			else
			{
				echo 0;
			}
			break;
			case 'buscarporid':
			$rti =  Rti::rtixId($_POST['idrti']);
			$fila = mysqli_fetch_object($rti );
			if($fila){
				$data=$fila;
				echo json_encode($data);//envio como objeto json
			}
			else
			{
				echo 0;
			}
			break;
			case 'modificarrti':
				$nuevaConexion=new Conexion();
				$conexion=$nuevaConexion->getConexion();
				$grabarrti="UPDATE rtixescuela SET turno='".$_POST['cbturno']."',estado='".$_POST['cbestado']."' WHERE rtiID=".$_POST['idrti'];
				$conexion->query($grabarrti);
				$sentencia="UPDATE personas SET apellido ='".strtoupper($_POST['txtapellido'])."', nombre ='".strtoupper($_POST['txtnombre'])."', dni= ".$_POST['txtdni'].", cuil=".$_POST['txtcuit'].", telefonoC = '".$_POST['txttelefono1']."', telefonoM = '".$_POST['txttelefono2']."', direccion= '".strtoupper($_POST['txtdomicilio'])."', email = '".$_POST['txtemail1']."', email2 = '".$_POST['txtemail2']."', facebook = '".$_POST['txtfacebook']."', twitter = '".$_POST['txttwitter']."', localidadId = ".round($_POST['cblocalidad'],0).", cpostal = '".$_POST['txtcp']."' WHERE personaId =".$_POST['txtidpersona'];
				if ($conexion->query($sentencia)) {
					echo 1;
                }else
				{
					echo "<br>"."Error al ejecutar la sentencia";
				}

			break;
			case 'registrarrti':
				$idpersona=0;
				$nuevaConexion=new Conexion();
				$conexion=$nuevaConexion->getConexion();
				if(trim($_POST['txtidpersona'])!=""){//Si existe la persona en la base
					$sentencia="UPDATE personas SET apellido ='".strtoupper($_POST['txtapellido'])."', nombre ='".strtoupper($_POST['txtnombre'])."', dni= ".$_POST['txtdni'].", cuil=".$_POST['txtcuit'].", telefonoC = '".$_POST['txttelefono1']."', telefonoM = '".$_POST['txttelefono2']."', direccion= '".strtoupper($_POST['txtdomicilio'])."', email = '".$_POST['txtemail1']."', email2 = '".$_POST['txtemail2']."', facebook = '".$_POST['txtfacebook']."', twitter = '".$_POST['txttwitter']."', localidadId = ".round($_POST['cblocalidad'],0).", cpostal = '".$_POST['txtcp']."' WHERE personaId =".$_POST['txtidpersona'];
					$idpersona=$_POST['txtidpersona'];
					if ($conexion->query($sentencia)) {
							echo 1;
					}else
					{
						echo "<br>"."Error al ejecutar la sentencia fffff";
					}
				}
				else//No existe la persona en la base de datos
					{
						$grabarpersona="INSERT INTO personas (apellido,nombre,dni,cuil,telefonoC,telefonoM,direccion,email,email2,facebook,twitter,localidadId,cpostal) VALUES ('". strtoupper($_POST['txtapellido'])."','". strtoupper($_POST['txtnombre'])."',". $_POST['txtdni'].",".$_POST['txtcuit'].",'". $_POST['txttelefono1']."','". $_POST['txttelefono2']."','". strtoupper($_POST['txtdomicilio'])."','". $_POST['txtemail1']."','". $_POST['txtemail2']."','".$_POST['txtfacebook']."','". $_POST['txttwitter']."',".round($_POST['cblocalidad'],0).",'". $_POST['txtcp']."')";
						$conexion->query($grabarpersona);
						$idpersona=mysqli_insert_id($conexion);

					}

						$grabarrti="INSERT INTO rti (personaId) VALUES (".$idpersona.")";
						$conexion->query($grabarrti);
						$idrti=mysqli_insert_id($conexion);
						$grabarrtinescuela=$sentencia="INSERT INTO rtixescuela (escuelaId,rtiId,turno,estado) VALUES (".$_POST['txtidesacuela'].",".$idrti.",'".$_POST['cbturno']."','".$_POST['cbestado']."')";
						if ($conexion->query($grabarrtinescuela)) {
							echo 1;
						}else
						{
							echo "<br>"."Error al ejecutar la sentencia";
						}


			break;
			case 'eliminarrti':
				$nuevaConexion=new Conexion();
				$conexion=$nuevaConexion->getConexion();
				$eliminarrti="DELETE from rtixescuela where rtiId=".$_POST['idrti']." and escuelaId=".$_POST['txtidesacuela'];
				if ($conexion->query($eliminarrti)) {
							echo 1;
				}else
				{
					echo "<br>"."Error al ejecutar la sentencia";
				}
			break;


	}
}
?>
