<?php
include_once('conexionv2.php');
include_once("referente.php");
include_once("maestro.php");

class Profesores
{
	private $profesorId;
 	private $personaId;
 	private $escuelaId;

function __construct($profesorId=NULL,
										 $personaId=NULL,
										 $escuelaId=NULL
										 )
	{
		$this->profesorId = $profesorId;
 		$this->personaId = $personaId;
 		$this->escuelaId = $escuelaId;
	}

	public function agregar()
	{
		$bd=Conexion2::getInstance();
		$sentencia="INSERT INTO profesores (profesorId,personaId,escuelaId)
		            VALUES (NULL,
                        ". $this->personaId.",
												". $this->escuelaId.");";

		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoProfesor=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	public function borrar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "DELETE FROM profesores WHERE profesorId=$this->profesorId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
			 	$ultimoRegistro=$bd->lastID();
				return $ultimoRegistro;
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}

	/*public function editar()
	{
		$bd=Conexion2::getInstance();
		$sentencia = "UPDATE Cursos SET fechaUltimaResp='".$this->fechaUltimaResp."' WHERE profesorId=$this->profesorId";
		 if ($bd->ejecutar($sentencia)) {//Ingresa aqui si fue ejecutada la sentencia con exito
				return $ultimoCursoFacilitadoresId=$bd->lastID();
		 }else{
					return $sentencia."<br>"."Error al ejecutar la sentencia".$conexion->errno." :".$conexion->error;
		 }
	}
*/
public function buscar($tipo=null,$limit=null,$order=null)
	{
		$bd=Conexion2::getInstance();
		$sentencia="SELECT *
								FROM profesores
								INNER JOIN personas
								ON profesores.personaId=personas.personaId
								WHERE 1";

		if($this->profesorId!=NULL || $this->personaId!=NULL ||
			$this->escuelaId!=NULL)
		{
			$sentencia.=" AND ";
  		if($this->profesorId!=NULL)
  		{
  			$sentencia.=" profesores.profesorId = $this->profesorId && ";
  		}

  		if($this->personaId!=NULL)
  		{
  			$sentencia.=" profesores.personaId = $this->personaId && ";
  		}

  		if($this->escuelaId!=NULL)
  		{
  			$sentencia.=" profesores.escuelaId=$this->escuelaId && ";
  		}

			$sentencia=substr($sentencia,0,strlen($sentencia)-3);
		}

		  // fin else

		if (!isset($order)) {
			$sentencia.="  ORDER BY profesores.personaId ASC";
		}else{
			$sentencia.="  ORDER BY profesores.personaId ".$order;
		}

		if(isset($limit)){
			$sentencia.=" LIMIT ".$limit;
		}
		//echo $sentencia.'<br><br>';
		//Maestro::debbugPHP($sentencia);

		//Maestro::debbugPHP($sentencia);
		if (isset($tipo)) {
			switch ($tipo) {
				case 'unico':
					$unico = mysqli_fetch_object($bd->ejecutar($sentencia));
					return $unico;
					break;
				case 'total':
							return $bd->ejecutar($sentencia);
						break;
				case 'cantidad':
								$cantidad = mysqli_num_rows($bd->ejecutar($sentencia));
								return $cantidad;
								break;
				default:
					# code...
					break;
			}
		}else{
			return $bd->ejecutar($sentencia);
		}

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

/**
 * AL SELECCIONAR EL BOTON X DE UN PROFESOR DETERMINADO
 */
if (isset($_POST['profesorId'])) {
	$estado= [];
	$profesor= new Profesores($_POST['profesorId']);
	$borrar = $profesor->borrar();

	$profesor2= new Profesores();
	$profesor2->escuelaId=$_POST['escuelaIdBorrar'];

	$total = $profesor2->buscar('cantidad');

	$listaProfesores = $profesor2->buscar('total',null,'DESC');

	while ($fila = mysqli_fetch_object($listaProfesores)) {
		$temporal=array('profesorId'=>$fila->profesorId,
										'nombre'=>$fila->nombre,
										'apellido'=>$fila->apellido);
										//'turno'=>Cursos::turno($fila->turno));
		array_push($estado,$temporal);
	}
	$json = json_encode($estado);
	//Maestro::debbugPHP($json);
	echo $json;

}


/**
 *
 */
if (isset($_POST['botonSaveTeacher'])) {
	//Maestro::debbugPHP($_POST);
		$estado= [];
	//if ($_POST['botonSaveTeacher']=='saveTeacher') {
		include_once('persona.php');
		if ($_POST['statusTeacher']=='create') {
			$persona= new Persona(null,$_POST['surnameTeacher'],
																$_POST['nameTeacher'],
																$_POST['dniTeacher'],
																$_POST['dniTeacher'],
																$_POST['phoneTeacher'],
																$_POST['phoneTeacher'],
																'nada',
																$_POST['emailTeacher'],
																$_POST['emailTeacher'],
																'nada',
																'nada',
																'0001',
																'4400',
																'nada'
															);
			$datoPersona = $persona->agregar();
			$profesor = new Profesores(null,$datoPersona,$_POST['escuelaId']);
			$datoProfesor = $profesor->agregar();

			$profesor2 = new Profesores(null,null,$_POST['escuelaId']);

			$buscarProfesor=$profesor2->buscar();

			while ($fila = mysqli_fetch_object($buscarProfesor)) {
				$temporal=array('profesorId'=>$fila->profesorId,
												'nombre'=>$fila->nombre,
												'apellido'=>$fila->apellido);
				array_push($estado,$temporal);
			}

		}else{
			$persona= new Persona($_POST['personaId'],
																$_POST['surnameTeacher'],
																$_POST['nameTeacher'],
																$_POST['dniTeacher'],
																$_POST['cuilTeacher'],
																null,
																$_POST['phoneTeacher'],
																null,
																$_POST['emailTeacher'],
																null,
																null,
																null,
																'0001',
																'4400',
																null
															);
					$datoPersona = $persona->update();

					$profesor = new Profesores(null,$_POST['personaId'],$_POST['escuelaId']);
					$datoProfesor = $profesor->agregar();

					$profesor2 = new Profesores(null,null,$_POST['escuelaId']);

					$buscarProfesor=$profesor2->buscar();

					while ($fila = mysqli_fetch_object($buscarProfesor)) {
						$temporal=array('profesorId'=>$fila->profesorId,
														'nombre'=>$fila->nombre,
														'apellido'=>$fila->apellido);
						array_push($estado,$temporal);
					}

		}

		$json = json_encode($estado);
		//Maestro::debbugPHP($json);
		echo $json;
}

/**
 * AL PRESIONAR BUSCAR PROFESOR
 */

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